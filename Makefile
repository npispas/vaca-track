# Project Name
PROJECT_NAME=vaca-track

# Define commands
up:
	docker-compose up -d --build

down:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d --build

logs:
	docker-compose logs -f

php:
	docker exec -it $(PROJECT_NAME)-php bash

nginx:
	docker exec -it $(PROJECT_NAME)-nginx bash

db:
	docker exec -it $(PROJECT_NAME)-db mysql -uuser -ppassword vaca_track

composer-install:
	docker exec -it $(PROJECT_NAME)-php composer install

composer-update:
	docker exec -it $(PROJECT_NAME)-php composer update

migrate:
	docker exec -it $(PROJECT_NAME)-php php artisan migrate

seed:
	docker exec -it $(PROJECT_NAME)-php php artisan db:seed

status:
	docker ps --filter "name=$(PROJECT_NAME)"

clean:
	docker system prune -af && docker volume prune -f