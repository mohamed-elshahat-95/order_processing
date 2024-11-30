-- You need to have installed php V8.2

Steps to do...

1- Cloning with SSH => Run: (git clone git@github.com:mohamed-elshahat-95/tenjaz-task.git)

2- Create (.env) file, you can copy the content of the (.env.example) file and past it on the created .env file,
and set the database credentials on it like this:

DB_CONNECTION=mysql\
DB_HOST=127.0.0.1\
DB_PORT=3306\
DB_DATABASE=test\
DB_USERNAME=root\
DB_PASSWORD=root

3- run [composer dump-autoload]

4- create a database with name (test) 

5- run [php artisan migrate] 

6- run [php artisan serve] to start the project and it will be running on (http://127.0.0.1:8000)

7- You can download the postman_collection of all created requests (in the postman_collection folder).