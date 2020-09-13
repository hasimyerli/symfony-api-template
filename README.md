# symfony-api-template
symfony-api-template
This is template


## Framework Best Practices

https://symfony.com/doc/current/best_practices.html

## Api Documentation
path: /doc/api

https://symfony.com/doc/current/bundles/NelmioApiDocBundle/index.html

## Requirements:
- docker  (Tested with version 19.03.12)
- docker-compose (Tested with version 1.26.2)
- docker-sync (Tested with version 0.5.14)

## Run 
`docker-compose up` (Any OS)

`make start_dev` (You can use this command this if docker is running very slowly on Mac OS X)

## Create An Entity
`php bin/console make:entity `

_Class name of the entity to create or update (e.g. GentlePizza):_
> Example

_-New property name (press <return> to stop adding fields):_
> firstname

_-Field type (enter ? to see all types) [string]:_
> string
>
_-Field length [255]:_
> &nbsp;

_-Can this field be null in the database (nullable) (yes/no) [no]:> password
> no

Add another property? Enter the property name (or press <return> to stop adding fields):
> lastname



## Create Migration

`php bin/console make:migration`

## Execute Migration
`# php bin/console doctrine:schema:update`