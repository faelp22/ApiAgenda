#!/bin/bash
#
# Script para coletar logs de deploy da aplicação PHP Symfony 2
# O mesmo coleta compacta e apaga os arquivos antigos.
# Author: Isael Sousa <falep22@gmail.com>
# Data: 11/04/2017
# ver: 1.0
#

bkp_logs="../bkp_logs/"
logs='app/logs/*'
data=`/bin/date +%H-%M-%d-%m-%Y`
filelog="logs-${data}.tar"

if [ ! -d "$bkp_logs" ]; then
    mkdir $bkp_logs
fi

tar -cf $filelog $logs
bzip2 $filelog
rm -Rf $logs

mv $filelog".bz2" $bkp_logs
