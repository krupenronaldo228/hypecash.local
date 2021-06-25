<div class="gallery-list">
<? for($i = 1; $i < 4; $i++) { ?>
	<div class="gallery-item">
		<a href="<?=base_url('assets/uploads/files/test/'.$i.'.jpg');?>" class="img" data-toggle="gallery">
			<?=check_img('assets/uploads/files/test/'.$i.'.jpg');?>
		</a>
		<div class="actions">
			<div class="input-group">
				<input type="text" class="form-input" value="Alt изображения" />
				<span class="input-group-append">
					<a href="javascript:void(0)" class="btn btn-icon btn-success" title="Сохранить описание"><?=fa5s('check');?></a>
				</span>
			</div>
		</div>
		<div class="links">
			<a href="javascript:void(0)" class="btn btn-xs btn-icon btn-error" title="Удалить изображение"><?=fa5s('times');?></a>
		</div>
	</div>
<? } ?>
</div>

<script>
	$('[data-toggle="gallery"]').gallery();
</script>