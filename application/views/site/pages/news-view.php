<div class="page-content">
	<div class="container">
		<?=$this->breadcrumbs->create_links();?>
		<div class="news-content">
			<div class="news-content-left">
				<div class="news-content-top">
					<h1 class="page-title"><?=$item['title'];?></h1>
					<div class="news-content-date">
						<?=fa5r('calendar-alt');?>
						<?=translate_date($item['pub_date']);?>
					</div>
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
						<a href="<?=base_url($this->page);?>">вернуться к списку новостей</a>
					</div>
				</div>
			</div>
			<div class="news-content-right">
				<div class="news-similar">
					<div class="news-similar-title">Читайте также</div>
					<ul class="news-similar-list">
						<? foreach($similar as $blog_post) { ?>
							<li>
								<a href="<?=base_url($this->page.'/'.$blog_post['alias']);?>" class="news-similar-item">
									<div class="image">
										<?=check_img(PATH_UPLOADS.'/'.$this->page.'/thumb/'.$blog_post['img'], ['alt' => $blog_post['img_alt']]);?>
									</div>
									<div class="description">
										<div class="date">
											<?=fa5r('calendar-alt');?>
											<?=translate_date($blog_post['pub_date']);?>
										</div>
										<div class="title"><?=$blog_post['title'];?></div>
										<div class="text"><?=$blog_post['brief'];?></div>
									</div>
								</a>
							</li>
						<? } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
