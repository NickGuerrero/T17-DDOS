Attacks will be added here. Please provide documentation as it becomes ready.

GoldenEye will need to be cloned from its repository. Once done, the Dockerfile will automatically carry it into the container.
```
git clone https://github.com/jseidl/GoldenEye.git
```

Start-up command
```
docker-compose --env-file ./.env up
```

Temporary Storage
RUN ./hpingsyn.sh