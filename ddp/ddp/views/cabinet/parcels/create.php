<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="view.php">
 * </description>
 * Создание новой посылки
 **********************************************************************************************************************/
?>
<div class="row clearfix f-space10"></div>
<div class="container">
  <div class="row"><!-- row -->
    <div class="col-md-3 col-sm-12 col-xs-12 box-block page-sidebar">
      <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
        <? $this->widget('application.components.widgets.cabinetMenuBlock'); // Виджет меню кабинета ?>
    </div><!-- /col-->
    <div class="col-md-9 col-sm-12 col-xs-12 main-column box-block">
        <? if (count($userItemsReadyForParcel->itemRecords) > 0) { ?>

      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title"><?= Yii::t('main', 'Лотов, готовых к отправке') . ': ' . count(
                $userItemsReadyForParcel->itemRecords
              ) . ' ' . Yii::t('main', 'шт') ?></h4>
        </div>
      </div>

      <div class="row clearfix f-space10"></div>
      <form action="<?= Yii::app()->createUrl('/cabinet/parcelsCart/add') ?>" method="POST" id="parcels-create">
        <!-- product -->
          <?
          $this->widget(
            'booster.widgets.TbGridView',
            [
              'id'            => 'parcelsCreate-grid',
              'type'          => 'striped',
              'dataProvider'  => $userItemsReadyForParcel->itemRecordsDataProvider,
              'enableSorting' => false,
              'ajaxUpdate'    => false,
              'template'      => '{summary}{pager}{items}{pager}',
              'summaryText'   => Yii::t('main', 'Лоты') . ' {start}-{end} ' . Yii::t(
                  'main',
                  'из'
                ) . ' {count}',
                //'htmlOptions'      => array('style' => 'cursor: pointer;'),
                /*                        'selectionChanged' => "function(id){window.location='"
                                          . Yii::app()->urlManager->createUrl('/cabinet/orders/view') . "/id/' +
                          $.fn.yiiGridView.getSelection(id);}",
                */
              'columns'       => [
                [
                  'name'              => 'item',
                  'type'              => 'raw',
                  'header'            => false,
                  'filter'            => false,
                  'headerHtmlOptions' => ['style' => 'width:0%; display:none'],
                  'value'             => function ($data) {
                      return Yii::app()->controller->widget(
                        'application.components.widgets.ParcelsItem',
                        [
                          'renderType'  => 'create',//$userCart->type
                          'orderItem'   => $data,
                          'readOnly'    => false,
                          'imageFormat' => '_200x200.jpg',
                        ],
                        true
                      );
                  },
                ],
              ],
            ]
          );
          ?>

        <!--</div><? // ("</div></div>") - если стоит разделить сисок посылок с функцианалом ? ?>

                    <!-- end: product -->
        <div class="row clearfix f-space30"></div>
        <!--<div class="container">
            <div class="row">
                <!-- 	Total amount -->
        <div class="col-md-4 col-sm-4 col-xs-12 cart-box-wr">
          <div class="box-content">
              <? if (isset($userItemsReadyForParcel->totalWeight) && ($userItemsReadyForParcel->totalWeight > 0)) { ?>
                <div class="cart-box-tm">
                  <div class="tm1"><?= Yii::t('main', 'Вес лотов, готовых к отправке') ?>:
                  </div>
                  <div class="tm2"><?= Formulas::weightWrapper(
                        $userItemsReadyForParcel->totalWeight
                      ) ?></div>
                </div>
              <? } ?>
            <div class="clearfix f-space10"></div>
            <div class="cart-box-tm">
              <div class="tm3 bgcolor2"><?= Yii::t(
                    'main',
                    'Стоимость лотов, готовых к отправке'
                  ) ?>:
              </div>
              <div class="tm4 bgcolor2"><?= Formulas::priceWrapper(
                    $userItemsReadyForParcel->totalLotsPrice
                  ) ?></div>
            </div>
          </div><!--End:Box-content-->
        </div><!--End:Col-->
        <!-- end: Total amount -->
        <!--</div><!--End:Row-->
        <!--<div class="clearfix f-space30"></div>

        <div class="row">-->
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="clearfix f-space10"></div>
          <!--Кнопки добавления в корзину -->
          <div style="display: inline-block;">
            <button style="display: inline-block; border-left: 15px white solid;"
                    class="btn btn-danger large color1 pull-right color2" type="button" name="reset"
                    onclick="location.reload();"><?= Yii::t(
                  'main',
                  'Сбросить выбор'
                ) ?></button>
            <button style="display: inline-block; border-left: 15px white solid;border-top: 15px white solid;"
                    class="btn large color1 pull-right" type="submit" name="saveSelected"><?= Yii::t(
                  'main',
                  'Выбранные - в корзину'
                ) ?></button>
            <button style="display: inline-block; border-left: 15px white solid;border-top: 15px white solid;"
                    class="btn large color1 pull-right" type="submit" name="saveAll"><?= Yii::t(
                  'main',
                  'Все - в корзину'
                ) ?></button>
          </div><!--End: Кнопки добавления лотов в корзину -->
        </div><!--End:Col-->
    </div><!--End:Row-->
    <!--</div><!-- End:Container-->
    </form>
      <? } else { ?>
        <!-- <div class="container"> -->
        <div class="row">
          <div class="col-md-12">
            <!--<div class="page-title">-->
            <div class="alert alert-danger"
            <h2><?= Yii::t('main', 'У вас нет лотов, готовых к отправке!') ?></h2>
            <!--</div>-->
          </div>
        </div>
        <!-- </div> -->
      <? } ?>
  </div><!--End:Col-->
</div><!-- /row -->
<div class="f-space20"></div>
</div><!-- /container-->
<script>
    /*
     function OpenCollapse() {
     $("#accordion-paysystem-items").addClass(" in");
     }
     */
</script>