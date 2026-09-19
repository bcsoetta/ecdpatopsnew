# PATOPS — Dokumentasi Perbaikan Modul Impor Sementara

Aplikasi: **BC PATOPS** (CodeIgniter / XAMPP)  
Repo: `ecdpatopsnew`  
Fokus perbaikan: modul **Impor Sementara** (Dokumen, Monitoring, Setting, Session)

---

## 1. Ringkasan

Modul Impor Sementara dikembangkan dari alur pelayanan dasar menjadi sistem yang lebih lengkap:

- Struktur menu bertingkat (Dokumen / Monitoring / Setting)
- Wizard pembuatan dokumen 5 tab + draf
- Monitoring dengan filter, sort, headline BPJ, ringkasan, dan detail Reekspor / Jaminan Definitif
- Notifikasi email (SMTP, template WYSIWYG, log, lonceng Monitoring)
- Manajemen session idle dengan peringatan & logout otomatis

---

## 2. Struktur menu (setelah perbaikan)

| Menu | URL | `menuActive` |
|------|-----|--------------|
| **Dokumen** (ex. Pelayanan) | `/import` | 4 |
| **Monitoring** | `/import/monitoring` | 8 |
| **Setting → SMTP Email** | `/import/setting` | 9 |
| **Setting → Format/Template Notifikasi** | `/import/setting_template` | 10 |
| **Setting → Log Notifikasi** | `/import/setting_log` | 11 |

File: `application/views/aside/menu.php`

---

## 3. Chronology pekerjaan

### 3.1 Restrukturisasi UI pembuatan dokumen

- Wizard **5 tab**: Pemberitahu → Perjalanan & Sponsor → Barang → Jaminan → Review
- Simpan resmi hanya di tab Review (`POST /import/create_new`)
- Bea masuk **tetap 10%** (readonly)
- Field penjamin dihapus dari form & cetakan Form Jaminan
- Email pemberitahu wajib divalidasi sebelum lanjut tab

### 3.2 Database pendukung (dijalankan manual oleh user)

- `ALTER TABLE import ADD email`
- `import_smtp_setting`
- `import_notif_format`
- `import_notif_log`
- `import_header_temp` (draf isian wizard)

> Catatan: aplikasi **tidak** auto-CREATE/ALTER table dari PHP.

### 3.3 Draf form

- Disimpan ke `import_header_temp` + barang di `import_items_temp`
- Restore saat modal dibuka ulang (selama masih login)
- Autosave: pindah tab, tutup modal, tambah/hapus barang, interval ~40 dtk
- **Logout** menghapus draf semua petugas (`delete_header_draft(TRUE)`)
- Simpan resmi menghapus draf petugas yang login

### 3.4 Monitoring

- Filter per kolom, daterangepicker, sort (default: Status BPJ naik / paling dekat JT)
- Status **Closed tidak ditampilkan** di daftar monitoring
- Headline klik: Jatuh Tempo / 7 Hari Sebelum / 30 Hari Sebelum
- Layout `container-fluid` (sama seperti Monitoring; Dokumen ikut diseragamkan)

### 3.5 Ringkasan Monitoring (3 card + filter tanggal)

Filter default: **2020-01-01 s/d hari ini**

| Card | Arti data |
|------|-----------|
| Dokumen IS | Total + **Aktif** (status ≠ Closed) |
| Reekspor | Closed + penyelesaian **Sesuai** (`re_status = 1`) — bisa diklik → modal datatable |
| Jaminan Definitif | Closed + **Tidak Sesuai / Lewat JT** (`re_status` 0/2) — jumlah + sum nominal jaminan — bisa diklik → modal |

Modal Reekspor/Jaminan: filter, paging, sort (default tanggal IS naik).

### 3.6 Notifikasi email

- Setting SMTP (password kosong = tetap pakai yang tersimpan)
- Template Summernote + placeholder `{nama}`, `{email}`, dll.
- Hook: `default` (lonceng), `0`–`7`, `created`/`open`, `overdue`, `closed`
- Auto email: cetak Form IS pertama kali → `created`; ubah status ke Closed → `closed`
- Lonceng Monitoring: preview template default (sudah diisi data), edit WYSIWYG; tombol sisip = **nilai baris**, bukan `{placeholder}`
- Kirim massal: template default tanpa edit per baris
- **Edit di popup lonceng tidak mengubah Setting template**

