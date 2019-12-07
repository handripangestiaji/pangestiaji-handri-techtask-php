# symfony-repository-pattern

## How-to install and build

1. Clone the repository

```console
foo@bar:~$ git clone https://github.com/handripangestiaji/pangestiaji-handri-techtask-php.git techtask-php
foo@bar:~$ cd techtask-php
```

2. If you don't have composer in your local, install the composer using following command (linux ubuntu)

```console
foo@bar:~$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

3. Copy the .env.example file to .env and change the database connection as per your local configuration

```console
foo@bar:~$ cp .env.example .env
foo@bar:~$ vi .env
```

```console
# customize this line!
DATABASE_URL="mysql://root:root@127.0.0.1:3306/loadsmile"
```

4. Create the database and migrate the techtask-php database using following command

```console
foo@bar:~$ bin/console doctrine:database:create
foo@bar:~$ bin/console doctrine:migrations:migrate
```

5. Update the library dependencies using following command

```console
foo@bar:~$ composer update
```
After all the dependencies is installed, you can start the your local web server or you can use symfony local web server to make it simple.

6. Please install symfony binary, you can check the instructions here https://symfony.com/download

7. After finish the installation of symfony, you can start your symfony local web server using following command

```console
foo@bar:~$ symfony server:start
```
Open your browser and navigate to http://127.0.0.1:8000/ . if everything is working, you'll see a welcome page.

8. To update the recipe and ingredient data into your database, navigate to http://127.0.0.1:8000/api/ingredient/insert-data and http://127.0.0.1:8000/api/recipe/insert-data

9. To use the lunch API you can use following API 

#### http://127.0.0.1:8000/api/lunch?use-by=2019-01-01