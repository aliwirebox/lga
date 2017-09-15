# Legal Asset

## Development Area
### Building
The following installation will require you to have Vagrant, GIT, PHP, and Composer on your local machine.

Windows
Open your command line tool(cmd, git-bash etc.) with administrator privileges. 
This is useful to avoid permission issues on the shared folder
Creating and booting the VM should always be done this way particularly if you need to run anything as sudo or root in the VM

All:
```
git clone git clone git@bitbucket.org:wireboxteam/legal-asset-app.git
cd legal-asset-app
composer install --ignore-platform-reqs
```

Windows:
```
vendor\\bin\\homestead make
```

Mac / Linux:
```
php vendor/bin/homestead make
```

Edit lines 9 - 12 of the Homestead.yml file. Either add the path to your ssh
key or comment out the lines. Then paste the following line on a new line in the config file.
```
version: 0.6.0
```

All:
```
vagrant up
```

Open you hosts file in an editor of your own choice.

Windows:
```
C:\Windows\System32\drivers\etc
```

Mac / Linux:
```
vim /etc/hosts
```

Then append the following line to the file.

All:
```
192.168.10.10 dev.legal-asset.com
```

Close and open your browser and [view your development area](http://dev.legal-asset.com)

### Compiling Assets

When the development area is building, gulp will run to compile files like CSS and JavaScript. If you need to make lots of changes to 
these files you can have gulp compile on the fly.  

Open a new terminal and run the commands below. Leave the terminal open after running the last command or use tmux to run gulp in 
the background.

All:
```
vagrant ssh
cd legal-asset-app/
gulp watch
```
### Update GIT Branch

Switching branches can leave you with dependencies, class maps, complied CSS and JavaScript files that are out of date. There is
a helper script that will run all the necessary commands to update the current GIT branch that you are on.  

All:
```
vagrant ssh
cd legal-asset/
./build/update.sh
```
It is still possible to get in a muddle with database migrations while switching branches but this script should limit those cases. 
If you run into trouble with your database migrations during development the easiest solution is to drop and recreate the database, 
then migrate and seed.

### Seeding
When you first build your development area your database will be seeded with lots of fake data. To re-seed the database with fake
data you can run the following command:  
```
vagrant ssh
cd legal-asset-app/
php artisan db:seed --class="DevelopmentSeeder"
```
If you only want the required data without any faked data you can run:
```
vagrant ssh
cd legal-asset-app/
php artisan db:seed
```

### Test User Details
By default the following users are created for you to use during development.

Candidate  
email: candidate@test.com  
pass: testpass  

Hirer  
email: hirer@test.com  
pass: testpass  

Admin  
email: brand-admin@test.com  
pass: testpass  

### Emails
All emails are written to mailcatcher which can be viewed at [http://dev.legal-asset.com:1080/](http://dev.legal-asset.com:1080/)

### Hirer Registration
To register as a hirer for a company you must have a email domain that has been white-listed by that company.  

In development all emails are written out to the [mailcatcher](http://dev.legal-asset.com:1080/) so you can sign up with any of the companies domains and get the verification
code from the log.  

### Running Tests
To run the tests make sure the test database is up to date.
```
php artisan migrate:refresh --database="test" --seed
```
Then run the tests via
```
vendor/bin/phpunit
```

## Stagging
### Releasing

Forge is hooked up to release when new commits are pushed to staging. Release messages are sent to the Slack channel #legal-asset.
[Click here to view staging](https://legal-asset.testmyurl.co.uk/).

All:
```
git push origin staging
```
### Test User Details
Test users are the same as developments

### Emails
All emails are written to mailtrap.io

### Hirer Registration
To register as a hirer for a company you must have a email domain that has been white-listed by that company.  

On staging go to mailtrap to validate emails


## Production
### Releasing

Forge is hooked up to release when new commits are pushed to master. Release messages are sent to the Slack channel #legal-asset.
[Click here to view production](https://legal-asset.com/).

All:
```
git push origin master
```
### Test User Details
There are no test users

### Emails
All emails are live and sent out via mailgun

### Hirer Registration
To register as a hirer for a company you must have a email domain that has been white-listed by that company.