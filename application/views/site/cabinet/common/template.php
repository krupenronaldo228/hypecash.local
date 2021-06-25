<section class="cabinet page-content">
	<div class="container">
		
		<? $this->load->view('site/common/warning');?>
		
		<div class="cabinet-content">
			<div class="cabinet-content-left">
				<nav class="cabinet-nav">
					<div class="cabinet-nav-title">Личный кабинет</div>
					<ul class="cabinet-nav-list">
					<? foreach($nav_cabinet as $nav_link) { ?>
						<li>
							<a href="<?=base_url($nav_link['link']);?>" class="cabinet-nav-item <?=uri(2) == $nav_link['alias'] ? 'current' : null?>">
								<?=$nav_link['icon'];?>
								<?=$nav_link['title'];?>
							</a>
						</li>
					<? } ?>
					</ul>
				</nav>
			</div>
			<div class="cabinet-content-right">
				<? $this->load->view('site/cabinet/'.$subview);?>
			</div>
		</div>
	</div>
</section>
