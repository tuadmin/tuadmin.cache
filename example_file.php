<?php
require __DIR__ . '/tuadmin/cache.php';
$cache = new \tuadmin\cache\file(__DIR__ ."/temp","prefix");
$password_raw='123456';
$cache_time_expire_in = 3600;//seconds
$heavy_key = $cache->{"id_for_this$password_raw"}(function()use($password_raw){
	$password_raw .=time();
	sleep(10);//simulate delay ,hard process 
	return md5($password_raw);
} ,$cache_time_expire_in);

echo $heavy_key;
//other example
$data_base_rows= $cache->{"list of configration global"}(function()use($password_raw){
	
	/*
		code for database and get other database merges, and other operations 
	*/
	
	return array(
		"list_1"=>time() .sleep(1),
		"list_2"=>time() .sleep(1),
		"list_3"=>time() .sleep(1),
		"list_4"=>time() .sleep(1),
		"list_5"=>time() .sleep(1),
		"list_6"=>time() .sleep(1),
		"list_7"=>time() .sleep(1),
		
	);
} ,3600*24);
foreach($data_base_rows as $key=>$value){
	echo "$key = $value\n";
}

echo $cache->_('ID for strings ',function(){
	return "this is for only strings ".time();
},3600);