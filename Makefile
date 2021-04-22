all: build up

build:
	docker-compose build

up:
	docker-compose up -d

stop:
	docker-compose stop

restart: stop up

down:
	docker-compose down

enter:
	docker exec -it chissmiii_kirby bash