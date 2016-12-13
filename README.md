# database-tools
Mysql Databases Tools 

Server-Config: 
	/****************************************************************************
	==============================Databases Config===============================
	*****************************************************************************/
	$dbConf = array(
	    1 => array(
	        'host' => '10.2.19.35',
	        'user' => 'root',
	        'password' => '',
	        'dbName' => 'dance_log',
	        'charSet' => 'utf8',
	        'port' => '3306'
	    ),
	    2 => array(
	        'host' => '10.2.19.27',
	        'user' => 'root',
	        'password' => '',
	        'dbName' => 'dance_log',
	        'charSet' => 'utf8',
	        'port' => '3306'
	    ),
	);


	/*******************************************************************************
	================================Server Name=====================================
	********************************************************************************/
	$serverList = array(
	    1 => array('name' => 'test1'),
	    2 => array('name' => 'test2'),
	);

Server-Start:
 	in PHP Server Can run.
 	Access index.php		
