<?php //localhost

class DB2{

	private static $db_server2 		= 'localhost';
	private static $db_database2 	= 'doa';
	private static $db_user2 		= 'root';
	private static $db_password2	= '';
	
	private static $dbpdo2 = null;

	public static function create2(){
		if(self::$dbpdo2 == null){
			try{
				//self::$dbpdo = new PDO("sqlsrv:server=".self::$db_server.";database=".self::$db_database.";", self::$db_user, self::$db_password);
				
				self::$dbpdo2 = new PDO("mysql:server=".self::$db_server2.";dbname=".self::$db_database2.";", self::$db_user2, self::$db_password2);
				
				self::$dbpdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		return self::$dbpdo2;
	}
		
}

?>
