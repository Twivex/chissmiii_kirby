# TODOS
## Priorisierung
- [X] Lovestory
  - [X] Bild zensieren
  - [X] Selfie von mir raussuchen
- [X] Textfeld (Text)
- [X] Ablaufplan: Timeline Alternative Bild -> Textfeld
- [X] Anfahrt (GMaps Karte + Beschreibung (Überschrift + Textfeld))
- [X] Liederwunsch (siehe Gästebuch)
- [X] Reisestatistiken von Polarsteps
- [X] Dropdown Navigation
- [X] Kirby Website lokal
- [X] SSH Zugang von außen
- [X] Kontakformular
- [X] Cookie Banner
- [X] Footer Nav
- [X] Impressum
- [X] Countdown mit Uhrzeit
- [X] Gallerie
- [X] Image Upload
  - https://degoo.com/
  - https://github.com/MDKPredator/degoo_drive
- [X] Mulit-Language
  - [ ] Deutsche Snippets extrahieren
  - [ ] Snippets übersetzen
  - [ ] Sprachwähler-Menü
  - [ ] Inhalte übersetzen -> Marlon?
  - [ ] übersetzte Inhalte einpflegen
- [~] Dev Server
- [X] Theming
  - [X] Gesamte Website
  - [X] Unterseiten
  - [X] Farbwelten entwickeln
    - [X] Verlobung
    - [X] Standesamt
    - [X] Hochzeit
- [X] HTTPS Redirect einrichten
- [X] Content Ordner als git repo
- [X] Favicon
- [X] Text Muted Color
- [X] Gallerie -> Komposition?
- [~] Album Cards:
  - [X] Custom Color
  - [ ] Image Position
- [ ] Album Image Upload Statusbar
- [ ] Album Image Upload Big Files
- [X] Album Image Preview
  - [X] Fullscreen
  - [X] Slider = Mini-Images

## Infrastruktur
- Git

- Docker
  - env file für docker-compose.prod.yml
  - prod ohne entrypoint testen
  - makefile updaten
    - prod-deploy = git pull && npm-build
    - neuer command: prod-setup = prod-up prod-npm-install npm-build
  - Dockerfile prod-stage:
    - nur notwendige Daten aus dist ziehen
      - einzeldateien
      - resources/assets
    - kirby über compose ziehen? -> testen!
- Kirby
  - Asset Firewall: https://k2.getkirby.com/docs/cookbook/asset-firewall
  - https://forum.getkirby.com/t/how-to-build-an-asset-firewall/1009

## Backend
- Gallery
  - Tab mit allen Dateien
  - Dateiformate begrenzen?

## Design / Layout
- Bootstrap
  - Grundgerüst
  - Theming
- Module
  - Navigation
  - Formular
  - Personen-Vorstellungen
  - Youtube Video Einbettung
  - Gallery Slider
  - Karte

## Inhalte
- Must-Haves
  - Impressum
  - Sitemap

# Done
## Infrastruktur
- Event Cards
- Readme anlegen
- Kirby
  - Installation
  - Frontend User Login: https://getkirby.com/docs/cookbook/security/access-restriction
  - Geschützte Seiten per Template
- Docker Setup
- Build Chain Setup
- Make Commands
- Git Repo
