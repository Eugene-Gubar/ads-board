# board

This README outlines the details of collaborating on this Ubiquity application.
A short introduction of this app could easily go here.

## Prerequisites

You will need the following things properly installed on your computer.

* php ^7.1
* [Git](https://git-scm.com/)
* [Composer](https://getcomposer.org)
* [Ubiquity devtools](https://ubiquity.kobject.net/)

## Installation

* `git clone <repository-url>` this repository
* `cd board`
* `composer install`

## Running / Development

* `Ubiquity serve`
* Visit your app at [http://127.0.0.1:8090](http://127.0.0.1:8090).

### devtools

Make use of the many generators for code, try `Ubiquity help` for more details

### Optimization for production

Run:
`composer dump-autoload --optimize --no-dev --classmap-authoritative`

## Docker
* `docker build -t board:dev .`
* `docker run -p 80:80 board:dev`
* [:your_docker_ip]/phpmyadmin
  login: admin, password: [see console docker - it`s auto generation]
* Create 'ads' and 'user' [table sql](https://github.com/Eugene-Gubar/ads-board/blob/master/table.sql)