<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>

	<title>Восстановление пароля - <?=strip_tags($settings['title']);?> AdminPanel</title>
	
	<title>Авторизация - <?=strip_tags($settings['title']);?> AdminPanel</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	
	<?=link_tag(PATH_ADMIN.'/css/app.css'.$version);?>
	
	<?=link_tag(PATH_PLUGINS.'/font-awesome/css/all.min.css'.$version);?>
	<?=link_tag(PATH_PLUGINS.'/font-montserrat/font.css'.$version);?>
	
	<?=link_tag('favicon.ico', 'shortcut icon', 'image/ico');?>
	<?=link_tag('favicon.ico', 'shortcut', 'image/ico');?>

</head>
<body class="login">
	<div class="login-bg" id="login-bg"></div>
	<div class="login-content">
		<div class="login-title">Восстановление пароля</div>
		<?=form_open('', ['class' => 'login-form']);?>
		
			<?=$error ? $error : null;?>
		
			<div class="form-group">
				<div class="form-caption">Логин:</div>
				<input type="text" name="login" class="form-input" value="<?=set_value('login');?>" />
				<?=form_error('login'); ?>
			</div>
		
			<div class="actions">
				<div class="actions-left">
					<button class="btn btn-lg btn-warning"><?=fa5s('unlock-alt mr5');?> Восстановить пароль</button>
				</div>
				<div class="actions-right">
					<?=anchor('/admin/login', fa5s('sign-in-alt color-success').'<span>Войти</span>', array('class' => 'actions-link'));?>
				</div>
			</div>
		<?=form_close();?>
	</div>
	<?=script(PATH_PLUGINS.'/particles/particles.min.js');?>
	<script>
		particlesJS('login-bg',
			
			{
				"particles": {
					"number": {
						"value": 80,
						"density": {
							"enable": true,
							"value_area": 800
						}
					},
					"color": {
						"value": "#ffffff"
					},
					"shape": {
						"type": "circle",
						"stroke": {
							"width": 0,
							"color": "#000000"
						},
						"polygon": {
							"nb_sides": 5
						},
						"image": {
							"src": "img/github.svg",
							"width": 100,
							"height": 100
						}
					},
					"opacity": {
						"value": 0.5,
						"random": false,
						"anim": {
							"enable": false,
							"speed": 1,
							"opacity_min": 0.1,
							"sync": false
						}
					},
					"size": {
						"value": 5,
						"random": true,
						"anim": {
							"enable": false,
							"speed": 40,
							"size_min": 0.1,
							"sync": false
						}
					},
					"line_linked": {
						"enable": true,
						"distance": 150,
						"color": "#ffffff",
						"opacity": 0.4,
						"width": 1
					},
					"move": {
						"enable": true,
						"speed": 6,
						"direction": "none",
						"random": false,
						"straight": false,
						"out_mode": "out",
						"attract": {
							"enable": false,
							"rotateX": 600,
							"rotateY": 1200
						}
					}
				},
				"interactivity": {
					"detect_on": "canvas",
					"events": {
						"onhover": {
							"enable": true,
							"mode": "repulse"
						},
						"onclick": {
							"enable": true,
							"mode": "push"
						},
						"resize": true
					},
					"modes": {
						"grab": {
							"distance": 400,
							"line_linked": {
								"opacity": 1
							}
						},
						"bubble": {
							"distance": 400,
							"size": 40,
							"duration": 2,
							"opacity": 8,
							"speed": 3
						},
						"repulse": {
							"distance": 200
						},
						"push": {
							"particles_nb": 4
						},
						"remove": {
							"particles_nb": 2
						}
					}
				},
				"retina_detect": true,
				"config_demo": {
					"hide_card": false,
					"background_color": "#b61924",
					"background_image": "",
					"background_position": "50% 50%",
					"background_repeat": "no-repeat",
					"background_size": "cover"
				}
			}
		
		);
	</script>
</body>
</html>