<thead>
    <tr class="list-header">
        <th class="">Title</th>
        <th class=""></th>
    </tr>
</thead>
<?php foreach ($items as $key => $item): ?>
<tr class="list-row" data-item-id="<?= $item->id ?>">    
    <td class="text-center wide"><?= $item->title ?></td>
    <? $view->renderTemplate('partials/form-actions',[ 'model_name' => $model_name,  'item' => $item ]) ?>                  
</tr> 
<?php endforeach ?>