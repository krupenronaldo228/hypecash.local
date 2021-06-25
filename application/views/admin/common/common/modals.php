<div class="note note-info">
	Документация по методам и событиям <a href="https://getbootstrap.com/docs/4.3/components/modal/" target="_blank">на официальном сайте</a>.
</div>

<div class="h3 semibold mb20">Default modal</div>

<a href="#defaultModal" class="btn btn-success" data-toggle="modal">Open modal</a>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Modal sizes</div>

<div class="btns-list">
	<a href="#smallModal" class="btn btn-info" data-toggle="modal">Small modal</a>
	<a href="#largeModal" class="btn btn-warning" data-toggle="modal">Large modal</a>
	<a href="#wideModal" class="btn btn-flamingo" data-toggle="modal">Wide modal</a>
	<a href="#fullsizeModal" class="btn btn-purple" data-toggle="modal">Fullsize modal</a>
</div>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Modal position</div>

<div class="btns-list">
	<a href="#topModal" class="btn btn-meadow" data-toggle="modal">Top modal</a>
	<a href="#bottomModal" class="btn btn-space" data-toggle="modal">Bottom modal</a>
	<a href="#leftModal" class="btn btn-plum" data-toggle="modal">Left modal</a>
	<a href="#rightModal" class="btn btn-brown" data-toggle="modal">Right modal</a>
</div>



<?/*======= DEFAULT MODAL =======*/?>
<div class="modal fade" tabindex="-1" role="dialog" id="defaultModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Modal title</div>
				<div class="modal-brief">Some description for modal</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
			<div class="modal-footer">
				<div class="modal-actions">
					<button class="btn btn-success">Save changes</button>
					<button class="btn" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?/*======= SMALL MODAL =======*/?>
<div class="modal fade modal-xs" tabindex="-1" role="dialog" id="smallModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Small modal</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
		</div>
	</div>
</div>

<?/*======= LARGE MODAL =======*/?>
<div class="modal fade modal-xl" tabindex="-1" role="dialog" id="largeModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Large modal</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
		</div>
	</div>
</div>

<?/*======= WIDE MODAL =======*/?>
<div class="modal fade modal-wide" tabindex="-1" role="dialog" id="wideModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Wide modal</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
		</div>
	</div>
</div>

<?/*======= FULLSIZE MODAL =======*/?>
<div class="modal fade modal-fullsize" tabindex="-1" role="dialog" id="fullsizeModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Fullsize modal</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
		</div>
	</div>
</div>

<?/*======= TOP MODAL =======*/?>
<div class="modal fade modal-top" tabindex="-1" role="dialog" id="topModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Top modal</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
		</div>
	</div>
</div>

<?/*======= BOTTOM MODAL =======*/?>
<div class="modal fade modal-bottom" tabindex="-1" role="dialog" id="bottomModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Bottom modal</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
		</div>
	</div>
</div>

<?/*======= LEFT MODAL =======*/?>
<div class="modal fade modal-left" tabindex="-1" role="dialog" id="leftModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Left modal</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
		</div>
	</div>
</div>

<?/*======= RIGHT MODAL =======*/?>
<div class="modal fade modal-right" tabindex="-1" role="dialog" id="rightModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Right modal</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
		</div>
	</div>
</div>