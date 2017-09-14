#!/bin/bash

npm install --silent -g npm-cache gulp retire

./www/html/wp-content/plugins/awp-demo/tests/bin/install-wp-tests.sh wordpress_test ubuntu '' 127.0.0.1

cd www

npm-cache install --cacheDirectory ~/node-cache

cd html/wp-content/plugins/awp-demo

composer install -o
