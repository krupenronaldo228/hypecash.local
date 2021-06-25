<? if(empty($items)) { ?>

    <?=action_result('info', 'У вас не создано еще ни одной записи. Вы можете '.anchor('admin/'.$this->page.'/create', 'создать запись.'));?>

<? } else { ?>

    <table class="table table-hover entries-table">
        <thead>
        <tr>
            <th></th>
            <th>Заголовок</th>
            <th></th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <? foreach($items as $item) { ?>
            <?=items_tree($item, 1, $this->page);?>
        <? } ?>
        </tbody>
    </table>

    <div class="form-actions mt20">
        <?=btn_link_create($this->page.'/create')?>
    </div>

<? } ?>

<? #var_dump($items);?>

<? function items_tree($item, $level = 1, $page) { ?>

    <? $not_empty = !empty($item['items']);?>

    <tr class="entries-tree-item <?=$not_empty ? 'not_empty' : null; ?>" data-entrie-parent="<?=$item['id_parent'];?>" data-entrie-id="<?=$item['id'];?>" style="<?=$item['id_parent'] != 0 ? 'display: none;' : null;?>" data-toggle="entries">
        <td class="entries-tree-toggles">
            <? if($not_empty) { ?>
                <div class="entries-tree-toggle color-warning">
                    <span class="entries-tree-toggle-close"><?=fa5s('folder fa-fw');?></span>
                    <span class="entries-tree-toggle-open"><?=fa5s('folder-open fa-fw');?></span>
                    <span class="entries-tree-toggle-counter"><?=count($item['items']);?></span>
                </div>
            <? } else { ?>
                <?=fa5r('folder color-gray-lite fa-fw');?>
            <? } ?>
        </td>
        <td>
            <div style="padding-left: <?=$level * 15 - 15;?>px;">
                <div class="entries-title" data-entries="title"><?=$item['name'];?></div>
                <div class="entries-brief"></div>
            </div>
        </td>
        <td class="entries-td-icons entries-td-hide-xs text-right">
            <?=seo_checker($item);?>
            <? if($item['home'] == 1) { ?>
                <span class="color-gray-lite" title="Отображать на главной" data-toggle="tooltip"><?=fa5s('home fa-fw');?></span>
            <? } ?>
            <? if($item['visibility'] == 0) { ?>
                <span class="color-error" title="Не отображать на сайте" data-toggle="tooltip"><?=fa5s('eye-slash fa-fw');?></span>
            <? } elseif($item['display'] == 0) { ?>
                <span class="color-gray-lite" title="Скрыто родительской категорией" data-toggle="tooltip"><?=fa5r('eye fa-fw');?></span>
            <? } else { ?>
                <span class="color-success" title="Отображать на сайте" data-toggle="tooltip"><?=fa5r('eye fa-fw');?></span>
            <? } ?>
        </td>
        <td class="entries-td-actions w200">
            <?=btn_icon_view($page.'/view/'.$item['id']);?>
            <?#=anchor('admin/'.$page.'/fields/'.$item['id'], fa5s('sliders-h'), ['class' => 'btn btn-icon btn-sm btn-warning'])?>
            <?=btn_icon_edit($page.'/edit/'.$item['id']);?>
            <?=btn_icon_delete($page.'/delete/'.$item['id']);?>
        </td>
    </tr>
    <? if($not_empty) { ?>
        <? foreach($item['items'] as $child) { ?>
            <?=items_tree($child, $level+1, $page);?>
        <? } ?>
    <? } ?>

<? } ?>
