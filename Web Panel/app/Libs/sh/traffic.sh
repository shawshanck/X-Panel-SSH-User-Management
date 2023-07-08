#!/bin/bash

nethogs -j -v3 -c6 > /var/www/html/cp/storage/log/out.json
pkill nethogs