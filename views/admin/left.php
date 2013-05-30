<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<script type="text/javascript" src="<?php echo STATIC_JS_PATH; ?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS_PATH; ?>chili-1.7.pack.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS_PATH; ?>jquery.easing.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS_PATH; ?>jquery.dimensions.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS_PATH; ?>jquery.accordion.js"></script>
<script language="javascript">
	jQuery().ready(function(){
		jQuery('#navigation').accordion({
			header: '.head',
			navigation1: true, 
			event: 'click',
			fillSpace: true,
			animated: 'bounceslide'
		});
	});
</script>
<style type="text/css">
<!--
body {
	margin:0px;
	padding:0px;
	font-size: 12px;
}
#navigation {
	margin:0px;
	padding:0px;
	width:150px;
}
#navigation a.head {
	cursor:pointer;
	background:url('<?php echo STATIC_IMG_PATH; ?>admin_img/main_34.gif') no-repeat scroll;
	display:block;
	font-weight:bold;
	margin:0px;
	padding:5px 0 5px;
	text-align:center;
	font-size:12px;
	text-decoration:none;
}
#navigation ul {
	border-width:0px;
	margin:0px;
	padding:0px;
	text-indent:0px;
}
#navigation li {
	list-style:none; display:inline;
}
#navigation li li a {
	display:block;
	font-size:12px;
	text-decoration: none;
	text-align:center;
	padding:3px;
}
#navigation li li a:hover {
	background:url('<?php echo STATIC_IMG_PATH; ?>admin_img/tab_bg.gif') repeat-x;
		border:solid 1px #adb9c2;
}
-->
</style>
</head>
<body>
<div  style="height:100%;">
  <ul id="navigation">
  <?php foreach($arrMenu as $key=>$menu) {?>
    <li> <a class="head"><?php echo $key;?></a>
      <ul>
	  <?php foreach($menu as $li=>$item) {?>
	  <?php if($item['isshow']){?>
        <li><a href='<?php echo site_url($item['c'].'/'.$item['a']);?><?php echo isset($item['param']) ? $item['param']:'';?>' target="rightFrame"><?php echo $item['name'];?></a></li>
		<?php }?> 
		<?php }?> 
      </ul>
    </li>
	<?php }?> 
  </ul>
</div>
</body>
</html>
