<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="reorder.php">
 * </description>
 * Выбор заказа\дозаказа при оформлении
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="page-title"><h4><?= Yii::t('main', 'Оформление заказа') ?></h4></div>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

      <div class="content">
        <h4><?= $this->pageTitle ?></h4>
          <? //=================================================================================?>
        <div class="form reorder">
          <form action="<?= $this->createUrl('checkout/reorder') ?>" method="post">
            <div class="row">
              <label>
                <input type="radio" name="order" value="0" checked/><?= Yii::t(
                    'main',
                    'Создать новый заказ'
                  ) ?>
              </label>
            </div>
            <label style="margin-left: 25px;"><?= Yii::t('main', 'Или добавить в существующий') ?></label>

            <div class="clear"></div>
              <?
              $this->widget(
                'zii.widgets.grid.CGridView',
                [
                  'id'            => 'orders-grid',
                  'dataProvider'  => $orders,
                  'enableSorting' => false,
//    'filter'=>$model,
                  'pager'         => [
                    'header'         => '',
                    'firstPageLabel' => '&lt;&lt;',
                    'prevPageLabel'  => '&lt;',
                    'nextPageLabel'  => '&gt;',
                    'lastPageLabel'  => '&gt;&gt;',
                  ],
//    'type'=>'striped bordered condensed',
                  'template'      => '{summary}{items}{pager}',
                  'summaryText'   => Yii::t('main', 'Заказы') . ' {start}-{end} ' . Yii::t(
                      'main',
                      'из'
                    ) . ' {count}',
                  'columns'       => [
                    [
                      'name'  => 'id',
                      'type'  => 'raw', //$model->id
                      'value' => function ($data) {
                          echo '<input type="radio" name="order" value="' .
                            $data->id .
                            '"/>' .
                            $data->uid .
                            '-' .
                            $data->id;
                      },
                    ],
                    [
                      'header'      => Yii::t('main', 'Товары'),
                      'type'        => 'raw',
                      'value'       => 'Order::getOrderItemsPreview($data->id,"_60x60.jpg")',
                      'htmlOptions' => ['style' => 'min-width:145px;height:60px;padding:3px;'],
                    ],
                    [
                      'name'  => 'date',
                      'type'  => 'raw',
                      'value' => 'date("d.m.Y H:i",$data->date)',
                    ],
                    [
                      'name'  => 'sum',
                      'type'  => 'raw',
                      'value' => 'Formulas::priceWrapper(Formulas::convertCurrency($data->sum,DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
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
                      'name'  => 'delivery',
                      'type'  => 'raw',
                      'value' => 'Formulas::priceWrapper(Formulas::convertCurrency($data->delivery,DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
                    ],
                    [
                      'header' => Yii::t('main', 'Итого'),
                      'type'   => 'raw',
                      'value'  => 'Formulas::priceWrapper(Formulas::convertCurrency($data->sum+$data->delivery,DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
                    ],
                  ],
                ]
              );
              ?>
            <div class="next-btn">
                <?= CHtml::submitButton(Yii::t('main', 'Далее'), ['class' => 'blue-btn bigger']) ?>
            </div>
          </form>
        </div>
      </div><!--End:Content-->
    </div><!--End:Col-->
  </div><!--End:Row-->
</div><!--End:Container-->