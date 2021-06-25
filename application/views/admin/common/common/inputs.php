<div class="h3 semibold mb20">Стандартные поля ввода</div>

<div class="mb30">
	<div class="form-group">
		<input type="text" name="" class="form-input" placeholder="Введите текст" />
	</div>
	<div class="form-group">
		<input type="text" name="" readonly class="form-input" value="Readonly attribute" />
	</div>
	<div class="form-group">
		<input type="text" name="" disabled class="form-input" value="Disabled attribute" />
	</div>
	<div class="form-group">
		<textarea name="" class="form-input" rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</textarea>
	</div>
</div>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Выпадающие списки</div>

<div class="mb30">
	<div class="form-group">
		<select name="" class="form-input">
			<option value="0" disabled selected>Default Select</option>
			<option value="1">Apple</option>
			<option value="2">Orange</option>
			<option value="3">Banana</option>
		</select>
	</div>
	<div class="form-group">
		<select name="" class="form-input">
			<option value="0" disabled selected>Group Select</option>
			<optgroup label="Fruits">
				<option value="1">Apple</option>
				<option value="2">Orange</option>
				<option value="3">Banana</option>
			</optgroup>
			<optgroup label="Vegetables">
				<option value="4">Potato</option>
				<option value="5">Carrot</option>
				<option value="6">Pepper</option>
			</optgroup>
		</select>
	</div>
	<div class="form-group">
		<select name="" multiple class="form-input" size="4">
			<option value="0" disabled>Multiple Select</option>
			<option value="1">Apple</option>
			<option value="2">Orange</option>
			<option value="3">Banana</option>
			<option value="4">Potato</option>
			<option value="5">Carrot</option>
			<option value="6">Pepper</option>
		</select>
	</div>
</div>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Стилизированный список</div>

<div class="mb30">
	<div class="form-group">
		<select name="" class="form-input form-select">
			<option value="0" disabled selected>Custom Default Select</option>
			<option value="1">Apple</option>
			<option value="2">Orange</option>
			<option value="3">Banana</option>
		</select>
	</div>
	<div class="form-group">
		<select name="" class="form-input form-select">
			<option value="0" disabled selected>Custom Group Select</option>
			<optgroup label="Fruits">
				<option value="1">Apple</option>
				<option value="2">Orange</option>
				<option value="3">Banana</option>
			</optgroup>
			<optgroup label="Vegetables">
				<option value="4">Potato</option>
				<option value="5">Carrot</option>
				<option value="6">Pepper</option>
			</optgroup>
		</select>
	</div>
</div>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Файл</div>

<div class="mb30">
	<input type="file" name="file" data-toggle="formfile" />
</div>

<hr class="mt30 mb30" />

<div class="h3 semibold mb20">Input groups</div>

<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-input" />
		<span class="input-group-append">
			<span class="input-group-text">
				<?=fa5s('dollar-sign fa-fw');?>
			</span>
		</span>
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-input" />
		<span class="input-group-append">
			<span class="input-group-text">
				.00
			</span>
			<span class="input-group-text">
				<?=fa5s('dollar-sign fa-fw');?>
			</span>
		</span>
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<span class="input-group-prepend">
			<span class="input-group-text">
				<?=fa5s('user fa-fw');?>
			</span>
		</span>
		<input type="text" class="form-input" />
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<span class="input-group-prepend">
			<span class="input-group-text">
				<?=fa5s('phone fa-fw');?>
			</span>
			<span class="input-group-text">
				+375
			</span>
		</span>
		<input type="text" class="form-input" />
	</div>
</div>