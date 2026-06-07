# Sistem Inventaris Aset Tetap JTT

Sistem Inventaris Aset Tetap berbasis web yang digunakan untuk membantu pengelolaan aset perusahaan secara terstruktur, mulai dari pendataan aset, pengelolaan ruangan, manajemen pengguna, hingga proses pengajuan aset.

---

## Fitur Utama

### Admin
- Dashboard Administratif
- Manajemen Data Aset
- Manajemen Data Ruangan
- Manajemen Data Pengguna
- Monitoring Pengajuan Aset
- Persetujuan atau Penolakan Pengajuan
- Pencarian dan Pengelolaan Data Inventaris

### User
- Dashboard Pengguna
- Melihat Data Aset
- Mengajukan Permintaan Aset
- Monitoring Status Pengajuan

---

## Teknologi yang Digunakan

- Laravel 12
- PHP 8.3
- MySQL / MariaDB
- Tailwind CSS
- Vite
- Blade Template Engine

---

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Node.js
- NPM

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/odynamic/Sistem-Inventaris-Aset-Tetap-JTT.git
cd Sistem-Inventaris-Aset-Tetap-JTT
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Install Dependency Frontend

```bash
npm install
```

### 4. Konfigurasi Environment

Salin file environment:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Sesuaikan konfigurasi database pada file `.env`.

### 5. Migrasi Database

```bash
php artisan migrate
```

Jika tersedia seeder:

```bash
php artisan db:seed
```

### 6. Menjalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Jalankan Vite:

```bash
npm run dev
```

Akses aplikasi melalui:

```text
http://127.0.0.1:8000
```

---

## Struktur Hak Akses

### Admin

Memiliki akses penuh terhadap:

- Pengelolaan aset
- Pengelolaan ruangan
- Pengelolaan pengguna
- Monitoring pengajuan aset
- Persetujuan dan penolakan pengajuan

### User

Memiliki akses terhadap:

- Dashboard pengguna
- Pengajuan aset
- Monitoring status pengajuan

---

## Modul Sistem

### Manajemen Aset
Mengelola data aset tetap perusahaan.

### Manajemen Ruangan
Mengelola lokasi atau ruangan penempatan aset.

### Manajemen Pengguna
Mengelola akun pengguna dan hak akses sistem.

### Pengajuan Aset
Mengelola proses permintaan dan persetujuan aset.

---

## Pengembang

Dikembangkan sebagai Sistem Inventaris Aset Tetap untuk mendukung proses administrasi dan pengelolaan aset perusahaan secara digital.

---

## Lisensi

Project ini dibuat untuk tujuan pembelajaran, penelitian, dan implementasi internal.
