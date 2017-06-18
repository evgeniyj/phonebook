<?php
include("./header.inc");
?>
<script type="text/javascript">
<!--
function errorMsg(name,ext,cat)
{
  // alert("Netscape 6 or Mozilla is needed to install a sherlock plugin");
  f=document.createElement("form");
  f.setAttribute("name","installform");
  f.setAttribute("method","post");
  f.setAttribute("action","http://phonebook/error.html");
  fe=document.createElement("input");
  fe.setAttribute("type","hidden");
  fe.setAttribute("name","name");
  fe.setAttribute("value",name);
  f.appendChild(fe);
  fe=document.createElement("input");
  fe.setAttribute("type","hidden");
  fe.setAttribute("name","ext");
  fe.setAttribute("value",ext);
  f.appendChild(fe);
  fe=document.createElement("input");
  fe.setAttribute("type","hidden");
  fe.setAttribute("name","cat");
  fe.setAttribute("value",cat);
  f.appendChild(fe);
  document.getElementsByTagName("body")[0].appendChild(f);
  if (document.installform) {
    document.installform.submit();
  } else {
    location.href="http://phonebook/error.html"; //hack for DOM-incompatible browsers
  }
}
function addEngine(name,ext,cat,type)
{
  if ((typeof window.sidebar == "object") && (typeof
  window.sidebar.addSearchEngine == "function"))
  {
    //cat="Web";
    //cat=prompt("In what category should this engine be installed?","Web")
    	window.sidebar.addSearchEngine(
        "http://phonebook/plugins/"+name+".src",
        "http://phonebook/plugins/"+name+"."+ext,
        name,
        cat );
   }
  else
  {
    errorMsg(name,ext,cat);
  }
}
//-->

</script>
<script type="text/javascript">
expand('11000');
</script>

<!-- Informational block -->
<table width="732" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle" align="left">
<td width="732" colspan="7" valign="middle" align="left" id="text_black"><br>
<strong><font color="#0d8e04">Phone extensions base search</font></strong><br>
Type your request, searches by name, department, title, phone extension. 
<br>Only entries with "phone number" or "email" will be viewed.
</td></tr>
</table>




<?php
include("./footer.inc");
?>