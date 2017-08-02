#!/usr/bin/env bash

cd ./nq-solicitors-app

if [ -f ./.env ] 
then
    echo ".env file already exists" 
else
    echo "Creating .env file" 
    cp ./.env.example ./.env
fi

echo "Installing npm modules" 
npm install --no-bin-links

echo "Installing bower dependencies" 
cd public
bower install
cd ../

echo "Migrating and seeding test database" 
echo "CREATE DATABASE test" | mysql -uhomestead -psecret
php artisan migrate --database="test" --seed

echo "Migrating and seeding demo database" 
php artisan key:generate
php artisan migrate
php artisan db:seed --class="DevelopmentSeeder"

echo "Compiling assets" 
gulp

echo "Link public storage" 
ln -s /home/vagrant/nq-solicitors-app/storage/app/public /home/vagrant/nq-solicitors-app/public/storage

echo "Install mailcatcher"
sudo apt-add-repository ppa:brightbox/ruby-ng
sudo apt-get update
sudo apt-get -y install ruby2.3 ruby2.3-dev
sudo gem install mailcatcher
mailcatcher --ip=0.0.0.0
