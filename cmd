#git merge

php artisan queue:restart
    
https://www.scaleway.com/en/docs/setup-a-mailserver-on-ubuntu-bionic-beaver-with-dovecot-postfix-rspamd/

git add .
git commit -m "before pull"
git pull

sudo chown -R www-data.www-data /var/www/ehwhlinmi-assurance.com/storage/;
sudo chown -R www-data.www-data /var/www/ehwhlinmi-assurance.com/bootstrap/cache;
sudo chown -R www-data.www-data /var/www/ehwhlinmi-assurance.com/storage/logs/;
sudo chown -R www-data.www-data /var/www/ehwhlinmi-assurance.com/storage/logs/laravel.log;
sudo chmod 775 -R /var/www/ehwhlinmi-assurance.com/storage/logs/laravel.log;
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 777 /var/www/ehwhlinmi-assurance.com/public/images/CNI/
chmod -R 777 /var/www/ehwhlinmi-assurance.com/public/images/BAI/
composer dump-autoload -o
php artisan clear-compiled
php artisan view:clear
php artisan optimize
php artisan config:cache;
php artisan config:clear;
php artisan cache:clear; 
php artisan passport:install

sudo chown -R www-data.www-data /var/www/version2.ehwhlinmi-assurance.com/storage/;
sudo chown -R www-data.www-data /var/www/version2.ehwhlinmi-assurance.com/bootstrap/cache;
sudo chown -R www-data.www-data /var/www/version2.ehwhlinmi-assurance.com/storage/logs/;
sudo chown -R www-data.www-data /var/www/version2.ehwhlinmi-assurance.com/storage/logs/laravel.log;
sudo chmod 775 -R /var/www/version2.ehwhlinmi-assurance.com/storage/logs/laravel.log;
sudo chown -R $USER:www-data storage;
sudo chown -R $USER:www-data bootstrap/cache;
chmod -R 775 storage;
chmod -R 775 bootstrap/cache;
chmod -R 777 /var/www/version2.ehwhlinmi-assurance.com/public/images/CNI/;
chmod -R 777 /var/www/version2.ehwhlinmi-assurance.com/public/images/BAI/;
composer dump-autoload -o;
php artisan clear-compiled;
php artisan view:clear;
php artisan optimize;
php artisan config:cache;
php artisan config:clear;
php artisan cache:clear;