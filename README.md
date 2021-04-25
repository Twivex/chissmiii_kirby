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

## How to Dev
### Setup
`make dev-setup`
- Build Images
- Start Containers
- Install NPM Packages
- Start Watch

### Start dev
`make up dev`
- Start Containers
- Start Watch

## How to Deploy
TODO: add description

## Misc Commands
`make upload-content`

Copy content from local to pi (Hint: may delete!)

`make download-content`

Copy content from pi to local (Hint: may delete!)
