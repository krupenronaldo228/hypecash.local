<? $flags = glob('./assets/plugins/flags/*'); ?>
<? $defaults_flags = ['by', 'ru', 'ua', 'gb', 'fr', 'de'];?>

<? /*foreach($flags as $flag) { ?>
	'<?=str_replace(['./assets/plugins/flags/', '.svg'], '', $flag);?>', 
<? } */?>


<div class="h3 semibold mb20">Default flags</div>

<div class="flag-list">
<? foreach($defaults_flags as $flag) { ?>
	<li>
		<span class="flag">
			<img src="<?='/assets/plugins/flags/'.$flag.'.svg';?>" alt="" />
		</span>
	</li>
<? } ?>
</div>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Flag sizes</div>

<? foreach(['xs' => 'Extra small', 'sm' => 'Small', '' => 'Default', 'lg' => 'Large', 'xl' => 'Extra large'] as $size => $title) { ?>
<div class="h5 semibold mb20"><?=$title;?></div>
<div class="flag-list">
<? foreach($defaults_flags as $flag) { ?>
	<li>
		<span class="flag flag-<?=$size;?>">
			<img src="<?='/assets/plugins/flags/'.$flag.'.svg';?>" alt="" />
		</span>
	</li>
<? } ?>
</div>
<? } ?>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">List</div>

<div class="flag-list">
<? foreach($flags as $flag) { ?>
	<li>
		<div class="flag-demo">
			<div class="flag-demo-img">
				<img src="<?=str_replace('./', '/', $flag);?>" alt="" />
			</div>
			<div class="flag-demo-title">
				<?=str_replace(['./assets/plugins/flags/', '.svg'], '', $flag);?>
			</div>
		</div>
	</li>
<? } ?>
</div>