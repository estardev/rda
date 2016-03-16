#!/bin/bash

git pull
php app/console cache:clear
php app/console doctrine:schema:update --dump-sql
