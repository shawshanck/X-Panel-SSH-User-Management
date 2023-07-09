#!/bin/bash
if [[ "$1" =~ [^a-zA-Z0-9] ]]; then
accept=444
else
accept=$1
fi

if [[ "$2" =~ [^a-zA-Z0-9] ]]; then
accept=22
else
accept=$2
fi
echo "cert = /etc/stunnel/stunnel.pem
 [openssh]
 accept = $accept
 connect = 0.0.0.0:$connect
" > /etc/stunnel/stunnel.conf