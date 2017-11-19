On mysql, create your DB & a user,

Open the .env file & modify DB_DATABASE=... DB_USERNAME=... DB_PASSWORD=...

Create folder images here : 

mkdir BuyYourCity/backend/storage/app/public/images

On backend folder,
Open your terminal & launch this command for generate tables :

$ php artisan migrate

After u can create fake datas with this :
$ php artisan db:seed

Finally you can start your local server with :
$ php artisan serv

You can access the API by the URL: http://localhost:8000/

Enjoy !!! ;)

U can see all routes aviable with : 
$ php artisan route:list


NEW !!!! We have our own server at : www.buyyourcity.ovh
u can use our api at www.api.buyyourcity.ovh

