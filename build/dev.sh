#!/usr/bin/env bash

cd ./legal-asset-app

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
#For Windows 10 hosts start git-bash etc. with administrator privileges and vagrant up to allow privileges to pass through to the host
ln -s /home/vagrant/legal-asset/storage/app/public /home/vagrant/legal-asset/public/storage


echo "Install mailcatcher"
sudo apt-add-repository ppa:brightbox/ruby-ng
sudo apt-get update
sudo apt-get -y install ruby2.3 ruby2.3-dev
sudo gem install mailcatcher
mailcatcher --ip=0.0.0.0
