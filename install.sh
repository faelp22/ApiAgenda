#!/bin/bash
#
# Script para update/install deploy de aplicações PHP Symfony 2
# Author: Isael Sousa <falep22@gmail.com>
# Data: 11/04/2017
# ver: 2.0
#

# essa variavel é necessaria em todo o sistema, se possivel instale essa variavel de ambiente no servidor
export SYMFONY_ENV=prod
logs_dir='app/logs/'
composer="/usr/local/bin/composer"

if [ ! -e "$composer" ]; then 
    echo "Não foi encontrado o composer padrão: $composer";
    composer="./composer.phar"
    if [ ! -e "$composer" ]; then
        echo "Não foi encontrado o composer local: $composer";
        echo "Baixando o composer!";
        bash getcomposer.sh
        if [ $? != 0 ]; then
            echo "Error ao baixando o composer!";
            echo "Verifique sua conexão com a internet!";
            exit 1;
        fi
        chmod a+x $composer
    else
        echo "Executando composer local: $composer";
    fi
fi

if [ "$(ls -A $logs_dir)" ]; then
    echo "Compactando logs"
    bash bkplogs.sh
else 
    echo "Sem logs para compactar"
fi

rm -Rf app/cache/*
rm -Rf app/sessions/*
rm -Rf web/bundles/*

$composer update --no-dev --optimize-autoloader
php app/console cache:clear --env=prod --no-debug
php app/console assets:install --symlink --env=prod --no-debug

exit 0;