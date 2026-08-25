# Nemo Security Lab

**Aplikasi Web Rentan untuk Latihan Penetration Testing**

Nemo Security Lab adalah aplikasi web internal fiktif milik perusahaan keamanan siber **Nemo Security**. Aplikasi ini dibangun menggunakan **Laravel 13** dan **MySQL/MariaDB** untuk tujuan edukasi, pelatihan keamanan siber, dan pengujian penetrasi di lingkungan lokal yang terkendali.

Aplikasi ini sengaja dirancang dengan banyak kerentanan keamanan berdasarkan **OWASP Top 10** agar pengguna dapat mempelajari cara menemukan, mengeksploitasi, dan memperbaiki celah keamanan pada aplikasi web modern.

---

## ⚠️ Peringatan

Aplikasi ini **HANYA** untuk digunakan di lingkungan lokal, laboratorium, atau sistem yang Anda miliki sendiri. **JANGAN** pernah menjalankannya di server publik atau menggunakannya untuk aktivitas ilegal.

---

## Fitur Utama

- **Halaman Depan (Landing Page)** – Profil perusahaan, layanan, FAQ, dan kontak.
- **Dashboard** – Statistik dan aktivitas terbaru.
- **Manajemen Products** – CRUD produk keamanan (SKU, harga, stok).
- **Manajemen Projects** – Proyek pentest, komentar (Stored XSS).
- **Manajemen Clients** – Data klien (IDOR, SQLi).
- **Manajemen Employees** – Data karyawan internal (IDOR, SQLi).
- **Vulnerability Database (Vuln DB)** – Referensi kerentanan (SQLi, IDOR).
- **Network Tools** – Ping & Traceroute (OS Command Injection).
- **Manajemen Files** – Upload, download, view file (IDOR, LFI, upload tanpa validasi).
- **Import Data** – Import users & products via CSV (CSV Injection).
- **Import File/URL** – Import file dari URL (SSRF).
- **Profile Management** – Update profil, avatar upload, avatar dari URL (SSRF).
- **Admin Panel** – Kelola user, file, dan dashboard admin.
- **Akses `.env` dan log publik** – Security Misconfiguration.

---

## Kerentanan yang Disengaja (OWASP Top 10)

| OWASP | Kerentanan | Lokasi |
|-------|------------|--------|
| A1 – Broken Access Control | IDOR pada semua resource | Semua controller `show`, `edit`, `update`, `destroy` |
| A3 – Injection | SQL Injection pada pencarian | `ProductController`, `ProjectController`, `ClientController`, `EmployeeController`, `VulnDbController` |
| A3 – Injection | OS Command Injection | `ToolController@ping`, `ToolController@traceroute` |
| A3 – Injection | Stored XSS pada komentar proyek | `ProjectController@storeComment`, `projects/show.blade.php` |
| A3 – Injection | Reflected XSS pada halaman depan | `welcome.blade.php` (parameter `search`) |
| A5 – Security Misconfiguration | File `.env` dapat diakses publik | `routes/web.php` (`GET /env`) |
| A5 – Security Misconfiguration | File log dapat diakses publik | `routes/web.php` (`GET /logs`) |
| A5 – Security Misconfiguration | Debug mode aktif, error verbose | `.env` (`APP_DEBUG=true`) |
| A7 – Authentication Failures | Tidak ada rate limiting, password policy lemah | `LoginController` |
| A8 – Software Integrity Failures | Upload file tanpa validasi tipe (shell upload) | `FileController@upload` |
| A8 – Software Integrity Failures | CSV Injection pada import | `ImportController` |
| A10 – SSRF | Import avatar/file dari URL tanpa validasi | `ProfileController@updateAvatarFromUrl`, `FileController@importFromUrl`, `AdminFileController@importFromUrl` |
| LFI | Local File Inclusion via parameter `path` | `FileViewController@viewByPath`, route `GET /lfi` |
| Open Redirect | Parameter `redirect` pada halaman depan | `welcome.blade.php` |

---

## Teknologi

- **Backend:** PHP 8.3+, Laravel 13
- **Database:** MySQL/MariaDB
- **Frontend:** Blade, Bootstrap 5, Bootstrap Icons
- **Session:** Database-based

---

## Instalasi

1. **Clone atau salin project** ke folder web server (misal `C:\laragon\www\pentest-lab`).

2. **Install dependencies:**
   ```bash
   composer install