		
        <!--begin::Scrolltop-->
                <div id="kt_scrolltop" class="scrolltop">
                    <span class="svg-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                                <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                </div>
        <!--end::Scrolltop-->

            <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
            <script src="<?=base_url('assets/plugins/global/plugins.bundle.js'); ?>"></script>
            <script src="<?=base_url('assets/plugins/custom/prismjs/prismjs.bundle.js'); ?>"></script>
            <script src="<?=base_url('assets/js/scripts.bundle.js'); ?>"></script>
            <script src="<?=base_url('assets/plugins/custom/datatables/datatables.bundle.js'); ?>"></script>
            <script src="<?=base_url('assets/js/pages/crud/datatables/data-sources/ajax-server-side.js'); ?>"></script>
            <script src="<?=base_url('assets/js/pages/widgets.js'); ?>"></script>
            <script src="<?=base_url('assets/js/pages/crud/file-upload/image-input.js'); ?>"></script>

            <?php
            $sessTtl = (int) $this->config->item('sess_expiration');
            if ($sessTtl < 60) {
                $sessTtl = 7200;
            }
            $sessWarn = 300;
            $sessTestMode = false;
            ?>
            <div class="modal fade" id="sessionTimeoutModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title text-dark font-weight-bold">Session Hampir Berakhir</h5>
                        </div>
                        <div class="modal-body">
                            <p class="mb-3">
                                Anda tidak aktif terlalu lama. Session akan berakhir dalam
                                <strong id="sessionTimeoutCountdown">05:00</strong>.
                            </p>
                            <div class="progress" style="height: 8px;">
                                <div id="sessionTimeoutBar" class="progress-bar bg-warning" role="progressbar" style="width: 100%;"></div>
                            </div>
                            <p class="text-muted mt-3 mb-0">Klik <strong>Lanjutkan</strong> untuk tetap masuk, atau <strong>Keluar</strong> untuk logout sekarang.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger" id="btnSessionLogout">Keluar</button>
                            <button type="button" class="btn btn-primary" id="btnSessionContinue">Lanjutkan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sessionTimeoutBanner" style="display:none;position:fixed;top:0;left:0;right:0;z-index:20001;background:#FFA800;color:#181C32;padding:12px 16px;text-align:center;font-weight:600;box-shadow:0 2px 8px rgba(0,0,0,.2);">
                Session hampir berakhir: <span id="sessionTimeoutBannerCount">05:00</span>
                &nbsp; <button type="button" class="btn btn-sm btn-dark" id="btnSessionContinueBanner">Lanjutkan</button>
            </div>
            <script>
                window.PATOPS_SESSION = {
                    pingUrl: <?= json_encode(base_url('home/session_ping')); ?>,
                    logoutUrl: <?= json_encode(base_url('user/logout')); ?>,
                    ttl: <?= (int) $sessTtl; ?>,
                    warnBefore: <?= (int) $sessWarn; ?>,
                    testMode: <?= $sessTestMode ? 'true' : 'false'; ?>
                };
            </script>
            <script src="<?=base_url('assets/js/app.session.js'); ?>?v=20260916g"></script>
            <script>
                (function($) {
                    function syncBanner() {
                        if (!window.PATOPSSessionGuard) return;
                        var rem = window.PATOPSSessionGuard.localRemaining();
                        if (rem <= window.PATOPSSessionGuard.warnBefore && rem > 0) {
                            $('#sessionTimeoutBanner').show();
                            $('#sessionTimeoutBannerCount').text(window.PATOPSSessionGuard.formatTime(rem));
                            $('#sessionTimeoutCountdown').text(window.PATOPSSessionGuard.formatTime(rem));
                        } else if (rem > window.PATOPSSessionGuard.warnBefore) {
                            $('#sessionTimeoutBanner').hide();
                        }
                    }
                    $(function() {
                        $('#sessionTimeoutBanner').appendTo('body');
                        $('#sessionTimeoutModal').appendTo('body');
                        $('#btnSessionContinueBanner').on('click', function() {
                            if (window.PATOPSSessionGuard) {
                                window.PATOPSSessionGuard.keepAlive();
                                $('#sessionTimeoutBanner').hide();
                            }
                        });
                        setInterval(syncBanner, 1000);
                    });
                })(jQuery);
            </script>