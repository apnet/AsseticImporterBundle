composer self-update

if [ -d /home/vagrant/share ]; then
    composer config --file=/home/vagrant/.composer/config.json vendor-dir /home/vagrant/share/vendor
    composer config --global vendor-dir /home/vagrant/share/vendor
    if [ ! -d /vagrant/vendor ]; then
        ln -s /home/vagrant/share/vendor /vagrant/vendor
    fi
fi
cd /vagrant
if [ -f ./github-oauth.txt ]; then
    GITHUB_OAUTH_TOKEN="$(cat github-oauth.txt)"

    composer config --file=/home/vagrant/.composer/config.json github-oauth.github.com $GITHUB_OAUTH_TOKEN
    chown vagrant:vagrant /home/vagrant/.composer/auth.json
    composer config --global github-oauth.github.com $GITHUB_OAUTH_TOKEN
fi
composer install
chown -R vagrant:vagrant /home/vagrant/share/vendor
app/console cache:warmup
app/console assets:install web
