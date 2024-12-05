
*CODE ADMINISTRATOR* 
cd Aledrogo
composer install
npm install

php artisan key:generate
php artisan migrate
npm run build 
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




paypal
sb-wgzug33467579@business.example.com
{pA31f.J

sb-a3jpd33473419@personal.example.com
GW}$F3?g


//paypal do enva
PAYPAL_CLIENT_ID=AV2Urlz4N18TNeR4pdC7Zh0clae9TiXZ8jdjGNTc29tFY-lI6pofcY3K1wlCIgH-w2mDf46ZyIsLO1qf
PAYPAL_CLIENT_SECRET=EGrn2wsTLd12ghIGYzf5bjm6RqXStASChkagdGhzJMRUEFftVXXm4dq1ILQTZiUxniMsTxPyqgOUvA5l
PAYPAL_MODE=sandbox
