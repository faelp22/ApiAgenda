#!/bin/bash
#
# Script para update/install deploy de aplicações PHP Symfony 2
# Author: Isael Sousa <falep22@gmail.com>
# Data: 17/08/2016
# ver: 1.0
#
# ln -fs ../bundles bundles

npm install
bower install
gulp
