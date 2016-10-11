#tuadmin.cache
system for caching data

    -(new file($PATH_FOLDER_CACHE))->{ANY_ID}($callback,$seconds_cache)
    -(new session())->{ANY_ID}($callback,$seconds_cache)
...
```php
<?php
require 'tuadmin\cache.php';
use tuadmin\cache;
$cache_file = new file(__DIR__ .'/tmp');
$cache_file->any_id_123(function(){},60)
```


...
<?php
class GO_Example_Model_Thing extends GO_Base_Db_ActiveRecord {
    ...