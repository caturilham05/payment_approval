## Dokumentasi Project Approval

- clone project ini terlebih dahulu
- buat database baru dengan nama approved
- jalankan perintah composer update
- copy .env.example dengan nama file .env
- generate key dengan cara <b>php artisan key:generate</b>
- jalankan perintah php artisan serve untuk menjalankan aplikasi dengan IP Address local http://127.0.0.1:8000


## Penting
- silahkan buat data user terlebih dahulu (buat user admin dan public)
- <b>Disarankan user public lebih dari 1 supaya bisa tahu data apporval berdasarkan user yang login</b>
- silahkan buka folder <b>database->factories</b> untuk membuat data user, kemudian jalankan <b>php artisan db:seed</b> untuk generate data user yang sudah di <b>database->factories</b>



## Penggunaan Aplikasi
- Akses Halaman http://127.0.0.1:8000/admin untuk login admin
- Akses Halaman http://127.0.0.1:8000 untuk login user public