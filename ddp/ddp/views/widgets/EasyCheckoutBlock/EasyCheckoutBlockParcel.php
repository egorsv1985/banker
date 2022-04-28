<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="EasyCheckoutBlockParcel.php">
 * </description>
 * Виджет переключателя валют фронта сайта
 * $currency = cny - текущая выбранная валюта
 **********************************************************************************************************************/
?>
<? $post = $this->post; ?>
  <div class="row clearfix f-space10"></div>
  <div class="container">
    <!-- row -->
    <div class="row">
      <!--  LEFT-COLUMN -->
      <!-- side bar -->
      <div class="col-md-3 col-sm-12 col-xs-12 box-block page-sidebar">
        <div class="box-heading"><span><?= Yii::t('main', 'СТОИМОСТЬ ПОСЫЛКИ') ?></span></div>
        <!-- Cart Summary -->
        <div class="box-content cart-box-wr">
          <div class="cart-box-tm">
            <div class="tm1"><?= Yii::t('main', 'Стоимость товаров в посылке') ?></div>
            <div class="tm2"><?= Formulas::priceWrapper($this->cart->cartLotsPrice) ?></div>
          </div>

          <div class="cart-box-tm">
            <div class="tm1"><?= Yii::t('main', 'Вес посылки') ?></div>
            <div class="tm2"> <?= Formulas::weightWrapper($this->cart->cartWeight); ?>
            </div>
          </div>
          <div class="cart-box-tm">
            <div class="tm3 bgcolor2"><?= Yii::t('main', 'Стоимость доставки') ?></div>
            <div class="tm4 bgcolor2"><?
                $deliverySumm = $this->cart->total;
                if (is_null($deliverySumm)) {
                    echo Yii::t('main', 'Доставка не выбрана');
                } else {
                    echo Formulas::priceWrapper(
                      (float) Formulas::convertCurrency(
                        $deliverySumm,
                        DSConfig::getVal('site_currency'),
                        DSConfig::getCurrency()
                      )
                    );
                }
                ?>
            </div>
          </div>
        </div>
          <? // Сообщение о недостатке средств ?>
          <? if ($this->user == null) { //todo: а еще здесь наверно стоит проверить войденный юзверь или нет ??? ?>
              <?= '<br /><div class="alert alert-info">'; ?>
              <?= Yii::t('main', 'Вы еще не зарегистрированы на сайте'); ?>
              <?= '</div>'; ?>
          <? } else { ?>

          <? } ?>
          <? $userBallance = Users::getBalance(Yii::app()->user->id);
          if (isset($userBallance)) {
              //echo Users::getUser(Yii::app()->user->id);
              //echo Yii::app()->user->id;
              //echo $userBallance . '12431241241';
          } else {
              //echo ('1234');
          }
          $paymentSumm = Formulas::convertCurrency(
            $this->cart->total,
            DSConfig::getCurrency(),
            DSConfig::getVal('site_currency')
          ) /*+ $deliverySumm*/
          ;
          if (DSConfig::getVal('checkout_order_reconfirmation_needed') == 0) { ?>
              <? if ($userBallance < $paymentSumm) { ?>
              <div class="alert alert-danger">
                <p><?= Yii::t('main', 'На вашем счету недостаточно средств для оплаты заказа') ?></p>
                <p><?= Yii::t('main', 'Вам необходимо пополнить счёт на') ?> <strong>
                        <?= Formulas::priceWrapper(
                          Formulas::convertCurrency(
                            $paymentSumm - $userBallance,
                            DSConfig::getVal('site_currency'),
                            DSConfig::getCurrency()
                          )
                        ) ?></strong>
                </p>
              </div>
              <? } ?>
          <? } ?>
      </div><!-- end:Col -->
        <? // Разделение левого и правого полей ?>
        <? /*===============================================================================================================*/ ?>
        <? // Разделение правого и левого полей ?>

      <div class="col-md-9 col-sm-12 col-xs-12 main-column box-block page-sidebar">

          <?
          if ($this->item_iid) {
              $actionParams = ['item' => $this->item_iid];
          } else {
              $actionParams = [];
          }
          $form = $this->beginWidget(
            'CActiveForm',
            [
              'id'                     => 'form-easy-checkout',
              'enableAjaxValidation'   => false,
              'enableClientValidation' => false,
              'method'                 => 'post',
              'action'                 => Yii::app()->createUrl('checkout/easyParcel', $actionParams),
                /* 'htmlOptions'            => array(
              'onsubmit' => "return false;",// Disable normal form submit
            ),
            */
              'clientOptions'          => [
                'validateOnType'   => false,
                'validateOnSubmit' => false,
              ],
            ]
          ); ?>
          <? // ================= АДРЕС ==========================================================================================?>
        <div class="panel panel-default">
            <? include_once __DIR__ . '/EasyCheckoutPanelAddress.php' ?>
        </div>
          <? // ============= СПОСОБ ДОСТАВКИ ================================================================================?>
          <? if (DSConfig::getVal('checkout_delivery_needed') == 1) { ?>
            <div class="panel panel-default">
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
              <div class="panel-collapse collapse" id="anchor-delivery">
                <div class="panel-body">
                  <div class="row co-row">
                    <div class="row"></div>
                      <? if (is_array($this->deliveries) && (count($this->deliveries) > 0)) {
                          $checkout_weight_needed = DSConfig::getVal('checkout_weight_needed') == 1;
                          $i = 1;
                          foreach ($this->deliveries as $delivery) { ?>
                            <div class="col-md-12">
                              <label>
                                <input type="radio" name="easyCheckout[delivery]"
                                       onclick="extSubmit('anchor-delivery');"
                                  <? if ($this->post &&
                                    isset($this->post['easyCheckout']['reorder']) &&
                                    $this->post['easyCheckout']['reorder']) {
                                      echo 'disabled';
                                  }
                                  ?>
                                  <? if (($this->post &&
                                      isset($this->post['easyCheckout']['delivery']) &&
                                      $this->post['easyCheckout']['delivery'] == $delivery->id)
                                    ||
                                    (($i == 1) &&
                                      (empty($this->post) || !isset($this->post['easyCheckout']['delivery'])))
                                  ) {
                                      echo 'checked';
                                  } ?>
                                       value="<?= $delivery->id ?>"/>
                                  <?= Yii::t('main', $delivery->name) ?>
                                  <? /* if ($delivery->summ > 0 && $checkout_weight_needed) {
                                            echo ': ' . Formulas::priceWrapper(
                                                Formulas::convertCurrency(
                                                  $delivery->summ,
                                                  DSConfig::getVal('site_currency'),
                                                  DSConfig::getCurrency()
                                                )
                                              );
                                        } */ ?>
                              </label>
                              <div class="hint"
                                   style="padding-left: 40px; color: #00BCFF; padding-bottom: 8px; padding-top: 8px; background-color: #EAEAEA">
                                  <?= Yii::t('main', $delivery->description) ?>
                              </div>
                            </div><!--End:col-->
                              <? $i++;
                          } ?>
                      <? } else { ?>
                        <div class="alert alert-danger">
                            <?= Yii::t(
                              'main',
                              'К сожалению, доставка в выбранную Вами страну или регион с указанными Вами параметрами временно не производится.'
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
                  </div><!--End:Row-->
                  <!-- end: Register -->

                </div>
              </div>
            </div>
            <!--</div>-->
          <? } ?>
          <? //====== ОПЛАТА =====================================================================================================?>
          <? // НЕ выводим заказ и оплату, если пользователь не авторизован и нет вобще никакого адреса
          // (обычно это делается на этапе выбора адреса) ?>
          <? if (!Yii::app()->user->id) { ?>
            <div class="payment-error">
              <div class="alert alert-danger">
                <strong><?= Yii::t(
                      'main',
                      'Для оплаты заказа вам необходимо, как минимум'
                    ) ?></strong>,
                <a style="font-size: 120%; color: deeppink; text-decoration: none; "
                   href="#anchor-address"><?= Yii::t('main', 'указать email и пароль') ?></a>!
              </div>
            </div>
          <? } elseif (!$this->address) { ?>
            <div class="payment-error">
              <div class="alert alert-danger">
                  <?= Yii::t(
                    'main',
                    'Для получения заказа вам необходимо, как минимум'
                  ) ?>, <a href="#anchor-address"><?= Yii::t(
                        'main',
                        'указать адрес, по которому он будет доставлен'
                      ) ?></a>!
              </div>
            </div>

          <? } else { ?>

            <div class="panel panel-default"> <!-- add class disabled to prevent from clicking -->
                <? include_once __DIR__ . '/EasyCheckoutPanelPayment.php' ?>
            </div>
          <? } ?>
          <? //========== ВЕС ЛОТОВ (ТОВАРЫ В ЗАКАЗЕ) ============================================================================?>
        <div class="panel panel-default"> <!-- add class disabled to prevent from clicking -->
          <div class="panel-heading closed" data-parent="#checkout-options" data-target="#anchor-items"
               data-toggle="collapse">
            <h4 class="panel-title" id="title-items"><a href="#a"> <span
                    class="fa fa-check"></span> <?= Yii::t(
                      'main',
                      'Товары в заказе'
                    ) ?>
              </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-right"
                                                                   aria-hidden="true"></i></span></h4>
          </div>
          <div class="panel-collapse collapse" id="anchor-items">
            <div class="panel-body">
              <div class="row co-row">
                <div class="box-content form-box">
                    <?
                    $this->widget(
                      'booster.widgets.TbGridView',
                      [
                        'id'              => 'checkoutParcel-grid',
                        'type'            => 'striped',
                        'dataProvider'    => $this->cart->cartRecordsDataProvider,
                        'enableSorting'   => false,
                        'ajaxUpdate'      => true,
                        'afterAjaxUpdate' => "function () {
                                             $('img.lazy').show().lazyload({                                           
                                             effect: 'fadeIn',
                                             effect_speed: 500,
                                             skip_invisible: false,
                                             threshold: 200
                                             });}",
                        'template'        => '{summary}{pager}{items}{pager}',
                        'summaryText'     => Yii::t('main', 'Лоты') . ' {start}-{end} ' . Yii::t(
                            'main',
                            'из'
                          ) . ' {count}',
                          //'htmlOptions'      => array('style' => 'cursor: pointer;'),
                          /*                        'selectionChanged' => "function(id){window.location='"
                                                    . Yii::app()->urlManager->createUrl('/cabinet/orders/view') . "/id/' +
                                    $.fn.yiiGridView.getSelection(id);}",
                          */
                        'columns'         => [
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
                                    'renderType'  => 'order',//$userCart->type
                                    'orderItem'   => $data,
                                    'readOnly'    => true,
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
                </div>
              </div>
            </div>
          </div>
        </div>
          <? //====== КОММЕНТАРИЙ ================================================================================================?>
        <div class="panel panel-default"> <!-- add class disabled to prevent from clicking -->
            <? include_once __DIR__ . '/EasyCheckoutPanelComment.php' ?>
        </div>

          <? // Таблица итоговой стоимости заказа ?>
          <? //=================================================================================================================?>
        <!-------------------------------------------------------->
        <div class="xyz-buuton pull-right" style="position: relative; display: inline-flex;">
            <? $userBallance = Users::getBalance(Yii::app()->user->id);
            $paymentSumm = Formulas::convertCurrency(
              $this->cart->total,
              DSConfig::getCurrency(),
              DSConfig::getVal('site_currency')
            ) /*+ $deliverySumm*/
            ;
            if (DSConfig::getVal('checkout_order_reconfirmation_needed') == 0) { ?>

                <? if ($userBallance < $paymentSumm) { ?>
                <div class="alert alert-danger" style="position: relative;bottom: 28px;right: 25px;">
                  <p><?= Yii::t('main', 'На вашем счету недостаточно средств для оплаты заказа') ?></p>
                  <p><?= Yii::t('main', 'Вам необходимо пополнить счёт на') ?>
                      <?= Formulas::priceWrapper(
                        Formulas::convertCurrency(
                          $paymentSumm - $userBallance,
                          DSConfig::getVal('site_currency'),
                          DSConfig::getCurrency()
                        )
                      ) ?>
                  </p>
                </div>
                    <? if (!is_null(
                      $this->user
                    )
                    ) { //todo: а еще здесь наверно стоит проверить войденный юзверь или нет ??? ?>
                  <br/>
                  <input value='<?= Yii::t('main', 'Пополнить счёт') ?>'
                         onclick="location.href='<?= Yii::app()->createUrl(
                           '/cabinet/balance/payment',
                           [
                             'sum' => $paymentSumm - $userBallance,
                             'r'   => '/checkout/payment',
                           ]
                         ) ?>'" class="btn btn-danger color2 pull-right" role="button"
                         style="position: relative;" type='button'/>
                    <? } ?>

                <? } else { ?>
                <div class="next-btn">
                  <input type="submit" id="payment_button" name="action[payment]"
                         value="<?= Yii::t('main', 'Оплатить') ?>"
                         class=" btn btn-danger blue-btn bigger pull-right"/>
                </div>
                <? } ?>
                <? $checkout_payment_needed = DSConfig::getVal('checkout_payment_needed') == 1;
                if (!$checkout_payment_needed) {
                    ?>
                    <? if (!is_null(
                      $this->user
                    )
                    ) { //todo: а еще здесь наверно стоит проверить войденный юзверь или нет ??? ?>
                    <div class="next-btn color2" style="padding-left: 10px;">
                      <input type="submit" id="nopayment_button" name="action[noPayment]"
                             value="<?= Yii::t('main', 'Оплатить позже') ?>"
                             class="btn btn-danger pull-right" role="button"/>
                    </div>
                    <? }
                }
            } else { ?>
              <div class="next-btn" style="padding-left: 10px;">
                <input type="submit" id="nopayment_button" name="action[noPayment]"
                       value="<?= Yii::t('main', 'Оформить заказ') ?>"
                       class="btn btn-danger blue-btn bigger pull-right"/>
              </div>
            <? } ?>
        </div>

        <div id="total-block-refresh" style="display:none">
          <div class="alert alert-warning">
              <?= Yii::t('main', 'В параметрах заказа произошли изменения') ?>,
            <br/><?= Yii::t('main', 'нажмите кнопку "сохранить изменения"') ?>
            <br/><?= Yii::t('main', 'для пересчета стоимости заказа') ?>
          </div>
          <div class="next-btn">
            <input type="submit" value="<?= Yii::t('main', 'Сохранить изменения') ?>"
                   name="action[weight]"
                   class="btn btn-info red-btn bigger pull-right"/>
          </div>
        </div>

        <!-------------------------------------------------------->

        <div class="clear" style="height: 30px;"></div>
          <? //===================================================================================================================?>
          <? $this->endWidget('CActiveForm'); ?>

      </div><!--End:Col-->
    </div><!--End:Row-->
  </div><!--End:Container-->
  <div class="row clearfix f-space10"></div>
<? include_once __DIR__ . '/EasyCheckoutScript.php' ?>