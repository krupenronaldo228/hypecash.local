<div class="page-content">
	<div class="container">
		<div class="page-top">
			<?=$this->breadcrumbs->create_links();?>
			<h1 class="page-title"><?=$pageinfo['title'];?></h1>
			<? if($pageinfo['brief']) { ?><div class="page-brief"><?=$pageinfo['brief'];?></div><? } ?>
		</div>
		
		<ul class="news-list">
		<? foreach($items as $blog_post) { ?>
			<li>
				<a href="<?=base_url($this->page.'/'.$blog_post['alias']);?>" class="news-item">
					<div class="image">
						<?=check_img(PATH_UPLOADS.'/'.$this->page.'/thumb/'.$blog_post['img'], ['alt' => $blog_post['img_alt']]);?>
					</div>
					<div class="description">
						<div class="date">
							<?=fa5r('calendar-alt');?>
							<?=translate_date($blog_post['pub_date']);?>
						</div>
						<div class="title"><?=$blog_post['title'];?></div>
						<div class="text"><?=$blog_post['text'];?></div>
                        <div class="text"><?=$blog_post['price'];?></div>
						<div class="action">
							<span class="link">Читать далее</span>
						</div>
					</div>
				</a>
			</li>
		<? } ?>
		</ul>
		
		<?=$this->pagination->create_links();?>

		<? if(strip_tags($pageinfo['text']) != '' && uri(2) == '') { ?>
		<div class="page-text">
			<div class="text-editor">
				<?=$pageinfo['text'];?>
			</div>
		</div>
		<? } ?>
	</div>
</div>
