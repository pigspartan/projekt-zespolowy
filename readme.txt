
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




//idk, żeby tailwind działał
//skrypt w package.json
"watch": "vite build --watch"
//uruchomić w 1. konsoli
npm run watch
//uruchomić drugą konsolę
//php artisan serve