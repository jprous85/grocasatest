##Deploy of groasatest Project
First create a docker containers

```docker-composer up```

after finish the containers building, enter inside the container project

```docker exec -it grocasatest bash```

Once inside, run:

````composer install````

````php artisan key:generate````
