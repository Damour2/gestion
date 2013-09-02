<? 


define('DBHOST','localhost');
	define('DBUSER','uv0928');
	define('DBPASS','heatelite2012');
	define('DBNAME','uv0928_scandinavian');
	define('DBPORT',3306);
	
	
$DBCONN = mysql_connect(DBHOST.':'.DBPORT,DBUSER,DBPASS) or trigger_error(mysqli_error($DBCONN),E_USER_ERROR);
mysql_select_db(DBNAME, $DBCONN);

mysql_query('set names utf8'); 







?>