<ul class="tiles-list">
	<li class="col-lg-3 col-md-6">
		<div class="tile tile-success">
			<div class="tile-body">
				<div class="tile-num"><?=$counter['news'];?></div>
				<div class="tile-label">новостей</div>
			</div>
			<div class="tile-bottom">
				<a href="<?=base_url('admin/news/create');?>" class="tile-link">
					Добавить новость
					<span class="icon"><?=fa5r('plus-square');?></span>
				</a>
			</div>
			<div class="tile-icon">
				<?=fa5s('bullhorn');?>
			</div>
		</div>
	</li>
	<li class="col-lg-3 col-md-6">
		<div class="tile tile-warning">
			<div class="tile-body">
				<div class="tile-num"><?=$counter['articles'];?></div>
				<div class="tile-label">статей</div>
			</div>
			<div class="tile-bottom">
				<a href="<?=base_url('admin/articles/create');?>" class="tile-link">
					Добавить статью
					<span class="icon"><?=fa5r('plus-square');?></span>
				</a>
			</div>
			<div class="tile-icon">
				<?=fa5r('file-alt');?>
			</div>
		</div>
	</li>
	<li class="col-lg-3 col-md-6">
		<div class="tile tile-info">
			<div class="tile-body">
				<div class="tile-num"><?=$counter['pages'];?></div>
				<div class="tile-label">страниц</div>
			</div>
			<div class="tile-bottom">
				<a href="<?=base_url('admin/pages/create');?>" class="tile-link">
					Добавить страницу
					<span class="icon"><?=fa5r('plus-square');?></span>
				</a>
			</div>
			<div class="tile-icon">
				<?=fa5s('file-alt');?>
			</div>
		</div>
	</li>
	<li class="col-lg-3 col-md-6">
		<div class="tile tile-error">
			<div class="tile-body">
				<div class="tile-num"><?=$siteinfo['title'];?></div>
				<div class="tile-label"><?=$siteinfo['description'];?></div>
			</div>
			<div class="tile-bottom">
				<a href="<?=base_url('admin/settings/edit');?>" class="tile-link">
					Изменить настройки
					<span class="icon"><?=fa5s('pen');?></span>
				</a>
			</div>
			<div class="tile-icon">
				<?=fa5s('cog');?>
			</div>
		</div>
	</li>
</ul>

