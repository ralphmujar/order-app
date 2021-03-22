#!/bin/bash

shopt -s extglob
echo "-- Copying dev to production --"
cp -R !(mysqldata) ../mysterious-ocean-67929/ && cd ../mysterious-ocean-67929/ && ./apply-prod-config.sh
shopt -u extglob
