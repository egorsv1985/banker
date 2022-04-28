<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="payment.php">
 * </description>
 * Рендеринг страницы оплаты заказа при оформлении
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="page-title"><h4><?= Yii::t('main', 'Оформление заказа') ?></h4></div>
    </div><!--End:Col-->
  </div><!--End:Row-->
    <? /*
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="cart-header">
            <tbody>
            <th style="width: 155px;"><?= Yii::t('main', 'Товар') ?></th>
            <th style="width: 380px;"><?= Yii::t('main', 'Описание') ?></th>
            <th><?= Yii::t('main', 'Параметры') ?></th>
            <th><?= Yii::t('main', 'Цена без скидок') ?></th>
            <th style="margin-right: 25px;"><?= Yii::t('main', 'Сумма') ?></th>
            </tbody>
        </table>
    </div><!--End:Col-->
</div><!--End:Row-->
    */ ?>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="content payment">
          <? foreach ($cart->cartRecords as $k => $item) { ?>
              <? $this->widget(
                'application.components.widgets.OrderItem',
                [
                  'orderItem' => $item,
                  'readOnly' => true,
                  'allowDelete' => false,
                  'imageFormat' => '_200x200.jpg',
                ]
              ); ?>
          <? } ?>
      </div><!--End:Content Payment-->
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <h4><?= Yii::t('main', 'Информация о способе получения заказа') ?></h4>

      <table class="table delivery-desc" style="background-color: #00aff0; color: white;">
        <tr>
          <th><?= Yii::t('main', 'Выбран способ доставки') ?>:</th>
          <td>
              <?php $delivery = Deliveries::getDelivery(0, false, $data['delivery_id']);
              if (isset($delivery->name)) {
                  echo $delivery->name;
              } else {
                  echo Yii::t('main', ' Не определено');
              } ?>
          </td>
        </tr>
        <tr>
          <th><?= Yii::t('main', 'Адрес получателя') ?>:</th>
          <td>
              <?= $data['country_name'] ?>, <?= $data['index'] ?>, <?= $data['city'] ?>
            , <?= $data['address'] ?>,
              <?= isset($data['fullname']) ? $data['fullname'] : "" ?>
            ,
              <?= isset($data['phone']) ? $data['phone'] : "" ?>
          </td>
        </tr>
      </table>

    </div><!--End:Col-->
    <form action="<?= Yii::app()->createUrl('/checkout/payment') ?>" method="post">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

        <input type="hidden" name="order_id" value="<?= $order_id ?>"/>

        <h4><?= Yii::t('main', 'Платежная информация') ?></h4>

        <table class="table delivery-desc" style="background-color: #f76b5c;">
          <tr>
            <th><?= Yii::t('main', 'Сумма за товары') ?>:</th>
            <td class="select"><?= Formulas::priceWrapper($cart->total) ?></td>
          </tr>
          <tr>
            <th><?= Yii::t('main', 'Сумма за доставку') ?>:</th>
            <td
                class="select"><?=
                Formulas::priceWrapper(
                  Formulas::convertCurrency(
                    $data['delivery'],
                    DSConfig::getVal('site_currency'),
                    DSConfig::getCurrency()
                  )
                ) ?></td>
          </tr>
          <tr class="total">
            <th><?= Yii::t('main', 'Итого к оплате') ?>:</th>
            <td
                class="select"><?=
                Formulas::priceWrapper(
                  (float) $cart->total + (float) Formulas::convertCurrency(
                    $data['delivery'],
                    DSConfig::getVal('site_currency'),
                    DSConfig::getCurrency()
                  )
                ) ?></td>
          </tr>
        </table>
      </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <? if (DSConfig::getVal('checkout_order_reconfirmation_needed') == 0) { ?>
            <? if (Users::getBalance(Yii::app()->user->id) <
              Formulas::convertCurrency(
                $cart->total,
                DSConfig::getCurrency(),
                DSConfig::getVal('site_currency')
              ) + $data['delivery']
            ) {
                ?>

            <div class="badge badge-danger payment-error">
              <p><?= Yii::t('main', 'На вашем счету недостаточно средств для оплаты заказа') ?>.</p>
              <input value='<?= Yii::t('main', 'Пополнить счёт') ?>'
                     onclick="location.href='<?=
                     Yii::app()->createUrl(
                       '/cabinet/balance/payment',
                       [
                         'sum' => Formulas::convertCurrency(
                             $cart->total,
                             DSConfig::getCurrency(),
                             DSConfig::getVal('site_currency')
                           ) +
                           $data['delivery'] - Users::getBalance(Yii::app()->user->id),
                         'r'   => '/checkout/payment',
                       ]
                     ) ?>'"
                     class="btn btn-danger bigger" type='button'/>
            </div>
            <!--     <input type="submit" name="doGoN" value="<? //=Yii::t('main','Оплатить')?>" class="blue-btn bigger" />  -->

            <? } else { ?>
            <div class="next-btn">
              <input type="submit" id="payment_button" name="doGo"
                     value="<?= Yii::t('main', 'Оформить заказ и оплатить') ?>"
                     class="btn btn-danger bigger"/>
            </div>
            <? } ?>

            <? $checkout_payment_needed = DSConfig::getVal('checkout_payment_needed') == 1; ?>
            <? if (!$checkout_payment_needed) { ?>
            <div class="next-btn">
              <input type="submit" id="nopayment_button" name="doGoNoPayment"
                     value="<?= Yii::t('main', 'Оформить заказ, но оплатить позже') ?>"
                     class="btn btn-warning bigger"/>
            </div>
            <? } ?>

        <? } else { ?>

          <div class="next-btn">
            <input type="submit" id="nopayment_button" name="doGoNoPayment"
                   value="<?= Yii::t('main', 'Закрыть заказ') ?>"
                   class="btn btn-success bigger"/>

          </div>
        <? } ?>

    </div><!--End:Col-->
    </form><!--End:FormChecoutPayment-->
  </div><!--End:Row-->
</div><!--End:Container-->