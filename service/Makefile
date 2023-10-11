messenger:
	cd /var/www/html/ && bin/console messenger:consume async -vv

phpunit:
	bin/phpunit

phpstan:
	vendor/bin/phpstan analyse && bin/console cache:clear

phpcbf:
	vendor/bin/phpcbf

phpmd:
	vendor/bin/phpmd src ansi ./tests/phpmd.xml

test:
	vendor/bin/phpcbf && vendor/bin/phpstan analyse && bin/console cache:clear && bin/phpunit && vendor/bin/phpmd src ansi ./tests/phpmd.xml

test-all:
	vendor/bin/phpcbf ; vendor/bin/phpstan analyse ; vendor/bin/phpmd src ansi ./tests/phpmd.xml ; bin/phpunit

rebuild-and-test-all:
    cd /var/www/html/ && vendor/bin/phpcbf && vendor/bin/phpstan analyse && bin/console cache:clear && bin/console --env=test doctrine\:schema\:drop --full-database --force && yes | bin/console --env=test doctrine\:migrations\:migrate && yes | bin/console --env=test doctrine\:fixtures\:load && bin/phpunit && vendor/bin/phpmd src ansi ./tests/phpmd.xml && vendor/bin/phpinsights --no-interaction

doctrine-rebuild-migrations-and-data:
	rm -f ./migrations/* && bin/console doctrine\:schema\:drop --full-database --force && bin/console make\:migration && yes | bin/console doctrine\:migrations\:migrate && yes | bin/console doctrine:fixtures:load

data-reset:
	bin/console doctrine:schema:drop --full-database --force && yes | bin/console doctrine:migrations:migrate && yes | bin/console doctrine:fixtures:load

drop-tables:
	bin/console doctrine:schema:drop --full-database --force

migration:
	bin/console make:migration

migrate:
	yes | bin/console doctrine:migrations:migrate

fixtures:
	yes | bin/console doctrine:fixtures:load

test-migrate:
	yes | bin/console --env=test doctrine:migrations:migrate

test-fixtures:
	yes | bin/console --env=test doctrine:fixtures:load

test-drop-tables:
	bin/console --env=test doctrine:schema:drop --full-database --force

doctrine-rebuild-test:
	bin/console --env=test doctrine:schema:drop --full-database --force && yes | bin/console --env=test doctrine:migrations:migrate && yes | bin/console --env=test doctrine:fixtures:load

ui:
	. ${NVM_DIR}/nvm.sh && nvm use && yarn encore dev --watch

entity:
	bin/console make:entity

clear-cache:
	bin/console cache:clear
