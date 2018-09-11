# arcanite-et
 
## Установка

`git clone --recursive -j8 git@github.com:Dragomeat/arcanite-et.git`
 
1. `cp .env.example .env`
2. `cp .env.laradock.example ./laradock/.env`
3. `cd laradock`
4. `docker-compose build workspace nginx php-fpm php-worker mysql`
5. `docker-compose up -d workspace nginx php-fpm php-worker mysql`
6. `docker-compose exec --user=laradock workspace bash`
7. `composer install`
8. `art key:generate`
9. `art migrate`
10. Change MAIL_DRIVER to log 
11. http://localhost
