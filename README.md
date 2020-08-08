# Rate My Church

![PHP Composer](https://github.com/oneworldcoders/rate-my-church/workflows/PHP%20Composer/badge.svg)

Rate My Church is an application that allows users to find a church that best fits their needs.

## Setup and Installation

* clone the repo
```
git clone https://github.com/oneworldcoders/rate-my-church.git
```

### Docker

* set environment
- [ ] create a .env file and copy the .env.example into it
- [ ] change to use the following env variables
- [ ] DB_DATABASE and POSTGRES_PASSWORD can be changed to your preference
```
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=rate_my_church
POSTGRES_USER=postgres
POSTGRES_PASSWORD=postgres
```

* build the image
```
docker-compose build
```

* run the container(s)
```
docker-compose up
```
* Ensure the services are running with 
```
docker ps
```
* run migrations and seeders
```
docker exec -it ratemychurch_app_1 /bin/bash
php artisan migrate
php artisan db:seed
```

### Without Docker

* set environment
- [ ] create a .env file and copy the .env.example into it
- [ ] change the following env variables to your preference
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

* install dependencies
```
composer install
```

* run migrations and seeders
```
php artisan migrate
php artisan db:seed
```

* start the server
```
php artisan serve
```

## Testing
```
composer run-script test
```
In case the tests are not running, you may need to generate a secret key.
* Generate secret key
```
php artisan key:generate
```

## Usage
There are 2 user types created from the seed data, an admin and a regular user, by default the regular users have no permissions and the admin has to manually assign the users various permissions. Register a user then Log in as an admin and add the user permissions. Each permission will give the user different features.

It is recommended to use different browsers or (same browser but one window in incognito) for the admin and regular user since cookies are used to determine the logged in user.

To log in as an admin
```
email: admin@example.com
password: password
```
