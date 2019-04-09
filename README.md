# Letgo Tech Test 


## How to execute this project
First clone the repository and go into the folder:
```
git clone https://github.com/spvernet/let
cd let
```

Then copy the .env.dist to .env:
```
cp .env.dist  .env
```
Then execute docker-compose command:
```
docker-compose up -d
```
Once the containers are up, go inside the container "letgo.api" and execute composer install:

```
docker exec -ti letgo.api bash
composer install
exit
```
Finally, add on your /etc/hosts the following line:

```
127.0.0.1	api.letgo.com.devel
```

Now, you have all the environment ready.

To try the api just send a GET to the:
```
api.letgo.com.devel/shout/realDonaldTrump/?limit=4
```
## Testing

For execute the unit test, just go inside the folder project and execute:
```
php bin/phpunit
```
