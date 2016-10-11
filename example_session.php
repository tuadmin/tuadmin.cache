<?php
require __DIR__ . '/tuadmin/cache.php';
/*trick for simulate in CLI, sessions*/
	session_save_path(__DIR__ ."/temp");
	session_id(md5("example2id"));
	session_start();

$cache = new \tuadmin\cache\session();
$cache_time_expire_in = 3600;//seconds
$password_raw=123456;
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

