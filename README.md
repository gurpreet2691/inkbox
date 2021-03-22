
## Description
Implement an algorithm to take incoming ecommerce orders and populate those order items onto print sheets. This is a 2D bin packing algorithm to add order items to sheets in best fit.

## Algorithm explanation
- Sort the orders in DESC order based on the size. 
- Insert the first order in the bin, check if the bin have space to add orders, if not create a new bin.
- recursively go to all the bin and check if the order fits in the existing bin.

## Instructions to run the code
Go to the folder where the project is cloned and run the following command
```
docker-compose up -d
```
This will create the docker containers.

## Migration
Once the containers are up and running. use the following command to run migrations.
- First go inside the container 
```
docker-compose exec app bash
```
Once you are inside the container. Run the following command one by one.
```
composer install

php artisian migrate

php artisan db:seed
```

### Now Open the browser
use the following URL to place the orders.

```
http://localhost:8080/api/place_order
```
