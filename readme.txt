
*CODE ADMINISTRATOR* 
cd Aledrogo
composer install
npm install

php artisan key:generate
php artisan migrate
npm run build 
php artisan serve

//Zdjęcia
1. backup zdjec
2. usun folder /public/storage
3. php artisan storage:link

//Tailwind
npm install -D tailwindcss postcss autoprefixer
npm run build

//mail  w.env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=f26e99ed9ea54a
MAIL_PASSWORD=6f08b6d0e52ad2
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="alledrogoTeam@pylote.com"
MAIL_FROM_NAME="${APP_NAME}"
