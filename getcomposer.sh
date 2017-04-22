#!/bin/bash
#
# Script para baixar composer mai recente da internet
# https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md
# Author: Isael Sousa <falep22@gmail.com>
# Data: 11/04/2017
# ver: 1.0
#

EXPECTED_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig)
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_SIGNATURE=$(php -r "echo hash_file('SHA384', 'composer-setup.php');")

if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]
then
    >&2 echo 'ERROR: Invalid installer signature'
    rm composer-setup.php
    exit 1
fi

php composer-setup.php --quiet
RESULT=$?
rm composer-setup.php
exit $RESULT
