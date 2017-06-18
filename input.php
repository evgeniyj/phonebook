<?php
include("./header.inc");
include("./connection.php");
?>

<?php
$criteria = strtolower($criteria);
#Defite string of request to your from DB:
$YOUR_PROPERTIES = 
$stid = oci_parse($conn, "SELECT".$YOUR_PROPERTIES.. $criteria . "'");
oci_execute($stid);

while($res = oci_fetch_array($stid))
{
  $data[] = $res;
}

$num = count($data);


if (!$criteria || $criteria == '%'){
	echo '<table width=732 height=50 border=0 id=text_black><tr><td valign=top><b>Empty request!</b></td></tr></table>';
    include("./footer.inc");
    exit();
}

	echo "<table border=0 width=732>";
	echo "<tr>";
	echo "<td align=\"center\">";
	echo "<div id=text_black>";

	//print the number, if any, of results
	echo 'We found &mdash; <b>' . $num . '</b> matches. Your request - &quot;<b>' . $criteria . '</b>&quot;.<br>';


?>

To get detailed information, please, click on &quot;<font id=mail_link>Name</font>&quot;.</div><br><br>

</td>
			</tr>
</table>


<table border="0" width="95%" id="text_black" cellpadding="1" cellspacing="1" bgcolor="#cccccc">
	<tr bgcolor="#e4e4e4">
		<td align ="center" height=25>&nbsp;<b>Name</b></td>
		<td align ="center">&nbsp;<b>Department</b></td>
		<td align ="center">&nbsp;<b>Title</b></td>
		<td align ="center">&nbsp;<b>Company</b></td>
		<td align ="center">&nbsp;<b>Phone</b>&nbsp;&nbsp;&nbsp;</td>
		<td align ="center">&nbsp;<b>Extension</b>&nbsp;&nbsp;&nbsp;</td>
	</tr>

<?php
//start the loop for printing the results		
//Get additional data from DB
oci_execute($stid);
$count = 0;
while($row=oci_fetch_array($stid)){
	$id = $row[0];
	$name = $row[1];
	$department = $row[2];
	$title = $row[3];
	$company = $row[4];
	$officePhone = $row[5];
	$ext = "";
	
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
	
		
		
		
		if ($row['PHOTO']) 
		{
			$photo = $row['PHOTO']->load();
			$photo = '<img src="data:image/jpeg;base64,'.base64_encode( $photo ).'" height="300" width="300"/>';
		}
		else
		{
			$photo = '<img src="./images/no_photo.png"';
		}
		
		if ($count % 2 == 0)
		{
			$color = "#FFFFFF";
		}else{
			$color = "#e4e4e4";
		}$count++;
		
		
		if (strpos($department, '&') !== false) {
			$department_link = str_replace("&","%26",$department);
		}
		else if (strpos($department, '"') !== false) {
			$department_link = str_replace("\"","%22",$department);
		}
		else if (strpos($department, '#') !== false) {
			$department_link = str_replace("#","%23",$department);
		}
		else
		{
			$department_link = $department;
		}
		
		echo "<tr bgcolor=\"$color\" onmouseover=\"this.style.backgroundColor='#99BDDB';\" onmouseout=\"this.style.backgroundColor='$color'\">";
		echo "<td height=\"30\" align=\"center\"><a class=\"fancybox fancybox.iframe\" href=\"./detailed.php?uid=".$id."\" id=\"mail_link\">&nbsp;&nbsp;".$name."</a></td>";
		echo "<td align=\"center\">&nbsp;<a id=\"mail_link\" href=\"./department.php?to=".$department_link."\">".$department."</a></b></a>&nbsp;</td>";
		echo "<td align=\"center\">&nbsp;".$title."&nbsp;</td>";
		echo "<td align=\"center\">&nbsp;".$company."&nbsp;</td>";
		echo "<td align=\"center\">&nbsp;".$officePhone."&nbsp;</td>";
		echo "<td align=\"center\">&nbsp;".$ext."&nbsp;</td>";
		echo "</tr>";
}


// Close the Oracle connection
oci_free_statement($stid);
oci_close($conn);


echo "</table>";
?>
				<br><br><br>

<?php
include("./footer.inc");
?>