### 3.7 Session (opsi B)

- Idle berdasarkan aktivitas nyata (klik/ketik/touch), bukan mousemove/scroll
- `last_user_activity` **tidak** di-refresh oleh setiap `auth()` AJAX
- Endpoint: `POST /home/session_ping`
- UI: modal + banner peringatan
- AJAX 401 → logout otomatis

**Produksi (TTL 2 jam):**

| Parameter | Nilai |
|-----------|--------|
| `sess_expiration` | 7200 detik (2 jam) |
| Peringatan | 300 detik (5 menit) sebelum habis |
| Ping cek session | tiap **3 menit** |
| Keep-alive saat aktif | tiap **2 menit** |
| Timer lokal banner | 1 detik (tanpa network) |

File terkait:

- `assets/js/app.session.js`
- `application/views/aside/script.php`
- `application/controllers/Home.php` → `session_ping()`
- `application/core/MY_Controller.php`

---

## 4. File utama yang diubah/ditambah

### Backend

- `application/controllers/Import.php`
- `application/controllers/Home.php`
- `application/controllers/User.php` / `Site.php` (logout + hapus draf)
- `application/models/Import_model.php`
- `application/core/MY_Controller.php`
- `application/config/config.php` (`sess_expiration`)

### Frontend

- `application/views/aside/menu.php`
- `application/views/aside/script.php`
- `application/views/impor/index.php`
- `application/views/impor/monitoring.php`
- `application/views/impor/setting.php`
- `application/views/impor/setting_template.php`
- `application/views/impor/setting_log.php`
- `application/views/impor/print_page.php`
- `assets/js/app.import.js`
- `assets/js/app.import.monitoring.js`
- `assets/js/app.import.setting.js`
- `assets/js/app.session.js` *(baru)*

---

## 5. Endpoint penting

| Endpoint | Fungsi |
|----------|--------|
| `POST /import/create_new` | Simpan dokumen IS |
| `POST /import/save_draft` / `get_draft` | Draf wizard |
| `POST /import/search_monitoring` | List monitoring |
| `POST /import/monitoring_summary` | Angka 3 card ringkasan |
| `POST /import/search_reekspor` | Detail modal Reekspor |
| `POST /import/search_jaminan_definitif` | Detail modal jaminan |
| `POST /import/preview_notification` / `send_notification` | Lonceng / bulk email |
| `POST /import/save_setting` / `test_notification` | SMTP & template |
| `POST /home/session_ping` | Cek / perpanjang session idle |

---

## 6. Aturan bisnis ringkas

**Status dokumen:** `1` Created, `2` Open, `3` Closed

**Penyelesaian (`re_status`):**

- `1` Sesuai → Reekspor
- `0` Tidak Sesuai → Jaminan Definitif
- `2` Lewat Jatuh Tempo → Jaminan Definitif

**Status BPJ (sisa hari):** `periode - (hari sejak doc_date)`  
Monitoring mengurutkan sisa hari terkecil lebih dulu.

**Pembulatan pungutan (per seri barang):**

| Pungutan | Aturan |
|----------|--------|
| Bea Masuk | `ceil` ke ribuan penuh |
| PPN / PPnBM | `(nilai pabean + BM) × tarif`, lalu `floor` ke rupiah penuh |
| PPh | Dasar nilai impor `floor` ke ribuan dulu, baru × tarif |

Acuan uji: CIF 100, kurs 17594, BM 10%, PPN 10%, PPh 7% → BM 176.000 + PPN 193.540 + PPh 135.450 = **504.990**

---

## 7. Cara uji cepat (opsional)

1. Session: sementara turunkan TTL, hard refresh, idle hingga banner/modal; kembalikan ke 7200.
2. Draf: isi wizard → tutup → buka lagi (pulih); logout → draf hilang.
3. Monitoring: klik card Reekspor / Jaminan; ubah filter tanggal ringkasan.
4. Lonceng: edit isi email → kirim; pastikan template Setting tidak berubah.

---

## 8. Catatan teknis

- Cache-bust JS lewat query `?v=...` di view.
- Partial save setting: halaman SMTP tidak boleh menimpa format template; sebaliknya password SMTP kosong = retain.
- Jangan auto-migrate schema dari PHP.
- Session guard: timer idle **client** sebagai acuan UI; ping server untuk auth/logout.
