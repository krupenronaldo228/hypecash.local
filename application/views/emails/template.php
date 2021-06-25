<table cellspacing="0" border="0" cellpadding="0" width="100%" style="margin: 0px; background-color: #eee; font-family: Arial, sans-serif; color: #333;">
	<tr height="30px;" style="height: 30px;">
		<td></td>
	</tr>
	<tr valign="top">
		<td valign="top">
			<table cellspacing="0" cellpadding="0" border="0" align="center" width="626" style="border: 1px solid #e5e5e5; background: #fff; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
				<tr valign="middle" bgcolor="<?=$tpl['color'];?>" height="100px;" style="height: 100px;">
					<td align="center" style="color: #FFFFFF; border-bottom: 2px solid rgba(0, 0, 0, 0.1); text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.4);" colspan="3">
						<h1 style="font-size: 24px; font-weight: 700; line-height: 25px; margin: 0; text-transform: uppercase;"><?=$site['title'];?></h1>
						<p style="font-size: 12px; line-height: 15px; margin: 10px 0 0;"><?=$site['description'];?></p>
					</td>
				</tr>
				<tr height="30px" style="height: 30px;">
					<td colspan="3"></td>
				</tr>
				<tr>
					<td width="30px" style="width: 30px;"></td>
					<td>
						<? $this->load->view('emails/'.$view); ?>
					</td>
					<td width="30px" style="width: 30px;"></td>
				</tr>
				<tr height="40px" style="height: 40px;">
					<td colspan="3"></td>
				</tr>
				<tr valign="middle" bgcolor="#182125">
					<td width="30px" style="width: 30px;"></td>
					<td>
						<table cellspacing="0" border="0" cellpadding="0" width="100%">
							<tr height="10px" style="height: 10px;">
								<td></td>
							</tr>
							<tr>
								<td align="center">
									<p style="margin: 0; font-size: 11px; line-height: 18px; color: #999;">
										Вы получили это письмо потому, что этот e-mail был указан на сайте <?=anchor('', $site['title'], ['style' => 'color: #999;']);?>.<br/>
										Если Вы получили это письмо по ошибке, проигнорируйте его.
									</p>
								</td>
							</tr>
							<tr height="10px" style="height: 10px;">
								<td></td>
							</tr>
						</table>
					</td>
					<td width="30px" style="width: 30px;"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr height="30px;" style="height: 30px;">
		<td></td>
	</tr>
</table>
