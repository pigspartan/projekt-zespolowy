
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
3. php artiyarn installsan storage:link

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

//mail  w.env
zróbcie konto na mailtrapie i skopiujcie PHP->laravel 9+ do .env


//paypal wstępnie 
1. composer require srmklive/paypal
2. php artisan vendor:publish --provider="Srmklive\PayPal\Providers\PayPalServiceProvider"
3. do env   PAYPAL_CLIENT_ID=id twoje
			PAYPAL_CLIENT_SECRET=klucz 
			PAYPAL_MODE=sandbox




paypal pussy
sb-wgzug33467579@business.example.com
{pA31f.J

sb-a3jpd33473419@personal.example.com
GW}$F3?g