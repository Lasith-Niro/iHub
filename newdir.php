<?php

require_once('include/config.php'); 
$ncam = "";
if (isset($_GET['cam']))
  $ncam = $_GET['cam'];
$pathFolder= $path."/";
if (isset($_GET['grpNo']))
{
  $pathFolder = $pathFolder.$ncam."/".$_GET['grpNo'];
	
	if (!file_exists($pathFolder))
	mkdir($pathFolder,0777,TRUE);
}
header("Location: index.php?cam=".$ncam);

?>