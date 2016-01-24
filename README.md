Symfony2 test project
=========
To set up the project
- run: composer install
- run: npm install
- run: bower install
- run: php app/console doctrine:database:create
- run: php app/console doctrine:migrations:migrate
- run: php app/console doctrine:fixtures:load
