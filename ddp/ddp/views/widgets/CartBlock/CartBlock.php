<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="CartBlock.php">
 * </description>
 * Виджет отображает состояние корзины в лэйауте
 * cart =
 * stdClass Object
 * (
 * [cartRecords] => Array
 * ()
 * [cartRecordsDataProvider] => CArrayDataProvider Object
 * (
 * [totalDiscount] => 0 - общая сумма скидки по корзине
 * [total] => 0 - сумма корзины
 * [totalNoDiscount] => 0 - сумма без скидок
 * [totalWeight] => 0 - общий вес корзины
 * [allowOrder] => 1 - можно ли оформлять заказ
 * [summAddToAllowOrder] => 0 - сумма, недостающая до оформления зказа
 * )
 **********************************************************************************************************************/
?>
<? if (count($cart->cartRecords) <= 0) { ?>
  <a href="<?= Yii::app()->createUrl('/cart/index') ?>"><i class="fa fa-shopping-cart fa-fw"></i>
    <span class="hidden-sm"> <?= Yii::t('main', 'Корзина пуста') ?></span></a>
<? } else { ?>
  <a href="<?= Yii::app()->createUrl('/cart/index') ?>"><i class="fa fa-shopping-cart fa-fw"></i>
    <span class="hidden-sm"> <?= count($cart->cartRecords) ?> <?= Yii::t('main', 'шт.') ?>
            | <?= Formulas::priceWrapper($cart->total) ?></span></a>
  <div class="dropdown-menu quick-cart">
    <div class="qc-row qc-row-heading">
      <span class="qc-col-qty"><?= Yii::t('main', 'Кол-во') ?></span> <span class="qc-col-name"><?= Yii::t(
              'main',
              'Товаров'
            ) ?>: <?= count($cart->cartRecords) ?></span>
      <span class="qc-col-price">&nbsp;&nbsp;<?= Formulas::priceWrapper($cart->total) ?></span>
    </div>

      <?php foreach ($cart->cartRecords as $k => $item) { ?>
        <div class="qc-row qc-row-item"><span class="qc-col-qty"><?= $item->num ?>&nbsp;<?= Yii::t(
                  'main',
                  'шт'
                ) ?>.</span>
          <span class="qc-col-name">
                <? // item image ?>
                    <a href="<?= Yii::app()->createUrl(
                      '/item/index',
                      ['dsSource' => $item->ds_source, 'iid' => $item->iid]
                    ) ?>"
                       target="_blank">
                        <img src="<?= Img::getImagePath($item->pic_url, '_60x60.jpg') ?>" alt=""
                             style="width: 60px !important;"/>
                </a>
                    <? // End of image ?>
            </span>
          <span class="qc-col-price"><?= Yii::t('main', 'На сумму') ?>&nbsp;:&nbsp;<?= Formulas::priceWrapper(
                $item->sum
              ) ?></span>

          <!--Удаление из корзины-->
          <span class="qc-col-remove" style="position: relative;right:10px;" data-toggle="tooltip" data-placement="left"
                title="<?= Yii::t('main', 'Удалить из корзины') ?>">
     <a href="<?= Yii::app()->createUrl('/cart/delete', ['id' => $item->id]) ?>"
        onclick="deleteCart(this,<?= $item->id ?>); return false;">
        <i class="fa fa-times fa-fw"></i>
     </a>
 </span>

        </div>
      <? } ?>

      <? if (!$cart->allowOrder) { ?>
        <div class="qc-row qc-row-heading">
          <span class="qc-col-qty"></span><span class="qc-col-name"><?= Yii::t(
                  'main',
                  'Нужен дозаказ на сумму'
                ) ?>:</span>
          <span class="qc-col-price"><?= Formulas::priceWrapper($cart->summAddToAllowOrder) ?></span></div>
      <? } ?>
    <div class="qc-row-bottom"><a class="btn qc-btn-viewcart"
                                  href="<?= Yii::app()->createUrl('/cart/index') ?>"><?= Yii::t(
              'main',
              'Подробно'
            ) ?></a><a class="btn qc-btn-checkout" href="<?= Yii::app()->createUrl('/checkout/easy') ?>"><?= Yii::t(
              'main',
              'Заказ'
            ) ?></a>
    </div>
  </div>
<? } ?>
