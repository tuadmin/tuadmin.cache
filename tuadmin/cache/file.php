<?php
namespace tuadmin\cache;
class file{
	public $path = './';
	public $constant_id=null;
	public function __construct($path,$constant_id=null){
		$this->path = $path;
		$this->constant_id=$constant_id;
		//$this->constant_id = ((bool)$constant_id)?md5($constant_id):$constant_id;
	}
	public function &_($id,$callback,$seconds=60){
		$id=md5($id);
		$file = $this->file_path_name($id);
		if( is_readable($file) && (filemtime($file) + $seconds)>time()){
			$result= file_get_contents($file);
		}else{
			$result=$callback();
			file_put_contents($file,$result);
		}
		return $result;
	}
	public function __call($id,$args){
		$id=md5($id);
		$file = $this->file_path_name($id);
		$seconds=isset($args[1])?$args[1]:60;
		if( is_readable($file) && (filemtime($file) + $seconds)>time()){
			return require($file);
		}
		$result=$args[0]();
		if(file_put_contents($file,'<?php return '. var_export($result,true) .';') > 2048){
			file_put_contents($file,php_strip_whitespace ($file));
		}
		return $result;
	}
	private function file_path_name($id){
		return $this->path . DIRECTORY_SEPARATOR . "{$this->constant_id}-$id.cache";
	}
}