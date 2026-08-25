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

## Kerentanan yang Terdapat

Aplikasi ini mengandung berbagai jenis kerentanan keamanan yang mengacu pada **OWASP Top 10**. Berikut penjelasan umum setiap kategori yang ada di dalam aplikasi:

### 1. Broken Access Control (Insecure Direct Object Reference)
Aplikasi memiliki kelemahan dalam memverifikasi hak akses pengguna terhadap sumber daya tertentu. Pengguna dengan peran terbatas mungkin dapat mengakses, mengubah, atau menghapus data milik pengguna lain hanya dengan memanipulasi parameter seperti ID pada URL.

**Dampak:**  
- Kebocoran data antar pengguna.  
- Modifikasi atau penghapusan data tanpa izin.  
- Potensi peningkatan hak akses.

### 2. Injection (SQL Injection, XSS, Command Injection)
Beberapa fitur tidak melakukan validasi atau sanitasi input dengan benar, sehingga memungkinkan penyisipan perintah berbahaya.

- **SQL Injection:** Pada fitur pencarian atau autentikasi, input pengguna dapat memanipulasi query database.  
- **Cross-Site Scripting (XSS):** Input yang tersimpan atau dipantulkan dapat mengeksekusi JavaScript di browser korban.  
- **OS Command Injection:** Pada fitur yang menjalankan perintah sistem, input pengguna dapat disisipkan untuk menjalankan perintah tambahan.

**Dampak:**  
- Pencurian sesi, cookie, atau data sensitif.  
- Manipulasi database.  
- Eksekusi perintah di server.

### 3. Security Misconfiguration
Aplikasi menyertakan beberapa konfigurasi yang tidak aman, seperti:

- Mode debug yang aktif.  
- Pesan error yang terlalu rinci.  
- File sensitif yang dapat diakses langsung.

**Dampak:**  
- Pengungkapan informasi sensitif (kredensial, path, konfigurasi).  
- Memudahkan penyerang dalam eksploitasi lebih lanjut.

### 4. Authentication Failures
Mekanisme autentikasi tidak menerapkan kebijakan yang cukup kuat, misalnya:

- Tidak ada pembatasan percobaan login (brute force).  
- Kebijakan password yang lemah.  
- Tidak ada mekanisme pengamanan sesi yang memadai.

**Dampak:**  
- Akun dapat diambil alih.  
- Serangan brute force atau credential stuffing.

### 5. Software and Data Integrity Failures
Pada fitur upload dan import, aplikasi tidak memvalidasi dengan benar jenis dan isi file yang diterima.

**Dampak:**  
- Unggahan file berbahaya (misal web shell).  
- Injeksi formula pada file CSV yang dapat dieksekusi saat dibuka di spreadsheet.

### 6. Server-Side Request Forgery (SSRF)
Aplikasi memiliki fitur yang mengambil sumber daya dari URL eksternal tanpa memvalidasi tujuan, sehingga dapat dimanfaatkan untuk mengakses layanan internal.

**Dampak:**  
- Pemindaian jaringan internal.  
- Akses ke layanan cloud metadata.  
- Bypass firewall.

### 7. Local File Inclusion (LFI)
Fitur baca file tidak membatasi path file yang dapat diakses, sehingga memungkinkan pembacaan file sensitif di server.

**Dampak:**  
- Pengungkapan file konfigurasi, kredensial, atau source code.  
- Potensi eksekusi kode jika dikombinasikan dengan teknik lain.

### 8. Open Redirect
Beberapa parameter URL dapat dialihkan ke domain eksternal tanpa validasi.

**Dampak:**  
- Serangan phishing.  
- Pencurian kredensial melalui redirect.

> **Catatan:** Lokasi pasti setiap kerentanan **tidak dicantumkan** dalam README ini. Peserta harus menemukannya sendiri melalui pengujian dan analisis source code.

---

## Teknologi

- **Backend:** PHP 8.3+, Laravel 13
- **Database:** MySQL/MariaDB
- **Frontend:** Blade, Bootstrap 5, Bootstrap Icons
- **Session:** Database-based

---

## Instalasi

### Persyaratan

Sebelum memulai, pastikan sudah terpasang:

- **PHP** minimal versi 8.3
- **Composer** (https://getcomposer.org)
- **MySQL/MariaDB** (disarankan memakai Laragon/XAMPP)
- **Git** (opsional, untuk clone repo)

### Langkah-langkah Instalasi

#### 1. Clone atau salin project ke folder web server

Jika menggunakan **Laragon**, letakkan di `C:\laragon\www`.  
Jika menggunakan **XAMPP**, letakkan di `C:\xampp\htdocs`.

**Clone dari GitHub:**
```bash
git clone https://github.com/zakyarielsyah11/Nemo-Security-Lab.git
cd Nemo-Security-Lab
