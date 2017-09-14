#!/bin/bash

source bin/vars/variables.sh

echo "Deploying theme..."
rsync -azq --partial --delete www/html/wp-content/themes/awp-demo/ \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/wp-content/themes/awp-demo/

echo "Deploying plugin..."
rsync -azq --partial --delete www/html/wp-content/plugins/awp-demo/ \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/wp-content/plugins/awp-demo/

echo "Deploying Pattern Lab..."
rsync -azq --partial --delete www/html/patternlab/ \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/patternlab/
