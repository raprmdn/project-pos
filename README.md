<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Point of Sale

Project Akhir Laravel Aplikasi Point of Sale

Studi Independen Kampus Merdeka - Akademi Fullstack Web Developer - NF Computer

Anggota Kelompok 10:

- [Qoidurrahman Haqiqi](https://github.com/kikisafera)
- [Muhammad Nabil Islam](https://github.com/mas-nano)
- [Rafi Putra Ramadhan](https://github.com/raprmdn)
- [Muhammad Yusuf Hijriah](https://github.com/yusufhijriah)

Features:
- Authentication, User login and register.
- Authorization, role and permissions.
- Chart Report pada Dashboard.
- CRUD Categories.
- CRUD Units.
- CRUD Products.
- CRUD Suppliers.
- Order, order products from suppliers.
- Sales.
- Transactions.
- Reports.
- Export PDF.
- Export Excel.
- Print Invoice.

Packages:
- [Laravel Fortify](https://laravel.com/docs/9.x/fortify)
- [Laravel DataTables](https://yajrabox.com/docs/laravel-datatables/master/installation)
- [Spatie Role and Permissions](https://spatie.be/docs/laravel-permission/v5/installation-laravel)
- [Laravel PDF](https://github.com/barryvdh/laravel-dompdf)
- [Laravel Excel](https://laravel-excel.com/)
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar) Development only
## Installation

Clone this repository
```bash
git clone https://github.com/mas-nano/project-pos.git
```
cd into `project-pos` folder, then
```bash
composer install
```
```bash
cp .env.example .env
```
```phpt
# Setup file driver and connection to the database.
FILESYSTEM_DRIVER=public
```
Run:
```bash
php artisan key:generate
```
```bash
php artisan storage:link
```
if you don't want to use a new database, you can import it from the `backup_project_pos.sql` file. 

Or you can type following the command
```bash
php artisan migrate --seed
```
Then, run laravel application
```bash
php artisan serve
```
Credentials:
```bash
# Email Administrator
kiki@email.com
nabil@email.com
rafi@email.com
yusuf@email.com

# Email Staff
staff@email.com

# Email Cashier
cashier@email.com

# All password
123123123
```
