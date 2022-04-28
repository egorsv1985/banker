<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="EasyCheckoutBlockOrderForParcel.php">
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
        <div class="box-heading"><span><?= Yii::t('main', 'СТОИМОСТЬ ЗАКАЗА') ?></span></div>
        <!-- Cart Summary -->
        <div class="box-content cart-box-wr">
          <div class="cart-box-tm">
            <div class="tm1"><?= Yii::t('main', 'Стоимость товаров в заказе') ?></div>
            <div class="tm2"><?= Formulas::priceWrapper($this->cart->total) ?></div>
          </div>

          <div class="cart-box-tm">
            <div class="tm1"><?= Yii::t('main', 'Стоимость доставки до склада') ?></div>
            <div class="tm2"> <? if (DSConfig::getVal('checkout_delivery_sum_needed') != 1) {
                    echo Yii::t('main', 'рассчитывается по фактическому весу заказа при получении');
                    $deliverySumm = 0;
                } else {
                    if (!isset($this->delivery) || !$this->delivery) {
                        $deliverySumm = 0;
                    } else {
                        $deliverySumm = $this->delivery->summ; //Стоимость доставки в валюте сайта
                    }
                    echo Formulas::priceWrapper(
                      Formulas::convertCurrency(
                        $deliverySumm,
                        DSConfig::getVal('site_currency'),
                        DSConfig::getCurrency()
                      )
                    );
                }
                ?>
            </div>
          </div>
          <div class="cart-box-tm">
            <div class="tm3 bgcolor2"><?= Yii::t('main', 'Итого') ?></div>
            <div class="tm4 bgcolor2"><?= Formulas::priceWrapper(
                  (float) $this->cart->total + (float) Formulas::convertCurrency(
                    $deliverySumm,
                    DSConfig::getVal('site_currency'),
                    DSConfig::getCurrency()
                  )
                ) ?>
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
              'action'                 => Yii::app()->createUrl('checkout/easy', $actionParams),
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
          <? // ================= ДОЗАКАЗ ========================================================================================?>

          <? if ($this->ordersForReorder && $this->ordersForReorder->getTotalItemCount() > 0) { ?>
            <div class="panel panel-default">
                <? include_once __DIR__ . '/EasyCheckoutPanelReorder.php' ?>
            </div>
          <? } ?>
          <? // ================= РЕГИСТРАЦИЯ ====================================================================================?>
        <div class="panel panel-default">
            <? include_once __DIR__ . '/EasyCheckoutPanelRegister.php' ?>
        </div>
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
                  <!--<h4>Проверте состав заказа и его вес.</h4>-->
                    <? foreach ($this->cart->cartRecords as $k => $item) { ?>
                        <? $this->widget(
                          'application.components.widgets.OrderItem',
                          [
                            'easyCheckout' => true,
                            'orderItem'    => $item,
                            'readOnly'     => false,
                            'allowDelete'  => false,
                            'onChange'     => "itemsChanged();",
                            'imageFormat'  => '_200x200.jpg',
                            'view'         => 'themeBlocks.OrderItem.OrderItemEasyCheckOut',
                          ]
                        ); ?>
                    <? } ?>
                    <? /**************************************************************************************/ ?>
                  <div class="next-btn" style="position: relative; top:-20px;">
                    <input type="submit" value="<?= Yii::t('main', 'Сохранить изменения') ?>"
                           name="action[weight]" role="button" style="position: relative; top:10px;"
                           class="btn brn-danger color2 pull-right"
                    />
                  </div>
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