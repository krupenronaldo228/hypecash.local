<? if($flash) { ?>
	<div class="page-error"><?=$flash;?></div>
<? } ?>
<? if($error) { ?>
	<div class="page-error"><?=action_result('error', $error);?></div>
<? } ?>