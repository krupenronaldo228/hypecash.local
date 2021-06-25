<div class="page-content">
	<div class="container">
		<?=$this->breadcrumbs->create_links();?>
		<div class="news-content-top">
			<h1 class="page-title"><?=$item['title'];?></h1>
		</div>
		<div class="text-editor">
			<?=$item['text'];?>
		</div>
		<div class="page-bottom">
			<div class="page-social">
				<div class="social">
					<div class="social-label">Поделиться:</div>
					<div class="social-init" data-toggle="social"></div>
				</div>
			</div>
			<div class="page-return">
				<a href="<?=base_url();?>">вернуться на главную</a>
			</div>
		</div>
		</div>
	</div>
</div>
