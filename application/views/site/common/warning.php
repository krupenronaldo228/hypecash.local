<? if($this->session->flashdata('site')) { ?>
	<div class="page-error"><?=$this->session->flashdata('site');?></div>
<? } ?>
<? if($error) { ?>
	<div class="page-error"><?=$error;?></div>
<? } ?>