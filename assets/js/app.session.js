(function($) {
    'use strict';

    var cfg = window.PATOPS_SESSION || {};
    var SessionGuard = {
        pingUrl: cfg.pingUrl || '',
        logoutUrl: cfg.logoutUrl || '',
        ttl: parseInt(cfg.ttl, 10) || 7200,
        warnBefore: parseInt(cfg.warnBefore, 10) || 300,
        testMode: !!cfg.testMode,
        checkEveryMs: 180000,
        activityKeepMs: 120000,
        remaining: null,
        warningShown: false,
        redirecting: false,
        countdownTimer: null,
        checkTimer: null,
        tickTimer: null,
        lastKeepSent: 0,
        lastActivityAt: Date.now(),

        formatTime: function(sec) {
            sec = Math.max(0, parseInt(sec, 10) || 0);
            var m = Math.floor(sec / 60);
            var s = sec % 60;
            return (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
        },

        ensureModal: function() {
            var $modal = $('#sessionTimeoutModal');
            if ($modal.length && $modal.parent()[0] !== document.body) {
                $modal.appendTo('body');
            }
            return $modal;
        },

        goLogout: function(message) {
            if (SessionGuard.redirecting) {
                return;
            }
            SessionGuard.redirecting = true;
            SessionGuard.stop();
            if (message) {
                try {
                    alert(message);
                } catch (e) {}
            }
            window.location.href = SessionGuard.logoutUrl || '/user/logout';
        },

        showWarning: function() {
            var rem = SessionGuard.localRemaining();
            SessionGuard.remaining = rem;
            var $modal = SessionGuard.ensureModal();

            if (!SessionGuard.warningShown) {
                SessionGuard.warningShown = true;
                if ($modal.length && typeof $modal.modal === 'function') {
                    $modal.css('z-index', 20000);
                    try {
                        $modal.modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });
                        $('.modal-backdrop').last().css('z-index', 19999);
                    } catch (e) {}
                }
                if (SessionGuard.testMode) {
                    // fallback supaya uji cepat tidak “senyap”
                    try {
                        console.warn('[SessionGuard] WARNING remaining=' + rem + 's');
                    } catch (e2) {}
                }
            }

            $('#sessionTimeoutCountdown').text(SessionGuard.formatTime(rem));
            SessionGuard.startCountdownDisplay();
        },

        hideWarning: function() {
            SessionGuard.warningShown = false;
            if (SessionGuard.countdownTimer) {
                clearInterval(SessionGuard.countdownTimer);
                SessionGuard.countdownTimer = null;
            }
            var $modal = $('#sessionTimeoutModal');
            if ($modal.length && typeof $modal.modal === 'function') {
                $modal.modal('hide');
            }
        },

        startCountdownDisplay: function() {
            if (SessionGuard.countdownTimer) {
                clearInterval(SessionGuard.countdownTimer);
            }
            var tick = function() {
                var rem = SessionGuard.localRemaining();
                SessionGuard.remaining = rem;
                $('#sessionTimeoutCountdown').text(SessionGuard.formatTime(rem));
                var pct = SessionGuard.warnBefore > 0
                    ? Math.max(0, Math.min(100, (rem / SessionGuard.warnBefore) * 100))
                    : 0;
                $('#sessionTimeoutBar').css('width', pct + '%');
                if (rem <= 0) {
                    SessionGuard.goLogout('Session berakhir. Silakan login kembali.');
                }
            };
            tick();
            SessionGuard.countdownTimer = setInterval(tick, 1000);
        },

        localRemaining: function() {
            var idleSec = Math.floor((Date.now() - SessionGuard.lastActivityAt) / 1000);
            return Math.max(0, SessionGuard.ttl - idleSec);
        },

        evaluateLocal: function() {
            if (SessionGuard.redirecting) {
                return;
            }
            var rem = SessionGuard.localRemaining();
            SessionGuard.remaining = rem;
            window.PATOPSSessionDebug = {
                ttl: SessionGuard.ttl,
                warnBefore: SessionGuard.warnBefore,
                remaining: rem,
                idleSec: Math.floor((Date.now() - SessionGuard.lastActivityAt) / 1000),
                testMode: SessionGuard.testMode
            };
            if (rem <= 0) {
                SessionGuard.goLogout('Session berakhir karena tidak ada aktivitas.');
                return;
            }
            if (rem <= SessionGuard.warnBefore) {
                SessionGuard.showWarning();
            } else if (SessionGuard.warningShown) {
                SessionGuard.hideWarning();
            }
        },

        markActivity: function(sendKeep) {
            SessionGuard.lastActivityAt = Date.now();
            if (SessionGuard.warningShown && !sendKeep) {
                return;
            }
            if (!sendKeep) {
                return;
            }
            var now = Date.now();
            if (now - SessionGuard.lastKeepSent < SessionGuard.activityKeepMs) {
                return;
            }
            SessionGuard.lastKeepSent = now;
            SessionGuard.ping(true);
        },

        ping: function(keep) {
            if (!SessionGuard.pingUrl || SessionGuard.redirecting) {
                return $.Deferred().reject().promise();
            }
            return $.ajax({
                url: SessionGuard.pingUrl,
                type: 'post',
                dataType: 'json',
                contentType: 'application/json; charset=UTF-8',
                data: JSON.stringify({ keep: !!keep }),
                global: false
            }).done(function(result) {
                if (!result || result.auth === false) {
                    SessionGuard.goLogout((result && result.message) ? result.message : 'Session berakhir. Silakan login kembali.');
                    return;
                }
                if (typeof result.ttl === 'number' && result.ttl >= 30) {
                    // jangan biarkan server menaikkan TTL saat mode uji
                    if (!SessionGuard.testMode) {
                        SessionGuard.ttl = result.ttl;
                    }
                }
                if (typeof result.warnBefore === 'number' && result.warnBefore > 0 && !SessionGuard.testMode) {
                    SessionGuard.warnBefore = result.warnBefore;
                }
                if (keep) {
                    SessionGuard.lastActivityAt = Date.now();
                    SessionGuard.lastKeepSent = Date.now();
                    SessionGuard.hideWarning();
                } else if (typeof result.remaining === 'number' && result.remaining <= 0) {
                    SessionGuard.goLogout(result.message || 'Session berakhir karena tidak ada aktivitas.');
                    return;
                }
                SessionGuard.evaluateLocal();
            }).fail(function(xhr) {
                if (xhr && (xhr.status === 401 || xhr.status === 403)) {
                    var msg = 'Session berakhir. Silakan login kembali.';
                    try {
                        var body = xhr.responseJSON || JSON.parse(xhr.responseText || '{}');
                        if (body && body.message) {
                            msg = body.message;
                        }
                    } catch (e) {}
                    SessionGuard.goLogout(msg);
                    return;
                }
                SessionGuard.evaluateLocal();
            });
        },

        keepAlive: function() {
            SessionGuard.lastActivityAt = Date.now();
            return SessionGuard.ping(true);
        },

        bindAjaxGuard: function() {
            $(document).ajaxComplete(function(event, xhr) {
                if (SessionGuard.redirecting || !xhr) {
                    return;
                }
                if (xhr.status === 401 || xhr.status === 403) {
                    SessionGuard.goLogout('Session berakhir. Silakan login kembali.');
                }
            });
        },

        bindActivity: function() {
            var events = 'click keydown touchstart';
            var throttle = null;
            $(document).on(events, function(e) {
                if ($(e.target).closest('#sessionTimeoutModal').length) {
                    return;
                }
                if (throttle) {
                    return;
                }
                throttle = setTimeout(function() {
                    throttle = null;
                    SessionGuard.markActivity(true);
                }, 400);
            });
        },

        stop: function() {
            if (SessionGuard.checkTimer) {
                clearInterval(SessionGuard.checkTimer);
                SessionGuard.checkTimer = null;
            }
            if (SessionGuard.tickTimer) {
                clearInterval(SessionGuard.tickTimer);
                SessionGuard.tickTimer = null;
            }
            if (SessionGuard.countdownTimer) {
                clearInterval(SessionGuard.countdownTimer);
                SessionGuard.countdownTimer = null;
            }
        },

        init: function() {
            if (!SessionGuard.pingUrl) {
                try {
                    console.error('[SessionGuard] pingUrl kosong');
                } catch (e) {}
                return;
            }
            SessionGuard.ensureModal();
            SessionGuard.bindAjaxGuard();
            SessionGuard.bindActivity();
            SessionGuard.lastActivityAt = Date.now();
            window.PATOPSSessionDebug = {
                ttl: SessionGuard.ttl,
                warnBefore: SessionGuard.warnBefore,
                remaining: SessionGuard.ttl,
                idleSec: 0
            };
            try {
                console.info('[SessionGuard] init ttl=' + SessionGuard.ttl + 's warn=' + SessionGuard.warnBefore + 's testMode=' + SessionGuard.testMode);
            } catch (e2) {}

            SessionGuard.ping(true);
            SessionGuard.checkTimer = setInterval(function() {
                SessionGuard.ping(false);
            }, SessionGuard.checkEveryMs);
            SessionGuard.tickTimer = setInterval(function() {
                SessionGuard.evaluateLocal();
            }, 1000);

            $('#btnSessionContinue').on('click', function() {
                var $btn = $(this);
                $btn.attr('disabled', 'disabled');
                SessionGuard.keepAlive().always(function() {
                    $btn.removeAttr('disabled');
                });
            });
            $('#btnSessionLogout').on('click', function() {
                SessionGuard.goLogout();
            });
        }
    };

    $(function() {
        SessionGuard.init();
    });

    window.PATOPSSessionGuard = SessionGuard;
})(jQuery);
