#!/bin/bash
accept=1
connect=2
if echo "$accept" | grep -qE '^[a-zA-Z0-9]+$'; then
   accept=$1
fi
if echo "$connect" | grep -qE '^[a-zA-Z0-9]+$'; then
   connect=$2
fi
echo "cert = /etc/stunnel/stunnel.pem
 [openssh]
 accept = $accept
 connect = 0.0.0.0:$connect
" > /etc/stunnel/stunnel.conf