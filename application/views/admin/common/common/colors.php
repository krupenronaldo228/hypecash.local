<? $colors = [
	['title' => 'Default color', 'class' => 'default', 'hex' => '182125'],
	['title' => 'Black color', 'class' => 'black', 'hex' => '000000'],
	['title' => 'Gray color', 'class' => 'gray', 'hex' => '6b6b6b'],
	['title' => 'Lite gray color', 'class' => 'gray-lite', 'hex' => '969696'],
	['title' => 'Info color', 'class' => 'info', 'hex' => '019fe6'],
	['title' => 'Success color', 'class' => 'success', 'hex' => '43c343'],
	['title' => 'Warning color', 'class' => 'warning', 'hex' => 'fd9b1e'],
	['title' => 'Error color', 'class' => 'error', 'hex' => 'fb4e3e'],
];?>

<div class="h3 semibold mb20">Стандартные цвета</div>

<ul class="row">
<? foreach($colors as $color) { ?>
	<li class="col-md-3 col-sm-4 col-xs-12">
		<div class="colors-demo-item">
			<div class="colors-demo-example bg-<?=$color['class'];?>"></div>
			<div class="colors-demo-title color-<?=$color['class'];?>">
				<?=$color['title'];?>
			</div>
			<div class="colors-demo-hex">
				#<?=$color['hex'];?>
			</div>
		</div>
	</li>
<? } ?>
</ul>

<hr class="mt30 mb30" />

<? $extra = [
	['title' => 'Blue color', 'class' => 'blue', 'hex' => '019fe6'],
	['title' => 'Azure color', 'class' => 'azure', 'hex' => '41c4ff'],
	['title' => 'Space color', 'class' => 'space', 'hex' => '016c9c'],
	['title' => 'Green color', 'class' => 'green', 'hex' => '43c343'],
	['title' => 'Emerald color', 'class' => 'emerald', 'hex' => '52e880'],
	['title' => 'Meadow color', 'class' => 'meadow', 'hex' => '1b8c1b'],
	['title' => 'Orange color', 'class' => 'orange', 'hex' => 'fd9b1e'],
	['title' => 'Yellow color', 'class' => 'yellow', 'hex' => 'ffd400'],
	['title' => 'Brown color', 'class' => 'brown', 'hex' => 'a95600'],
	['title' => 'Red color', 'class' => 'red', 'hex' => 'fb4e3e'],
	['title' => 'Flamingo color', 'class' => 'flamingo', 'hex' => 'ff7e72'],
	['title' => 'Fire color', 'class' => 'fire', 'hex' => 'd82e1f'],
	['title' => 'Purple color', 'class' => 'purple', 'hex' => '8e44ad'],
	['title' => 'Pink color', 'class' => 'pink', 'hex' => 'ff6ec5'],
	['title' => 'Plum color', 'class' => 'plum', 'hex' => '682784'],
	['title' => 'Info mute', 'class' => 'mute-info', 'hex' => 'e5f5fc'],
	['title' => 'Success mute', 'class' => 'mute-success', 'hex' => 'ecf9ec'],
	['title' => 'Warning mute', 'class' => 'mute-warning', 'hex' => 'fff5e8'],
	['title' => 'Error mute', 'class' => 'mute-error', 'hex' => 'ffedeb'],
];?>

<div class="h3 semibold mb20">Дополнительные цвета</div>

<ul class="row">
<? foreach($extra as $color) { ?>
	<li class="col-md-3 col-sm-4 col-xs-12">
		<div class="colors-demo-item">
			<div class="colors-demo-example bg-<?=$color['class'];?>"></div>
			<div class="colors-demo-title color-<?=$color['class'];?>">
				<?=$color['title'];?>
			</div>
			<div class="colors-demo-hex">
				#<?=$color['hex'];?>
			</div>
		</div>
	</li>
<? } ?>
</ul>