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
	docker exec -it $(PROJECT_NAME)-db bash

composer-install:
	docker exec -it $(PROJECT_NAME)-php composer install

composer-update:
	docker exec -it $(PROJECT_NAME)-php composer update

fix:
	docker exec -it $(PROJECT_NAME)-php composer cs-fix

npm-install:
	docker exec -it $(PROJECT_NAME)-php npm install

npm-update:
	docker exec -it $(PROJECT_NAME)-php npm update

migrate:
	docker-compose exec php php App/Database/Migrations/run_migrations.php

rollback:
	docker-compose exec php php App/Database/Migrations/rollback_migrations.php

seed:
	docker-compose exec php php App/Database/Seed/seeder.php

status:
	docker ps --filter "name=$(PROJECT_NAME)"

clean:
	docker system prune -af && docker volume prune -f