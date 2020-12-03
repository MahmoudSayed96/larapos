# larapos
> This is laravel admin dashboard for Point Of Sale (POS) app.
## Steps to run app
* Clone/Download repo
* copy file example.env and rename it to .env and change database configurations
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larapos_db
DB_USERNAME=root
DB_PASSWORD=root
```
* Run migration to create tables and users`SuperAdmin and Admin`
> php artisan migrate:fresh --seed
* Run this command and go to `http://localhost:8000`
> php artisan serve

## Login as super admin
Email:
> super_admin@app.com
Password: 
> asd123

# OR
## Login as admin
Email:
> admin@app.com
Password: 
> asd123
