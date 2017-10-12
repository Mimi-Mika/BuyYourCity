On mysql, create your DB & a user,

Open the .env file & modify DB_DATABASE=... DB_USERNAME=... DB_PASSWORD=...

On backend folder,
Open your terminal & launch this command for generate tables :
$ php artisan migrate

After u can create fake datas with this :
$ php artisan db:seed

Finally you can start your server with :
$ php artisan serv

You can access the API by the URL: http://localhost:8000/api/

Enjoy !!! ;)