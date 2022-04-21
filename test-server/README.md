To prepare the server, launch with the command. You'll need the provided environment file.
```
docker-compose --env-file ./.env.dev up
```
To access the MariaDB server, access the container via the CLI
```
mysql --password $DB_NAME
```
Once created, the website can be accessed through localhost: 127.0.0.1
Docker set-up created from: https://www.sitepoint.com/docker-php-development-environment/