# 🚀 RockBlog - Laravel Blog CMS

<p align="center">
    <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" width="100">
</p>

<p align="center">
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

RockBlog adalah aplikasi Content Management System (CMS) berbasis Laravel untuk membuat dan mengelola blog dengan antarmuka admin yang mudah digunakan.

## ✨ Fitur Utama

### 🌐 Frontend
- **Homepage Blog** - Tampilkan semua artikel dengan pagination
- **Detail Artikel** - Halaman detail artikel dengan cover image
- **Responsive Design** - Menggunakan Tailwind CSS untuk tampilan yang responsif
- **SEO Friendly** - URL structure yang bersih dan SEO optimized

### 🔐 Admin Panel
- **Dashboard Admin** - Panel kontrol untuk mengelola blog
- **Manajemen Artikel** - CRUD lengkap untuk artikel (Create, Read, Update, Delete)
- **Upload Gambar** - Fitur upload cover image untuk artikel
- **User Authentication** - Sistem login/register dengan Laravel Breeze
- **User Management** - Setiap artikel terkait dengan user/author

### 🛠 Fitur Teknis
- **Image Storage** - Sistem penyimpanan gambar yang aman
- **Database Relations** - Relasi User-Post yang proper
- **Validation** - Form validation untuk semua input
- **Flash Messages** - Notifikasi sukses/error untuk user experience
- **Route Protection** - Middleware auth untuk area admin

## 🏗 Teknologi Yang Digunakan

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates + Alpine.js
- **Styling**: Tailwind CSS
- **Build Tools**: Vite
- **Database**: MySQL/SQLite (configurable)
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage (local/public)

## 📋 Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL atau SQLite
- Web Server (Apache/Nginx)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/Rock-Code-Brutal/RockBlog.git
cd RockBlog
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rockblog
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Migration & Seeding
```bash
# Jalankan migration
php artisan migrate

# Jalankan seeder (optional)
php artisan db:seed
```

### 6. Storage Link
```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

### 7. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan tersedia di: `http://localhost:8000`

## 🎯 Penggunaan

### Akses Public
- **Homepage**: `/` - Melihat semua artikel blog
- **Detail Artikel**: `/posts/{id}` - Melihat detail artikel

### Akses Admin
1. **Register/Login**: `/register` atau `/login`
2. **Admin Dashboard**: `/admin/dashboard`
3. **Kelola Artikel**: `/admin/posts`
   - Tambah artikel baru
   - Edit artikel yang sudah ada
   - Hapus artikel
   - Upload cover image

## 📁 Struktur Project

```
RockBlog/
├── app/
│   ├── Http/Controllers/
│   │   └── PostController.php      # Controller untuk artikel
│   ├── Models/
│   │   ├── Post.php                # Model artikel
│   │   └── User.php                # Model user
├── resources/
│   └── views/
│       ├── admin/                  # Views admin panel
│       │   ├── dashboard.blade.php
│       │   └── posts/
│       ├── posts/                  # Views public
│       │   ├── index.blade.php     # Homepage blog
│       │   └── show.blade.php      # Detail artikel
│       └── layouts/                # Layout templates
├── routes/
│   └── web.php                     # Route definitions
└── database/
    ├── migrations/                 # Database migrations
    └── seeders/                    # Database seeders
```

## 🔧 Kustomisasi

### Menambah Field Artikel
1. Buat migration baru:
```bash
php artisan make:migration add_fields_to_posts_table
```

2. Update model `Post.php` di `$fillable`
3. Update form views di `resources/views/admin/posts/`
4. Update controller validation

### Mengubah Tampilan
- Edit file Blade di `resources/views/`
- Kustomisasi CSS di `resources/css/app.css`
- Konfigurasi Tailwind di `tailwind.config.js`

## 🤝 Kontribusi

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 License

Project ini menggunakan [MIT License](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

Developed with ❤️ by [Rock Code Brutal](https://github.com/Rock-Code-Brutal)

---

### 🆘 Troubleshooting

**Error "Class not found":**
```bash
composer dump-autoload
```

**Error storage link:**
```bash
php artisan storage:link
```

**Error permissions:**
```bash
chmod -R 775 storage bootstrap/cache
```

Untuk pertanyaan atau dukungan, silakan buka [issue](https://github.com/Rock-Code-Brutal/RockBlog/issues) di repository ini.
