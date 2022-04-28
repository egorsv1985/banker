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
<? if (count($userCart->cartRecords) > 0) { ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title">
          <h2><?= Yii::t('main', 'Лотов в корзине') .
              ': ' .
              count($userCart->cartRecords) .
              ' ' .
              Yii::t('main', 'шт') ?></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="row clearfix f-space10"></div>
  <div class="container">
    <div class="col-md-12">
      <form action="<?= Yii::app()->createUrl('/cart/save') ?>" method="POST" id="cart-save">
        <!-- product -->

          <? foreach ($userCart->cartRecords as $k => $item) { ?>
              <? $this->widget(
                'application.components.widgets.CartItem',
                [
                  'orderItem' => $item,
                  'readOnly' => false,
                  'imageFormat' => '_200x200.jpg',
                ]
              );
              ?>
          <? } ?>

        <!-- end: product -->
        <div class="row clearfix f-spac20"></div>

        <div class="row">
          <!-- 	Estimate Shipping & Taxes -->
          <div class="col-md-4  col-sm-4 col-xs-12 cart-box-wr">
            <div class="box-heading"><span><?= Yii::t('main', 'Ваш комментарий к заказу') ?></span></div>
            <div class="clearfix f-space10"></div>
            <div class="box-content cart-box">
              <p><?= Yii::t('main', 'Оставьте Ваш комментарий к заказу, если это необходимо') ?>:</p>
              <textarea class="input4" name="comment"></textarea>
            </div>

          </div>
          <!-- end: Estimate Shipping & Taxes -->
          <!-- 	Discount Codes -->
          <div class="col-md-4  col-sm-4 col-xs-12 cart-box-wr">
            <div class="box-heading"><span><?= Yii::t('main', 'Промо-код') ?></span></div>
            <div class="clearfix f-space10"></div>
            <div class="box-content cart-box">
              <p><?= Yii::t('main', 'Промо-код или дисконтный код, если они у Вас есть') ?>:</p>
              <input type="text" value="" name="promocode" class="input4"/>
            </div>

          </div>
          <!-- end: Discount Codes -->
          <!-- 	Total amount -->
          <div class="col-md-4 col-sm-4 col-xs-12 cart-box-wr">
            <div class="box-content">
                <? if (($userCart->totalDiscount > 0) && DSConfig::getVal('source_show_old_price')) { ?>
                  <div class="cart-box-tm">
                    <div class="tm1"><?= Yii::t('main', 'Экономия') ?>:</div>
                    <div class="tm2"><?= Formulas::priceWrapper($userCart->totalDiscount) ?></div>
                  </div>
                <? } ?>
              <div class="clearfix f-space10"></div>
              <div class="cart-box-tm">
                <div class="tm3 bgcolor2"><?= Yii::t('main', 'Итого') ?>:</div>
                <div class="tm4 bgcolor2"><?= Formulas::priceWrapper($userCart->total) ?></div>
              </div>
            </div><!--End:Box-content-->
          </div><!--End:Col-->
          <!-- end: Total amount -->
        </div><!--End:Row-->

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <?= (!$userCart->allowOrder) ? '<div class="alert alert-error">' . Yii::t(
                  'main',
                  'Нужен дозаказ на сумму'
                ) . ': ' . Formulas::priceWrapper($userCart->summAddToAllowOrder) . '</div>' : '' ?>
              <?= ($userCart->overloadedCount) ? '<div class="alert alert-block">' . Yii::t(
                  'main',
                  'В корзине останется товаров'
                ) . ': ' . $userCart->overloadedCount . '</div>' : '' ?>
            <div class="clearfix f-space10"></div>
            <!--Кнопки корзины -->
            <div class="clearfix f-space10"></div>
            <div style="display: inline-block;" class="pull-right">
              <button style="display: inline-block; border-left: 15px white solid;"
                      class="btn large color1 pull-right" type="submit" name="save"><?= Yii::t(
                    'main',
                    'Посчитать и сохранить'
                  ) ?></button>
              <button style="display: inline-block; border-left: 15px white solid;"
                      class="btn btn-warning large pull-right" type="button" name="deleteAll"
                      onclick="clearCart();return true;"><?= Yii::t('main', 'Очистить корзину') ?></button>
              <button
                  style="display: inline-block;" <?= (!$userCart->allowOrder) ? 'disabled="disabled"' : '' ?>
                  class="btn btn-danger large pull-right"
                  type="submit" name="easyCheckout"
                  value="<?= Yii::t('main', 'Перейти к оплате') ?>"><?= Yii::t(
                    'main',
                    'Оформить заказ'
                  ) ?></button>
            </div><!--End: Кнопки корзины -->
            <div class="clearfix f-space20"></div>
          </div><!--End:Col-->
        </div><!--End:Row-->
    </div><!-- End:Container-->
    </form>
  </div><!--End:Col-->
  <!--</div><!--End:container-->
<? } else { ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!--<div class="page-title">-->
        <div class="alert alert-success"
        <h2><?= Yii::t('main', 'Ваша корзина пуста!') ?></h2>
        <!--</div>-->
      </div>
    </div>
  </div>
<? } ?>
</div>
<div class="clearfix f-space30"></div>
