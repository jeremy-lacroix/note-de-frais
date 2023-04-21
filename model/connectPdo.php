<?php

class connectPdo 
{
	private static $db; 
	
	private function __construct(){} 
	
	static function getObjPdo() {
		 
		if(!isset(self::$db))
		{
			//self::$db = new PDO('mysql:dbname=gestion_note_de_frais;host=localhost', 'root', '');
			self::$db = new PDO('mysql:dbname=u479250329_note_de_frais;host=notedefrais.store', 'u479250329_user', 'Rootroot10');
			self::$db->query('SET NAMES utf8');
			self::$db->query('SET CHARACTER SET utf8');
		} 
		return self::$db; 
    }
}


?>