<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-head">
				<div class="card-title">
					<?=fa5r('envelope color-gray-lite mr5');?> Последние сообщения
				</div>
			</div>
			<div class="card-body">
			<? if(empty($feedbacks)) { ?>
				<?=action_result('', 'Сообщений пока нет')?>
			<? } else { ?>
				<ul class="message-list">
				<? foreach($feedbacks as $feedback) { ?>
					<li>
						<a href="<?=base_url('admin/feedback/view/'.$feedback['id']);?>" class="message-item">
							<div class="icon bg-warning"><?=fa5r('envelope color-white');?></div>
							<div class="date">
								<div><?=date('d.m.Y', strtotime($feedback['add_date']));?></div>
								<div><?=date('H:i:s', strtotime($feedback['add_date']));?></div>
							</div>
							<div class="text">
								<span class="bold"><?=$feedback['phone'];?></span>
								<? if($feedback['name'] != '') { ?><span class="color-gray">- <?=$feedback['name'];?></span><? } ?>
								<span class="color-gray">- <?=$feedback['title'];?></span>
							</div>
						</a>
					</li>
				<? } ?>
				</ul>
			<? } ?>
			</div>
			<div class="card-bottom">
				<div class="card-links">
					<a href="<?=base_url('admin/feedback');?>">Перейти ко всем сообщениям</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-head">
				<div class="card-title">
					<?=fa5r('comments color-gray-lite mr5');?> Последние отзывы
				</div>
			</div>
			<div class="card-body">
			<? if(empty($reviews)) { ?>
				<?=action_result('', 'Отзывов пока нет')?>
			<? } else { ?>
				<ul class="message-list">
				<? foreach($reviews as $review) { ?>
					<li>
						<a href="<?=base_url('admin/reviews/view/'.$review['id']);?>" class="message-item">
							<div class="icon bg-info"><?=fa5r('comments color-white');?></div>
							<div class="date">
								<div><?=date('d.m.Y', strtotime($review['add_date']));?></div>
								<div><?=date('H:i:s', strtotime($review['add_date']));?></div>
							</div>
							<div class="text">
								<span class="bold"><?=$review['name'];?></span>
								<? if($review['phone'] != '') { ?><span class="color-gray">- <?=$review['phone'];?></span><? } ?>
							</div>
						</a>
					</li>
				<? } ?>
				</ul>
			<? } ?>
			</div>
			<div class="card-bottom">
				<div class="card-links">
					<a href="<?=base_url('admin/reviews');?>">Перейти ко всем отзывам</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-head">
				<div class="card-title">
					<?=fa5s('bullhorn color-gray-lite mr5');?> Последние новости
				</div>
			</div>
			<div class="card-body">
			<? if(empty($news)) { ?>
				<?=action_result('', 'Новостей пока нет')?>
			<? } else { ?>
				<ul class="publication-list">
				<? foreach($news as $new) { ?>
					<li>
						<div class="publication-item">
							<div class="img">
								<?=check_img('assets/uploads/news/thumb/'.$new['img']);?>
								<div class="actions">
									<a href="<?=base_url('admin/news/edit/'.$new['id']);?>" title="Редактирование">
										<?=fa5s('pen');?>
									</a>
									<a href="<?=base_url('admin/news/view/'.$new['id']);?>" title="Просмотр">
										<?=fa5s('eye');?>
									</a>
								</div>
							</div>
							<div class="descr">
								<div class="title">
									<a href="<?=base_url('news/'.$new['alias']);?>" class="title" target="_blank" title="Открыть на сайте"><?=$new['title'];?></a>
									<?=fa5s('external-link-alt color-info ml5');?>
								</div>
								<div class="date"><?=fa5r('calendar-alt') . ' ' . translate_date($new['pub_date']) . ' ' . date('H:i', strtotime($new['pub_date']));?></div>
								<div class="brief"><?=$new['brief'];?></div>
							</div>
						</div>
					</li>
				<? } ?>	
				</ul>
			<? } ?>
			</div>
			<div class="card-bottom">
				<div class="card-links">
					<a href="<?=base_url('admin/news');?>">Все статьи</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-head">
				<div class="card-title">
					<?=fa5r('file-alt color-gray-lite mr5');?> Последние статьи
				</div>
			</div>
			<div class="card-body">
			<? if(empty($articles)) { ?>
				<?=action_result('', 'Статей пока нет')?>
			<? } else { ?>
				<ul class="publication-list">
				<? foreach($articles as $new) { ?>
					<li>
						<div class="publication-item">
							<div class="img">
								<?=check_img('assets/uploads/articles/thumb/'.$new['img']);?>
								<div class="actions">
									<a href="<?=base_url('admin/articles/edit/'.$new['id']);?>" title="Редактирование">
										<?=fa5s('pen');?>
									</a>
									<a href="<?=base_url('admin/articles/view/'.$new['id']);?>" title="Просмотр">
										<?=fa5s('eye');?>
									</a>
								</div>
							</div>
							<div class="descr">
								<div class="title">
									<a href="<?=base_url('articles/'.$new['alias']);?>" class="title" target="_blank" title="Открыть на сайте"><?=$new['title'];?></a>
									<?=fa5s('external-link-alt color-info ml5');?>
								</div>
								<div class="date"><?=fa5r('calendar-alt') . ' ' . translate_date($new['pub_date']) . ' ' . date('H:i', strtotime($new['pub_date']));?></div>
								<div class="brief"><?=$new['brief'];?></div>
							</div>
						</div>
					</li>
				<? } ?>	
				</ul>
			<? } ?>
			</div>
			<div class="card-bottom">
				<div class="card-links">
					<a href="<?=base_url('admin/articles');?>">Все статьи</a>
				</div>
			</div>
		</div>
	</div>
</div>
