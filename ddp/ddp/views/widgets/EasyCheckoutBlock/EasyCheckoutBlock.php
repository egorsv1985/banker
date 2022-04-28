<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="EasyCheckoutBlock.php">
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
          <div class="tm1"><?= Yii::t('main', 'Стоимость доставки заказа') ?></div>
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

        <!--
        <div class="cart-box-tm">
            <div class="tm1">Итого</div>
            <div class="tm2">$54.00</div>
        </div>
        -->
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
        <? //  Сообщение о недостатке средств ?>
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
                <? /*
                    <br />
                    <input value='<?= Yii::t('main', 'Пополнить счёт') ?>'
                       onclick="location.href='<?= Yii::app()->createUrl(
                         '/cabinet/balance/payment', array(
                           'sum' => $paymentSumm - $userBallance,
                           'r'   => '/checkout/payment'
                         )
                       ) ?>'" class="btn btn-danger color2 pull-right" role="button"
                       style="position: relative;" type='button'/>
                    */ ?>
            <? } ?>
        <? } ?>
    </div><!-- end:Col -->

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
            <div class="panel-heading closed" data-parent="#checkout-options" data-target="#op2"
                 data-toggle="collapse">
              <h4 class="panel-title">
                <a href="#a">
                  <span class="fa fa-map-marker"></span>
                    <?= Yii::t('main', 'Дозаказ') ?>
                </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-down"
                                                                     aria-hidden="true"></i></span>
              </h4>
            </div>
            <div class="panel-collapse collapse" id="op2">
              <div class="panel-body">
                <div class="row co-row">

                  <!------------------------------------->
                    <? /* $form = $this->beginWidget(
                                  'CActiveForm',
                                  array(
                                    'id' => 'form-easy-checkout',
                                    'enableAjaxValidation' => false,
                                    'enableClientValidation' => false,
                                    'method' => 'post',
                                    'action' => Yii::app()->createUrl('checkout/easy', array('item' => $this->item_iid)),
                                    'clientOptions' => array(
                                      'validateOnType' => false,
                                      'validateOnSubmit' => false,
                                    ),
                                  )
                                ); */ ?>
                  <!------------------------------------->
                  <div style="display: none;">
                    <input type="radio" name="easyCheckout[reorder]" value="0"
                           onclick="extSubmit('anchor-reorder');"
                           <? if (empty($this->post) || !isset($this->post['easyCheckout']['reorder']) ||
                           $this->post['easyCheckout']['reorder'] == 0) { ?>checked<? } ?> />
                  </div>
                  <!------------------------------------->

                    <? $this->widget(
                      'booster.widgets.TbGridView',
                      [
                        'id'            => 'orders-grid',
                        'dataProvider'  => $this->ordersForReorder,
                        'enableSorting' => false,
                        'pager'         => [
                          'header'         => '',
                          'firstPageLabel' => '&lt;&lt;',
                          'prevPageLabel'  => '&lt;',
                          'nextPageLabel'  => '&gt;',
                          'lastPageLabel'  => '&gt;&gt;',
                        ],
                        'template'      => '{summary}{items}{pager}',
                        'summaryText'   => Yii::t('main', 'Заказы') . ' {start}-{end} ' .
                          Yii::t('main', 'из') . ' {count}',
                        'columns'       => [
                          [
                            'name'  => 'id',
                            'type'  => 'raw', //$model->id
                            'value' => function ($data) use (&$post) {
                                $checked = '';
                                if ($post &&
                                  isset($post['easyCheckout']['reorder']) &&
                                  $post['easyCheckout']['reorder'] == $data->id) {
                                    $checked = ' checked';
                                }
                                echo '<input type="radio" name="easyCheckout[reorder]" onclick="extSubmit(\'anchor-reorder\');" value="' .
                                  $data->id .
                                  '"' .
                                  $checked .
                                  '/>' .
                                  $data->uid .
                                  '-' .
                                  $data->id;
                            },
                          ],
                          [
                            'header'      => Yii::t('main', 'Товары'),
                            'type'        => 'raw',
                            'value'       => 'Order::getOrderItemsPreview($data->id,"_60x60.jpg")',
                            'htmlOptions' => ['style' => 'min-width:110px;height:60px;padding:3px;'],
                          ],
                          [
                            'name'  => 'date',
                            'type'  => 'raw',
                            'value' => 'date("d.m.Y H:i",$data->date)',
                          ],
                          [
                            'name'  => 'sum',
                            'type'  => 'raw',
                            'value' => 'Formulas::priceWrapper(Formulas::convertCurrency($data->sum,DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
                          ],
                          [
                            'name'  => 'weight',
                            'type'  => 'raw',
                            'value' => '$data->weight',
                          ],
                          [
                            'name'  => 'delivery_id',
                            'type'  => 'raw',
                            'value' => '$data->delivery_id',
                          ],
                          [
                            'name'  => 'delivery',
                            'type'  => 'raw',
                            'value' => 'Formulas::priceWrapper(Formulas::convertCurrency($data->delivery,DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
                          ],
                          [
                            'header' => Yii::t('main', 'Итого'),
                            'type'   => 'raw',
                            'value'  => 'Formulas::priceWrapper(Formulas::convertCurrency($data->sum+$data->delivery,DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
                          ],
                        ],
                      ]
                    ); ?>
                </div>
              </div>
            </div>
          </div>
        <? } ?>

        <? // ================= АДРЕС ==========================================================================================?>
      <div class="panel panel-default">
        <div class="panel-heading  opened" data-parent="#checkout-options" data-target="#op2-1"
             data-toggle="collapse">
          <h4 class="panel-title"><a href="#a"> <span class="fa fa-envelope-o"></span>
                  <?= Yii::t('main', 'Адрес доставки') ?>
            </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-down"
                                                                 aria-hidden="true"></i></span></h4>
        </div>
        <div class="panel-collapse collapse in" id="op2-1">
          <div class="panel-body">
            <div class="row co-row">
              <!----------------------------------->
              <div class="payment-error" style="text-align: center; color: red; padding: 0;">
                  <? if (Yii::app()->user->id) { ?>
                    <div class="alert alert-danger"><span style="color: #00b4ff"><label><?= Yii::t(
                                  'main',
                                  'Ваш EMail'
                                ) ?>:</label> <?= $this->user->email ?></span></div>
                  <? } else { ?>
                <div class="alert alert-danger">
                  <h2><strong><?= Yii::t('main', 'Обратите внимание') ?>!</strong></h2>
                  <strong><?= Yii::t(
                        'main',
                        'Для оформления заказа необходимо, как минимум, указать email и пароль'
                      ) ?></strong>
                  <br/><br/>
                  <strong><?= Yii::t(
                        'main',
                        'и ввести свой адрес для доставки или выбрать из предложеных'
                      ) ?></strong>
                  </p>
                    <? } ?>
                </div>
                  <? if (count($this->addresses)) { ?>
                    <table class="cabinet-table">
                      <tr>
                        <th></th>
                        <th><?= Yii::t('main', 'Адрес') ?></th>
                        <th><?= Yii::t('main', 'Получатель') ?></th>
                        <th><?= Yii::t('main', 'Телефон') ?></th>
                      </tr>
                        <? $i = 1; ?>
                        <? foreach ($this->addresses as $address) { ?>
                          <tr>
                            <td style="padding-left: 25px;">
                              <input type="radio" name="easyCheckout[address]"
                                     onclick="extSubmit('anchor-address');"
                                <? if ($this->post &&
                                  isset($this->post['easyCheckout']['reorder']) &&
                                  $this->post['easyCheckout']['reorder']) {
                                    echo 'disabled';
                                }
                                ?>
                                <?
                                if (($this->post &&
                                    isset($this->post['easyCheckout']['address']) &&
                                    $this->post['easyCheckout']['address'] == $address['id'])
                                  ||
                                  (($i == 1) && (empty($this->post) || !isset($this->post['easyCheckout']['address'])))
                                ) {
                                    echo 'checked';
                                }
                                ?> value="<?= $address['id'] ?>"/>
                            </td>
                            <td><?= $address['country'] ?>
                              ,&nbsp;<?= $address['index'] ?>
                              ,&nbsp;<?= $address['address'] ?></td>
                            <td><?= $address['fullname'] ?></td>
                            <td><?= $address['phone'] ?></td>

                          </tr>
                            <? $i++; ?>
                        <? } ?>
                    </table>
                  <? } ?>
                  <? if (!($this->post &&
                    isset($this->post['easyCheckout']['reorder']) &&
                    $this->post['easyCheckout']['reorder'])) { ?>
                    <div class="row buttons pull-right">
                      <input type="button"
                             style="position: relative; margin-top: 10px; margin-bottom: 5px;"
                             value="<?= Yii::t('main', 'Новый адрес') ?>"
                             onclick="$('#newAddressDialog').modal('show');"
                             class="brn btn-danger red-btn bigger"/>
                    </div>

                      <? // Диалог добавления нового адреса?>

                      <? /*php $this->beginWidget(
                                      'booster.widgets.TbModal',
                                      array(
                                        'id' => 'newAddressDialog',
                                      )
                                    ); */ ?>
                    <!----->
                    <div class="modal fade" id="newAddressDialog">
                      <div class="modal-dialog modal-lg"
                           style="background-color: white;border-radius:5px;">
                        <!----->
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"
                                  aria-hidden="true">&times;
                          </button>
                          <h4 class="modal-title"><?= Yii::t(
                                'main',
                                'Добавить адрес доставки'
                              ) ?></h4>
                        </div>
                        <div class="modal-body">

                          <div class="form">

                              <? if (is_null(Yii::app()->user->id)) { ?>
                                <div class="alert alert-info">
                                    <?= Yii::t(
                                      'main',
                                      'Если вы уже ранее регистрировались на нашем сайте для входа в свой аккаунт заполните поля в красной рамке, для создания нового аккаунта внимательно заполните все поля'
                                    ) ?>
                                </div>
                                <div class="login-border"
                                     style="border: 2px solid red !important;">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <label class="required"
                                             for="easyCheckout[newAddress][email]"><?= Yii::t(
                                            'main',
                                            'Ваш EMail'
                                          ); ?><span
                                            class="required">*</span></label>
                                      <input class="input3" form="form-easy-checkout"
                                             id="easyCheckout[newAddress][email]"
                                             placeholder="E-Mail"
                                             type="text"
                                             name="easyCheckout[newAddress][email]"
                                             maxlength="128"/>
                                    </div>
                                    <div class="col-md-4">
                                      <label class="required"
                                             for="easyCheckout[newAddress][password]"><?= Yii::t(
                                            'main',
                                            'Пароль'
                                          ); ?><span
                                            class="required">*</span></label>
                                      <input class="input3"
                                             form="form-easy-checkout"
                                             id="easyCheckout[newAddress][password]"
                                             placeholder="<?= Yii::t('main', 'Пароль') ?>"
                                             type="password"
                                             name="easyCheckout[newAddress][password]"
                                             maxlength="128"/>
                                    </div>
                                    <div class="col-md-4">
                                      <label class="required"
                                             for="easyCheckout[newAddress][phone]"><?= Yii::t(
                                            'main',
                                            'Телефон'
                                          ); ?><span
                                            class="required">*</span></label>
                                      <input class="input3"
                                             form="form-easy-checkout"
                                             id="easyCheckout[newAddress][phone]"
                                             placeholder="<?= Yii::t('main', 'Телефон') ?>"
                                             type="text"
                                             name="easyCheckout[newAddress][phone]"
                                             maxlength="32"/>

                                      <br/>
                                    </div><!--End:Col-->
                                  </div><!--End:Row-->
                                </div><!--End: login-border -->
                                <br/>
                              <? } ?>

                            <div class="row">
                              <div class="col-md-4">
                                <label class="required"
                                       for="easyCheckout[newAddress][fullname]"><?= Yii::t(
                                      'main',
                                      'ФИО'
                                    ); ?><span
                                      class="required">*</span></label>
                                <input class="input3" form="form-easy-checkout"
                                       id="easyCheckout[newAddress][fullname]" type="text"
                                       placeholder="<?= Yii::t('main', 'ФИО') ?>"
                                       name="easyCheckout[newAddress][fullname]"
                                       maxlength="512"/>
                              </div>
                            </div><!--End:Row-->
                            <div class="row">
                              <div class="col-md-4">
                                <label class="required"
                                       for="easyCheckout[newAddress][country]"><?= Yii::t(
                                      'main',
                                      'Страна'
                                    ); ?><span
                                      class="required">*</span></label>
                                <select class="input3" form="form-easy-checkout"
                                        id="easyCheckout[newAddress][country]"
                                        name="easyCheckout[newAddress][country]"
                                        style="height: 48px;">
                                  <option value=""><?= Yii::t(
                                        'main',
                                        'Выберите страну'
                                      ) ?></option>

                                    <? $countries = Deliveries::getCountries(true);
                                    if (is_array($countries)) {
                                        foreach ($countries as $alpha3 => $country) { ?>
                                          <option value="<?= $alpha3 ?>"><?= $country ?></option>
                                        <? } ?>
                                    <? } ?>
                                </select>
                              </div>
                              <div class="col-md-4">

                                <label class="required"
                                       for="easyCheckout[newAddress][city]"><?= Yii::t(
                                      'main',
                                      'Город'
                                    ); ?><span class="required">*</span></label>
                                <input class="input3" form="form-easy-checkout"
                                       id="easyCheckout[newAddress][city]" type="text"
                                       name="easyCheckout[newAddress][city]"
                                       maxlength="128"/>
                              </div>
                              <div class="col-md-4">
                                <label class="required"
                                       for="easyCheckout[newAddress][index]"><?= Yii::t(
                                      'main',
                                      'Почтовый индекс'
                                    ); ?>
                                  <span class="required">*</span></label>
                                <input class="input3" form="form-easy-checkout"
                                       id="easyCheckout[newAddress][index]" type="text"
                                       name="easyCheckout[newAddress][index]"
                                       maxlength="128"/>
                              </div><!--End:Col-->
                            </div><!--End:Row-->
                            <div class="row">
                              <div class="col-md-12">

                                <label class="required"
                                       for="easyCheckout[newAddress][address]"><?= Yii::t(
                                      'main',
                                      'Адрес'
                                    ); ?><span
                                      class="required">*</span></label>
                                <textarea class="input3" form="form-easy-checkout"
                                          placeholder="<?= Yii::t('main', 'Адрес доставки') ?>"
                                          id="easyCheckout[newAddress][address]"
                                          name="easyCheckout[newAddress][address]"
                                          rows="1"></textarea>
                              </div><!--End:Col-->
                            </div><!--End:Row-->
                            <div class="row">
                              <div class="col-md-12">
                                <label class="required"
                                       for="easyCheckout[newAddress][region]"><?= Yii::t(
                                      'main',
                                      'Регион'
                                    ); ?><span
                                      class="required">*</span></label>
                                <input class="input3" form="form-easy-checkout"
                                       id="easyCheckout[newAddress][region]" type="text"
                                       name="easyCheckout[newAddress][region]"
                                       maxlength="128"/>
                              </div><!--End:Col-->
                            </div><!--End:Row-->
                              <? /*
                                            <input type="hidden" name="easyCheckout[newAddress][phone]" value="<?=Yii::t('main','Не указан')?>"/>
                                            */ ?>
                          </div>
                          <!----------------------------------->

                        </div><!--End:Modal-body-->
                        <!----------------------------------->

                        <div class="modal-footer">
                          <div class="row buttons">
                              <? //form="form-easy-checkout" ?>
                            <input type="button" style="margin-right: 25px;"
                                   value="<?= Yii::t('main', 'Отмена') ?>"
                                   onclick="$('#newAddressDialog').modal('hide');"
                                   class="btn btn-danger red-btn bigger pull-right"/>
                            <input type="submit" form="form-easy-checkout"
                                   style="right: 10px;position: relative;"
                                   value="<?= Yii::t('main', 'Добавить') ?>"
                                   name="action[newAddress]"
                                   onclick="
                                    $('#newAddressDialog').modal('hide');
                                    <? /* var input = $('<input>')
                                    .attr('type', 'hidden')
                                    .attr('name', 'action[newAddress]').val('appendNewAddress');
                                    $('#form-easy-checkout').append($(input));
                                    $('#form-easy-checkout').submit(); */ ?>"
                                   class="btn btn-danger blue-btn bigger pull-right"/>
                          </div>
                        </div>

                        <!----------------------------------->

                          <? // $this->endWidget('booster.widgets.TbModal'); ?>
                        <!---->
                      </div>
                    </div>
                    <!---->
                  <? } ?>
                <!----------------------------------->

                <!--</div>-->
              </div>
            </div>
          </div>
        </div>

          <? // ============= СПОСОБ ДОСТАВКИ ================================================================================?>
        <div class="panel panel-default">
          <div class="panel-heading closed" data-parent="#checkout-options" data-target="#op3"
               data-toggle="collapse">
            <h4 class="panel-title">
              <a href="#a">
                <span class="fa fa-truck"></span>
                  <?= Yii::t('main', 'Выберете способ доставки') ?>
              </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-down"
                                                                   aria-hidden="true"></i></span></h4>
          </div>
          <div class="panel-collapse collapse" id="op3">
            <div class="panel-body">
              <div class="row co-row">
                <div class="row"></div>
                  <? if (is_array($this->deliveries) && (count($this->deliveries) > 0)) {
                      $checkout_weight_needed = DSConfig::getVal('checkout_weight_needed') == 1;
                      $i = 1;
                      foreach ($this->deliveries as $delivery) { ?>
                        <div class="col-md-6">
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
                                (($i == 1) && (empty($this->post) || !isset($this->post['easyCheckout']['delivery'])))
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
            <div class="panel-heading closed" data-parent="#checkout-options" data-target="#op5"
                 data-toggle="collapse">
              <h4 class="panel-title">
                <a href="#a"> <span class="fa fa-money"></span>
                    <?= Yii::t('main', 'Выберете способ оплаты') ?>
                </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-down"
                                                                     aria-hidden="true"></i></span>
              </h4>
            </div>
            <div class="panel-collapse collapse" id="op5">
              <div class="panel-body">
                <div class="row co-row form-group product-chooser">

                  <!-- Payment methods -->
                  <div class="col-md-12 col-xs-12">

                      <? if ($this->totalUserBallance < $this->totalPaymentSumm) { ?>
                        <br/>
                        <div class="payment-error alert alert-danger">
                          <p style="color: red; text-align: center">
                            <strong> <?= Yii::t('main', 'Внимание') ?> !</strong>
                            <br/> <?= Yii::t(
                                'main',
                                'На вашем счету недостаточно средств для оплаты заказа'
                              ) ?>
                            <br/> <?= Yii::t('main', 'Вам необходимо пополнить счёт на') ?>
                            &nbsp;&nbsp; <?= Formulas::priceWrapper(
                                (float) $this->totalPaymentSumm - (float) $this->totalUserBallance
                              ) ?>
                          </p>
                        </div>
                      <? } ?>
                    <!-- Выбор способа оплаты из доступных -->

                      <? if (is_array($this->paySystems) && (count($this->paySystems) > 0)) { ?>
                      <? foreach ($this->paySystems as $paySystem) { ?>

                    <div class="blogpost row product-chooser-item">
                      <div class="blogcontent ">
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

                      <? /*

                                    <input type="radio" style=" position: relative;"
                                               id="paysystem-<?= $paySystem->int_name; ?>"
                                          <? if (($this->post && isset($this->post['easyCheckout']['paySystem']) &&
                                            $this->post['easyCheckout']['paySystem'] == $paySystem->int_name)) {
                                                      echo 'checked'; }  ?>
                                               onclick="paySystemChanged()"
                                               value="<?= $paySystem->int_name; ?>"
                                               name="easyCheckout[paySystem]">

                                        <!--------------------------->

                                            <div class="blogpost row">
                                                <div class="blogcontent">
                                                    <div class="blogdetails col-md-3 col-xs-12 date date-easy" style="height: 170px;">
                                                        <img src="<?= $paySystem->logo_img; ?>" style="height: 60px !important; width: 60px !important; position: relative; top: 40px;"/>
                                                    </div><!--End:Col-->
                                                    <div class="col-md-9 col-xs-12 blog-summery" style="height: 170px; padding: 5px !important; overflow: hidden;">
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
                                                    </div><!--End:Col-->
                                                </div><!--End:BlogContent-->
                                            </div><!--End:Row-->
                                        </input>
                                */ ?>
                      <? } ?><!--End:Foreach-->
                      <? } ?><!--End:If-->
                    <!-- ./ Выбор способа оплаты из доступных -->
                  </div>
                  <!-- end: Payment methods -->
                </div>
              </div>
            </div>
          </div>
        <? } ?>


        <? //====== ОПЛАТА =====================================================================================================?>
        <? /*
            <div class="section">
            <div class="row">
                <h4 class="page-title"
                    style="display: inline-block !important; font-size: 120%; padding: 10px;"><?= Yii::t(
                      'main',
                      'Оплата'
                    ) ?></h4>
                <div id="total-block" class="content payment">

                    <br/>
                    <?  // НЕ выводим заказ и оплату, если пользователь не авторизован и нет вобще никакого адреса
                        // (обычно это делается на этапе выбора адреса) ?>
                    <? if (!Yii::app()->user->id) { ?>
                        <div class="payment-error">
                            <p style="text-align: center; color: red;"><strong><?= Yii::t(
                                      'main',
                                      'Для оплаты заказа вам необходимо, как минимум'
                                    ) ?></strong>,
                                <a style="font-size: 120%; color: deeppink; text-decoration: none; "
                                   href="#anchor-address"><?= Yii::t('main', 'указать email и пароль') ?></a>!
                            </p>
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
                        <? //======== СПОСОБ ОПЛАТЫ ========================================================================?>
                        <? if (DSConfig::getVal('checkout_order_reconfirmation_needed') == 0) { ?>
                            <div id="anchor-paysystem" class="section">
                                <div class="row">
                                    <div id="accordion-paysystem">
                                        <h4 class="page-title" style="display: inline-block !important;">
                                            <?= Yii::t('main', 'Выбор способа пополнения счета') ?>
                                        </h4>
                                        <div>
                                            <? if ($this->totalUserBallance < $this->totalPaymentSumm) { ?>
                                                <div class="payment-error">
                                                    <p style="color: red; text-align: center">
                                                        <strong> <?= Yii::t('main', 'Внимание') ?> !</strong>
                                                        <br/> <?= Yii::t(
                                                          'main',
                                                          'На вашем счету недостаточно средств для оплаты заказа'
                                                        ) ?>
                                                        <br/> <?= Yii::t('main', 'Вам необходимо пополнить счёт на') ?>
                                                        &nbsp;&nbsp; <?= Formulas::priceWrapper(
                                                          (float) $this->totalPaymentSumm - (float) $this->totalUserBallance
                                                        ) ?>
                                                    </p>
                                                </div>
                                            <? } ?>
                                            <!-- Выбор способа оплаты из доступных -->
                                            <? if (is_array($this->paySystems) && (count($this->paySystems) > 0)) { ?>
                                                <? foreach ($this->paySystems as $paySystem) { ?>
                                                    <input type="radio" style=" position: relative;"
                                                           id="paysystem-<?= $paySystem->int_name; ?>"
    */ ?>
        <? /* if (($this->post && isset($this->post['easyCheckout']['paySystem']) && $this->post['easyCheckout']['paySystem'] == $paySystem->int_name)) {
                                                      echo 'checked'; } */ ?>
        <? /*
                                                           onclick="paySystemChanged()"
                                                           value="<?= $paySystem->int_name; ?>"
                                                           name="easyCheckout[paySystem]">

                                                    <!--------------------------->
                                                    <label for="paysystem-<?= $paySystem->int_name; ?>"
                                                           style="position: relative; display: inline-block; width: 29%; vertical-align: top; top: 10px; border: 1px #00b4ff solid;">
                                                        <div class="hint"
                                                             style="padding-left: 10px; color: #00BCFF; background-color: #EAEAEA; position: relative; height: 170px; overflow-y: hidden; ">
                                                            <h3>
                                                                <? if (Utils::appLang() == 'ru') { ?>
                                                                    <?= $paySystem->name_ru; ?>
                                                                    <?
                                                                } else {
                                                                    ?>
                                                                    <?= $paySystem->name_en; ?>
                                                                <? } ?>
                                                            </h3>
                                                            <img src="<?= $paySystem->logo_img; ?>" height="40" alt=""/>
                                                            <br/>
                                                            <span>
                                                                <? if (Utils::appLang() == 'ru') { ?>
                                                                    <?= $paySystem->descr_ru; ?>
                                                                    <?
                                                                } else {
                                                                    ?>
                                                                    <?= $paySystem->descr_en; ?>
                                                                <? } ?>
                                                            </span>
                                                        </div>
                                                    </label>
                                                    <!--------------------------->
                                                    </input>
                                                <? } ?>
                                            <? } ?>
                                            <!-- ./ Выбор способа оплаты из доступных -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <? } ?>

                        <? //====== Батоны, сабмиты... ======================================================================?>
                        <div class="xyz-buuton">
                            <? if (DSConfig::getVal('checkout_order_reconfirmation_needed') == 0) { ?>
                                <div class="next-btn">
                                    <input type="submit" id="payment_button" name="action[payment]"
                                           value="<?= Yii::t('main', 'Оплатить') ?>"
                                           class="blue-btn bigger"
                                      <? if ($this->totalUserBallance < $this->totalPaymentSumm) { ?>
                                          disabled="disabled"
                                      <? } ?>
                                    />
                                </div>
                                <? $checkout_payment_needed = DSConfig::getVal('checkout_payment_needed') == 1;
                                if (!$checkout_payment_needed) {
                                    ?>
                                    <div class="next-btn">
                                        <input type="submit" id="nopayment_button" name="action[noPayment]"
                                               value="<?= Yii::t('main', 'Оплатить позже') ?>"
                                               class="blue-btn bigger"
                                          <? if (!Yii::app()->user->id) { ?>
                                              disabled="disabled"
                                          <? } ?>
                                        />
                                    </div>
                                    <?
                                }
                            } else { ?>
                                <div class="next-btn">
                                    <input type="submit" id="nopayment_button" name="action[noPayment]"
                                           value="<?= Yii::t('main', 'Оформить заказ') ?>"
                                           class="blue-btn bigger"/>
                                </div>
                            <? } ?>
                        </div>
                    <? } ?>
    */ ?>
        <? /*
                    <div id="total-block-refresh" style="display:none">
                        <div class="alert alert-danger">
                            <?= Yii::t('main', 'В параметрах заказа произошли изменения') ?>,
                            <br/><?= Yii::t('main', 'нажмите кнопку "сохранить изменения"') ?>
                            <br/><?= Yii::t('main', 'для пересчета стоимости заказа') ?>
                        </div>
                        <div class="next-btn">
                            <input type="submit" value="<?= Yii::t('main', 'Сохранить изменения') ?>"
                                   name="action[weight]"
                                   class="red-btn bigger"/>
                        </div>
    */ ?>

        <? /* </div> */ ?>
        <? /* </div> */ ?>
        <? //========== ВЕС ЛОТОВ (ТОВАРЫ В ЗАКАЗЕ) ============================================================================?>
      <div class="panel panel-default"> <!-- add class disabled to prevent from clicking -->
        <div class="panel-heading closed" data-parent="#checkout-options" data-target="#op6"
             data-toggle="collapse">
          <h4 class="panel-title"><a href="#a"> <span class="fa fa-check"></span> <?= Yii::t(
                    'main',
                    'Товары в заказе'
                  ) ?>
            </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-down"
                                                                 aria-hidden="true"></i></span></h4>
        </div>
        <div class="panel-collapse collapse" id="op6">
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
                         name="action[weight]" role="button"
                         class="btn brn-danger color2 pull-right"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <? /*
                <div id="anchor-weight" class="section">
                    <div id="accordion-weight">
                        <h4 class="page-title" style="display: inline-block !important;"><?= Yii::t(
                              'main',
                              'Проверьте детали заказа, уточните вес товаров'
                            ) ?></h4>
                        <div>
                            <? foreach ($this->cart->cartRecords as $k => $item) { ?>
                                <? $this->widget(
                                  'application.components.widgets.OrderItem',
                                  array(
                                    'easyCheckout' => true,
                                    'orderItem'    => $item,
                                    'readOnly'     => false,
                                    'allowDelete'  => false,
                                    'onChange'     => "itemsChanged();",
                                    'imageFormat'  => '_200x200.jpg',
                                  )
                                );
                                ?>
                            <? } ?>
                            <div class="next-btn">
                                <input type="submit" value="<?= Yii::t('main', 'Сохранить изменения') ?>"
                                       name="action[weight]"
                                       class="blue-btn bigger"/>
                            </div>
                        </div>
                    </div>
                </div>
    */ ?>
        <? //====== КОММЕНТАРИЙ ================================================================================================?>
      <div class="panel panel-default"> <!-- add class disabled to prevent from clicking -->
        <div class="panel-heading closed" data-parent="#checkout-options" data-target="#op7"
             data-toggle="collapse">
          <h4 class="panel-title"><a href="#a"> <span class="fa fa-comment"></span>
                  <?= Yii::t('main', 'Коментарий к заказу') ?>
            </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-down"
                                                                 aria-hidden="true"></i></span>
          </h4>
        </div>
        <div class="panel-collapse collapse" id="op7">
          <div class="panel-body">
            <div class="row co-row">
              <div class="box-content form-box">
                            <textarea id="easyCheckout[comment]"
                                      name="easyCheckout[comment]" style="position: relative; left: 20px;"
                                      rows="4"
                                      placeholder="Введите коментарий к заказу"
                            ><? if (isset($this->post['easyCheckout']['comment'])) {
                                    echo $this->post['easyCheckout']['comment'];
                                } ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

        <? // Таблица итоговой стоимости заказа ?>
        <? //=================================================================================================================?>
      <!-------------------------------------------------------->
      <div class="xyz-buuton pull-right" style="position: relative; display: inline-flex;top:40px;">
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
                  )) { //todo: а еще здесь наверно стоит проверить войденный юзверь или нет ??? ?>
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
                  )) { //todo: а еще здесь наверно стоит проверить войденный юзверь или нет ??? ?>
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

<? if ($this->anchor) { ?>
  <script>
      $(document).ready(function () {
          location.hash = '#<?=$this->anchor?>';
      });
  </script>
<? } ?>
<script>
    function itemsChanged() {
        $('#total-block-refresh').css('display', 'block');
        $('#total-block').css('display', 'none');
    }

    function extSubmit(anchor) {
        var input = $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'action[anchor]').val(anchor);
        $('#form-easy-checkout').append($(input));
        $('#form-easy-checkout').submit();
    }

    function paySystemChanged() {
        $('#payment_button').removeAttr('disabled');

    }

    $(function () {
        $('div.product-chooser').find('div.product-chooser-item').on('click', function () {
            $(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
            $(this).addClass('selected');
            $(this).find('input[type="radio"]').prop('checked', true);
        });
    });
</script>