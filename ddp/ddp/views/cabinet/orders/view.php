<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="view.php">
 * </description>
 * Просмотр заказа в кабинете
 **********************************************************************************************************************/
?>
<? // Расчёты используемых ниже значений?>
<?
// Нужно ли подтверждение заказа после проверки менеджером
$checkout_order_reconfirmation_needed = DSConfig::getVal('checkout_order_reconfirmation_needed') == 1;
//Вес заказа
$orderWeight =
  (isset($order->manual_weight) && ($order->manual_weight)) ? $order->manual_weight :
    $order->calculated->actual_lots_weight;
$orderWeight = ($orderWeight) ? $orderWeight : $order->weight;
//Доставка заказа
$orderDelivery =
  ($order->manual_delivery || $order->manual_delivery === '0') ? $order->manual_delivery : $order->delivery;
//Доставка заказа по Китаю
$orderChineseDeliverySumm = 0;
if (DSConfig::getValDef('delivery_source_auto_apply_manual_changes', 0) != '1') {
    foreach ($order->ordersItems as $orderItem) {
        if (!in_array($orderItem->status, OrdersItemsStatuses::getOrderItemExcludedStatusesArray())) {
            $orderChineseDeliverySumm = $orderChineseDeliverySumm + $orderItem->calculated_lotExpressFee;
        }
    }
} else {
    foreach ($order->ordersItems as $orderItem) {
        if (!in_array($orderItem->status, OrdersItemsStatuses::getOrderItemExcludedStatusesArray())) {
            if (isset($orderItem->actual_lot_express_fee) && is_numeric($orderItem->actual_lot_express_fee)
              && $orderItem->actual_lot_express_fee >= 0
            ) {
                $val = $orderItem->actual_lot_express_fee;
            } else {
                $val = $orderItem->calculated_lotExpressFee;
            }
            $orderChineseDeliverySumm = $orderChineseDeliverySumm + $val;
        }
    }
}
$orderChineseDeliverySumm = Formulas::convertCurrency(
  $orderChineseDeliverySumm,
  'cny',
  DSConfig::getVal('site_currency'),
  false,
  $order->date
);
// $orderSum - стоимость заказа
// $orderSumNoDelivery - стоимость заказа без доставки
if (is_numeric($order->manual_sum)) {
    $orderSum = $order->manual_sum;
    if (DSConfig::getValDef('delivery_source_fee_in_price', 0) == 1) {
        $orderSumNoDelivery = $orderSum;
    } else {
        $orderSumNoDelivery = $orderSum - $orderChineseDeliverySumm;
    }
} else {
    $orderSum = $order->sum;
    if (DSConfig::getValDef('delivery_source_fee_in_price', 0) == 1) {
        $orderSumNoDelivery = $orderSum;
    } else {
        $orderSumNoDelivery = $orderSum - $orderChineseDeliverySumm;
    }
}
// $orderTotalDelivery - полная стоимость доставки
if (DSConfig::getVal('checkout_weight_needed')) {
    $orderTotalDelivery = (is_numeric($order->manual_delivery)) ? $order->manual_delivery : $order->delivery;
} else {
    $orderTotalDelivery = 0;
}
// ХЗ что такое, но очень нужно!
if (DSConfig::getVal('source_show_old_price')) {
    $orderDelivery = (is_numeric(
      $order->manual_delivery
    )) ? $order->manual_delivery : $order->delivery;
} else {
    $orderDelivery = null;
}
// Стоимость товаров в текущей валюте
$orderSumCurr = Formulas::convertCurrency(
  $orderSum,
  DSConfig::getVal('site_currency'),
  DSConfig::getCurrency(),
  false,
  $order->date
);
// Стоимость доставки в текущей валюте
$orderDeliveryCurr = Formulas::convertCurrency(
  $orderDelivery,
  DSConfig::getVal('site_currency'),
  DSConfig::getCurrency(),
  false,
  $order->date
);
// Общая стоимость заказа с доставкой в текущей валюте
$orderTotal = Formulas::priceWrapper($orderSumCurr + $orderDeliveryCurr);
// Оплачено по заказу
$payed = round(OrdersPayments::getPaymentsSumForOrder($order->id), 2);
// Оплачено ли хоть что-то
$paymentCreated = $payed > 0;
// Стоимость заказа
$pay = round($orderDelivery + $orderSum, 2);
// Сумма необходимого платежа в текущей валюте
$paymentSumm = Formulas::priceWrapper(
  Formulas::convertCurrency(
    $orderSum + $orderDelivery - OrdersPayments::getPaymentsSumForOrder($order->id),
    DSConfig::getVal('site_currency'),
    DSConfig::getCurrency(),
    false,
    $order->date
  )
);
// Нужен ли вобще платёж
$paymentNeeded = $orderSum + $orderDelivery - OrdersPayments::getPaymentsSumForOrder(
    $order->id
  ) > Users::getBalance(Yii::app()->user->id);
