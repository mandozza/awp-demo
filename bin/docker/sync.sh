#!/bin/bash

source bin/vars/variables.sh

echo "Syncing local files into docker container..."

docker exec -it $WP_CONTAINER bash -c "\
  find . -maxdepth 1 -type f -delete \
  && find . -maxdepth 1 -type d \
    -not -name . \
    -not -name .. \
    -not -name node_modules \
    -not -name html \
    -exec rm -r {} + 2> /dev/null \
  && find html/wp-content/plugins/awp-demo -maxdepth 1 -type f -delete \
  && find html/wp-content/plugins/awp-demo -maxdepth 1 -type d \
    -not -name . \
    -not -name .. \
    -not -name awp-demo \
    -not -name vendor \
    -exec rm -r {} + 2> /dev/null \
  && rm -rf html/wp-content/themes/awp-demo"

docker cp www $WP_CONTAINER:/var/

docker exec -it $WP_CONTAINER bash -c "\
  chown -R www-data:www-data /var/www/html"

echo "Sync complete!"
