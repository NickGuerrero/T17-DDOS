Attacks will be added here. Please provide documentation as it becomes ready.

GoldenEye will need to be cloned from its repository. Once done, the Dockerfile will automatically carry it into the container.
```
git clone https://github.com/jseidl/GoldenEye.git
# IP="127.0.0.1"
# Remove clone, now pull from local
# git clone https://github.com/jseidl/GoldenEye.git
# python3 ./GoldenEye/GoldenEye/goldeneye.py "http://$IP?action=get&id=$ID" -w 1 -s 1
```
Building the image
```
docker build -t attack_container .
docker build -t ngdos -f ATK.Dockerfile .
```
Start-up command
```
docker-compose --env-file ./.env up
```