Symfony Workstation
=============
Simple Workstation for symfony

## Installation
	1. Install Node JS
		http://nodejs.org/

	2. Run the following commands in there order:
		$ git submodule update --init --recursive
		$ curl -s https://getcomposer.org/installer | php
		$ php composer.phar install
		$ php composer.phar update

	3. Install libraries
		$ cd web/media/js/vendor
		$ bower update
		$ bower install

## Deployment
# node r.js -o build.js