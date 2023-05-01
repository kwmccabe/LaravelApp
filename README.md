# LaravelApp

This is a Laravel demo application.

## How To:
- Create App
- - `curl -s https://laravel.build/laravelapp | bash`
- - `cd laravelapp`
- Launch App
- - `./vendor/bin/sail up &`
- - `docker ps`
- - `docker exec -it laravelapp-laravel.test-1 bash`
- InfoController
- - `./vendor/bin/sail artisan make:controller InfoController`
- Product Migration
- - `./vendor/bin/sail artisan make:migration create_product_table`
- - - `./vendor/bin/sail artisan migrate [--pretend]`
- - - `./vendor/bin/sail artisan migrate:fresh`
- - - `./vendor/bin/sail artisan migrate:status`
- - - `./vendor/bin/sail artisan db:show`
- - - `./vendor/bin/sail artisan db:table products`
- Product Model, Factory, Controller, and Request
- - `./vendor/bin/sail artisan make:model Product`
- - `./vendor/bin/sail artisan make:factory -m ProductModel ProductFactory`
- - `./vendor/bin/sail artisan make:controller ProductController --resource --model=Product`
- - `./vendor/bin/sail artisan make:request StoreProductRequest`


## Links:
- [Laravel Docs](https://laravel.com/docs/)
- [Laracasts](https://laracasts.com/)
- [Laravel Bootcamp](https://bootcamp.laravel.com)
- [News](https://laravel-news.com/)
- [Blog](https://blog.laravel.com/)
- [Nova](https://nova.laravel.com/)
- [Forge](https://forge.laravel.com/)
- [Vapor](https://vapor.laravel.com/)

