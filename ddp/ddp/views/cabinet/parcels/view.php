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
$parcelWeight =
  (isset($parcel->manual_weight) && is_numeric($parcel->manual_weight)) ? $parcel->manual_weight : $parcel->weight;

// $parcelSum - стоимость заказа
if (is_numeric($parcel->manual_sum)) {
    $parcelSum = $parcel->manual_sum;
} else {
    $parcelSum = $parcel->sum;
}

// Стоимость товаров в текущей валюте
$parcelSumCurr = Formulas::convertCurrency(
  $parcelSum,
  DSConfig::getVal('site_currency'),
  DSConfig::getCurrency(),
  false,
  $parcel->date
);
// Оплачено по заказу
$payed = round(ParcelsPayments::getPaymentsSumForParcel($parcel->id), 2);
// Оплачено ли хоть что-то
$paymentCreated = $payed > 0;
// Стоимость заказа
$pay = round($parcelSum, 2);
// Сумма необходимого платежа в текущей валюте
$paymentSumm = Formulas::priceWrapper(
  Formulas::convertCurrency(
    $parcelSum - ParcelsPayments::getPaymentsSumForParcel($parcel->id),
    DSConfig::getVal('site_currency'),
    DSConfig::getCurrency(),
    false,
    $parcel->date
  )
);
// Нужен ли вобще платёж
$paymentNeeded = $parcelSum - ParcelsPayments::getPaymentsSumForParcel(
    $parcel->id
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
    <div class="col-md-9 col-sm-12 col-xs-12 main-column box-block page-sidebar">
        <? /*****************************************************************************/ ?>
        <? /*  Если нужно оплатить или требуется доплата - сообщим клиенту об этом      */ ?>
        <? /*****************************************************************************/ ?>
        <? if ((($pay > $payed) && (abs($pay - $payed) > 1))
          && (
            ($checkout_order_reconfirmation_needed && is_numeric($order->manual_sum))
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
                'товаров и (или) доставки, для посылки'
              ) ?>
            <b>№<?= $parcel->uid . '-' . $parcel->id ?></b><br/>
              <?= Yii::t('main', 'Вам необходимо оплатить или доплатить') ?>&nbsp;
            <span style="font-size: 120%;color: red; font-weight: bold;"><?=
                Formulas::priceWrapper(
                  Formulas::convertCurrency(
                    $parcelSum - ParcelsPayments::getPaymentsSumForParcel($parcel->id),
                    DSConfig::getVal('site_currency'),
                    DSConfig::getCurrency(),
                    false,
                    $parcel->date
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
              <span class="fa fa-arrow-right"></span>
              <span><?= Yii::t('main', 'Посылка') ?>
                                &nbsp;ID:&nbsp;<?= $parcel->uid . '-' . $parcel->id ?></span>
            </h4>
          </div>
        </div>
        <table class="table table-striped">

          <tr>
            <th><?= Yii::t('main', 'Дата заказа') ?>:</th>
            <td><?= date('d.m.Y H:i', $parcel->date) ?></td>
          </tr>
            <? if ($parcel->extstatuses) { ?>
              <tr>
                <th><?= Yii::t('main', 'Статус заказа') ?>:</th>
                <td class="select"><?= $parcel->statuses->name . ' (' . $parcel->extstatuses . ')' ?></td>
              </tr>
                <?
            } else {
                ?>
              <tr>
                <th><?= Yii::t('main', 'Статус заказа') ?>:</th>
                <td class="select"><?= Yii::t('main', $parcel->statuses->name) ?></td>
              </tr>
            <? } ?>
            <? if ($parcel->code) { ?>
              <tr>
                <th><?= Yii::t('main', 'Трекинг посылки') ?>:</th>
                <td class="select"><?
                    if ($parcel->code) {
                        if (preg_match('/^http/is', $parcel->code)) {
                            echo "<a href='{$parcel->code}' target='_blank'>{$parcel->code}</a>";
                        } else {
                            echo $parcel->code;
                        }
                    } else {
                        echo Yii::t('main', 'не получен');
                    }
                    ?>
                </td>
              </tr>
            <? } else { ?>
                <? if (count($parcel->parcelsItemsLegend) > 0) { ?>
                <th><?= Yii::t('admin', 'Статусы лотов') ?>:</th>
                <td class="select">
                    <? foreach ($parcel->parcelsItemsLegend as $itemStatus) { ?>
                      <span style="<?= $itemStatus['excluded'] ? 'color:red;' : '' ?>"><?= Yii::t(
                            'main',
                            $itemStatus['name']
                          ) ?></span>: <?= $itemStatus['cnt'] ?>&nbsp;
                    <? } ?>
                </td>
                <? } ?>
            <? } ?>
          <tr>
            <th><?= Yii::t('main', 'Сумма за доставку') ?>:</th>
            <td class="select">
                <? if (DSConfig::getVal('source_show_old_price')) {
                    if (is_numeric($parcelSum)) {
                        echo Formulas::priceWrapper(
                          Formulas::convertCurrency(
                            $parcelSum,
                            DSConfig::getVal('site_currency'),
                            DSConfig::getCurrency(),
                            false,
                            $parcel->date
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
            <td class="select"><?
                if (is_numeric($parcelSum)) {
                    echo Formulas::priceWrapper(
                      Formulas::convertCurrency(
                        $parcelSum,
                        DSConfig::getVal('site_currency'),
                        DSConfig::getCurrency(),
                        false,
                        $parcel->date
                      )
                    );
                } else {
                    echo Yii::t('main', 'не рассчитано');
                }
                ?>
                <? if (is_numeric($parcelSum) && (DSConfig::getVal('rates_use_currency_log') == 1)) { ?>
                  &nbsp;<span style="font-size: small"><?= Yii::t('main', 'по курсу на') . ' ' . date(
                          'd.m.Y',
                          $parcel->date
                        ) ?></span>
                <? } ?>
            </td>
          </tr>
            <? if (in_array($parcel->statuses->value, ['CANCELED_BY_CUSTOMER', 'CANCELED_BY_SERVICE'])) { ?>
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
            'type'     => 'parcels',
            'orderId'  => $parcel->id,
            'pageSize' => 5,
          ]
        );
        ?>
        <? $this->widget(
          'application.components.widgets.EventsBlock',
          [
            'subjectId'    => $parcel->id,
            'eventsType'   => '^Parcels\.|^ParcelsItems\.',
            'pageSize'     => 1000,
            'showInternal' => false,
            'filter'       => "(t.event_name in (
                    'Parcels.beforeUpdate.status',
                    'Parcels.beforeUpdate.manager',
                    'Parcels.beforeUpdate.manual_weight'
                    'Parcels.beforeUpdate.delivery_id',
                    'Parcels.beforeUpdate.code',
                    'Parcels.afterInsert.created',
                    'ParcelsItems.beforeUpdate.status',
                    'ParcelsItems.beforeUpdate.tid',
                    'ParcelsItems.beforeUpdate.track_code',
                    'ParcelsItems.beforeUpdate.actual_num',
                    'ParcelsItems.beforeUpdate.actual_lot_price',
                    'ParcelsItems.beforeUpdate.actual_lot_weight'
                    ))",
          ]
        );
        ?>
        <? $this->widget(
          'application.components.widgets.OrderCommentsBlock',
          [
            'parcelId'    => $parcel->id,
            'orderId'     => false,
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
               data-target="#collapseParcelItem">
            <h4 class="panel-title">
              <span class="fa fa-arrow-right"></span>
              <a href="#accordion111">
                  <?= Yii::t('main', 'Товары в посылке') ?>
                : <?= count($parcel->parcelsItems) ?>
              </a>
            </h4>
          </div>
          <div id="collapseParcelItem" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="f-space10"></div>
                <? foreach ($parcel->parcelsItems as $item) { ?>
                    <?
                    echo Yii::app()->controller->widget(
                      'application.components.widgets.ParcelsItem',
                      [
                        'renderType'  => 'parcel',//$userCart->type
                        'orderItem'   => $item,
                        'readOnly'    => true,
                        'imageFormat' => '_200x200.jpg',
                      ],
                      true
                    );

                    /*
                    $this->widget(
                      'application.components.widgets.OrderItem',
                      array(
                        'orderItem'      => $item,
                        'readOnly'       => true,
                        'allowDelete'    => false,
                        'publicComments' => true,
                        'imageFormat'    => '_200x200.jpg',
                      )
                    );
                    */ ?>
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
               data-target="#collapseParcelItemDeliv">
            <h4 class="panel-title">
              <span class="fa fa-arrow-right"></span>
              <a href="#accordion2" class="collapsed">
                  <?= Yii::t('main', 'Информация о доставке') ?>
              </a>
            </h4>
          </div>
          <div id="collapseParcelItemDeliv" class="panel-collapse collapse">
            <div class="panel-body">
                <? /**************************************************************/ ?>
              <table class="delivery-desc table table-striped">
                <tr>
                  <th><?= Yii::t('main', 'Вес посылки') ?>:</th>
                  <td><?= $parcelWeight ? Formulas::weightWrapper($parcelWeight) : Yii::t(
                        'main',
                        "рассчитывается..."
                      ) ?></td>
                </tr>
                  <?
                  if (DSConfig::getVal('source_show_old_price')
                    ||
                    Yii::app()->user->inRole(['manager', 'orderManager', 'parcelManager', 'topManager', 'superAdmin'])
                  ) { ?>
                    <tr>
                      <th><?= Yii::t('main', 'Сумма за доставку') ?>:</th>
                      <td>
                          <? if ($parcelSum > 0) { ?>
                              <?=
                              Formulas::priceWrapper(
                                Formulas::convertCurrency(
                                  $parcelSum,
                                  DSConfig::getVal('site_currency'),
                                  DSConfig::getCurrency(),
                                  false,
                                  $parcel->date
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
                          if ($parcel->code) {
                              if (preg_match('/^http[s]*/is', $parcel->code)) {
                                  echo "<a href='{$parcel->code}' target='_blank'>{$parcel->code}</a>";
                              } else {
                                  echo $parcel->code;
                              }
                          } else {
                              echo Yii::t('main', 'не получен');

                          }
                          ?></td>
                    </tr>
                    <tr>
                      <th><?= Yii::t('main', 'Дата отправки') ?>:</th>
                        <? if ($parcel->status == 'SEND_TO_CUSTOMER') {
                            //TODO: в эту функцию добавить тип объекта
                            $lastEvent = EventsLog::getLastEventForSubj($parcel->id, 'Parcels.beforeUpdate.status');
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
                      <?php $delivery = Deliveries::getDelivery(0, false, $parcel['delivery_id']);
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
                      <? if ($parcel->addresses) { ?>
                          <?=
                          Deliveries::getCountryName(
                            $parcel->addresses['country']
                          ) ?>, <?= $parcel->addresses['index'] ?>, <?= $parcel->addresses['city'] ?>, <?= $parcel->addresses['address'] ?>.
                          <?= $parcel->addresses['fullname'] ?>
                          <?= $parcel->addresses['phone'] ?>
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
          ($checkout_order_reconfirmation_needed && is_numeric($parcel->manual_sum))
          || !$checkout_order_reconfirmation_needed)
        ) {
        ?>

      <!--<div style="padding: 10px 10px;"></div>-->
    <? //==== Выбор способа оплаты ================================ ?>
      <div class="panel-group" id="accordion-paysystem">
        <div class="panel panel-default">
          <div class="panel-heading closed" data-parent="#accordion-paysystem"
               data-target="#accordion-paysystem-items" data-toggle="collapse">
            <h4 class="panel-title">
              <i class="fa fa-arrow-right"></i>
              <a href="#accordion-paysystem" class="collapsed">
                  <?= Yii::t('main', 'Выбор способа пополнения счета') ?>
              </a>
            </h4>
          </div>

            <? /*
                <div class="panel-heading closed" data-parent="#checkout-options" data-target="#anchor-delivery"
                     data-toggle="collapse">
                    <h4 class="panel-title" id="title-delivery">
                        <a href="#a">
                            <span class="fa fa-truck"></span>
                            <? if (isset($this->delivery) && $this->delivery) { ?>
                                <?= Yii::t('main', 'Cпособ доставки') ?>: <?= $this->delivery->name ?>

                            <? } else { ?>
                                <?= Yii::t('main', 'Выберете способ доставки') ?>
                            <? } ?>
                        </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-right"
                                                                             aria-hidden="true"></i></span></h4>
                </div>
              */ ?>

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
                  //TODO: Тут возможно нужно делать новый контроллер или указывать, что платим за посылку!
                  var payLocationBase = '<?=Yii::app()->createUrl('/cabinet/balance/order', []) ?>';
                  var payLocationOrder = '/pid/<?=$parcel->id?>';
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
    <? /*
            <div class="panel-group" id="accordion3">
                <div class="panel panel-default">
                    <div class="panel-heading" data-target="#collapseParcelSum" data-toggle="collapse">
                        <h4 class="panel-title"><?= Yii::t('main', 'Стоимость заказа') ?></h4>
                    </div>
                </div>
                <div class="panel-collapse collapse in" id="collapseParcelSum">
                    <div class="panel-body">
                        <div class="delivery-desc table table-striped" style="margin-bottom: 0 !important;">
                            <table class="table table-striped">

                                <? if (in_array($parcel->statuses->value, array('CANCELED_BY_CUSTOMER', 'CANCELED_BY_SERVICE'))) { ?>
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
                */ ?>
    <? /*****************************************************/ ?>
    <? /*
                    </div><!--End:Panel-body-->
                </div><!--End:Panel-collapse-->
            </div><!--End:Panel-->
            */ ?>
    <? /*****************************************************/ ?>
      <div class="two-btn row">
        <div class="col-md-12">
          <button id="payment_button" data-balloon-pos="left" data-balloon="<?= Yii::t('main', 'Оплатить сейчас') ?>"
                  onclick="location.href=payLocationBase+payLocationOrder+payLocationPaySystem"
                  class="btn btn-danger" type="button" role="button">
            <span class="glyphicon glyphicon-thumbs-up" style="padding: 10px 9px;"></span>
          </button>
            <? } ?><!--End: If -->
            <? /*****************************************************/ ?>
            <? /*                  Другие кнопки                    */ ?>
            <? /*****************************************************/ ?>
            <? if (ParcelsStatuses::isAllowedStatusForParcel(
                'CANCELED_BY_CUSTOMER',
                $parcel->id,
                Yii::app()->user->id,
                null
              )
              &&
              !in_array(
                $parcel->statuses->value,
                [
                  'CANCELED_BY_CUSTOMER',
                  'CANCELED_BY_SERVICE',
                  'SEND_TO_CUSTOMER',
                  'RECEIVED_BY_CUSTOMER',
                ]
              )
            ) { ?>
              <form action="<?= Yii::app()->createUrl(
                '/cabinet/parcels/delete',
                ['pid' => $parcel->id]
              ) ?>">
                <button class="btn btn-default" data-balloon-pos="left"
                        data-balloon="<?= Yii::t('main', 'Отменить заказ') ?>"
                        style="border: 1px solid #c9302c;">
                  <span class="glyphicon glyphicon-remove" style="color: red;padding: 10px 8px;"></span>
                </button>
              </form>
            <? } ?>
            <? if (ParcelsStatuses::isAllowedStatusForParcel(
                'RECEIVED_BY_CUSTOMER',
                $parcel->id,
                Yii::app()->user->id,
                null
              )
              && (!ParcelsStatuses::isAllowedStatusForParcel(
                  'CANCELED_BY_CUSTOMER',
                  $parcel->id,
                  Yii::app()->user->id,
                  null
                ) || Yii::app()->user->inRole('superAdmin'))
              && !in_array(
                $parcel->statuses->value,
                ['CANCELED_BY_CUSTOMER', 'CANCELED_BY_SERVICE', 'RECEIVED_BY_CUSTOMER']
              )
            ) { ?>
              <form action="<?= Yii::app()->createUrl(
                '/cabinet/parcels/received',
                ['pid' => $parcel->id]
              ) ?>">
                <button class="btn btn-success" data-balloon-pos="left"
                        data-balloon="<?= Yii::t('main', 'Подтвердить получение') ?>">
                  <span class="glyphicon glyphicon-ok" style="padding: 10px 9px;"></span>
                </button>
              </form>
            <? } ?>
            <? /*
                        <form action="<?= Yii::app()->createUrl('/tools/question',array('order',$order->id)) ?>">
                            <button style="float:right; padding: 14px"
                                    class="btn btn-primary blue-btn bigger"><?= Yii::t(
                                  'main',
                                  'Обратиться в службу поддержки'
                                ) ?></button>
                        </form>
                         */ ?>
        </div>
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