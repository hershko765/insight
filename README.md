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
	# php app/console cache:clear -e prod
	# node r.js -o build.js

# Update Changes Flow
	# Commit and push changes
	# Checkout develop and merge your branch
	# Push develop
	# Pull develop in server shell

# The update handler will check for updated addons with last release of atleast 2014 or 1 year ago