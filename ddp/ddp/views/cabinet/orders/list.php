<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="list.php">
 * </description>
 * Рендеринг списка заказов в кабинете
 **********************************************************************************************************************/
?>
<div class="f-space10"></div>
<div class="container">
  <div class="row"><!-- row -->
    <div class="col-md-3 col-sm-12 col-xs-12 box-block page-sidebar">
      <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
        <? // Виджет меню кабинета
        $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
    </div><!-- /col-->
    <div class="col-md-9 col-sm-12 col-xs-12 main-column box-block">

        <? if (isset($type) && $type) { ?>
          <div class="panel panel-default">
            <div class="panel-heading">
                <? $status = OrdersStatuses::model()->find('value=:value', [':value' => $type]); ?>
              <h4 class="panel-title"><?= Yii::t('main', $status['name']) ?></h4>
            </div>
          </div><!--End:Panel-->
            <?
            $this->widget(
              'booster.widgets.TbGridView',
              [
                'id'               => 'orders-grid',
                'type'             => 'striped',
                'dataProvider'     => $orders,
                'enableSorting'    => false,
                'pagerCssClass'    => 'pagerNoClass',
                  /*
                  'pager'            => array(
                    'header'         => '',
                    'firstPageLabel' => '&lt;&lt;',
                    'prevPageLabel'  => '&lt;',
                    'nextPageLabel'  => '&gt;',
                    'lastPageLabel'  => '&gt;&gt;',
                  ),
                  */
                'template'         => '{summary}{pager}{items}{pager}',
                'summaryText'      => Yii::t('main', 'Заказы') . ' {start}-{end} ' . Yii::t(
                    'main',
                    'из'
                  ) . ' {count}',
                'htmlOptions'      => ['style' => 'cursor: pointer;'],
                'selectionChanged' => "function(id){window.location='"
                  . Yii::app()->urlManager->createUrl('/cabinet/orders/view') . "/id/' + 
          $.fn.yiiGridView.getSelection(id);}",
                'columns'          => [
                  [
                    'name'  => 'id',
                    'type'  => 'raw',
                    'value' => 'CHtml::link(CHtml::encode($data->uid."-".$data->id),array("/cabinet/orders/view", "id"=>$data->id))',
                  ],
                  [
                    'header'      => Yii::t('main', 'Товары'),
                    'type'        => 'raw',
                    'value'       => 'Order::getOrderItemsPreview($data->id,"_60x60.jpg")',
                    'htmlOptions' => ['style' => 'min-width:190px;height:60px;padding:3px;'],
                  ],
                  [
                    'name'  => 'date',
                    'type'  => 'raw',
                    'value' => 'date("d.m.Y H:i",$data->date)',
                  ],
                  [
                    'name'  => 'sum',
                    'type'  => 'raw',
                    'value' => 'Formulas::priceWrapper(Formulas::convertCurrency((($data->manual_sum)?$data->manual_sum:$data->sum),DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
                  ],
                  [
                    'name'  => 'weight',
                    'type'  => 'raw',
                    'value' => '$data->weight',
                  ],
                  [
                    'name'  => 'delivery_id',
                    'type'  => 'raw',
                    'value' => '$data->delivery_id',
                  ],
                  [
                    'name'    => 'delivery',
                    'type'    => 'raw',
                    'value'   => 'Formulas::priceWrapper(Formulas::convertCurrency(
            (($data->manual_delivery || ((string)$data->manual_delivery===\'0\'))?$data->manual_delivery:$data->delivery),
            DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
                    'visible' => DSConfig::getVal('source_show_old_price'),
                  ],
                  [
                    'header' => Yii::t('main', 'Итого'),
                    'type'   => 'raw',
                    'value'  => 'Formulas::priceWrapper(Formulas::convertCurrency(
            (($data->manual_sum)?$data->manual_sum:$data->sum)+
            (($data->manual_delivery || ((string)$data->manual_delivery===\'0\'))?$data->manual_delivery:$data->delivery),
            DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
                  ],
                ],
              ]
            );
            ?>
        <? } else { ?>
          <div>
            <h3><?= Yii::t('main', 'Статус не определен') ?></h3>
          </div>
        <? } ?>
    </div>

  </div><!-- /row -->
</div><!-- /container-->