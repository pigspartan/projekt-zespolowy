
*CODE ADMINISTRATOR* 
cd Aledrogo
composer install
npm install

php artisan key:generate
php artisan migrate
npm run build 
//jeśli jest ściana czerwonego tekstu to może npm update
php artisan serve

//Seedowanie ról
php artisan db:seed --class=RoleSeeder

//Zdjęcia
1. backup zdjec
2. usun folder /public/storage
3. php artisan storage:link

//Tailwind
npm install -D tailwindcss postcss autoprefixer
npm run build

// Zmiana statusu zamówienia i transakcji po 5 minutach oczekiwania
php artisan queue:work

// instalacja broadcastowanya
php artisan install:broadcasting
  - instaluj reverb
  - instaluj zależności
  
uruchom php artisan reverb:start --port=8001 (wybierz port albo wcale nie dawaj jak działa bez)



//idk, żeby tailwind działał
//skrypt w package.json
"watch": "vite build --watch"
//uruchomić w 1. konsoli
npm run watch
//uruchomić drugą konsolę
php artisan serve

//mail  w.env
zróbcie konto na mailtrapie i skopiujcie PHP->laravel 9+ do .env


//paypal wstępnie
1. composer require srmklive/paypal
2. php artisan vendor:publish --provider="Srmklive\PayPal\Providers\PayPalServiceProvider"
3. do env   PAYPAL_CLIENT_ID=id twoje
			PAYPAL_CLIENT_SECRET=klucz
			PAYPAL_MODE=sandbox




paypal
sb-wgzug33467579@business.example.com
{pA31f.J

sb-a3jpd33473419@personal.example.com
GW}$F3?g






//funy wipe
php artisan db:wipe    