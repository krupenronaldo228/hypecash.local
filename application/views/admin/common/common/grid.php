<div class="h3 semibold mb20">Стандартная сетка</div>

<? for($i = 1; $i < 13; $i++) { ?>
<div class="row form-group">
	<div class="col-<?=$i;?>">
		<div class="bsgridsquare">col-<?=$i;?></div>
	</div>
</div>
<? } ?>

<hr class="mt30 mb30" />


<style>
.bsgridsquare {
	display: flex;
	align-items: center;
	justify-content: center;
	height: 50px;
	background: #f3f3f3;
}
</style>