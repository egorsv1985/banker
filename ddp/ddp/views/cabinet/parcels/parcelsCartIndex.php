<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 * Рендеринг корзины клиента
 * http://<domain.ru>/ru/cart/index
 * var $userCart = stdClass#1
 * (
 * [cartRecords] => array()
 * [cartRecordsDataProvider] => CArrayDataProvider#2)
 * [totalDiscount] => 0
 * [total] => 0
 * [totalNoDiscount] => 0
 * [totalWeight] => 0
 * [allowOrder] => true
 * [summAddToAllowOrder] => 0
 * )
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
        <? // Original cart markup ------------------------------ ?>
      <div class="row clearfix f-space10" xmlns="http://www.w3.org/1999/html"></div>
        <? if (count($userCart->cartRecords) > 0) { ?>
          <!--
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                  -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"><?= Yii::t('main', 'Лотов в корзине') . ': ' . count(
                    $userCart->cartRecords
                  ) . ' ' . Yii::t('main', 'шт') ?></h4>
            </div>
          </div>
          <!--
                      </div>
                  </div>
              </div>
          -->
          <!---- ---->
          <!-- 	Total amount -->
            <? if (isset($userCart->cartWeight) && ($userCart->cartWeight > 0)) { ?>
                <?= Yii::t('main', 'Вес посылки') ?>:
                <?= Formulas::weightWrapper($userCart->cartWeight) ?>
            <? } ?>
          <br/>
            <?= Yii::t('main', 'Стоимость товаров') ?>:
            <?= Formulas::priceWrapper($userCart->cartLotsPrice) ?>
          <!-- end: Total amount -->
          <!----  ---->

          <div class="row clearfix f-space10"></div>
          <form action="<?= Yii::app()->createUrl('/cabinet/parcelsCart/save') ?>" method="POST"
                id="parcelsCart-save">
            <!-- product -->
              <?
              $this->widget(
                'booster.widgets.TbGridView',
                [
                  'id'            => 'parcelsCart-grid',
                  'type'          => 'striped',
                  'dataProvider'  => $userCart->cartRecordsDataProvider,
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
                              'renderType'  => 'cart',//$userCart->type
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
            <!-- end: product -->

            <!--</div>--><? // ("</div>") - если стоит разделить сисок посылок с функцианалом ? ?>

            <div class="row clearfix f-space30"></div>

            <!--<div class="container">-->
            <div class="row">
              <!-- 	Estimate Shipping & Taxes -->
              <div class="col-md-4  col-sm-4 col-xs-12 cart-box-wr">
                <div class="box-heading"><span><?= Yii::t('main', 'Комментарий') ?></span>
                </div>
                <div class="clearfix f-space10"></div>
                <div class="box-content cart-box">
                  <p><?= Yii::t('main', 'Оставьте Ваш комментарий к заказу, если это необходимо') ?>
                    :</p>
                  <textarea class="input4" name="parcel-comment"></textarea>
                </div>
                <div class="clearfix f-space30"></div>
              </div>
              <!-- end: Estimate Shipping & Taxes -->
              <!-- 	Discount Codes -->
              <div class="col-md-4  col-sm-4 col-xs-12 cart-box-wr">
                <div class="box-heading"><span><?= Yii::t('main', 'Промо-код') ?></span></div>
                <div class="clearfix f-space10"></div>
                <div class="box-content cart-box">
                  <p><?= Yii::t(
                        'main',
                        'Введите промо-код или дисконтный код, если они у Вас есть'
                      ) ?>:</p>
                  <input type="text" value="" name="promocode" class="input4"/>
                </div>
                <div class="clearfix f-space30"></div>
              </div>
              <!-- end: Discount Codes -->
              <!-- 	Total amount -->
              <div class="col-md-4 col-sm-4 col-xs-12 cart-box-wr">
                <div class="box-content">
                    <? if (isset($userCart->cartWeight) && ($userCart->cartWeight > 0)) { ?>
                      <div class="cart-box-tm">
                        <div class="tm1"><?= Yii::t('main', 'Вес посылки') ?>:</div>
                        <div class="tm2"><?= Formulas::weightWrapper($userCart->cartWeight) ?></div>
                      </div>
                    <? } ?>
                  <div class="clearfix f-space10"></div>
                  <div class="cart-box-tm">
                    <div class="tm3 bgcolor2"><?= Yii::t('main', 'Стоимость товаров') ?>:</div>
                    <div class="tm4 bgcolor2"><?= Formulas::priceWrapper(
                          $userCart->cartLotsPrice
                        ) ?></div>
                  </div>
                </div><!--End:Box-content-->
              </div><!--End:Col-->
              <!-- end: Total amount -->
            </div><!--End:Row-->
            <div class="clearfix f-space30"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="row">
                    <? if (is_array($userCart->deliveries) && (count($userCart->deliveries) > 0)) {
                    $checkout_weight_needed = DSConfig::getVal('checkout_weight_needed') == 1;
                    foreach ($userCart->deliveries as $delivery) { ?>
                      <div class="col-md-6">
                        <label>
                            <?= $delivery->country ?>: <?= Yii::t('main', $delivery->name) ?>
                            <? if ($delivery->summ > 0 && $checkout_weight_needed) {
                                echo ': ' . Formulas::priceWrapper(
                                    Formulas::convertCurrency(
                                      $delivery->summ,
                                      DSConfig::getVal('site_currency'),
                                      DSConfig::getCurrency()
                                    )
                                  );
                            } ?>
                        </label>
                        <div class="hint"
                             style="padding-left: 40px; color: #00BCFF; padding-bottom: 8px; padding-top: 8px; background-color: #EAEAEA">
                            <?= Yii::t('main', $delivery->description) ?>
                        </div>
                      </div><!--End:col-->
                    <? } ?>
                </div>
                <div class="clearfix f-space10"></div>

                <div class="alert alert-info">
                    <?= Yii::t(
                      'main',
                      'Вы сможете выбрать службу доставки в процессе оформления заказа'
                    ) ?>
                </div>
                  <? } else { ?>
                    <div class="alert alert-danger">
                        <?= Yii::t(
                          'main',
                          'Стоимость доставки будет уточняться менеджером. Сделаейте заказ, после чего Вы сможете подтвердить отправку посылки'
                        ) ?>
                    </div>

                    <div class="delivery-more">
                      <a href="<?= Yii::app()->createUrl(
                        '/article/index',
                        ['url' => 'dostavka']
                      ) ?>">
                          <?= Yii::t('main', 'Подробнее об условиях доставки') ?>
                      </a>
                    </div>

                  <? } ?>
              </div>

              <div class="clearfix f-space30"></div>

              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= (!$userCart->allowOrder) ? '<div class="alert alert-error">' . Yii::t(
                        'main',
                        'Заказ посылки невозможен'
                      ) . '</div>' : '' ?>
                  <div class="clearfix f-space10"></div>
                  <!--Кнопки корзины -->
                  <div style="display: inline-block;">
                    <button
                        class="btn large color1 pull-right" type="submit" name="save"><?= Yii::t(
                          'main',
                          'Пересчитать корзину'
                        ) ?></button>
                    <button style="margin: 0 10px;"
                            class="btn large color1 pull-right" type="button" name="deleteAll"
                            onclick="clearParcelsCart();return true;"><?= Yii::t(
                          'main',
                          'Очистить корзину'
                        ) ?></button>
                    <button
                        style="display: inline-block;" <?= (!$userCart->allowOrder) ? 'disabled="disabled"' : '' ?>
                        class="btn large color1 pull-right"
                        type="submit" name="easyCheckout"
                        value="<?= Yii::t('main', 'Перейти к оплате') ?>"><?= Yii::t(
                          'main',
                          'Оформить заказ'
                        ) ?></button>
                  </div><!--End: Кнопки корзины -->
                </div><!--End:Col-->
              </div><!--End:Row-->
            </div><!-- End:Container-->
          </form>
        <? } else { ?>
          <!-- <div class="container"> -->
          <div class="row">
            <div class="col-md-12">
              <!--<div class="page-title">-->
              <div class="alert alert-danger"
              <h2><?= Yii::t('main', 'Ваша корзина посылок пуста!') ?></h2>
              <!--</div>-->
            </div>
          </div>
          <!-- </div> -->
        <? } ?>
    </div>
  </div><!--End:Col-->
</div><!-- /row -->
<div class="f-space20"></div>
