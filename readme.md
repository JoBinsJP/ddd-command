### Introduction
In this architecture we will separate our application and domain layers. In default our application layer lies in 
**'App\Application'** and domain in **'App\Domain'** namespace; Further it can be configured from config file.
```php
<?php

return [
    'application'     => 'App\Application',
    'domain'          => 'App\Domain',

    /**
     * |
     * | Base Controller Path
     * |
     */
    'controller_path' => 'App\Infrastructure\Controllers\Controller',
];
```
### Installation
This tools is supposed to require only in the development phase. So you can install it as development dependencies.
```
composer require aammui/ddd --dev
```
##### Create a Controller
```
php artisan ddd:controller LoginController auth
```
Above Controller class can call from ```web.php``` as follows.
```php
<?php

use App\Application\Auth\LoginController;

Route::get('login',[LoginController::class,'index']);
Route::post('login',[LoginController::class,'store']);
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
| Command | Application | Domain | Description |
| --- | ----------- | :------: | ------|
| ```php artisan ddd:request LoginRequest auth``` | FormRequest |         | Creates FormRequest named ```LoginRequest``` in namespace ```App\Application\Auth\Requests```  |
| Yet to implement. | Rules       |         | |
| Yet to implement. | ResponseClass |         | Have a look on this articles. [Versatile Respoonse](https://timacdonald.me/versatile-response-objects-laravel/) |
|  ```php artisan ddd:controller LoginController auth``` | Controllers |         |  Creates Controller named ```LoginController``` in namespace ```App\Application\Auth\Controllers``` |
|  ```php artisan ddd:model Transaction Account``` |             | Models  | |
| Yet to implement. |             | Jobs    | |
| Yet to implement. |             | Actions | |
