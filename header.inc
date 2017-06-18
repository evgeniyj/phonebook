<?php
header("Content-Type: text/html; charset=UTF-8");
header("Last-Modified: ".gmdate("D, d M Y H:i:s",time()-3600)." GMT");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5.0 Transitional//EN">
<html>
<head>
<title>Company - Phonebook</title>
<link rel="shortcut icon" href="./images/logo.jpg">

	<!-- Add jQuery library -->
	 <script type="text/javascript" src="./lib/jquery-1.10.1.min.js"></script>
	<!--<script type="text/javascript" src="./lib/jquery-3.1.1.min.js"></script> -->

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="./source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css?v=2.1.5" media="screen" />

	
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$(".fancybox").fancybox({
        'width': 610,
        'height': 400,
		'fitToView': false,
		'autoSize' : false,
        'transitionIn': 'elastic', // this option is for v1.3.4
        'transitionOut': 'elastic', // this option is for v1.3.4
        // if using v2.x AND set class fancybox.iframe, you may not need this
        'type': 'iframe'
        // if you want your iframe always will be 600x250 regardless the viewport size
        //'fitToView' : false  // use autoScale for v1.3.4
    });

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>


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
	font-size: 8pt;
	font-weight: bold;
	text-decoration: none;
}
</style>

<script>
<!--
function sf(){document.query_too.too.focus();}
// -->
</script>
</head>
<body bgcolor="#ffffff" text="#000000" bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" marginheight="0" marginwidth="0">
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="top" align="center">
<td>
<!--  //// -->

<a href="./" target="_top"><img src="./images/logo.jpg" width="460" height="103" hspace="0" vspace="0" border="0"></a>


<!-- / Search and logo -->
<form name="query_too" action="./input.php">
<table width="520" height="10" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
<td width="571" height="10" align="left" valign="middle"><br>
<?php
$criteria = htmlspecialchars($_GET['too']);
$encoding=mb_detect_encoding($criteria, "UTF-8,ASCII,WINDOWS-1251");
if ($encoding=='Windows-1251'){
$criteria=iconv('windows-1251', 'UTF-8', $criteria);
}
?>
<input autocomplete="off" tabindex="1" value="" id="search" name="too" type="text">
<SCRIPT LANGUAGE="JavaScript">
document.query_too.too.focus()
</SCRIPT>
<input type="submit" class="submit" value="Search" tabindex="2" id="go">

</td>
</tr>
</table>
<!-- / Search and logo -->
<!-- /header -->