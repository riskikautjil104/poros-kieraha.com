<p align="center">
  <img src="public/assets/images/logo.png" alt="News Portal Logo" width="200">
</p>

<h1 align="center">News Portal - Laravel News Management System</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge" alt="MIT License">
</p>

<p align="center">
  Sistem manajemen berita modern yang dibangun dengan Laravel 12, dirancang untuk mempublikasikan dan mengelola konten berita secara efisien dengan antarmuka yang responsif dan user-friendly.
</p>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Cara Penggunaan](#-cara-penggunaan)
- [Struktur Proyek](#-struktur-proyek)
- [Screenshot](#-screenshot)
- [API Documentation](#-api-documentation)
- [Testing](#-testing)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)
- [Kontak](#-kontak)

---

## 🎯 Tentang Proyek

**News Portal** adalah aplikasi manajemen berita berbasis web yang dirancang untuk memudahkan publikasi dan pengelolaan konten berita secara profesional. Aplikasi ini menyediakan dua bagian utama:

- **Frontend Publik**: Antarmuka yang ramah pengguna untuk pengunjung membaca berita, mencari artikel, dan berlangganan newsletter
- **Panel Admin**: Dashboard lengkap untuk mengelola berita, kategori, tag, pengguna, banner, dan iklan

Aplikasi ini cocok untuk media online, blog berita, portal informasi, atau organisasi yang memerlukan sistem publikasi berita yang robust dan scalable.

---

## ✨ Fitur Utama

### 📰 Manajemen Berita
- **CRUD Lengkap**: Buat, baca, update, dan hapus berita dengan mudah
- **Kategorisasi**: Organisasi berita berdasarkan kategori
- **Sistem Tagging**: Tag berita untuk kategorisasi lebih detail
- **Status Publikasi**: Draft dan published untuk kontrol konten
- **Auto-generate Slug**: URL-friendly slug otomatis dari judul
- **Counter Views**: Tracking jumlah pembaca untuk setiap berita
- **Rich Text Editor**: Excerpt dan konten lengkap dengan formatting
- **Upload Gambar**: Fitur upload dengan validasi dan optimasi gambar

### 💬 Sistem Komentar
- Komentar interaktif pada setiap berita
- Rate limiting untuk mencegah spam
- Sistem moderasi komentar oleh admin
- Notifikasi komentar baru

### 👥 Manajemen Pengguna
- Registrasi dan login dengan verifikasi email
- Sistem role-based access (Admin, Editor, User)
- Profil pengguna dengan avatar
- Panel manajemen pengguna untuk admin
- Password reset dan two-factor authentication

### 🎛️ Panel Admin
- **Dashboard**: Overview statistik berita, views, dan users
- **Manajemen Konten**: CRUD untuk berita, kategori, dan tag
- **Manajemen Pengguna**: Kelola role dan permissions
- **Banner Management**: Upload dan atur banner promosi
- **Ads Management**: Kelola iklan di berbagai posisi
- **Newsletter**: Manajemen subscriber dan pengiriman email

### 🌐 Frontend Publik
- Halaman beranda dengan berita terbaru dan trending
- Listing berita berdasarkan kategori dan tag
- Pencarian berita dengan filter advanced
- Halaman detail berita dengan related articles
- Formulir berlangganan newsletter
- Responsive design untuk semua device

### 🔒 Fitur Keamanan
- Rate limiting untuk login dan form submission
- Security headers middleware
- Validasi dan sanitasi upload file
- HTML Purifier untuk pembersihan konten
- CSRF protection
- XSS prevention

### 🎨 Fitur Tambahan
- Banner carousel di homepage
- Sistem iklan dengan posisi dinamis
- Newsletter subscription dan management
- SEO-friendly URLs
- Social media sharing buttons
- Breadcrumb navigation

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **Framework**: Laravel 12
- **Bahasa**: PHP 8.2+
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Breeze

### Frontend
- **Template Engine**: Blade
- **CSS Framework**: Tailwind CSS 3.x
- **JavaScript**: Vanilla JS / Alpine.js
- **Asset Bundler**: Vite

### Library & Package
- **Intervention Image**: Manipulasi dan optimasi gambar
- **HTMLPurifier**: Pembersihan dan sanitasi HTML
- **Laravel Sanctum**: API authentication (optional)
- **Spatie Laravel Permission**: Role & permission management

---

## 📦 Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut:

- PHP >= 8.2
- Composer >= 2.0
- Node.js >= 18.x & NPM >= 9.x
- MySQL >= 8.0 atau MariaDB >= 10.3
- Extension PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, GD atau Imagick

---

## 🚀 Instalasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi:

### 1. Clone Repository
```bash
