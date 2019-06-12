#tuadmin.cache
system for caching data

    -(new file($PATH_FOLDER_CACHE))->{ANY_ID}($callback,$seconds_cache)
    -(new session())->{ANY_ID}($callback,$seconds_cache)
##Cache in static files
```php
<?php
require 'tuadmin\cache.php';
$cache = new tuadmin\cache\file(__DIR__ .'/tmp');
```

##Cache in session
```php
<?php
require 'tuadmin\cache.php';
$cache = new tuadmin\cache\session(md5('var_in_session'));//alternative for name ,cache in $__SESSION[md5('var_in_session')]
```
##Use object cache


```php
$cache_expire_in=3600;//seconds
$variable_key= '123';//for use in identifier
$var = $cache->{"id_is_$variable_key"}(function()use($variable_key){
	return array(time()." this is cached for var".$variable_key);
},$cache_expire_in);

echo $var[0];
```
##example for only *tuadmin\cache\file* and result is ever string

```php
echo $cache->_("id_is_for_ever_string",function(){
	return time()." this is cached for var";
},60);
```

[Haga clic aquí para prestar su apoyo a: donaciones para más proyectos y hacer una donación al PAYPAL!](https://paypal.me/pools/c/87BTML2gwr)