?>
<? /****************************************************************************************/ ?>
<? /*                     Конец  расчётов используемых ниже значений                       */ ?>
<? /****************************************************************************************/ ?>
<div class="row clearfix f-space10"></div>
<div class="container">
  <div class="row"><!-- row -->
    <div class="col-md-3 col-sm-12 col-xs-12 box-block page-sidebar">
      <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
        <? $this->widget('application.components.widgets.cabinetMenuBlock'); // Виджет меню кабинета ?>
    </div><!-- /col-->
    <div class="col-md-9 col-sm-12 col-xs-12 main-column box-block">
        <? /*****************************************************************************/ ?>
        <? /*  Если нужно оплатить или требуется доплата - сообщим клиенту об этом      */ ?>
        <? /*****************************************************************************/ ?>
        <? if ((($pay > $payed) && (abs($pay - $payed) > 1))
          && (
            ($checkout_order_reconfirmation_needed && (is_numeric(
                $order->manual_delivery
              )) && ($order->ordersItemsForReorder <= 0))
            || !$checkout_order_reconfirmation_needed)
        ) {
            ?>
          <div class="alert alert-info" style="color: #00a8ff;">
            <h4><?= Yii::t('main', 'Требуется оплата') ?></h4>
              <?=
              Yii::t(
                'main',
                'В результате уточнения стоимости'
              ) ?>
            <br/>
              <?=
              Yii::t(
                'main',
                'товаров и (или) доставки, по заказу'
              ) ?>
            <b>№<?= $order->uid . '-' . $order->id ?></b><br/>
              <?= Yii::t('main', 'Вам необходимо оплатить или доплатить') ?>&nbsp;
            <span style="font-size: 120%;color: red; font-weight: bold;"><?=
                Formulas::priceWrapper(
                  Formulas::convertCurrency(
                    $orderSum + $orderDelivery - OrdersPayments::getPaymentsSumForOrder($order->id),
                    DSConfig::getVal('site_currency'),
                    DSConfig::getCurrency(),
                    false,
                    $order->date
                  )
                ) ?>
                    </span>

            <a href="#accordion-paysystem" class="btn btn-primary btn-lg active pull-right" role="button"
               onclick="OpenCollapse()"
               style="position: relative; top: -20px;">
                <?= Yii::t('main', 'Способ оплаты') ?>
            </a>
            <br/>
          </div><!--End:Alert-->
        <? } ?>
        <? /*****************************************************************************/ ?>
        <? /*  Если нужно у клиента недостаточно средств на счете - сообщим клиенту     */ ?>
        <? /*                О необходимости пополнить счет                             */ ?>
        <? /*****************************************************************************/ ?>
        <? if ($paymentNeeded) { ?>
          <div class="payment-error">
            <div class="alert alert-danger" style="color: red;">
              <h4> <?= Yii::t('main', 'Внимание') ?> !</h4>
              <p>
                  <?= Yii::t('main', 'На Вашем счету недостаточно средств для оплаты заказа') ?><br/>
                  <?= Yii::t('main', 'Вам необходимо пополнить счёт!') ?>
                <a href="#accordion-paysystem" class="btn btn-danger btn-lg active pull-right" role="button"
                   onclick="OpenCollapse()"
                   style="position: relative; top: -20px;">
                    <?= Yii::t('main', 'Способ оплаты') ?>
                </a>
              </p>
            </div>
          </div>
        <? } ?>
        <? /* ******************************************************************** */ ?>
      <div class="cabinet-content content payment">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
                            <span><?= Yii::t('main', 'Заказ') ?>
                                &nbsp;ID:&nbsp;<?= $order->uid . '-' . $order->id ?></span>
            </h4>
          </div>
        </div>
        <table class="table table-striped">

          <tr>
            <th><?= Yii::t('main', 'Дата заказа') ?>:</th>
            <td><?= date('d.m.Y H:i', $order->date) ?></td>
          </tr>
            <? if ($order->extstatuses) { ?>
              <tr>
                <th><?= Yii::t('main', 'Статус заказа') ?>:</th>
                <td class="select"><?= $order->statuses->name . ' (' . $order->extstatuses . ')' ?></td>
              </tr>
                <?
            } else {
                ?>
              <tr>
                <th><?= Yii::t('main', 'Статус заказа') ?>:</th>
                <td class="select"><?= Yii::t('main', $order->statuses->name) ?></td>
              </tr>
            <? } ?>
            <? if ($order->code) { ?>
              <tr>
                <th><?= Yii::t('main', 'Трекинг посылки') ?>:</th>
                <td class="select"><?
                    if ($order->code) {
                        if (preg_match('/^http/is', $order->code)) {
                            echo "<a href='{$order->code}' target='_blank'>{$order->code}</a>";
                        } else {
                            echo $order->code;
                        }
                    } else {
                        echo Yii::t('main', 'не получен');
                    }
                    ?>
                </td>
              </tr>
            <? } else { ?>
                <? if (count($order->ordersItemsLegend) > 0) { ?>
                <th><?= Yii::t('admin', 'Статусы лотов') ?>:</th>
                <td class="select">
                    <? foreach ($order->ordersItemsLegend as $itemStatus) { ?>
                      <span style="<?= $itemStatus['excluded'] ? 'color:red;' : '' ?>"><?= Yii::t(
                            'main',
                            $itemStatus['name']
                          ) ?></span>: <?= $itemStatus['cnt'] ?>&nbsp;
                    <? } ?>
                </td>
                <? } ?>
            <? } ?>
            <? if (in_array($order->statuses->value, ['CANCELED_BY_CUSTOMER', 'CANCELED_BY_SERVICE'])) { ?>
              <tr class="total">
                <th><?= Yii::t('main', 'Внимание') ?>:</th>
                <td class="select"><?= Yii::t(
                      'main',
                      'Заказ отменен, все платежи возвращены на Ваш счет'
                    ) ?>!
                </td>
              </tr>
            <? } ?>
        </table>
      </div><!--End:Cabinet-content-->

        <? $this->widget(
          'application.components.widgets.OrderPaymentsBlock',
          [
            'orderId'  => $order->id,
            'pageSize' => 5,
          ]
        );
        ?>

        <? $this->widget(
          'application.components.widgets.EventsBlock',
          [
            'subjectId'    => $order->id,
            'eventsType'   => '^Order\.|^OrdersItems\.',
            'pageSize'     => 1000,
            'showInternal' => false,
            'filter'       => "(t.event_name in (
                    'Order.beforeUpdate.status',
                    'Order.beforeUpdate.manager',
                    'Order.beforeUpdate.manual_weight'
                    'Order.beforeUpdate.delivery_id',
                    'Order.beforeUpdate.code',
                    'Order.afterInsert.created',
                    'OrdersItems.beforeUpdate.status',
                    'OrdersItems.beforeUpdate.tid',
                    'OrdersItems.beforeUpdate.track_code',
                    'OrdersItems.beforeUpdate.actual_num',
                    'OrdersItems.beforeUpdate.actual_lot_price',
                    'OrdersItems.beforeUpdate.actual_lot_weight'
                    ))",
          ]
        );
        ?>

        <? $this->widget(
          'application.components.widgets.OrderCommentsBlock',
          [
            'orderId'     => $order->id,
            'orderItemId' => false,
            'public'      => true,
            'pageSize'    => 5,
            'imageFormat' => '_200x200.jpg',
          ]
        );
        ?>
      <div class="panel-group" id="accordion1">
        <div class="panel panel-default">
          <div class="panel-heading closed" data-toggle="collapse" data-parent="#accordion1"
               data-target="#collapseOrderItem">
            <h4 class="panel-title">
              <span class="fa fa-arrow-right"></span>
              <a href="#accordion100">
                  <?= Yii::t('main', 'Товары в заказе') ?>
                : <?= count($order->ordersItems) ?>
              </a>
            </h4>
          </div>
          <div id="collapseOrderItem" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="f-space10"></div>
                <? foreach ($order->ordersItems as $item) { ?>
                    <?
                    $this->widget(
                      'application.components.widgets.OrderItem',
                      [
                        'orderItem'      => $item,
                        'readOnly'       => true,
                        'allowDelete'    => false,
                        'publicComments' => true,
                        'imageFormat'    => '_200x200.jpg',
                      ]
                    );
                    ?>
                  <hr/>
                <? } ?>
            </div><!--End:Panel-body-->
          </div><!--End:Panel-collapse-->
        </div><!--End:Panel-->
      </div><!--End:Panel-group-->

        <? /**************************************************************/ ?>

      <div class="panel-group" id="accordion2">
        <div class="panel panel-default">
          <div class="panel-heading closed" data-toggle="collapse" data-parent="#accordion2"
               data-target="#collapseOrderItemDeliv">
            <h4 class="panel-title">
              <span class="fa fa-arrow-right"></span>
              <a href="#accordion2-100" class="collapsed">
                  <?= Yii::t('main', 'Информация о доставке') ?>
              </a>
            </h4>
          </div>
          <div id="collapseOrderItemDeliv" class="panel-collapse collapse">
            <div class="panel-body">
                <? /**************************************************************/ ?>
              <table class="delivery-desc table table-striped">
                <tr>
                  <th><?= Yii::t('main', 'Вес посылки') ?>:</th>
                  <td><?= $orderWeight ? Formulas::weightWrapper($orderWeight) : Yii::t(
                        'main',
                        "рассчитывается..."
                      ) ?></td>
                </tr>
                  <?
                  if (DSConfig::getVal('source_show_old_price')
                    || Yii::app()->user->inRole(['manager', 'orderManager', 'topManager', 'superAdmin'])
                  ) { ?>
                    <tr>
                      <th><?= Yii::t('main', 'Сумма за доставку') ?>:</th>
                      <td>
                          <? if ($orderDelivery > 0) { ?>
                              <?=
                              Formulas::priceWrapper(
                                Formulas::convertCurrency(
                                  $orderDelivery,
                                  DSConfig::getVal('site_currency'),
                                  DSConfig::getCurrency(),
                                  false,
                                  $order->date
                                )
                              ); ?>
                              <?
                          } else {
                              ?>
                              <?= Yii::t('main', 'рассчитывается...'); ?>
                          <? } ?>
                      </td>
                    </tr>
                    <tr>
                      <th><?= Yii::t('main', 'Трекинг посылки') ?>:</th>
                      <td><?
                          if ($order->code) {
                              if (preg_match('/^http/is', $order->code)) {
                                  echo "<a href='{$order->code}' target='_blank'>{$order->code}</a>";
                              } else {
                                  echo $order->code;
                              }
                          } else {
                              echo Yii::t('main', 'не получен');

                          }
                          ?></td>
                    </tr>
                    <tr>
                      <th><?= Yii::t('main', 'Дата отправки') ?>:</th>
                        <? if ($order->status == 'SEND_TO_CUSTOMER') {
                            $lastEvent = EventsLog::getLastEventForSubj($order->id, 'Order.beforeUpdate.status');
                            if ($lastEvent) {
                                $sendDate = $lastEvent[0]->date;
                            } else {
                                $sendDate = false;
                            }
                        } else {
                            $sendDate = false;
                        }
                        ?>
                      <td><?= ($sendDate) ? $sendDate : Yii::t('main', 'Не отправлен'); ?></td>
                    </tr>
                  <? } ?>
                <tr>
                  <th><?= Yii::t('main', 'Способ доставки') ?>:</th>
                  <td>
                      <?php $delivery = Deliveries::getDelivery(0, false, $order['delivery_id']);
                      if (isset($delivery->name)) {
                          echo $delivery->name;
                      } else {
                          echo Yii::t('main', ' Не определено');
                      } ?>
                  </td>
                </tr>
                <tr>
                  <th><?= Yii::t('main', 'Адрес') ?>:</th>
                  <td>
                      <? if ($order->addresses) { ?>
                          <?=
                          Deliveries::getCountryName(
                            $order->addresses['country']
                          ) ?>, <?= $order->addresses['index'] ?>, <?= $order->addresses['city'] ?>, <?= $order->addresses['address'] ?>.
                          <?= $order->addresses['fullname'] ?>
                          <?= $order->addresses['phone'] ?>
                      <? } ?>
                  </td>
                </tr>
              </table>

            </div><!--End:Panel-body-->
          </div><!--End:Panel-collapse-->
        </div><!--End:Panel-->
      </div><!--End:Panel-group-->
        <? /**************************************************************/ ?>



        <? /*****************************************************/ ?>
        <? if ((($pay > $payed) && (abs($pay - $payed) > 1))
        && (
          ($checkout_order_reconfirmation_needed && (is_numeric(
              $order->manual_delivery
            )) && ($order->ordersItemsForReorder <= 0))
          || !$checkout_order_reconfirmation_needed)
        ) {
        ?>

    <? /*
			    <div class="alert alert-info">
                    <h4><?= Yii::t('main', 'Требуется оплата') ?></h4>
                    <?=
                    Yii::t(
                      'main',
                      'В результате уточнения стоимости товаров и (или) доставки, по заказу'
                    ) ?> <b>№<?= $order->uid . '-' . $order->id ?></b><br/>
                    <?= Yii::t('main', 'вам необходимо оплатить или доплатить') ?>&nbsp;
                    <span style="color: red; font-weight: bold;"><?=
                        Formulas::priceWrapper(
                          Formulas::convertCurrency(
                            $orderSum + $orderDelivery - OrdersPayments::getPaymentsSumForOrder($order->id),
                            DSConfig::getVal('site_currency'),
                            DSConfig::getCurrency(),
                            false,
                            $order->date
                          )
                        ) ?>
                    </span>
                </div><!--End:Alert-->
			*/ ?>
      <!--<div style="padding: 10px 10px;"></div>-->
    <? //==== Выбор способа оплаты ================================ ?>
      <div class="panel-group" id="accordion-paysystem">
        <div class="panel panel-default">
          <div class="panel-heading closed" data-parent="#accordion-paysystem"
               data-target="#accordion-paysystem-items" data-toggle="collapse">
            <h4 class="panel-title">
              <span class="fa fa-arrow-right"></span>
              <a href="#accordion-paysystem" class="collapsed">
                  <?= Yii::t('main', 'Выбор способа пополнения счета') ?>
              </a>
            </h4>
          </div>

          <div id="accordion-paysystem-items" class="panel-collapse collapse">
            <div class="pane-body">
              <div class="product-chooser">
                <div class="f-space10"></div>
                <!-- Выбор способа оплаты из доступных -->
                  <? $paySystems = PaySystems::model()->findAll(
                    "enabled=1 order by SUBSTRING(parameters, '<sortorder>(.*?)<\/sortorder>'),id"
                  );
                  $preferedPaySystem = '';
                  ?>
                  <? if (is_array($paySystems) && (count($paySystems) > 0)) { ?>
                      <? foreach ($paySystems as $i => $paySystem) {
                          if ($i == 0) {
                              $preferedPaySystem = $paySystem->int_name . '[' . $paySystem->id . ']';
                          }
                          ?>
                      <!----------------------------->
                      <div class="blogpost row product-chooser-item">
                        <div class="blogcontent">
                          <div class="blogdetails col-md-3 col-xs-12 date date-easy"
                               style="height: 170px;">
                            <img src="<?= $paySystem->logo_img; ?>"
                                 style="height: 60px !important; width: 60px !important; position: relative; top: 40px;"/>
                          </div><!--End:Col-->
                          <div class="col-md-9 col-xs-12 blog-summery"
                               style="height: 170px; padding: 5px !important; overflow: hidden;">
                            <h3>
                                <? if (Utils::appLang() == 'ru') { ?>
                                    <?= $paySystem->name_ru; ?>
                                    <?
                                } else {
                                    ?>
                                    <?= $paySystem->name_en; ?>
                                <? } ?>
                            </h3>
                            <span class="bloginfo"></span>
                            <p>
                                <? if (Utils::appLang() == 'ru') { ?>
                                    <?= $paySystem->descr_ru; ?>
                                <? } else { ?>
                                    <?= $paySystem->descr_en; ?>
                                <? } ?>
                            </p>
                            <input type="radio" style=" position: relative;"
                                   id="paysystem-<?= $paySystem->int_name . '[' . $paySystem->id . ']'; ?>"
                                   onclick="paySystemChanged()"
                                   value="<?= $paySystem->int_name . '[' . $paySystem->id . ']'; ?>"
                                   name="easyCheckout[paySystem]">
                          </div><!--End:Col-->

                        </div><!--End:BlogContent-->
                      </div><!--End:Row-->
                      <br/>
                      <!---------------------->
                      <? } ?>
                  <? } ?>
                <!-- ./ Выбор способа оплаты из доступных -->
              </div>
              <script>
                  $(function () {
                      $('div.product-chooser').find('div.product-chooser-item').on('click', function () {
                          $(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
                          $(this).addClass('selected');
                          $(this).find('input[type="radio"]').prop('checked', true);
                      });
                  });

                  var payLocationBase = '<?=Yii::app()->createUrl('/cabinet/balance/order', []) ?>';
                  var payLocationOrder = '/oid/<?=$order->id?>';
                  var payLocationPaySystem = '/paysystem/<?=$preferedPaySystem?>';

                  function paySystemChanged(paysystem) {
                      payLocationPaySystem = '/paysystem/' + paysystem;
                  }
              </script>
                <? //==== Конец выбора способа оплаты ============================ ?>
            </div><!--End:Panel-body-->
          </div><!--End:Panel-collapse-->
        </div><!--End:Panel-->
      </div><!--End:Panel-group-->
    <? /*****************************************************/ ?>
      <div class="panel-group" id="accordion3">
        <div class="panel panel-default">
          <div class="panel-heading" data-target="#collapseOrderSum" data-toggle="collapse">

            <h4 class="panel-title"><span class="fa fa-arrow-right"></span><?= Yii::t('main', ' Стоимость заказа') ?>
            </h4>
          </div>
        </div>
        <div class="panel-collapse collapse in" id="collapseOrderSum">
          <div class="panel-body">
            <div class="delivery-desc table table-striped" style="margin-bottom: 0 !important;">
              <table class="table table-striped">
                <tr>
                  <th><?= Yii::t('main', 'Сумма за товары') ?>:</th>
                  <td class="select" style="width: 269px;">
                      <?= Formulas::priceWrapper(
                        Formulas::convertCurrency(
                          $orderSumNoDelivery,
                          DSConfig::getVal('site_currency'),
                          DSConfig::getCurrency(),
                          false,
                          $order->date
                        )
                      ) ?>
                  </td>
                </tr>
                <tr>
                  <th><?= Yii::t('main', 'Сумма за доставку') ?>:</th>
                  <td class="select" style="width: 269px;">
                      <? if (DSConfig::getVal('source_show_old_price')) {
                          if (is_numeric($orderDelivery)) {
                              echo Formulas::priceWrapper(
                                Formulas::convertCurrency(
                                  $orderDelivery,
                                  DSConfig::getVal('site_currency'),
                                  DSConfig::getCurrency(),
                                  false,
                                  $order->date
                                )
                              );
                          } else {
                              echo Yii::t('main', 'не рассчитано');
                          }
                      } else {
                          echo Yii::t('main', 'рассчитывается по фактическому весу посылки при получении');
                      }
                      ?></td>
                </tr>
                <tr class="total">
                  <th><?= Yii::t('main', 'Общая сумма заказа') ?>:</th>
                  <td class="select" style="width: 269px;"><?= $orderTotal; ?>
                      <? if ((DSConfig::getVal('rates_use_currency_log') == 1)) { ?>
                        &nbsp;<span style="font-size: small"><?= Yii::t('main', 'по курсу на') . ' ' . date(
                                'd.m.Y',
                                $order->date
                              ) ?></span>
                      <? } ?>
                  </td>
                </tr>
                  <? if (in_array($order->statuses->value, ['CANCELED_BY_CUSTOMER', 'CANCELED_BY_SERVICE'])) { ?>
                    <div class="total alert alert-ganger">
                      <span><?= Yii::t('main', 'Внимание') ?>:</span>
                      <span class="select"><?= Yii::t(
                            'main',
                            'Заказ отменен, все платежи возвращены на Ваш счет'
                          ) ?>!</span>
                    </div>
                  <? } ?>
              </table>
            </div>
              <? /*****************************************************/ ?>
          </div><!--End:Panel-body-->
        </div><!--End:Panel-collapse-->
      </div><!--End:Panel-->
    <? /*****************************************************/ ?>
        <? } ?><!--End: If -->

        <? /*****************************************************/ ?>
        <? /*                  Другие кнопки                    */ ?>
        <? /*****************************************************/ ?>

      <div class="two-btn row">
        <div class="col-md-12">

            <? if ((($pay > $payed) && (abs($pay - $payed) > 1))
            && (
              ($checkout_order_reconfirmation_needed && (is_numeric(
                  $order->manual_delivery
                )) && ($order->ordersItemsForReorder <= 0))
              || !$checkout_order_reconfirmation_needed)
            ) { ?>
        <input id="payment_button" value="<?= Yii::t('main', 'Оплатить сейчас') ?>"
               style="margin-left: 10px;"
               onclick="location.href=payLocationBase+payLocationOrder+payLocationPaySystem"
               class="btn btn-danger pull-right buy-btn bigger active"
               type="button"/>
            <? } ?><!--End: If -->

            <? if (OrdersStatuses::isAllowedStatusForOrder(
                'CANCELED_BY_CUSTOMER',
                $order->id,
                Yii::app()->user->id,
                null
              )
              &&
              !in_array(
                $order->statuses->value,
                [
                  'CANCELED_BY_CUSTOMER',
                  'CANCELED_BY_SERVICE',
                  'SEND_TO_CUSTOMER',
                  'RECEIVED_BY_CUSTOMER',
                ]
              )
            ) { ?>
              <form action="<?= Yii::app()->createUrl('/cabinet/orders/delete', ['oid' => $order->id]) ?>">
                <button class="btn btn-default pull-right" data-balloon-pos="left"
                        data-balloon="<?= Yii::t('main', 'Отменить заказ') ?>"
                        style="border: 1px solid red;" type="button">
                  <span class="glyphicon glyphicon-remove" style="color:red;padding: 10px 5px;"></span>
                    <? //= Yii::t('main', 'Отменить заказ') ?>
                </button>
              </form>
            <? } ?>
            <? if (OrdersStatuses::isAllowedStatusForOrder(
                'RECEIVED_BY_CUSTOMER',
                $order->id,
                Yii::app()->user->id,
                null
              )
              && (!OrdersStatuses::isAllowedStatusForOrder(
                  'CANCELED_BY_CUSTOMER',
                  $order->id,
                  Yii::app()->user->id,
                  null
                ) || Yii::app()->user->inRole('superAdmin'))
              && !in_array(
                $order->statuses->value,
                ['200-1', 'CANCELED_BY_CUSTOMER', 'CANCELED_BY_SERVICE', 'RECEIVED_BY_CUSTOMER']
              )
            ) { ?>
              <form action="<?= Yii::app()->createUrl(
                '/cabinet/orders/received',
                ['oid' => $order->id]
              ) ?>">
                <button class="btn btn-success pull-right" data-balloon-pos="left"
                        data-balloon="<?= Yii::t('main', 'Подтвердить получение') ?>" type="button">
                  <span class="glyphicon glyphicon-ok" style="padding: 10px 6px;"></span>
                </button>
              </form>
            <? } ?>
          <form action="<?= Yii::app()->createUrl('/tools/question', ['order', $order->id]) ?>">
            <button class="btn btn-info pull-right" data-balloon-pos="left"
                    data-balloon="<?= Yii::t('main', 'Обратиться в службу поддержки') ?>" type="button">
              <span class="glyphicon glyphicon-edit" style="padding: 10px 6px;"></span>
            </button>
          </form>

        </div>
      </div><!--!-->
    </div>

      <? /*****************************************************************************/ ?>
      <? /*  Если нужно(!) у клиента недостаточно средств на счете - сообщим клиенту  */ ?>
      <? /*                О необходимости пополнить счет                             */ ?>
      <? /*****************************************************************************/ ?>
      <? if ($paymentNeeded) { ?>
        <div class="f-space20"></div>
        <div class="payment-error">
          <div class="alert alert-danger" style="color: red;">
            <h4> <?= Yii::t('main', 'Внимание') ?> !</h4>
            <p>
                <?= Yii::t('main', 'На Вашем счету недостаточно средств для оплаты заказа') ?><br/>
                <?= Yii::t('main', 'Вам необходимо пополнить счёт!') ?>
              <a href="#accordion-paysystem" class="btn btn-danger btn-lg active pull-right" role="button"
                 onclick="OpenCollapse()"
                 style="position: relative; top: -20px;">
                  <?= Yii::t('main', 'Способ оплаты') ?>
              </a>
            </p>
          </div>
        </div>
      <? } ?>
      <? /* ******************************************************************** */ ?>
  </div><!--End:Col-->
</div><!-- /row -->
<div class="f-space20"></div>
</div><!-- /container-->
<script>
    function OpenCollapse() {
        $('#accordion-paysystem-items').addClass(' in');
    }
</script>