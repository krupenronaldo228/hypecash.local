<div class="note note-info">
	Документация по методам и событиям <a href="https://bootstrap-datepicker.readthedocs.io/en/stable/index.html" target="_blank">на официальном сайте</a>.
</div>

<div class="h3 semibold mb20">Стандартный календарь</div>

<div data-toggle="datepicker-inline"></div>

<script>
	$('[data-toggle="datepicker-inline"]').datepicker();
</script>


<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Календарь для поля ввода</div>

<div class="form-group">
	<input type="text" class="form-input" data-toggle="datepicker-input" readonly>
</div>

<script>
	$('[data-toggle="datepicker-input"]').datepicker();
</script>

<div class="form-group">
	<div class="input-group date" data-toggle="datepicker-group">
		<input type="text" class="form-input" readonly>
		<span class="input-group-append datepicker-btn">
			<span class="input-group-text">
				<?=fa5r('calendar-alt fa-fw');?>
			</span>
		</span>
	</div>
</div>

<script>
	$('[data-toggle="datepicker-group"]').datepicker();
</script>