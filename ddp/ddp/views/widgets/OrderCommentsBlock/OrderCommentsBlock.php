<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="OrderCommentsBlock.php">
 * </description>
 * Виджет отображает комментарии заказа, например при просмотре заказа вкабинете
 * var $dataProvider =
 * CActiveDataProvider#1
 * ([modelClass] => 'OrdersComments'
 * [model] => OrdersComments#2
 * (
 * [attaches] => null
 * [fromName] => null
 * )
 * var $blockId = 'order-comments-1916'
 * var $isItem = false - комментарий не к заказу а к лоту?
 * var $parentId = '1916' -id заказа\лота, к которому принадлежит комментарий
 * var $public = true - виджет используется во фронте и не отображаются внутренние комментарии
 **********************************************************************************************************************/
?>

<div class="panel-group" id="accordion-comments-<?= $blockId ?>" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading closed" data-parent="#accordion-comments-<?= $blockId ?>"
         data-target="#heading-accordion-comments-<?= $blockId ?>" data-toggle="collapse">
      <h4 class="panel-title">
        <span class="fa fa-arrow-right"></span>
        <a <?= ($dataProvider->totalItemCount <= 0) ? ' class="collapsed" ' : ' '; ?> href="#commentsCollapseOne1">

            <?= Yii::t('main', 'Комментарии') ?>
            <? if ($dataProvider->totalItemCount > 0) { ?>
              : <?= $dataProvider->totalItemCount; ?>
            <? } ?>
          <!--<span class="op-number" style="float: right;"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>-->

        </a>
      </h4>
    </div>
    <div id="heading-accordion-comments-<?= $blockId ?>"
         class="panel-collapse collapse <? //= ($dataProvider->totalItemCount <= 0) ? '' : ' in'; ?>"
         aria-labelledby="heading-accordion-comments-<?= $blockId ?>">
      <div class="panel-body">
        <div class="comment-block">
            <?
            $this->widget(
              'booster.widgets.TbGridView',
              [
                'id'           => 'grid-comments-' . $blockId,
                'dataProvider' => $dataProvider,
                'type'         => 'striped bordered condensed',
                'template'     => '{items}{pager}', //{summary}{pager}
                'columns'      => [
                  [
                    'name'        => 'fromName',
                    'type'        => 'raw',
                    'htmlOptions' => ['style' => 'width:15%;font-size:0.9em;color:#00BCFF;'],
                    'value'       => function ($data) {
                        return (($data->internal) ? '<i class="icon-lock"></i>' : '') .
                          '<span>' .
                          $data->fromName .
                          '</span>';
                    },

                  ],
                  [
                    'name'        => 'date',
                    'htmlOptions' => ['style' => 'width:15%;font-size:0.9em;'],
                  ],
                  [
                    'name'        => 'message',
                    'type'        => 'raw',
                    'htmlOptions' => ['style' => 'width:70%;'],
                    'value'       => function ($data) {
                        return Yii::app()->controller->widget(
                          "application.components.widgets.OrderCommentsViewBlock",
                          [
                            "message"     => $data->message,
                            "itemId"      => $data->id,
                            "isItem"      => isset($data->item_id),
                            "pageSize"    => 5,
                            "imageFormat" => "_200x200.jpg",
                          ],
                          true
                        );
                    },
                  ],
                ],
              ]
            );
            ?>

            <?php $this->widget(
              'booster.widgets.TbButton',
              [
                'label'       => Yii::t('admin', 'Добавить комментарий'),
                'context'     => 'primary',
                'htmlOptions' => [
                  'data-toggle' => 'modal',
                  'data-target' => '#new-message-' . $blockId,
                  'class'       => 'pull-right',
                ],
              ]
            );
            ?>
        </div>
          <? // Modal ?>
          <?php $this->beginWidget(
            'booster.widgets.TbModal',
            ['id' => 'new-message-' . $blockId]
          ); ?>

        <div class="modal-header">
          <a class="close" data-dismiss="modal">&times;</a>
          <h4><?= Yii::t('main', 'Новое сообщение') ?></h4>
        </div>

        <div class="modal-body">
          <form id="new-message-form-<?= $blockId ?>">
              <? if ($isItem) { ?>
                <label><b><?= Yii::t('main', 'Комментарий к лоту') ?>:</b></label><br/>
                  <?
              } else {
                  ?>
                <label><b><?= Yii::t('main', 'Комментарий к заказу') ?>:</b></label><br/>
              <? } ?>
            <input type="hidden" name="message[isItem]" value="<?= (int) $isItem ?>"/>
            <input type="hidden" name="message[parentId]" value="<?= $parentId ?>"/>
            <textarea cols="60" rows="3" name="message[message]" id="message-<?= $blockId ?>"></textarea>
              <? if ($public) { ?>
                <input type="hidden" name="message[public]" value="1"/>
                  <?
              } else {
                  ?>
                <br><input type="checkbox" name="message[public]" value="1"/><?=
                  Yii::t(
                    'main',
                    'Виден заказчику'
                  ) ?>
              <? } ?>
          </form>
        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-primary pull-right"
                  onclick="
                      $('#new-message-<?= $blockId ?>').modal('hide');
                      var msg = $('#new-message-form-<?= $blockId ?>').serialize();
                      $.post('<?= Yii::app()->createUrl('/') ?>message/create',msg, function(){
                      $('#message-<?= $blockId ?>').val('');
                      $.fn.yiiGridView.update('grid-comments-<?= $blockId ?>');
                      },'text');
                      return false;
                      "><?= Yii::t('admin', 'Сохранить') ?></button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"
                  onclick="$('#message-<?= $blockId ?>').val('');
                      return false;"><?= Yii::t('admin', 'Отмена') ?></button>

        </div>
          <?php $this->endWidget(); ?>
          <? //==============================================================================?>
      </div>
    </div>
  </div>
</div>