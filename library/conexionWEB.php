<? 


define('DBHOST','localhost');
	define('DBUSER','webbypr1_dolce');
	define('DBPASS','guillon');
	define('DBNAME','webbypr1_dolce');
	define('DBPORT',3306);
	
	
$DBCONN = mysql_connect(DBHOST.':'.DBPORT,DBUSER,DBPASS) or trigger_error(mysqli_error($DBCONN),E_USER_ERROR);
mysql_select_db(DBNAME, $DBCONN);

mysql_query('set names utf8'); 







?>