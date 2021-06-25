<div style="border: 1px solid #d8d8d8;">
	<div style="padding: 20px; background: #f3f3f3; border-bottom: 2px solid #d8d8d8; text-align: left; font-family: Arial, sans-serif;">
		<span style="display: inline-block;">
			<img src="<?=base_url('assets/uploads/settings/'.$site['img']);?>" style="display: inline-block; vertical-align: middle; margin-right: 15px; height: 60px;" />
			<span style="display: inline-block; vertical-align: middle; ">
				<span style="font-size: 46px; font-weight: 700; line-height: 1;  display: block; "><?=$site['name']?></span>
				<span style="font-size: 16px; color: #808080;"><?=$site['descr'];?></span>
			</span>
		</span>
	</div>
	<div style="padding: 20px 20px 40px; font-size: 14px; line-height: 21px;">
		Отзывы<br/>
		<br/>
		<? if($name != "") { ?><strong>Имя:</strong> <?=$name;?><br/><? } ?>
		<? if($phone != "") { ?><strong>Телефон:</strong> <?=$phone;?><br/><? } ?>
		<? if($email != "") { ?><strong>E-mail:</strong> <?=$email;?><br/><? } ?>
		<strong>Текст отзыва:</strong> <?=$text;?><br/>
		<strong>Дата:</strong> <?=date('d.m.Y H:i');?><br/>
		<br/>
		Более подробная информацию Вы можете получить по ссылке<br/>
		<?=anchor('/admin/reviews/view/'.$idItem, '', array('style' => 'color: #017eff'));?>
	</div>
</div>