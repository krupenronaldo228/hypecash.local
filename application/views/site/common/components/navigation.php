<nav class="navigation">
	<div class="container">
		<a href="javascript:void(0)" class="navigation-btn"><?=fa5s('bars');?> Меню сайта</a>
		<div class="navigation-list">
			<ul>
				<? foreach($nav_header as $nav_link) { ?>
					<li>
						<div class="navigation-item">
							<?=nav_link($nav_link, ['class' => 'navigation-link']);?>

							<? if(!empty($nav_link['items'])) { ?>
								<ul class="navigation-child">
									<? foreach($nav_link['items'] as $nav_child) { ?>
										<li>
											<?=nav_link($nav_child);?>
										</li>
									<? } ?>
								</ul>
							<? } ?>
						</div>
					</li>
				<? } ?>
			</ul>
		</div>
	</div>
</nav>
