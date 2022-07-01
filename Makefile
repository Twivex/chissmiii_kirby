CONTAINER?=chissmiii_kirby

all: help

help:
	@echo "Makefile Instructions:\n" \
	"build: \$$ docker-compose build\n" \
	"up: \$$ docker-comose up -d\n" \
	"prod: \$$ make prod-build prod-up"
	"prod-build: \$$docker-compose -f docker-compose.prod.yml build\n" \
	"prod-up: \$$ docker-compose -f docker-compose.prod.yml up -d\n" \
	"stop: \$$ docker-compose stop\n" \
	"restart: \$$ make stop up\n" \
	"down: \$$ docker-compose down --volumes --rmi all\n" \
	"enter: \$$ docker exec -it \$$CONTAINER bash\n" \
	"npm-install: \$$ docker exec -it \$$CONTAINER sh -c \"npm install\"\n" \
	"dev: \$$ docker exec -it \$$CONTAINER sh -c \"npm run dev\"\n" \
	"dev-setup: \$$ make build up npm-install dev\n" \
	"download-content: \$$ rsync -avzP --delete dock@bay:/var/www/chissmiii_content/ ./dist/content/\n" \
	"upload-content: \$$ rsync -avzP --delete ./dist/content/ dock@bay:/var/www/chissmiii_content\n" \

build:
	docker-compose build

up:
	docker-compose up -d

dev-setup: build up npm-install dev

prod-build:
	docker-compose -f docker-compose.prod.yml build

prod-up:
	docker-compose -f docker-compose.prod.yml up -d

prod: prod-build prod-up

stop:
	docker-compose stop

restart: stop up

down:
	docker-compose down --volumes --rmi all

enter:
	docker exec -it ${CONTAINER} bash

npm-install:
	docker exec -it ${CONTAINER} sh -c "npm install"

dev:
	docker exec -it ${CONTAINER} sh -c "npm run dev"

download-content:
	rsync -avzP --delete dock@bay:/var/www/chissmiii/dist/content/ ./dist/content/

upload-content:
	rsync -avzP --delete ./dist/content/ dock@bay:/var/www/chissmiii/dist/content/