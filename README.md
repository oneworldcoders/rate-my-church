# rate-my-church

![PHP Composer](https://github.com/oneworldcoders/rate-my-church/workflows/PHP%20Composer/badge.svg)


## Setup and Installation
### Docker
* clone the repo
```
git clone https://github.com/oneworldcoders/rate-my-church.git
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
* run migrations
```
docker exec -it ratemychurch_app_1 /bin/bash
php artisan migrate
```

### Without Docker
* clone the repo
```
git clone https://github.com/oneworldcoders/rate-my-church.git
```

* install dependencies
```
composer install
```

* run migrations
```
php artisan migrate
```

## Testing
```
composer run-script test
```