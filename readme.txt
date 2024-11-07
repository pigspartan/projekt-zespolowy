
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




//idk, żeby tailwind działał
//skrypt w package.json
"watch": "vite build --watch"
//uruchomić w 1. konsoli
npm run watch
//uruchomić drugą konsolę
//php artisan serve