To prepare the server, launch with the command. You'll need the provided environment file.
```
docker-compose --env-file ./.env.dev up
```
To access the MariaDB server, access the container via the CLI and enter the password in the .env.dev file. It should default to root.
```
mysql --password
```
If you haven't built the volume before, you'll need to run the SQL files through the CLI to create the tables. Once created, the website can be accessed through localhost: 127.0.0.1 (Localhost redirects to the Nginx server page).
Docker set-up created from: https://www.sitepoint.com/docker-php-development-environment/