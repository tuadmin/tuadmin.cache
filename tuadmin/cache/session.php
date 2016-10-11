<?php
namespace tuadmin\cache;
class session{
	public $id=0;
	public function __construct(){
		$this->id = md5(__FILE__);
		if(!isset($_SESSION[$this->id])){
			$_SESSION[$this->id]=array();
		}
	}
	public function __call($id,$args){
		$seconds=isset($args[1])?$args[1]:60;
		//$id=md5($id);//not neccesary
		if( !array_key_exists($id, $_SESSION[$this->id] ) 
			||($_SESSION[$this->id][$id][1] + $seconds)<time()
		   ){
			$_SESSION[$this->id][$id]=array($args[0](),time() );
		   }
		return $_SESSION[$this->id][$id][0];
	}
}