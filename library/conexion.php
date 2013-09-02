<? 


class Config {

	public $EN_DESARROLLO; 
	public $lang = 'es';
	public $NOMBRE_SESION = "Libo";
	private $DBCONN = null;

	public function Config() {
		
		$EN_DESARROLLO = (strpos($_SERVER["SERVER_NAME"], "maxi") === false) ? false : true;
		if ($EN_DESARROLLO) {
			define('DBHOST','localhost');
			define('DBUSER','root');
			define('DBPASS','');
			define('DBNAME','libo_gestion');
			define('DBPORT',3306);
			$DOMINIO = "http://maxi/libo/gestion";	
		}	
		else {
			define('DBHOST','localhost');
			define('DBUSER','libo_site');
			define('DBPASS','as21AQW');
			define('DBNAME','libo_site');
			define('DBPORT',3306);
			$DOMINIO = "http://www.new.libo.com.ar/";
		
		}
		
		$DBCONN = mysql_connect(DBHOST.':'.DBPORT,DBUSER,DBPASS) or trigger_error(mysqli_error($DBCONN),E_USER_ERROR);
		mysql_select_db(DBNAME, $DBCONN);
	
		mysql_query('set names utf8');
		return $DBCONN; 
	}
}






?>