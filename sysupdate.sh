php artisan down
git pull origin master
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
php composer.phar install
php artisan migrate
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan up
