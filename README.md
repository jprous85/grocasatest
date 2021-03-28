##Deploy of groasatest Project
First copy .env.example to .env

Create a docker containers

```docker-composer up```

after finish the containers building, enter inside the container project

```docker exec -it grocasatest bash```

Once inside, run:

````composer install````
