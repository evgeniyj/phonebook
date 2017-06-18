<?php
header("Content-Type: text/html; charset=UTF-8");
header("Last-Modified: ".gmdate("D, d M Y H:i:s",time()-3600)." GMT");
include("./connection.php");
?>


<?php

$uid = htmlspecialchars($_GET['uid']);

if (!$uid){ exit("Empty request!"); };


?>


<style type="text/css">
#search {
    border:1px solid #C5C5C5;
    color:#434E52;
    float:left;
    font-family:arial;
    font-size: 83%;
    height: 15px;
    margin:0 -1px 0 0;
    padding:2px 1px 3px 3px;
    width:464px;
}
#go {
    margin:0;
    padding: 0;
    float:right;
    height:22px;
    width:50px;
    font-size:0;
    text-indent:-9999px;
    cursor:pointer;
    background:url("./images/search.gif") no-repeat scroll 0 0 transparent;
    border:0 none;
}
#text {
	color: #FFFFFF;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10pt;
}
#text_black {
	color: #000000;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10pt;
}
#text_black_small {
	color: #000000;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 8pt;
}
#text_black_small {
	color: #000000;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 8pt;
}
#text_black_small_gray {
	color: #a5a5a5;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 8pt;
}
#fox_link {
	color: #FFFFFF;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10pt;
	text-decoration: underline;
}
#mail_link {
	color: #0a447f;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10pt;
	font-weight: bold;
	text-decoration: none;
}
</style>


<?php

$criteria = $_REQUEST['uid'];

#Defite string of request to your from DB:
$YOUR_PROPERTIES = 
$stid = oci_parse($conn, "SELECT".$YOUR_PROPERTIES.. $criteria . "'");
oci_execute($stid);
//start the loop for printing the results
while($row=oci_fetch_array($stid)){
		
	$id = $row[0];
	$name = $row[1];
	$name_cn = $row[9];
	$department = $row[2];
	$title = $row[3];
	$company = $row[4];
	$officePhone = $row[5];
	$mobile = $row[6];
	$email = $row[7];
	
	$officePhone = str_replace("*","-",$officePhone);
	$officePhone = str_replace("+","",$officePhone);
		
		
		if (substr($officePhone, 0, 3) == "8-8" && strlen($officePhone) == 10)
		{
			$tmp = $officePhone;
			$officePhone = substr($tmp, 0, 6);
			$ext = substr($tmp, 7, strlen($officePhone));
		}
		else if (strlen($officePhone) == 17 && (strcmp(substr($officePhone,strlen($officePhone) - 12, 1), "-")) == 0)
		{
			$ext = substr($officePhone, strlen($officePhone)-5, 5);
		}
		else if (strlen($officePhone) > 3 && (strcmp(substr($officePhone,strlen($officePhone) - 7, 1), "-")) == 0)
		{
			$ext = substr($officePhone,strlen($officePhone)-5, 5);
			$officePhone = "+".substr($officePhone, 0, strlen($officePhone)-8);
			$officePhone = str_replace(" -","",$officePhone);
		}
		else if (strlen($officePhone) > 3 && (strcmp(substr($officePhone, 0, 2), "8-")) == 0)
		{
			$officePhone = str_replace("+","",$officePhone);
			$officePhone = str_replace(" - ","",$officePhone);
		}
		else if (strlen($officePhone) == 5)
		{
			$ext = $officePhone;
			$officePhone = "";
		}
		else if (strlen($officePhone) == 17 && (strcmp(substr($officePhone, 11, 1), "-")) == 0)
		{
			$ext = substr($officePhone, 12, 5);
			$areaCode = substr($officePhone, 0, 4);
			$officePhone = "+(86) ".$areaCode." ".substr($officePhone, 4, 7);
		}
		else if (strlen($officePhone) == 18 && (strcmp(substr($officePhone, 12, 1), "-")) == 0)
		{
			$ext = substr($officePhone, 13, 5);
			$areaCode = substr($officePhone, 0, 4);
			$officePhone = "+(86) ".$areaCode." ".substr($officePhone, 5, 7);
		}
		else
		{
			$officePhone = str_replace("+","",$officePhone);
			$officePhone = str_replace(" - ","",$officePhone);
			$officePhone = str_replace("(86)","+(86)",$officePhone);
			$ext = "";
		}
		
		if (strlen($officePhone) > 0)
		{
			$officePhone = "Phone: "."<b>".$officePhone."</b>";
		}
		if (strlen($ext) > 0)
		{
			$ext = ", &nbsp;&nbsp;&nbsp;ext: "."<b>".$ext."</b>";
		}
		$officePhone = $officePhone.$ext;
		
		if ($row['PHOTO']) 
		{
			$photo = $row['PHOTO']->load();
			$im = imagecreatefromstring($photo);
			
			$width = imagesx($im);
			$height = imagesy($im);
			$tmp_width = imagesx($im);
			$tmp_height = imagesy($im);
			$basic_width = $width/1000;
			$basic_height = $height/1000;
			
			if ($width <= 300 && $height <= 300)
			{
				$photo = '<img src="data:image/jpeg;base64,'.base64_encode( $photo ).'"height="'.$height.'" width="'.$width.'"/>';
			}
			else if ($width - $height > 0 && $width > 300)
			{
				$height = $height/$width*300;
				$width = 300;
				
				$photo = '<img src="data:image/jpeg;base64,'.base64_encode( $photo ).'"height="'.$height.'" width="'.$width.'"/>';
			}
			else if ($width - $height < 0 && $height > 300)
			{
				$width = $width/$height*300;
				$height = 300;
				$photo = '<img src="data:image/jpeg;base64,'.base64_encode( $photo ).'"height="'.$height.'" width="'.$width.'"/>';
			}
			else if ($width - $height == 0 && $height > 300)
			{
				$height = 300;
				$width = 300;
				$photo = '<img src="data:image/jpeg;base64,'.base64_encode( $photo ).'"height="'.$height.'" width="'.$width.'"/>';
			}			
		}
		else
		{
			$photo = '<img src="./images/no_photo.png"';
		}
		

if (strlen($mobile) < 1)
{
	$mobile = "";
}
else
{
	$mobile = 'Mobile: <b>+(86) '.$mobile.' </b>';
}

?>

<table border = "0">
    <tr>
        <td colspan="2" valign = "middle" height = "50"><b><font size="4" color="#003D5B">Contact information</font></b><hr></td>
    </tr>
    <tr>
        <td rowspan="2" height="300" width="300" align="center"><?php echo $photo?></td>
        <td height="150" align = "center" valign = "top" height="50"><font size="5" color="#51565B" fase="Tahoma"><b><?php echo $name ?></b></font><br><font size="5" color="#51565B" fase="Tahoma"><?php echo $name_cn ?></font><br><font size="3" color="#51565B" fase="Tahoma"><?php echo $title ?></font><br><br><a id="mail_link" href="./department.php?to=<?php echo $department ?>"target="_top"><?php echo $department ?></td>
    </tr>
    <tr>
        <td height="150" width="300" valign = "bottom"><br><?php echo $officePhone?><br><?php echo $mobile ?><br><a id="mail_link" href="mailto:<?php echo $email ?>"><?php echo $email ?></a><br><br><br></td>
    </tr>
</table>

	
	

<?php
}
// Close the Oracle connection
oci_free_statement($stid);
oci_close($conn);

echo "</table>";
?>

<?php
//include("./footer.inc");
?>
