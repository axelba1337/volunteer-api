# Volunteer Event Management API

Tugas seleksi magang Backend Developer yang dibangun menggunakan **Laravel 12**. Sistem ini memungkinkan pengguna untuk mendaftar, login, melihat daftar event sukarelawan, dan mendaftar (join) ke event tersebut.

## Teknologi yang Digunakan
- **Framework:** Laravel 12.x
- **Database:** MySQL (Laragon)
- **Authentication:** Laravel Sanctum
- **Tools:** Postman / Thunder Client

---

## Cara Install

1. **Clone Repository**
   ```bash
   git clone https://github.com/axelba1337/volunteer-api
   cd volunteer-api
   ```

2. **Install Dependensi**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan sesuaikan koneksi database Anda (Laragon default):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=volunteer_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate App Key**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database & Seeding**
   Jalankan perintah ini untuk membuat tabel (singular) dan mengisi data awal:
   ```bash
   php artisan migrate --seed
   ```

---

## Cara Menjalankan Project

Jalankan server lokal Laravel:
```bash
php artisan serve
```
API sekarang dapat diakses di `http://127.0.0.1:8000/api`.

---

## Daftar Endpoint API

**Header Wajib:**  
`Accept: application/json`  
`Authorization: Bearer <token_anda>` (untuk endpoint yang butuh login)

| Fitur | Method | Endpoint | Auth | Deskripsi |
|-------|--------|----------|------|-----------|
| **Auth** | POST | `/register` | No | Pendaftaran user baru |
| | POST | `/login` | No | Login untuk mendapatkan token |
| | POST | `/logout` | **Yes** | Menghapus token aktif |
| **Event** | GET | `/events` | **Yes** | Daftar event (Paginated) |
| | POST | `/events` | **Yes** | Membuat event baru |
| | GET | `/events/{id}` | **Yes** | Detail satu event & peserta |
| | POST | `/events/{id}/join` | **Yes** | User login bergabung ke event |

---

## Catatan Asumsi/Desain

1. **Struktur Tabel Singular:** Mengikuti instruksi, tabel database dinamai `user`, `event`, dan `event_user` (bukan jamak default Laravel).
2. **Relasi Data:** Menggunakan relasi `belongsToMany` di kedua model (`User` & `Event`) untuk menangani hubungan *Many-to-Many*.
3. **API Resources:** Digunakan untuk menstandarisasi output JSON agar terpisah dari struktur database mentah (lebih rapi dan mudah dikelola frontend).
4. **Keamanan:** Validasi input wajib ada di setiap endpoint `POST`. Penggunaan `Hash` untuk password dan `Sanctum` untuk manajemen token.

---

## Jawaban Pertanyaan Wajib

### 1. Bagian tersulit apa dari assignment ini?
Salah satu tantangan terbesar adalah melewati penyesuaian (override) standar konvensi Laravel, yang secara default menggunakan nama tabel jamak (*plural*). Karena instruksi meminta nama tabel tunggal (*singular*), saya harus memastikan bahwa setiap migrasi, model, dan definisi kunci luar didefinisikan secara manual agar hubungan antar tabel tetap berjalan dengan benar tanpa mengandalkan automasi Laravel.

### 2. Jika diberi waktu 1 minggu, apa yang akan kamu perbaiki?
- **Automated Testing:** Membuat unit test dan feature test untuk memastikan setiap endpoint aman dari bug.
- **Documentation:** Membuat dokumentasi Swagger agar frontend developer bisa mencoba API secara interaktif.
- **Authorization:** Menambahkan *Spatie Roles & Permissions* untuk membedakan antara Admin (yang bisa buat/edit event) dan User biasa (yang hanya bisa join).

### 3. Kenapa memilih pendekatan teknis tersebut?
- **Laravel 12 & Sanctum:** Memilih versi ini karena lebih optimal dalam performa dan menggunakan Sanctum karena merupakan library autentikasi API resmi yang ringan (serta native) dan cocok untuk aplikasi *Stateful/Stateless* seperti ini.
- **Eloquent Relationship:** Mengoptimalkan fitur Eloquent untuk menjaga kode mudah dibaca (Readability).
- **Pagination & Resources:** Mengimplementasikan fitur bonus ini sejak awal karena dalam aplikasi nyata, pengiriman data dalam jumlah besar tanpa pagination dan formatter akan memperlambat aplikasi frontend.

--- 
**Developer:** Axel Belliandri
