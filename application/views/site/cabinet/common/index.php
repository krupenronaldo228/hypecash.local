<div class="cabinet-top">
	<?=$this->breadcrumbs->create_links();?>
	<div class="cabinet-title">
		<h1 class="title"><?=$pageinfo['title'];?></h1>
		<? if($pageinfo['brief']) { ?><div class="brief"><?=$pageinfo['brief'];?></div><? } ?>
	</div>
</div>

<? if(strip_tags($pageinfo['text']) != '') { ?>
<div class="cabinet-bottom">
	<div class="text-editor">
		<?=$pageinfo['text'];?>
	</div>
</div>
<? } ?>