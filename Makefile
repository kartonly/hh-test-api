#Первый запуск
first-start: app-build start

app-build:
	docker-compose build
start:
	docker-compose up -d
app-stop:
	docker-compose stop
exec-php-fpm:
	docker-compose exec news-php-fpm bash

