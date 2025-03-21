PHP_CLI = symfony_test_task_php-cli
DOCKER_COMPOSE = docker-compose -f docker-compose.yml --env-file ./_docker/.env
DOCKER_COMPOSE_PHP_CLI_EXEC = ${DOCKER_COMPOSE} run -it -u www ${PHP_CLI}

WELCOME = Welcome	"\n\n"http://localhost:4444"\n\n"

build:
	${DOCKER_COMPOSE} build

up:
	${DOCKER_COMPOSE} up -d
down:
	${DOCKER_COMPOSE} down -v --rmi=all --remove-orphans

php_cli:
	${DOCKER_COMPOSE} run -it -u www ${PHP_CLI} bash

composer_dev:
	${DOCKER_COMPOSE} run -it -u www ${PHP_CLI} composer install --optimize-autoloader

migrate:
	${DOCKER_COMPOSE} run -it -u www ${PHP_CLI} php ./bin/console doctrine:migrations:migrate --no-interaction

init:
	make build up composer_dev migrate wprint

wprint:
	@echo ${WELCOME}
