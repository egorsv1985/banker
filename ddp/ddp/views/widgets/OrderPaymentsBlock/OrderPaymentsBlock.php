<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="OrderPaymentsBlock.php">
 * </description>
 * Виджет отображает платежи по заказу
 * var $dataProvider = CActiveDataProvider#1
 * (
 * [modelClass] => 'OrdersPayments'
 * )
 * var $blockId = 'order-payments-1916'
 **********************************************************************************************************************/
?>
<? /*
<div class="panel-group" id="accordion-comments-<?= $blockId ?>" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading closed" data-parent="#accordion-comments-<?= $blockId ?>"
             data-target="#heading-accordion-comments-<?= $blockId ?>" data-toggle="collapse">
            <h4 class="panel-title">
                <a <?= ($dataProvider->totalItemCount <= 0) ? ' class="collapsed" ' : ' '; ?> href="#commentsCollapseOne">
                        <?= Yii::t('main', 'Комментарии') ?>
                    <? if ($dataProvider->totalItemCount > 0) {?>
                        : <?= $dataProvider->totalItemCount;?>
                    <? } ?>
                        <!--<span class="op-number" style="float: right;"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>-->

                </a>
            </h4>
        </div>
        <div id="heading-accordion-comments-<?= $blockId ?>"
             class="panel-collapse collapse <?//= ($dataProvider->totalItemCount <= 0) ? '' : ' in'; ?>"
             aria-labelledby="heading-accordion-comments-<?= $blockId ?>">
            <div class="panel-body">
                <div class="comment-block">
*/ ?>
<div class="panel-group" id="accordion-payments-<?= $blockId ?>" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading closed" data-parent="#accordion-payments-<?= $blockId ?>"
         data-target="#heading-accordion-payments-<?= $blockId ?>" data-toggle="collapse">
      <h4 class="panel-title">
        <span class="fa fa-arrow-right"></span>
        <a <?= ($dataProvider->totalItemCount <= 0) ? ' class="collapsed" ' : ' '; ?> href="#paymentsCollapseOne">
            <?= Yii::t('main', 'Платежи по заказу') ?>
            <? if ($dataProvider->totalItemCount > 0) { ?>
              : <?= $dataProvider->totalItemCount; ?>
            <? } ?>
        </a>
      </h4>
    </div>
    <div id="heading-accordion-payments-<?= $blockId ?>"
         class="panel-collapse collapse <? //= ($dataProvider->totalItemCount <= 0) ? '' : ' in'; ?>"
         aria-labelledby="heading-accordion-payments-<?= $blockId ?>">
      <div class="panel-body closed">
          <? $this->widget(
            'booster.widgets.TbGridView',
            [
              'id'           => 'grid-payments-' . $blockId,
              'dataProvider' => $dataProvider,
              'type'         => 'striped bordered condensed',
              'template'     => '{items}{pager}', //{summary}{pager}
              'columns'      => [
                [
                  'name'        => 'fromName',
                  'htmlOptions' => ['style' => 'width:50px;font-size:0.9em;'],
                ],
                [
                  'name' => 'summ',
                ],
                [
                  'name'        => 'date',
                  'htmlOptions' => ['style' => 'width:45px;font-size:0.9em;'],
                ],
                [
                  'name'  => 'descr',
                  'type'  => 'raw',
                  'value' => function ($data) {
                      return Yii::t('main', $data->descr);
                  },
                ],
              ],
            ]
          );
          ?>
      </div>
    </div>
  </div>
</div>