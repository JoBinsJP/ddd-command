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
##### Create a FormRequest
```
php artisan ddd:request LoginRequest auth
```
#### Create a model
```
php artisan ddd:model User auth
```