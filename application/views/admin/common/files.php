<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<title><?=$page['title'];?></title>
		
		<script data-main="<?=base_url(PATH_PLUGINS.'/elfinder/main.js');?>" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.5/require.min.js"></script>
		<script>
			define('elFinderConfig', {
				// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
				defaultOpts : {
					url : '<?=base_url('admin/files/elfinder_init');?>',
					commandsOptions : {
						edit : {
							extraOptions : {
								creativeCloudApiKey : '',
								managerUrl : ''
							}
						},
						quicklook : {
							sharecadMimes : [
								'image/vnd.dwg', 'image/vnd.dxf', 'model/vnd.dwf', 'application/vnd.hp-hpgl', 'application/plt', 'application/step', 'model/iges', 'application/vnd.ms-pki.stl', 'application/sat', 'image/cgm', 'application/x-msmetafile'
							],
							googleDocsMimes : [
								'application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/postscript', 'application/rtf'
							],
							officeOnlineMimes : [
								'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation'
							]
						}
					},
					bootCallback : function(fm, extraObj) {
						fm.bind('init', function() {
						
						});
						var title = document.title;
						fm.bind('open', function() {
							var path = '',
								cwd  = fm.cwd();
							if (cwd) {
								path = fm.path(cwd.hash) || null;
							}
							document.title = path? title + ' : ' + path : title;
						}).bind('destroy', function() {
							document.title = title;
						});
					},
					cssAutoLoad : false,
					resizable: false,
				},
				managers : {
					'elfinder': {}
				}
			});
		</script>
	</head>
	<body>
		<div id="elfinder"></div>
		
		<link rel="stylesheet" href="/assets/plugins/elfinder/css/elfinder.min.css" type="text/css">
		<link href="/assets/plugins/elfinder/themes/css/theme-vix.css" rel="stylesheet" type="text/css" />

	</body>
</html>
