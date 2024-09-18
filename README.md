# 1. Chạy migrate để build database

# 2. Cài đặt Laravel JWT
composer require tymon/jwt-auth:^1.0.2

# 3. Khai báo JWT trong app
'providers' => [ Tymon\JWTAuth\Providers\LaravelServiceProvider::class],
'aliases' => ['JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class, 'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class],

# 4. Chạy lệnh 2 lệnh
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret

# 5. Cài đặt package mail:
composer require illuminate/mail

# 6. Cấu hình mail:
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=systemautosendmail@gmail.com
MAIL_PASSWORD=esxwcyoddcyylpxy
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=systemautosendmail@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

# 7. Chạy lệnh: 
php artisan make:mail SendMail


php artisan migrate --path=/database/migrations/2024_08_27_144256_create_family_informations_table.php
php artisan migrate --path=/database/migrations/2024_08_27_091738_create_students_table.php

<!-- Tối về bổ sung get api các trường đại học -->