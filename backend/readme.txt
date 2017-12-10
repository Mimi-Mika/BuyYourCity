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



We have our own server at : www.buyyourcity.ovh
u can use our api at www.api.buyyourcity.ovh





NEW !!!!
We have our own api documentation provided by SWAGGER

instalation :
Simple type that on your terminal
composer require "darkaonline/l5-swagger:5.5.*" 

php artisan l5-swagger:publish
after you enter this command it will some folder from vendor to public folder

php artisan l5-swagger:publish-config
to create config file. From that file you config some information like : Title, auth_token, security_definition, key_inject....

php artisan l5-swagger:publish-views
to publish views (resources/views/vendor/l5-swagger)

Navigate to your localhost by add this "/api/documentaion" like this:
http://localhost:8000/api/documentation (I created virtual host)
if not virtual host it shoud look like this:
http://localhost:8000/mylaravel/public/api/documentation 
You will swagger is running like below but it is not yet working properly, so you have to generate api-docs.json.

First you have to create controller like :
php artisan make:controller ApiController

and then you will see this file in controller folder and you have to add @SWG/Swagger above the controller like this: Don't forget to type this command to generate the api_docs.json :
php artisan l5-swagger:generate

We will create another DashboardController to show GET in Swagger. So please type this command:
php artisan make:controller 