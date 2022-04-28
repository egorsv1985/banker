<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="weight.php">
 * </description>
 * Форма ввода веса лотов заказа
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="page-title"><h3 style="position: relative; top: 35px;"><?= Yii::t(
                'main',
                'Оформление заказа'
              ) ?></h3></div>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="content">
        <br/>
        <div class="weight-desc">
          <div class="alert alert-info"><?= cms::customContent('checkout-weight-desc') ?></div>
        </div><!--Weight-desc-->
      </div><!--End:Content-->
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <form action="<?= $this->createUrl('/checkout/weight') ?>" method="POST">
          <?php foreach ($cart->cartRecords as $k => $item) { ?>
              <? $this->widget(
                'application.components.widgets.OrderItem',
                [
                  'orderItem'   => $item,
                  'readOnly'    => false,
                  'allowDelete' => false,
                  'imageFormat' => '_200x200.jpg',
                ]
              );
              ?>
          <? } ?>

        <input type="hidden" name="description" value="шаг 2"/>
        <input type="hidden" name="step" value="2"/>

        <div class="next-btn" style="float: right;">
            <?= CHtml::submitButton(
              Yii::t('main', 'Продолжить оформление заказа'),
              ['class' => 'btn btn-danger bigger']
            ) ?>
        </div>
      </form>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <hr/>
  <div class="page-title">
    <h3 style="position: relative; top: 35px;"><?= Yii::t('main', 'Справочник веса товаров по категориям'); ?></h3>
  </div>

  <div class="cabinet-table">
      <? $this->widget(
        'booster.widgets.TbGridView',
        [
          'id'           => 'weights-grid',
          'dataProvider' => $weights->search(),
          'filter'       => $weights,
          'pager'        => [
            'header'         => '',
            'firstPageLabel' => '&lt;&lt;',
            'prevPageLabel'  => '&lt;',
            'nextPageLabel'  => '&gt;',
            'lastPageLabel'  => '&gt;&gt;',
          ],
          'template'     => '{summary}{items}{pager}',
          'summaryText'  => Yii::t('main', 'Значения') . ' {start}-{end} ' . Yii::t('main', 'из') . ' {count}',
          'columns'      => [
            [
              'name'        => 'search',
              'type'        => 'raw',
              'value'       => 'Yii::app()->DVTranslator->translateText($data->search,"zh",Utils::appLang())',
//            'filter' => false,
              'htmlOptions' => ['title' => Yii::t('main', 'Поиск возможен только для русского и английского')],
            ],
            [
              'name'   => 'en',
              'filter' => false,
            ],
            [
              'name'   => 'min_weight',
              'filter' => false,
            ],
            [
              'name'   => 'max_weight',
              'filter' => false,
            ],
          ],
        ]
      );
      ?>
  </div><!--End:Cabinet-table--->
</div><!--End:Container-->