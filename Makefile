all: build up

build:
	docker-compose build

up:
	docker-compose up -d

dev-setup: build up npm-install dev

stop:
	docker-compose stop

restart: stop up

down:
	docker-compose down

enter:
	docker exec -it chissmiii_kirby bash

npm-install:
	docker exec -it chissmiii_kirby sh -c "npm install"

dev:
	docker exec -it chissmiii_kirby sh -c "npm run dev"

download-content:
	rsync -avzP --delete dock@bay:/var/www/chissmiii/dist/content/ ./dist/content/

upload-content:
	rsync -avzP --delete ./dist/content/ dock@bay:/var/www/chissmiii/dist/content/