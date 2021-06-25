<table cellspacing="0" border="0" cellpadding="0" width="100%">
	<tr>
		<td>
			<p style="font-size: 14px; line-height: 24px; margin: 0;">
				Обратная связь: <strong><?=$title;?></strong>
			</p>
		</td>
	</tr>
	<tr height="20px" style="height: 20px;">
		<td></td>
	</tr>
	<tr>
		<td style="font-size: 14px; line-height: 24px;">
			<p style="margin: 0;">
				<strong>Имя:</strong> <?=!empty($name) ? $name : '<span style="color: #7d7d7d">не указано</span>';?>
			</p>
			<p style="margin: 0;">
				<strong>Телефон:</strong> <?=!empty($phone) ? $phone : '<span style="color: #7d7d7d">не указано</span>';?>
			</p>
			<p style="margin: 0;">
				<strong>E-mail:</strong> <?=!empty($email) ? $email : '<span style="color: #7d7d7d">не указано</span>';?>
			</p>
			<p style="margin: 0;">
				<strong>Комментарий:</strong> <?=!empty($text) ? nl2br($text) : '<span style="color: #7d7d7d">не указано</span>';?>
			</p>
			<p style="margin: 0;">
				<strong>Дата:</strong> <?=date('d.m.Y H:i');?>
			</p>
		</td>
	</tr>
	<tr height="20px" style="height: 20px;">
		<td></td>
	</tr>
	<tr>
		<td style="font-size: 14px; line-height: 24px;">
			Более подробная информацию Вы можете получить по ссылке<br/>
			<?=anchor('/admin/feedback/view/'.$id, '', ['style' => 'color: '.$tpl['color']]);?>
		</td>
	</tr>
</table>