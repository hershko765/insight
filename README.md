Symfony Workstation
=============
Simple Workstation for symfony
## Installation
	Run the following commands in there order:
	-git clone -b workstation_clean --single-branch git@github.com:hershko765/Symfony-Workstation.git
	- curl -s https://getcomposer.org/installer | php
	- php composer.phar update
	- php composer.phar install
	- git submodule update --init --recursive


# each componenet will have DB
# Wow Inject
	Table called inject.sources that will contain all the sources of addons
	each source will have leading class that will be responsible from extracting
	data for the addons table column such as - addon name, description , download link
	besides that there wil be a default class that will be able to extract the details nesserty by default
	for example, for a standalone addon website that contain 1 donwload link or JSON source