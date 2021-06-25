<div class="h3 semibold mb20">Default</div>

<ul class="tiles-list">
	<li class="col-md-3 col-sm-4">
		<div class="tile">
			<div class="tile-body">
				<div class="tile-num">12</div>
				<div class="tile-label">entries</div>
			</div>
			<div class="tile-bottom">
				<a href="javascript:void(0)" class="tile-link">
					Create new entry
					<span class="icon"><?=fa5r('plus-square');?></span>
				</a>
			</div>
			<div class="tile-icon">
				<?=fa5r('file-alt');?>
			</div>
		</div>
	</li>
</ul>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Common</div>

<? $tiles = [
	'info' => fa5r('bell'),
	'success' => fa5r('check-circle'),
	'warning' => fa5r('question-circle'),
	'error' => fa5r('times-circle'),
];?>

<ul class="tiles-list">
<? foreach($tiles as $class => $icon) { ?>
	<li class="col-md-3 col-sm-4">
		<div class="tile tile-<?=$class;?>">
			<div class="tile-body">
				<div class="tile-num"><?=rand(1, 1000);?></div>
				<div class="tile-label">entries</div>
			</div>
			<div class="tile-bottom">
				<a href="javascript:void(0)" class="tile-link">
					Create new entry
					<span class="icon"><?=fa5r('plus-square');?></span>
				</a>
			</div>
			<div class="tile-icon">
				<?=$icon;?>
			</div>
		</div>
	</li>
<? } ?>
</ul>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Colors</div>

<? $tiles = [
	'gray' => fa5r('check-circle'),
	'dark' => fa5r('check-circle'),
	'blue' => fa5r('check-circle'),
	'azure' => fa5r('check-circle'),
	'space' => fa5r('check-circle'),
	'green' => fa5r('check-circle'),
	'emerald' => fa5r('check-circle'),
	'meadow' => fa5r('check-circle'),
	'orange' => fa5r('check-circle'),
	'yellow' => fa5r('check-circle'),
	'brown' => fa5r('check-circle'),
	'red' => fa5r('check-circle'),
	'flamingo' => fa5r('check-circle'),
	'fire' => fa5r('check-circle'),
	'purple' => fa5r('check-circle'),
	'pink' => fa5r('check-circle'),
	'plum' => fa5r('check-circle'),
];?>

<ul class="tiles-list">
<? foreach($tiles as $class => $icon) { ?>
	<li class="col-md-3 col-sm-4">
		<div class="tile tile-<?=$class;?>">
			<div class="tile-body">
				<div class="tile-num"><?=rand(1, 1000);?></div>
				<div class="tile-label">entries</div>
			</div>
			<div class="tile-bottom">
				<a href="javascript:void(0)" class="tile-link">
					Create new entry
					<span class="icon"><?=fa5r('plus-square');?></span>
				</a>
			</div>
			<div class="tile-icon">
				<?=$icon;?>
			</div>
		</div>
	</li>
<? } ?>
</ul>