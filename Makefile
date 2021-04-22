all: build up

build:
	docker-compose build

up:
	docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down

enter:
	docker exec -it chissmiii_kirby bash