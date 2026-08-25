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
<img width="1532" height="822" alt="Landing_Page" src="https://github.com/user-attachments/assets/fff48962-bd1a-42d7-9974-4a16459fe27c" />
- **Dashboard** – Statistik dan aktivitas terbaru.
<img width="1535" height="822" alt="Dashboard_User" src="https://github.com/user-attachments/assets/120a1ac0-59b6-41f5-8da6-242597cc4c95" />
<img width="1535" height="827" alt="Dashboard_Admin" src="https://github.com/user-attachments/assets/5b4d19cd-275c-4fcd-bf20-d52790c979bf" />
- **Manajemen Products** – CRUD produk keamanan (SKU, harga, stok).
<img width="1535" height="821" alt="Products" src="https://github.com/user-attachments/assets/dca10d04-00bd-42d1-ac16-1951907f417c" />
- **Manajemen Projects** – Proyek pentest, komentar.
- <img width="1535" height="817" alt="Projects" src="https://github.com/user-attachments/assets/b8c94f1d-103e-43b0-988d-4947d28f6773" />
- **Manajemen Clients** – Data klien.
- <img width="1535" height="830" alt="Clients" src="https://github.com/user-attachments/assets/198355e1-bff3-4ae3-9354-7df27224e639" />
- **Manajemen Employees** – Data karyawan internal.
- <img width="1535" height="822" alt="Employees" src="https://github.com/user-attachments/assets/22bff2d7-f2d2-41f1-b5b7-6e651922c42c" />
- **Vulnerability Database (Vuln DB)** – Referensi kerentanan.
<img width="1535" height="827" alt="Vuln_DB" src="https://github.com/user-attachments/assets/84af9b9a-17cc-42a2-8452-d8f1ff58dc2b" />
- **Network Tools** – Ping & Traceroute.
<img width="1535" height="817" alt="Network_Tools" src="https://github.com/user-attachments/assets/743d4682-702f-495a-a863-8c56eb75743e" />
- **Manajemen Files** – Upload, download, view file.
<img width="1535" height="826" alt="Files" src="https://github.com/user-attachments/assets/d2b8a58c-581e-4fdc-a8b0-604abfabcd0c" />
- **Import Data** – Import users & products via CSV.
- <img width="1535" height="830" alt="Import Data" src="https://github.com/user-attachments/assets/844593cb-25fb-45e0-83c8-aedbae504392" />
- **Import File/URL** – Import file dari URL.
- <img width="1535" height="826" alt="Files" src="https://github.com/user-attachments/assets/9006f3e8-13da-4d42-b290-a14edb7cca7d" />
- **Profile Management** – Update profil, avatar upload, avatar dari URL.
<img width="1532" height="820" alt="Profile_Admin" src="https://github.com/user-attachments/assets/b6db5b71-55e0-4036-b18b-a3238615b478" />
<img width="1530" height="847" alt="Profile_User" src="https://github.com/user-attachments/assets/1665b14a-6036-4590-97e3-d9eb08ccbd63" />
- **Admin Panel** – Kelola user, file, dan dashboard admin.
<img width="1527" height="812" alt="Admin_Panel" src="https://github.com/user-attachments/assets/d236c8fb-1009-4a40-b268-d30ffea8d535" />

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
