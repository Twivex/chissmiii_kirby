CONTAINER?=chissmiii_kirby

all: help

help:
	@echo "Makefile instructions:\n" \
	"dev-build: \$$ docker-compose -f docker-compose.yml -f docker-compose.dev.yml build\n" \
	"dev-up: \$$ docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d\n" \
	"dev: dev-up npm-watch\n" \
	"dev-setup: dev-build dev-up\n" \
	"dev-restart: stop dev-up\n" \
	"dev-npm-install: \$$ docker exec -it ${CONTAINER} sh -c \"npm install\"\n" \
	"-------------------------------------------------------------------------------------\n" \
	"prod-build: \$$ docker-compose -f docker-compose.yml -f docker-compose.prod.yml build\n" \
	"prod-up: \$$ docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d\n" \
	"prod: prod-build prod-up\n" \
	"prod-restart: stop prod-up\n" \
	"prod-npm-install: \$$ docker exec -it ${CONTAINER} sh -c \"npm install --only=prod\"\n" \
	"prod-deploy: prod-build prod-restart prod-npm-install npm-build\n" \
	"-------------------------------------------------------------------------------------\n" \
	"stop: \$$ docker-compose stop\n" \
	"down: \$$ docker-compose down --volumes --rmi all\n" \
	"enter: \$$ docker exec -it ${CONTAINER} bash\n" \
	"-------------------------------------------------------------------------------------\n" \
	"npm-watch: \$$ docker exec -it ${CONTAINER} sh -c \"npm run dev\"\n" \
	"npm-build: \$$ docker exec -it ${CONTAINER} sh -c \"npm run build\"\n" \
	"-------------------------------------------------------------------------------------\n" \
	"download-vols: \$$ rsync -avzP --delete dock@bay:/var/www/chissmiii_vols/content/ ./dist/content/ && ...\n" \
	"upload-vols: \$$ rsync -avzP --delete ./dist/content/ dock@bay:/var/www/chissmiii_vols/content/ && ...\n" \

dev-build:
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml build

dev-up:
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d

dev: dev-up npm-watch

dev-setup: dev-build dev-up

dev-restart: stop dev-up

dev-npm-install:
	docker exec -it ${CONTAINER} sh -c "npm install"

prod-build:
	docker-compose -f docker-compose.yml -f docker-compose.prod.yml build

prod-up:
	docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d

prod: prod-build prod-up

prod-restart: stop prod-up

prod-npm-install:
	docker exec -it ${CONTAINER} sh -c "npm install --only=prod"

prod-deploy: prod-build prod-restart prod-npm-install npm-build

stop:
	docker-compose stop

down:
	docker-compose down --volumes --rmi all

enter:
	docker exec -it ${CONTAINER} bash

npm-watch:
	docker exec -it ${CONTAINER} sh -c "npm run dev"

npm-build:
	docker exec -it ${CONTAINER} sh -c "npm build"

download-vols:
	rsync -avzP --delete dock@bay:/var/www/chissmiii_vols/content/ ./dist/content/ && \
	rsync -avzP --delete dock@bay:/var/www/chissmiii_vols/media/ ./dist/media/ && \
	rsync -avzP --delete dock@bay:/var/www/chissmiii_vols/site/accounts/ ./dist/site/accounts/

upload-vols:
	rsync -avzP --delete ./dist/content/ dock@bay:/var/www/chissmiii_vols/content/ && \
	rsync -avzP --delete ./dist/media/ dock@bay:/var/www/chissmiii_vols/media/ && \
	rsync -avzP --delete ./dist/site/accounts/ dock@bay:/var/www/chissmiii_vols/site/accounts/