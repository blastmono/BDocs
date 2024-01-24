#!/bin/sh

set -e

echo 'installando dependencias'
npm install

echo 'Actualizando cambios'
npm run watch