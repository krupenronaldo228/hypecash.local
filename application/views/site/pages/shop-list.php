<div class="page-content">
	<div class="container">
		<div class="page-top">
			<?=$this->breadcrumbs->create_links();?>
			<h1 class="page-title"><?=$pageinfo['title'];?></h1>
			<? if($pageinfo['brief']) { ?><div class="page-brief"><?=$pageinfo['brief'];?></div><? } ?>
		</div>

      <!--  <ul class="category-parents">
            <li>
                <a href="<?/*=base_url($this->page)*/?>" class="current">Все товары</a>
            </li>
            --><?/* foreach($categories as $categorys) { */?>
                <!--<li>
                    <div class="cat-name"><a href="<?/*=base_url($this->page.'/'.$categorys['alias']);*/?>"><?/*=$categorys['name'];*/?></a></div>
                </li>-->
               <!-- <li class="entries-td-img entries-td-hide-xs">
                    <div class="img"><?/*=check_img(PATH_UPLOADS.'/'.$folder.'/thumb/'.$categorys['img'], ['class' => 'block w100']);*/?></div>
                </li>-->
              <!--  <li class="entries-table-mobile">
                    <div class="entries-title" data-entries="title"><a href="<?/*=base_url($this->page.'/'.$categorys['alias']);*/?>"><?/*=$categorys['title'];*/?></div>
                </li>

            <?/* } */?>
        </ul>-->


        <table class="table table-hover entries-table">
            <tbody>
            <? foreach($items as $categorys) { ?>
                <tr data-entries="item">
                    <td class="entries-table-mobile">
                        <div class="entries-title" data-entries="title"><a href="<?=base_url($this->page.'/'.$categorys['alias']);?>"><?=$categorys['name'];?></a></div>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>

		
		<ul class="news-list">
		<? foreach($products as  $blog_post) { ?>
			<li>
				<a href="<?=base_url($this->page.'/'.$categorys['alias'].'/'.$blog_post['alias']);?>" class="news-item">
					<div class="image">
						<?=check_img(PATH_UPLOADS.'/'.$this->page.'/thumb/'.$blog_post['img'], ['alt' => $blog_post['img_alt']]);?>
					</div>
					<div class="description">
						<div class="date">
							<?=fa5r('calendar-alt');?>
							<?=translate_date($blog_post['pub_date']);?>
						</div>
						<div class="title"><?=$blog_post['title'];?></div>
						<div class="text"><?=$blog_post['brief'];?></div>
                        <div class="text"><?=$blog_post['price'];?></div>
						<div class="action">
							<span class="link">Читать далее</span>
						</div>
					</div>
				</a>
			</li>
		<? } ?>
		</ul>
		
		<?=$this->pagination->create_links();?>

		<? if(strip_tags($pageinfo['text']) != '' && uri(2) == '') { ?>
		<div class="page-text">
			<div class="text-editor">
				<?=$pageinfo['text'];?>
			</div>
		</div>
		<? } ?>
	</div>
</div>
