# ChissMiii Website
## Infrastructure
- Kirby
- Node, NPM Build Chain
- Docker Compose for Dev & Prod

### Server
**Hardware**
|||
-----|----
Device | Raspberry Pi 3B+
SD | SanDisk 32GB
HDD | -

**Operating System**
|||
-----|----
Distributor ID | Raspbian
Description | Raspbian GNU/Linux 10 (buster)
Release | 10
Codename | buster

### Software/Frameworks
- Kirby v3.6.6
- Bootstrap v5.1.3

## How to Dev
- create a file `.env-name` with content `env=dev`

### Setup & First start
- Pull base image: `make docker-pull`
- Build image, create network + volumes & start container: `make up`
- Install Node packages: `make npm-install`
- Start watch: `make npm-watch`

### Start dev
- run `make dev` or run `make up` & run `make npm-watch`
