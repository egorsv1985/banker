<div class="panel-heading closed" data-parent="#checkout-options" data-target="#anchor-address"
     data-toggle="collapse">
  <h4 class="panel-title" id="title-address">
    <a href="#a"> <span class="fa fa-address-card"></span>
        <?= Yii::t('main', 'Адрес доставки') ?>
        <? if (isset($this->address)) {
            echo ': ' . $this->address->city . ', ' . $this->address->fullname;
        } ?>
    </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
  </h4>
</div>
<div class="panel-collapse collapse" id="anchor-address">
  <div class="panel-body">
    <div class="row co-row">
      <!----------------------------------->
      <div class="payment-error" style="text-align: center; color: red; padding: 0;">
          <? if (Yii::app()->user->id) { ?>
            <div class="alert alert-danger">
                        <span style="color: #00b4ff">
                            <label><?= Yii::t('main', 'Ваш EMail') ?>:</label>
                            <?= $this->user->email ?>
                        </span>
            </div>
          <? } else { ?>
            <div class="alert alert-danger">
              <h2><strong><?= Yii::t('main', 'Обратите внимание') ?>!</strong></h2>
              <strong>
                  <?= Yii::t(
                    'main',
                    'Для оформления заказа необходимо, как минимум, указать email и пароль'
                  ) ?>
              </strong>
              <br/><br/>
              <strong>
                  <?= Yii::t('main', 'и ввести свой адрес для доставки или выбрать из предложеных') ?>
              </strong>
              <p/>
            </div>
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
                        || (($i == 1) && (empty($this->post) || !isset($this->post['easyCheckout']['address'])))
                      ) {
                          echo 'checked';
                      }
                      ?> value="<?= $address['id'] ?>"/>
                  </td>
                  <td><?= $address['country'] ?>
                    ,&nbsp;<?= $address['index'] ?>
                    ,&nbsp;<?= $address['address'] ?></td>
                  <td><?= $address['fullname'] ?>&nbsp;<?= $address['fullname'] ?></td>
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
          <!----->
          <div class="modal fade" id="newAddressDialog">
            <div class="modal-dialog modal-lg" style="background-color:white;border-radius:5px;">
              <!----->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
                <h4 class="modal-title"><?= Yii::t('main', 'Добавить адрес доставки') ?></h4>
              </div>
              <div class="modal-body">

                <div class="form">

                    <? if (is_null(Yii::app()->user->id)) { ?>
                      <div class="alert alert-danger">
                          <?= Yii::t(
                            'main',
                            'Если вы уже ранее регистрировались на нашем сайте для входа в свой аккаунт заполните поля в красной рамке, для создания нового аккаунта внимательно заполните все поля'
                          ) ?>
                      </div>
                      <div class="login-border"
                           style="border: 2px solid red !important;padding: 10px 0;border-radius: 6px;">
                        <div class="row">
                          <div class="col-md-4">
                            <label class="required"
                                   for="easyCheckout[newAddress][email]"><?= Yii::t(
                                  'main',
                                  'Ваш EMail'
                                ); ?><span
                                  class="required">*</span></label>
                            <input class="input3 pull-right" form="form-easy-checkout"
                                   id="easyCheckout[newAddress][email]"
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
                            <input class="input3 pull-right" form="form-easy-checkout"
                                   id="easyCheckout[newAddress][password]"
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
                            <input class="input3 pull-right" form="form-easy-checkout"
                                   id="easyCheckout[newAddress][phone]"
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
                      <label class="required" for="easyCheckout[newAddress][fullname]"><?= Yii::t(
                            'main',
                            'ФИО'
                          ); ?><span
                            class="required">*</span></label>
                      <input class="input3 pull-right" form="form-easy-checkout"
                             id="easyCheckout[newAddress][fullname]" type="text"
                             name="easyCheckout[newAddress][fullname]"
                             maxlength="512"/>
                    </div>
                  </div><!--End:Row-->
                  <div class="row clearfix f-space10"></div>
                  <div class="row">
                    <div class="col-md-4">
                      <label class="required" for="easyCheckout[newAddress][country]"><?= Yii::t(
                            'main',
                            'Страна'
                          ); ?><span
                            class="required">*</span></label>
                      <select class="input3 pull-right" form="form-easy-checkout"
                              id="easyCheckout[newAddress][country]"
                              name="easyCheckout[newAddress][country]" style="height: 48px;">
                        <option value=""><?= Yii::t('main', 'Выберите страну') ?></option>

                          <? $countries = Deliveries::getCountries(true);
                          if (is_array($countries)) {
                              foreach ($countries as $alpha3 => $country) { ?>
                                <option value="<?= $alpha3 ?>"><?= $country ?></option>
                              <? } ?>
                          <? } ?>
                      </select>
                    </div>
                    <div class="col-md-4">

                      <label class="required" for="easyCheckout[newAddress][city]"><?= Yii::t(
                            'main',
                            'Город'
                          ); ?><span class="required">*</span></label>
                      <input class="input3 pull-right" form="form-easy-checkout"
                             id="easyCheckout[newAddress][city]" type="text"
                             name="easyCheckout[newAddress][city]"
                             maxlength="128"/>
                    </div>
                    <div class="col-md-4">
                      <label class="required" for="easyCheckout[newAddress][index]"><?= Yii::t(
                            'main',
                            'Индекс'
                          ); ?>
                        <span class="required">*</span></label>
                      <input class="input3 pull-right" form="form-easy-checkout"
                             id="easyCheckout[newAddress][index]" type="text"
                             name="easyCheckout[newAddress][index]"
                             maxlength="128"/>
                    </div><!--End:Col-->
                  </div><!--End:Row-->
                  <div class="row clearfix f-space10"></div>
                  <div class="row">
                    <div class="col-md-4">

                      <label class="required"
                             for="easyCheckout[newAddress][address]"><?= Yii::t(
                            'main',
                            'Адрес'
                          ); ?><span
                            class="required">*</span></label>
                      <textarea class="input3 pull-right" form="form-easy-checkout"
                                id="easyCheckout[newAddress][address]"
                                name="easyCheckout[newAddress][address]"
                                rows="1"></textarea>
                    </div><!--End:Col-->

                    <div class="col-md-4">
                      <label class="required"
                             for="easyCheckout[newAddress][region]"><?= Yii::t(
                            'main',
                            'Регион'
                          ); ?><span
                            class="required">*</span></label>
                      <input class="input3 pull-right" form="form-easy-checkout"
                             id="easyCheckout[newAddress][region]" type="text"
                             name="easyCheckout[newAddress][region]"
                             maxlength="128"/>
                    </div><!--End:Col-->
                  </div><!--End:Row-->
                    <? //TODO: Потенциально проблеммный код ?>
                  <input type="hidden" name="easyCheckout[newAddress][phone]"
                         value="<?= Yii::t('main', 'Не указан') ?>"/>
                </div><!--End:Form-->
              </div>

              <div class="modal-footer">
                <div class="row buttons">
                  <input type="button" style="margin-right: 25px;"
                         value="<?= Yii::t('main', 'Отмена') ?>"
                         onclick="$('#newAddressDialog').modal('hide');"
                         class="btn btn-danger red-btn bigger pull-right"/>
                  <input type="submit" form="form-easy-checkout"
                         style="right: 10px;position: relative;"
                         value="<?= Yii::t('main', 'Добавить') ?>"
                         name="action[newAddress]"
                         onclick="
                                    $('#newAddressDialog').modal('hide');"
                         class="btn btn-danger blue-btn bigger pull-right"/>
                </div>
              </div>
            </div>
          </div>
        <? } ?>
    </div>
  </div>
</div>
