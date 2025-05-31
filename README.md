Run commands to setup local environment
1) `git clone https://github.com/hliu0080/movies-laravel`
2) `cd movies-laravel`
3) `cp .env.example .env` - update db info to match with your local 
4) `sudo chmod -R 777 storage bootstrap/cache`
5) `composer install`
6) `php artisan migrate`
7) Add on /etc/vhosts - `127.0.0.1 local-movies.com`

