<!DOCTYPE html>
<html lang="ru">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<title><?=$seo['title'];?></title>
	<meta name="keywords" content="<?=$seo['keywords'];?>" />
	<meta name="description" content="<?=$seo['description'];?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<link rel="canonical" href="<?=$seo['canonical'];?>" />
	
	<?=link_tag('favicon.ico'.$version, 'shortcut icon', 'image/ico');?>
	<?=link_tag('favicon.ico'.$version, 'shortcut', 'image/ico');?>
	
	<?=link_tag('assets/site/css/style.css'.$version);?>
	
	<?=link_tag('assets/plugins/font-awesome/css/font-awesome.min.css'.$version);?>
	<?=link_tag('assets/plugins/font-opensans/font.css');?>
	
</head>
<body class="pageview-<?=$pageinfo['alias'];?>">

<div class="cap">
	<div class="cap-top">
		<div class="title"><?=$siteinfo['title'];?></div>
		<div class="descr"><?=$siteinfo['description'];?></div>
	</div>
	<div class="cap-bottom">
		<div class="title"><?=$siteinfo['cap_title'];?></div>
		<div class="descr"><?=nl2br($siteinfo['cap_description']);?></div>
	</div>
</div>

</body>
</html>
