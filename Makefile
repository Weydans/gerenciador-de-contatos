run: down install
	docker-compose up -d --build
	docker-compose exec app composer install
	make status

test:
	docker-compose exec app ./vendor/bin/phpunit 

down:
	docker-compose down
	make status

status:
	docker-compose ps -a

install:
	ls .env || cp .env.example .env
	ls .data || mkdir .data

uninstall:
	cd .. && rm -rf gerenciador-de-contatos

