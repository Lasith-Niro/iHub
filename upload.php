
<?php require_once('include/config.php'); ?>
<?php require_once('include/language/'.$LANG.'.php'); ?>
<?php require_once('include/ls_func.php'); ?>
<html>
<link rel="shortcut icon" href="/favicon.ico">
<link href="images/template/<?php echo $Template ?>/styles/stylefss.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style11 {
	color: #666666;
	font-size: 8pt;
}
-->
</style>
<head>
<title>File Sharing System</title>
<link rel="shortcut icon" href="/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<script type="text/javascript" language="javascript" src="scripts/script.php"></script>
<script type="text/javascript" language="javascript" src="scripts/MessageBoxes.js"></script>
<?php if ($JSFX_LinkFader2) { ?>
<script type="text/javascript" language="javascript" src="scripts/JSFX_LinkFader2.js"></script>
<?php } ?>
<style type="text/css">
<!--
.style13 {font-size: 7pt; font-family: Arial, Helvetica, sans-serif; color: #999999; }
-->
<!--
	.EstiloProcesando {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 12px;
		font-weight: bold;
	}
	-->
</style>
<link href="styles/pages.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="contenedor"></div>
<script type="text/javascript" language="javascript"> msgboxProcesando(true); </script>
<div class="container">
<form action="" method="get" name="formFiles">
<table width="<?php echo $pTableWidth ?>" border="0" align="<?php echo $pTableAlign?>" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr bgcolor="#99CCFF" class="features"> 
    <td width="285" bgcolor="#6699CC">
<div align="center" ><strong><?php echo $nFile?></strong></div></td>
    <td width="131" bgcolor="#6699CC">
<div align="right"><strong><?php echo $nSize?></strong></div></td>
    <td width="86" bgcolor="#6699CC">
<div align="center"><strong><?php echo $nFileType?></strong></div></td>
    <td width="98" bgcolor="#6699CC">
<div align="center"><strong><?php echo $nAction?></strong></div></td>
  </tr>
  
	<tr bgcolor="#FFFFFF"> 
    <td>
  <?php 
  
  if (isset($_GET['cam']))
  {
  	$ncam = "". $_GET['cam']; // modificado para prevenir la doble linea
	?>

	<p>
	<a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam=<?php echo setUpperPath($_GET['cam'])?>"><img src="images/open.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo ($_GET['cam'])?>/..</a>
	</p>
<?php
  }
  else
  {
  	$ncam = "";
	?>
	<p>
	<a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam="><img src="images/open.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle">/..</a>
	</p>
<?php
}
?>
	</td>
    <td></td>
    <td> 
     
     </td>
    <td align="right"><a href="javascript:void(0);" onMouseOver="window.status='';return true;" onClick="newFolder('<?php echo $ncam ?>')"><img src="images/closed.gif" width="16" height="16" border="0" align="absmiddle" title="<?php echo $nNewFolderIcon ?>"></a></td>
  </tr>
  <tr bgcolor="#CCCCCC"> 
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <?php
  $path = $path . $ncam;
  ?>
  <?php

if ($dir = @opendir($path)) {
  while (($file = readdir($dir)) !== false) {
    //echo "$file\n";
	if ($file != "." && $file != "..") {
?>
  <tr bgcolor="#FFFFFF"> 
    <td height="19"><p>&nbsp;
	<?php if (!is_dir($path."/".$file)) { ?>
	<a class="fadeLink" onClick="msgboxProcesando(true);" href="<?php echo $path."/".$file?>" ><?php echo " ".$file?></a>
	<?php }else{?>
	<a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam=<?php if (isset($_GET['cam'])){echo $_GET['cam'];}else{echo "";} echo "/".$file?>" ><img src="images/closed.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo " " .$file?></a>
	<?php }?></p>
	</td>
    <td><div align="right"><p><?php echo tamanio_archivo($file,$path);?></p></div></td>
    <td> 
     
      <div align="center"> <p><?php if(tipo_archivo($file,$path)==1) echo $nTDir; else echo $nTFile;?></p></div></td>
    <td align="right"><p>
	<?php if (!is_dir($path."/".$file)) { ?>
	<a href="javascript:void(0);" onClick="msgboxProcesando(true); deleteOption('<?php echo $path."/".$file?>', 2,'<?php echo $ncam?>');" onMouseOver="window.status='';return true;">
	<img src="images/delete.gif" title="<?php echo $nDeleteIcon ?>" width="18" height="14" border="0">
	<?php }else{?>
	<a href="javascript:void(0);" onClick="msgboxProcesando(true); deleteOption('<?php echo $path."/".$file?>', 1,'<?php echo $ncam?>');" onMouseOver="window.status='';return true;">
	<img src="images/delete.gif" title="<?php echo $nDeleteFolderIcon ?>" width="18" height="14" border="0">
	<?php }?>
</a></p></td>
  </tr>
  <tr bgcolor="#CCCCCC"> 
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <?php
  }  }
  closedir($dir);
}

?>
</table>
</form>
    </div>
<?php require_once('images/template/'.$Template.'/includes/foot.php'); ?>

  <table width="600" border="0" align="center" cellpadding="2" cellspacing="1">
<form action="fileup.php" method="post" enctype="multipart/form-data" name="form1">
    <tr> 
      <td> 
       <span class="style11"><?php echo $nSelectFile ?></span>
        <input name="userfile" type="file">
		<?php if(isset($_GET['cam'])) {?>
		<input name="carpeta" type="hidden" value="<?php echo $_GET['cam'] ?>">
		<?php }?>
&nbsp;&nbsp;<input type="submit"  value="<?php echo $nButtonName ?>" onClick="msgboxProcesando(true);"></td>
    </tr>
</form>
</table>
</body>
</html>
