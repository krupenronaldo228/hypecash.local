<!DOCTYPE html>
<html lang="ru">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<title><?=$page['title'];?></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	
	<?=link_tag(PATH_ADMIN.'/css/app.css'.$version);?>
	
	<?=link_tag(PATH_PLUGINS.'/font-awesome/css/all.min.css'.$version);?>
	<?=link_tag(PATH_PLUGINS.'/font-montserrat/font.css'.$version);?>
	<?=link_tag(PATH_PLUGINS.'/bootstrap/css/bootstrap-grid.css');?>
	<? foreach($styles as $css) { ?><?=link_tag($css.$version);?><? } ?>
	
	<?=link_tag('favicon.ico', 'shortcut icon', 'image/ico');?>
	<?=link_tag('favicon.ico', 'shortcut', 'image/ico');?>

	<script>
		const base_url = "<?=base_url()?>",
			csrf_test_name = "<?=$csrf;?>";
	</script>

	<?=script(PATH_PLUGINS.'/jquery/jquery-3.5.0.min.js');?>
	<?=script(PATH_PLUGINS.'/bootstrap/plugins/modals.js');?>
	<?=script(PATH_PLUGINS.'/bootstrap/plugins/tooltips.js');?>
	<?=script(PATH_PLUGINS.'/jquery.formstyler/jquery.formstyler.js');?>
	<?=script(PATH_ADMIN.'/js/template.js'.$version);?>
	<?=script(PATH_ADMIN.'/js/common.js'.$version);?>
	<?=script(PATH_ADMIN.'/js/content.js'.$version);?>
	<? foreach($scripts as $script) { ?><?=script($script.$version);?><? } ?>

</head>
<body>

