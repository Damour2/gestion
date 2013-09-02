<?

header('Content-Type: text/html; charset=utf-8');


$mensaje = "<html><style>
				div.linea {
					width: 100%;
					clear: both;
				}
				span { 
					margin-left: 20px;
					width: 150px;
					float: left;
				}
			</style><body>";


$asunto = $_GET[asunto];
$mensaje .= $_GET[mensaje].'<br><br>'.$_POST[datos];
$mensaje .= "</body></html>";

// echo $asunto;
// echo "<br><br><br>";
// echo $mensaje;

$recipiente = $_GET[recipiente];
// $recipiente = "info@prismacomunicacion.com.ar";
$devolver = "marcos@libo.com.ar";

$sheader="From:".$devolver."\n";
$sheader .=  "Reply-To:".$devolver."\n"; 
$sheader .= "X-Mailer:PHP/".phpversion()."\n"; 
// To send HTML mail, the Content-type header must be set
$sheader  .= 'MIME-Version: 1.0' . "\n";
$sheader .= 'Content-type: text/html; charset=utf-8' . "\n";

//echo $recipiente. " Mensaje desde scandinavian.com.ar ". $mensaje. $sheader;

	
    
    //$mensaje=htmlspecialchars_decode($mensaje,ENT_QUOTES);//optional - I use encoding to POST data
    if (mail($recipiente, $asunto, $mensaje, $sheader))
	echo "Su mensaje se ha enviado correctamente.";
	else echo "Ha habido un error. Intente mas tarde por favor.";





?>