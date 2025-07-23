# **Penerapan Enkripsi dan Vulnerability Assessment dalam Aplikasi Manajemen Klub Sepak Bola**

## **1. Analisis Kasus**

### **1.1. Latar Belakang**

Dalam industri sepak bola profesional, data klub, pemain, dan manajer sangat penting dan bersifat sensitif. Data seperti gaji, kontrak, dan informasi pribadi harus dijaga kerahasiaannya. Aplikasi berbasis web dirancang untuk membantu klub mengelola informasi manajer, pemain, dan klub itu sendiri. Namun, tanpa perlindungan yang tepat, data ini rentan terhadap kebocoran dan serangan siber.

### **1.2. Masalah yang Dihadapi**

- Informasi pribadi dan kontrak bocor karena tidak adanya enkripsi
- Tidak adanya otentikasi API untuk interaksi sistem eksternal
- Form input rawan terhadap SQL Injection atau XSS
- Data di database tidak dienkripsi, membuat data sensitif mudah diakses jika server disusupi

### **1.3. Tujuan**

- Membangun aplikasi manajemen data klub yang aman
- Mengimplementasikan enkripsi pada data sensitif
- Melakukan assessment terhadap potensi kerentanan sistem

---

## **2. Pengembangan Aplikasi**

### **2.1. Tools dan Framework yang Digunakan**

- **Backend**: Laravel 11
- **Frontend**: Filament (Laravel Admin Panel)
- **Database**: MySQL/MariaDB
- **Security Library**: Laravel Crypt, Hash, dan Validator

### **2.2. Fitur Aplikasi**

- CRUD Data Klub, Pemain, dan Manajer
- Enkripsi API Token Manager menggunakan Laravel Encryptor
- Admin Panel dengan Filament
- Autentikasi API Token (future use)

### **2.3. Struktur Tabel (ERD)**

![Untitled (9).png](attachment:de0aaff1-c297-4689-bf3c-d0b949ca7ae6:Untitled_(9).png)

ERD ini menggambarkan hubungan antara entitas *Club*, *Player*, dan *Manager* dalam sebuah sistem manajemen klub sepak bola. Setiap klub memiliki pemain dan manajer yang berelasi langsung dengannya.

| Entitas Sumber | Atribut FK | Entitas Tujuan | Kardinalitas |
| --- | --- | --- | --- |
| `Player` | `club_id` | `Club` | Many-to-One (banyak pemain per klub) |
| `Manager` | `club_id` | `Club` | One-to-One / One-to-Many (umumnya satu manajer per klub, tapi bisa juga multi jika dibutuhkan historikal) |

### **2.4. Implementasi Enkripsi**

- Field `api_token` dienkripsi saat menyimpan ke database menggunakan:
    
    ```php
    $manager->api_token = Crypt::encrypt('managerapi1');
    
    ```
    
- Decrypt saat dibutuhkan:
    
    ```php
    $decrypted = Crypt::decrypt($manager->api_token);
    
    ```
    

---

## **3. Vulnerability Assessment**

### **3.1. Metode Penilaian**

- Manual Testing
- Laravel Debug Mode Check
- OWASP Top 10 Reference

### **3.2. Potensi Kerentanan dan Solusi**

| Jenis Kerentanan | Deskripsi | Solusi |
| --- | --- | --- |
| SQL Injection | Form input tanpa validasi bisa menyisipkan query | Gunakan Eloquent ORM dan Validator |
| XSS | Input HTML pada nama/komentar tanpa filter | Gunakan `e()` atau `{{ }}` di Blade |
| Insecure Storage | `api_token` disimpan tanpa enkripsi | Gunakan `Crypt::encrypt()` dan `decrypt()` |
| CSRF | Form tidak memiliki token CSRF | Gunakan `@csrf` pada form |
| Exposed Debug Info | Debug mode aktif di production | Matikan `APP_DEBUG` di `.env` |

---

## **4. Strategi Pengamanan Data**

### **4.1. Enkripsi dan Hashing**

- Gunakan `Crypt::encrypt()` untuk menyimpan token dan data sensitif.
- Gunakan `Hash::make()` untuk password dan autentikasi jika ada fitur login.

### **4.2. Validasi Input**

- Laravel Validator digunakan untuk setiap form
    
    ```php
    $request->validate([
      'contact_email' => 'required|email',
      'salary' => 'numeric|min:0'
    ]);
    
    ```
    

### **4.3. Middleware dan Proteksi API**

- Gunakan middleware `auth:api` atau `token validation` sederhana berbasis token.

### **4.4. Environment dan Deployment**

- `.env` file tidak di-commit ke Git
- `APP_DEBUG=false` saat production
- Gunakan HTTPS

---

## **5. Kesimpulan**

Melalui aplikasi manajemen klub sepak bola ini, kita tidak hanya fokus pada fungsionalitas tetapi juga keamanan. Penerapan enkripsi pada data sensitif dan melakukan vulnerability assessment adalah langkah penting dalam menjaga keamanan data yang diolah sistem. Praktik ini juga bisa dikembangkan lebih jauh, termasuk dengan implementasi JWT untuk autentikasi API, logging aktivitas, dan pengamanan akses role-based.

---

**Lampiran:**

- Kode Laravel: Model, Seeder, Migration, Controller sudah diterapkan dengan enkripsi
- Tools keamanan yang disarankan: Laravel Security Checker, OWASP ZAP, dan Laravel Telescope
