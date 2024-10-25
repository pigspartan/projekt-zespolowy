
*CODE ADMINISTRATOR* 
cd Aledrogo
composer install
npm install

php artisan key:generate
php artisan migrate
npm run build 
php artisan serve

//Zdjęcia
php artisan storage:link

//Tailwind
npm install -D tailwindcss postcss autoprefixer
npm run build

