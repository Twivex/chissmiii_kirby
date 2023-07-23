include .$(pwd)/.env
include .$(pwd)/.env-name

all: help

help:
	@echo "Makefile instructions:\n" \
	"docker-build: \$$ docker buildx build --push --platform=${BUILD_TARGET_PLATFORM} --tag twivex/${BASE_IMAGE_NAME} .\n" \
	"docker-pull: \$$ docker pull ${BASE_IMAGE_NAME}\n" \
	"-------------------------------------------------------------------------------------\n" \
	"build: \$$ docker-compose -f docker-compose.yml -f docker-compose.{env}.yml build\n" \
	"up: \$$ docker-compose -f docker-compose.yml -f docker-compose.{env}.yml up -d\n" \
	"stop: \$$ docker-compose stop\n" \
	"restart: stop up\n" \
	"-------------------------------------------------------------------------------------\n" \
	"dev: up npm-watch env=dev\n" \
	"deploy: build restart npm-build env=prod\n" \
	"-------------------------------------------------------------------------------------\n" \
	"down: \$$ docker-compose down --volumes --rmi all\n" \
	"enter: \$$ docker exec -it ${MAIN_CONTAINER_NAME}-{env} bash\n" \
	"-------------------------------------------------------------------------------------\n" \
	"npm-install: \$$ docker exec -it ${MAIN_CONTAINER_NAME}-{env} sh -c \"npm install\"\n" \
	"npm-build: \$$ docker exec -it ${MAIN_CONTAINER_NAME}-{env} sh -c \"npm run build\"\n" \
	"npm-watch : \$$ docker exec -it ${MAIN_CONTAINER_NAME}-{env} sh -c \"npm run dev\"\n" \

docker-build:
	docker buildx build --push --platform=${BUILD_TARGET_PLATFORM} --tag twivex/${BASE_IMAGE_NAME} .

docker-pull:
	docker pull twivex/${BASE_IMAGE_NAME}

build:
	docker-compose -f docker-compose.yml -f docker-compose.${env}.yml build

up:
	docker-compose -f docker-compose.yml -f docker-compose.${env}.yml up -d

stop:
	docker-compose stop

restart: stop up

dev:
	make up npm-watch env=dev

deploy:
	make docker-pull build restart npm-build env=prod

down:
	docker-compose down --volumes --rmi all

enter:
	docker exec -it ${MAIN_CONTAINER_NAME}-${env} bash

npm-install:
	docker exec -it ${MAIN_CONTAINER_NAME}-${env} sh -c "npm install"

npm-build:
	docker exec -it ${MAIN_CONTAINER_NAME}-${env} sh -c "npm run build"

npm-watch:
	docker exec -it ${MAIN_CONTAINER_NAME}-${env} sh -c "npm run dev"

git-pull-content:
	git submodule update --remote --merge dist/content

git-push-content:
	cd dist/content && \
	git add . && \
	git commit -m "updated content" && \
	git push && \
	cd ../../ && \
	git add dist/content && \
	git commit -m "updated submodule state dist/content" && \
	git push

fix-permissions:
	sudo chown -R dock:www-data . && \
	sudo find /var/www/ -type d -exec chmod 775 {} + && \
	sudo find /var/www/ -type f -exec chmod 664 {} +