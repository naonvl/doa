<?php
@session_start();
						
@error_reporting(E_ALL & ~E_NOTICE);

@ob_start();
include_once ("app/include/queryfunctions.php");
include_once ("app/include/functions.php");

date_default_timezone_set('Asia/Jakarta');

//include_once ("app/include/function_login.php");
//include_once ("app/include/login_check.inc.php");

//$conn=db_connect(HOST,USER,PASS,DB,PORT);
$dbpdo = DB::create();

//-------------------mod rewrite
$segmen0   = "";
$segmen1   = "";
$segmen2   = "";
$segmen3   = "";
$segmen4   = ""; 
$segmen5   = "";
$segmen6   = "";
$segmen7   = "";
$segmen8   = "";
$segmen9   = "";
$segmen10   = "";
$segmen11   = "";
$segmen12   = "";

$nama_folder = dirname($_SERVER['PHP_SELF']);
//$nama_folder = dirname("../".$_SERVER['PHP_SELF']); //online (subdomain)

$url = explode("/",$_SERVER["REQUEST_URI"]); //localhost
//$url = explode("/","sisfoys.com/".$_SERVER["REQUEST_URI"]); //online

$segmen0   = $url[0];
$segmen1   = $url[1];
$segmen2   = $url[2];
$segmen3   = $url[3];
$segmen4   = $url[4]; 
$segmen5   = $url[5];
$segmen6   = $url[6];
$segmen7   = $url[7];
$segmen8   = $url[8];
$segmen9   = $url[9];
$segmen10   = $url[10];
$segmen11   = $url[11];
$segmen12   = $url[12];

include 'app/class/class.select.php';
include 'app/class/class.selectview.php';
include 'app/class/class.protection.php';

$select		= new select;
$selectview = new selectview;
$protection = new protection;

$__main = "";
//if($segmen1 != "") { $__main = "main.php?"; }
if($segmen1 != "") { $__main = ""; }

$act	= $segmen2; //$_GET['act'];
$menu	= ""; //$_GET['menu'];

if($segmen2 == "main.php") {
	$segmen2 = obraxabrix('main');
	$act = $segmen2;
}

/*$url2 = explode("?",$segmen2);
if($url2[1] != "") {
	$act = $url2[1];
}*/

//-----------------------------/\

if (($_SESSION["logged"] == 0)) {
	
	if ($act == obraxabrix('logout')) { include_once("logout.php"); }
	echo 'Access denied';	
?>
	<script>
		window.location = 'http://localhost/dadakan/';
	</script>
<?php	
	exit;
}


//seting folder
$__folder = "";
if($segmen3 != '') {
	$__folder = "../";
	//$nama_folder = "../".$nama_folder; //online
}

if($segmen4 != '') {
	$__folder = "../../";
	//$nama_folder = "../../".$nama_folder; //online
}

if($segmen5 != '') {
	$__folder = "../../../";
	//$nama_folder = "../../../".$nama_folder; //online
}

if($segmen6 != '') {
	$__folder = "../../../../";
	//$nama_folder = "../../../../".$nama_folder; //online
}

if($segmen7 != '') {
	$__folder = "../../../../../";
	//$nama_folder = "../../../../../".$nama_folder; //online
}	 

if($segmen8 != '') {
	$__folder = "../../../../../../";
	//$nama_folder = "../../../../../../".$nama_folder; //online
}

if($segmen9 != '') {
	$__folder = "../../../../../../../";
	//$nama_folder = "../../../../../../../".$nama_folder; //online
}

if($segmen10 != '') {
	$__folder = "../../../../../../../../";
	//$nama_folder = "../../../../../../../../".$nama_folder; //online
}

if($segmen11 != '') {
	$__folder = "../../../../../../../../../";
	//$nama_folder = "../../../../../../../../../".$nama_folder; //online
}

if($segmen12 != '') {
	$__folder = "../../../../../../../../../../";
	//$nama_folder = "../../../../../../../../../../".$nama_folder; //online
}

##check resolution
/*if(!isset($_SESSION['lebarlayar'])) {
	
	echo "<script language=\"JavaScript\">

	document.location=\"$PHP_SELF?r=1&width=\"+screen.width+\"&height=\"+screen.height;

	</script>";

	if(isset($_GET['width']) && isset($_GET['height'])) {
		$_SESSION['lebarlayar'] = $_GET['width'];
		$_SESSION['tinggilayar'] = $_GET['height'];
	}
}*/
##--------------/\-------------

?>
