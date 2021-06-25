<link rel="canonical" href="<?=$seo['canonical'];?>" />

<?=link_tag(['rel' => 'apple-touch-icon', 'sizes' => '57x57', 'href' => PATH_SITE.'/img/favicon/apple-touch-icon-57x57.png'.$version]);?>
<?=link_tag(['rel' => 'apple-touch-icon', 'sizes' => '60x60', 'href' => PATH_SITE.'/img/favicon/apple-touch-icon-60x60.png'.$version]);?>
<?=link_tag(['rel' => 'apple-touch-icon', 'sizes' => '72x72', 'href' => PATH_SITE.'/img/favicon/apple-touch-icon-72x72.png'.$version]);?>
<?=link_tag(['rel' => 'apple-touch-icon', 'sizes' => '76x76', 'href' => PATH_SITE.'/img/favicon/apple-touch-icon-76x76.png'.$version]);?>
<?=link_tag(['rel' => 'apple-touch-icon', 'sizes' => '114x114', 'href' => PATH_SITE.'/img/favicon/apple-touch-icon-114x114.png'.$version]);?>
<?=link_tag(['rel' => 'apple-touch-icon', 'sizes' => '120x120', 'href' => PATH_SITE.'/img/favicon/apple-touch-icon-120x120.png'.$version]);?>
<?=link_tag(['rel' => 'apple-touch-icon', 'sizes' => '144x144', 'href' => PATH_SITE.'/img/favicon/apple-touch-icon-144x144.png'.$version]);?>
<?=link_tag(['rel' => 'apple-touch-icon', 'sizes' => '152x152', 'href' => PATH_SITE.'/img/favicon/apple-touch-icon-152x152.png'.$version]);?>
<?=link_tag(['rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => PATH_SITE.'/img/favicon/apple-touch-icon-180x180.png'.$version]);?>
<?=link_tag(['rel' => 'icon', 'type' => 'image/png', 'href' => PATH_SITE.'/img/favicon/favicon-32x32.png'.$version, 'sizes' => '32x32']);?>
<?=link_tag(['rel' => 'icon', 'type' => 'image/png', 'href' => PATH_SITE.'/img/favicon/android-chrome-192x192.png'.$version, 'sizes' => '192x192']);?>
<?=link_tag(['rel' => 'icon', 'type' => 'image/png', 'href' => PATH_SITE.'/img/favicon/favicon-96x96.png'.$version, 'sizes' => '96x96']);?>
<?=link_tag(['rel' => 'icon', 'type' => 'image/png', 'href' => PATH_SITE.'/img/favicon/favicon-16x16.png'.$version, 'sizes' => '16x16']);?>
<?=link_tag(['rel' => 'manifest', 'href' => PATH_SITE.'/img/favicon/manifest.json'.$version]);?>

<? foreach ($seo['og'] as $og_property => $og_content) { ?>
	<meta property="og:<?= $og_property; ?>" content="<?= htmlspecialchars($og_content); ?>"/>
<? } ?>

<? if($siteinfo['template_color']) { ?>
	<meta name="theme-color" content="#<?=$siteinfo['template_color'];?>" />
<? } ?>
