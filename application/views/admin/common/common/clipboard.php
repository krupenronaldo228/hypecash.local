<div class="note note-info">
	Документация по методам и событиям <a href="https://clipboardjs.com/" target="_blank">на официальном сайте</a>.
</div>

<div class="h3 semibold mb20">Copy from input</div>

<div class="form-group">
	<div class="input-group">
		<span class="input-group-prepend">
			<a href="javascript:void(0)" class="btn btn-icon" data-toggle="clipboard" data-clipboard-target="#copyInput1">
				<?=fa5r('clone fa-fw');?>
			</a>
		</span>
		<input type="text" class="form-input" id="copyInput1" value="Lorem ipsum dolor sit amet, consectetur adipiscing elit" />
	</div>
</div>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Cut from input</div>

<div class="form-group">
	<div class="input-group">
		<span class="input-group-prepend">
			<a href="javascript:void(0)" class="btn btn-icon" data-toggle="clipboard" data-clipboard-target="#copyInput2" data-clipboard-action="cut">
				<?=fa5s('cut fa-fw');?>
			</a>
		</span>
		<input type="text" class="form-input" id="copyInput2" value="Lorem ipsum dolor sit amet, consectetur adipiscing elit" />
	</div>
</div>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Copy from attribute</div>

<div class="btn-list">
	<a href="javascript:void(0)" class="btn btn-info" data-toggle="clipboard" data-clipboard-text="Some text from data-attribute">
		<?=fa5r('clone fa-fw mr5');?>
		Copy some text
	</a>
</div>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Browser support</div>

<ul class="list">
	<li>
		<?=fa5b('chrome fa-fw mr5 font-16 color-purple');?>
		Chrome 42+
	</li>
	<li>
		<?=fa5b('edge fa-fw mr5 font-16 color-space');?>
		Edge 12+
	</li>
	<li>
		<?=fa5b('internet-explorer fa-fw mr5 font-16 color-blue');?>
		IE 9+
	</li>
	<li>
		<?=fa5b('firefox fa-fw mr5 font-16 color-orange');?>
		Firefox 41+
	</li>
	<li>
		<?=fa5b('opera fa-fw mr5 font-16 color-red');?>
		Opera 29+
	</li>
	<li>
		<?=fa5b('safari fa-fw mr5 font-16 color-azure');?>
		Safari 10+
	</li>
</ul>

<script>
	new ClipboardJS('[data-toggle="clipboard"]');
</script>