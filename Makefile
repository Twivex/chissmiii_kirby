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

pull-content-2dev:
	ssh dock@bay "cd /ext_storage/kirby-content && git add . && git commit -m \"updated content\" && git push"; \
	cd ${EXTERNAL_VOLUMES_PATH}/kirby-content && git pull

sync-videos-2dev:
	rsync -avzP --delete --include="*/" --include="*.mp4" --exclude="*" dock@bay:/ext_storage/kirby-content/ ${EXTERNAL_VOLUMES_PATH}/kirby-content/

push-content-2bay:
	cd ${EXTERNAL_VOLUMES_PATH}/kirby-content && \
	git add . && git commit -m "updated content" && git push

sync-videos-2bay:
	rsync -avzP --delete --include="*/" --include="*.mp4" --exclude="*" ${EXTERNAL_VOLUMES_PATH}/kirby-content/ dock@bay:/ext_storage/kirby-content/

fix-permissions:
	sudo chown -R dock:www-data . && \
	sudo find /var/www/ -type d -exec chmod 775 {} + && \
	sudo find /var/www/ -type f -exec chmod 664 {} +