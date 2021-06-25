<div class="page-content">
	<div class="container">
		<div class="page-top">
			<?=$this->breadcrumbs->create_links();?>
			<h1 class="page-title"><?=$pageinfo['title'];?></h1>
			<? if($pageinfo['brief']) { ?><div class="page-brief"><?=$pageinfo['brief'];?></div><? } ?>
		</div>
		
		<ul class="reviews-list">
		<? foreach($items as $item) { ?>
			<li>
				<div class="reviews-item">
					<div class="image">
						<?=check_img(PATH_UPLOADS.'/'.$this->page.'/thumb/'.$item['img'], ['alt' => $siteinfo['template_alt']], 'user.png');?>
					</div>
					<div class="description">
						<div class="title"><?=$item['name'];?></div>
						<div class="date">
							<?=fa5r('calendar-alt');?>
							<?=translate_date($item['pub_date']);?>
						</div>
						<div class="text">
							<div class="text-editor"><?=nl2br($item['text']);?></div>
						</div>
						<? if($item['link'] != '') { ?>
						<div class="link">
							<noindex>
								<?=anchor($item['link'], '', ['target' => '_blank', 'rel' => 'nofollow']);?>
							</noindex>
						</div>
						<? } ?>
					</div>
				</div>
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
