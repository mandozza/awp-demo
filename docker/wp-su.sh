#!/bin/bash

# Run wp-cli with proper permissions
sudo -u www-data /bin/wp-cli.phar "$@"
