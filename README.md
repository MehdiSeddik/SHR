# SHR API

Symfony 6.1 api powered by api-platform, using php 8.1

## How to contribute

# 1 | Install package manager ans symfony cli

To run the dev environment, you'll need [composer](https://getcomposer.org/) and [Symfony CLI](https://symfony.com/download)

# 3 | Clone this repo

clone the repo using the command `git clone https://github.com/MehdiSeddik/SHR.git` \
then install the dependencies using `composer install`.

# 4 | Create your local database

You will need a [server-stack](https://www.letecode.com/quest-ce-que-wamp-lamp-mamp-xampp-et-quelle-difference-faut-il-faire)
or you can use docker ! (docker file and docker-compose are already configured)

when your local db is ready, fork the `.env` file and name it `.env.local` (this makes it untracked ), then change the line 
`DATABASE_URL="mysql://root:!donotshrthispwd!@mysql:3306/shrdb?serverVersion=8&charset=utf8mb4"`
to match your db config

when it's all done, run the command : `php bin/console doctrine:database:create`

sometimes after pulling new changes, the db schema can change. dont forget to update your db using `php bin/console d:s:u` (doctrine:schema:update) 

# 4 | Launch the server

run the command  `symfony serve`

### Great job, you can now contribute !
