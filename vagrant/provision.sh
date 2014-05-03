composer self-update
cd /vagrant
composer install
app/console cache:warmup
app/console assets:install web
