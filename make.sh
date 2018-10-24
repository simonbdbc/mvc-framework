#!/usr/bin/env bash
# Script de création de module (architecture de base).

if [ $1 ]
then
    sType=$1
fi
if [ $2 ]
then
    sNom=$2
fi

echo "make "$sType" with name "$sNom ;