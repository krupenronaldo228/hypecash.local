<div class="entries-view">
	<div class="entries-view-left">
		<div class="entries-view-img"><?=check_img('assets/uploads/files/test/item.jpg');?></div>
	</div>
	<div class="entries-view-right">
		<?=entries_info([
			['icon' => fa5r('calendar-alt fa-fw'), 'text' => date('d.m.Y H:i').' <i class="mr15"></i> '.visibility(1)],
			['icon' => fa5s('external-link-alt fa-fw'), 'text' => anchor('/', '', ['target' => '_blank'])],
			['icon' => fa5r('comment-dots fa-fw'), 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nulla ante, molestie et mattis quis, accumsan sit amet magna. Etiam eleifend iaculis viverra.'],
		]);?>
	</div>
</div>

<hr class="mt20 mb20" />

<div class="h3 semibold mb20">Текст страницы</div>

<div class="text-editor">
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eleifend lectus urna, et viverra ante hendrerit in. Aliquam euismod dolor ut mi dictum, non ullamcorper elit dictum. Aliquam a malesuada urna. Nunc nec euismod odio, dapibus hendrerit augue. Mauris turpis lectus, varius ut nibh sed, facilisis laoreet tellus. Integer non consequat tellus. Pellentesque interdum porttitor ligula, sed imperdiet dui elementum non.</p>
	<p>Fusce malesuada varius sollicitudin. Sed egestas, justo quis maximus aliquam, orci risus ultricies mauris, quis pharetra est diam quis erat. Praesent faucibus dui sit amet risus malesuada, ac finibus erat aliquet. Pellentesque nisl nunc, consectetur vel mi nec, aliquam aliquam risus. Cras at odio massa. Nulla quis ipsum at velit ullamcorper tincidunt vitae a elit. Pellentesque eleifend congue enim sagittis faucibus. Suspendisse et metus rhoncus, cursus magna quis, finibus tortor. Sed blandit tellus vel pharetra cursus. Aenean at vehicula leo. Aliquam nibh magna, posuere iaculis volutpat mollis, fringilla sed ipsum. Nunc pulvinar cursus augue, id porttitor ante rhoncus ac. Praesent at libero a metus euismod congue eu at libero. Praesent non lacus consectetur, ornare augue ut, pellentesque arcu.</p>
</div>

<hr class="mt20 mb20" />

<div class="h3 semibold mb20">SEO страницы</div>

<?=entries_info([
	['icon' => fa5s('bullhorn fa-fw'), 'text' => 'Meta title'],
	['icon' => fa5s('tags fa-fw'), 'text' => 'Meta keywords'],
	['icon' => fa5s('tags fa-fw'), 'text' => 'Meta description'],
]);?>

<hr class="mt20 mb20" />

<div class="btns-list">
	<?=anchor('/', 'Редактировать', ['class' => 'btn btn-success'])?>
	<?=anchor('admin/'.uri(2), 'Вернуться назад', ['class' => 'btn'])?>
</div>