<div class="container">
	<div class="sidenav">
		<div class="sidenav-header">
			<a href="<?=base_url('admin')?>" class="logo">
				<div class="img"></div>
				<div class="title">
					V-IX.CMS
					<span>ver. <?=$cms['version'];?></span>
				</div>
			</a>
		</div>
		<div class="sidenav-title">
			<div class="title" title="<?=htmlspecialchars($siteinfo['title']);?>"><?=$siteinfo['title'];?></div>
			<div class="descr">admin-panel</div>
		</div>
		<div class="sidenav-menu">
			<ul class="sidenav-menu-parents">
			<? foreach($navigation as $navparent) { ?>
				<? $_haschild = !empty($navparent['items']) ? true : false;?>
				<li>
					<a href="<?=!empty($navparent['link']) ? base_url('admin/'.$navparent['link']) : 'javascript:void(0)';?>" class="sidenav-menu-parent" <?=$navparent['alias'] == 'files' ? 'target="_blank"' : null;?>>
						<span class="icon">
							<i class="fa5 <?=$navparent['icon'];?> fa-fw"></i>
						</span>
						<span class="title">
							<?=$navparent['name'];?>
							<? if($_haschild) { ?>
							<span class="toggle"><?=fa5s('angle-right');?></span>
							<? } ?>
						</span>
					</a>
					<? if($_haschild) { ?>
					<ul class="sidenav-menu-childs">
					<? foreach($navparent['items'] as $navchild) { ?>
						<li>
							<a href="<?=!empty($navchild['link']) ? base_url('admin/'.$navchild['link']) : 'javascript:void(0)';?>" class="sidenav-menu-child <?=uri(2) == $navchild['alias'] ? 'current' : null;?>">
								<?=$navchild['name'];?>
							</a>
							<? if(!empty($admin_bells[$navchild['alias']]['count']) and $admin_bells[$navchild['alias']]['count'] != 0) { ?>
							<span class="sidenav-menu-count label-<?=$admin_bells[$navchild['alias']]['color'];?>">
								<?=$admin_bells[$navchild['alias']]['count'] < 100 ? $admin_bells[$navchild['alias']]['count'] : '99+';?>
							</span>
							<? } ?>
							<? if($navchild['create_btn'] == 1) { ?>
							<a href="<?=base_url('admin/'.$navchild['link'].'/create');?>" class="sidenav-menu-create">
								<?=fa5s('plus');?>
							</a>
							<? }?>
						</li>
					<? } ?>
					</ul>
					<? } ?>
				</li>
			<? } ?>
			</ul>
		</div>
		<div class="sidenav-footer">
			2014-<?=date('Y');?> &copy; Powered by <a href="https://project-max.ru" target="_blank">ProjectMax</a>
		</div>
	</div>
	
	<div class="content">
	
		<header class="header">
			<div class="header-left">
				<div class="header-mobile">
					<a href="javascript:void(0)" class="header-link" data-toggle="nav">
						<?=fa5s('bars');?>
					</a>
				</div>
			</div>
			<div class="header-right">
				<ul class="header-links">
					<li>
						<a href="<?=base_url();?>" class="header-link" target="_blank">
							<?=fa5s('home');?>
						</a>
					</li>
					<? foreach($admin_bells as $alias => $bell) { ?>
						<? if($bell['header']) { ?>
						<li>
							<a href="<?=base_url('admin/'.$alias);?>" class="header-link">
								<?=$bell['icon'];?>
								<? if($bell['count'] != 0) { ?>
								<span class="count"><?=$bell['count'] < 100 ? $bell['count'] : '99+';?></span>
								<? } ?>
							</a>
						</li>
						<? } ?>
					<? } ?>
					<li>
						<div class="header-userbar">
							<a href="javascript:void(0)" class="header-userbar-info">
								<div class="img">
									<?=fa5r('user-circle');?>
								</div>
								<div class="title">
									<span><?=$userinfo['login'];?></span>
									<?=fa5s('angle-down');?>
								</div>
							</a>
							<ul class="header-userbar-menu">
								<li>
									<div class="info">
										<div class="title"><?=$userinfo['name'];?></div>
										<div class="email" title="<?=$userinfo['email'];?>"><?=$userinfo['email'];?></div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?=base_url('admin/users/edit/'.$userid);?>">
										<?=fa5s('user-edit fa-fw');?>
										<span>Профиль</span>
									</a>
								</li>
								<li>
									<a href="<?=base_url('admin/users/password');?>">
										<?=fa5s('user-lock fa-fw');?>
										<span>Пароль</span>
									</a>
								</li>
								<li>
									<a href="<?=base_url('admin/settings');?>">
										<?=fa5s('cog fa-fw');?>
										<span>Настройки</span>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?=base_url('admin/settings');?>">
										<?=fa5s('sign-out-alt fa-fw');?>
										<span>Выйти</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<?/*<li>
						<a href="<?=base_url('admin/login/logout');?>" class="header-link">
							<?=fa5s('sign-out-alt');?>
						</a>
					</li>*/?>
				</ul>
			</div>
		</header>
		
		<div class="page-container">
			<div class="page-top">
				<?=$this->breadcrumbs->create_admin_links(); ?>
				<h1 class="page-title"><?=$page['title'];?></h1>
			</div>
			<? if($pagecontent) { ?>
				<div class="page-content">
					<? $this->load->view('admin/common/warning');?>
					<? $this->load->view('admin/'.$view);?>
				</div>
			<? } else { ?>
				<? $this->load->view('admin/common/warning');?>
				<? $this->load->view('admin/'.$view);?>
			<? } ?>
		</div>
		
	</div>
</div>

<? # SOME EXTRA HTML ?>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteEntryModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Удаление записи</div>
				<a href="javascript:void(0)" class="modal-close" data-dismiss="modal" aria-label="Close"><?=fa5s('times');?></a>
			</div>
			<?=form_open('', ['id' => 'deleteEntryForm']);?>
				<div class="modal-body">
					<p>Вы уверены что хотите удалить запись <strong id="deleteEntryTitle"></strong>?</p>
				</div>
				<div class="modal-footer">
					<div class="modal-actions">
						<button class="btn btn-error"><?=fa5s('times mr5')?> Удалить</button>
						<a href="javascript:void(0)" class="btn" data-dismiss="modal">Отмена</a>
						<input type="hidden" name="delete" value="delete" />
					</div>
				</div>
			<?=form_close();?>
		</div>
	</div>
</div>



</body>
</html>
