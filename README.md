### Get Started

- This project using Laravel 10
- Make sure you have Composer installed in your local pc
- clone this project and copy `.env.example` and rename to `.env`
- please modify this database configuration based on your preferences 
```
DB_CONNECTION=pgsql|mysql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=surplus
DB_USERNAME=root
DB_PASSWORD=12345678
```
- run `composer install`
- run migration command `php artisan migrate` you'll see all your table will be migrate to database
- run seeder command `php artisan db:seed` and check on table `products, category, images, category_product and product_image` some initial values will be inserted
- to get list of route please run `php artisan route:list`
- use command `php artisan serve` to run application
- example payload for create and update category
```
{
    "name" : "Makanan Berat",
    "enable" : true
}
```
- example payload for create and update product
```
{
    "name" : "Biskuit",
    "description" : "Rasa tiramisu",
    "enable" : true,
    "categories": [2,3],
    "images": [
        {
            "name" : "biskuit",
            "file" : "biskuit.jpg",
            "enable" : true
        }
    ]
}
```
