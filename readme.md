### Introduction
In this architecture we will separate our application and domain layers. In default our application layer lies in **'App\Application'** and domain in **'App\Domain'** namespace;
### Installation
This tools is supposed to require only in the development phase. So you can install it as development dependencies.
```
composer require aammui/ddd --dev
```

### Application Setup
* Remove default namespace for controllers ```$protected $namespace = 'App\Http\Controllers';``` in 
 ```App\Providers\RouteServiceProvider.php;``` or You can just setup namespace for particular route file in RouteServiceProvider
```
protected function mapFrontRoutes()
{
    Route::middleware('web')
        ->namespace('App\Application')
        ->group(base_path('routes/front.php'));
}
```
Here we created ```front.php``` file for new **ddd** routes, and setup and loaded this routes in ***RouteServiceProvider***.
* Call this methods ```mapFrontRoutes()``` from ```map()``` in the ***RouteServiceProvider***.

##### Create a Controller
```
php artisan ddd:controller LoginController auth
```
Above Controller can call from ```front.php``` as follows.
```php
<?php

Route::group(['namespace'=>'Domain\Auth'],function(){
    Route::get('login','LoginController@method');
});
```
##### Create a FormRequest
Following command creates a Laravel's FomRequest Class in the application domain. i.e. in the ```app\Application\Auth\Requests\``` directory. FormRequest is part of application layer rather than core business layer so it is supposed to be stored in the application directory.
```
php artisan ddd:request LoginRequest auth
```
#### Create a model
Below commands create a Transaction model into the Account domain. The Transaction models lies on ```app\Domain\Account\Models\Transaction.php``` file. Domain model is part of core buiness layer so it is supposed to be stored in the domain directory. 
```
php artisan ddd:model Transaction Account
```
#### Domain Vs Application 
| Application | Domain | Description |
| ----------- | :------: | ------|
| FormRequest |         | |
| Rules       |         | |
| ResponseClass |         | Have a look on this articles. [Versatile Respoonse](https://timacdonald.me/versatile-response-objects-laravel/) |
| Controllers |         | |
|             | Models  | |
|             | Jobs    | |
|             | Actions | |

### Summary Of Available Commands
| Command | Description |
| ------- | ------- |
| ```php artisan ddd:request UserStoreRequest admin``` | Creates FormRequest named ```UserStoreRequest``` in namespace ```App\Application\Admin\Requests``` |
| ```php artisan ddd:controller UsersController admin``` | Creates Controller named ```UsersController``` in namespace ```App\Application\Admin\Controllers```|
