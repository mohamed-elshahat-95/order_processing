-- You need to have installed php V8.2

Steps to do...

1- Create (.env) file, you can copy the content of the (.env.example) file and past it on the created .env file,
and set the database credentials on it like this:

DB_CONNECTION=mysql\
DB_HOST=127.0.0.1\
DB_PORT=3306\
DB_DATABASE=test\
DB_USERNAME=root\
DB_PASSWORD=root\

2- run [composer dump-autoload]

3- create a database with name (test) 

4- run [php artisan migrate] 

5- run [php artisan serve] to start the project and it will be running on (http://127.0.0.1:8000)

6- You can download the postman_collection of all created requests (in the postman_collection folder).