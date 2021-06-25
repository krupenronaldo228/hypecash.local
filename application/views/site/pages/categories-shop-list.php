<div class="page-content">
    <div class="container">
        <div class="page-top">
            <?=$this->breadcrumbs->create_links();?>
            <!--<h1 class="page-title"><?/*=$item['name'];*/?></h1>-->
        </div>

        <!--<ul class="category-parents">
            <li>
                <a href="<?/*=base_url($this->page)*/?>" class="current">Все товары</a>
            </li>
            <?/* foreach($categories as $categorys) { */?>
                <li>
                    <div class="cat-name"><a href="<?/*=base_url($this->page.'/'.$categorys['alias']);*/?>"><?/*=$categorys['name'];*/?></a></div>
                </li>
            <?/* } */?>
        </ul>-->


        <table class="table table-hover entries-table">
            <tbody>
            <? foreach($nav as $categorys) { ?>
                <tr data-entries="item">
                    <td class="entries-table-mobile">
                        <div class="entries-title" data-entries="title"><a href="<?=base_url($this->page.'/'.$categorys['alias']);?>"><?=$categorys['name'];?></a></div>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>


        <ul class="news-list">
            <? foreach($products as $catalog) { ?>
                <li>
                    <a href="<?=base_url($this->page.'/'.$categorys['alias'].'/'.$catalog['alias']);?>" class="news-item">
                        <div class="image">
                            <?=check_img(PATH_UPLOADS.'/'.$this->page.'/thumb/'.$catalog['img'], ['alt' => $catalog['img_alt']]);?>
                        </div>
                        <div class="description">
                            <div class="date">
                                <?=fa5r('calendar-alt');?>
                                <?=translate_date($catalog['pub_date']);?>
                            </div>
                            <div class="title"><?=$catalog['title'];?></div>
                            <div class="text"><?=$catalog['brief'];?></div>
                            <div class="text"><?=$catalog['price'];?></div>
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
