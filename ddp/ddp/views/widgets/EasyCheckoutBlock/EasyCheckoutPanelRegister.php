<div class="panel-heading  opened" data-parent="#checkout-options" data-target="#anchor-register"
     data-toggle="collapse">
  <h4 class="panel-title" id="title-register"><a href="#a"> <span class="fa fa-envelope-o"></span>
          <?= Yii::t('main', 'Авторизация') ?>
    </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
  </h4>
</div>
<div class="panel-collapse collapse in" id="anchor-register">
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
              <p/>
            </div>
          <? } ?>
      </div>
        <? if (!Yii::app()->user->id) { ?>
          <div class="alert alert-info">
              <?= Yii::t(
                'main',
                'Если вы уже ранее регистрировались на нашем сайте - введите email и пароль, для создания нового аккаунта внимательно заполните все поля'
              ) ?>
          </div>
          <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
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
          </div><!--End:Row-->
          <div class="row clearfix f-space10"></div>
          <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
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
            <div class="col-md-6">
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
            <div class="col-md-6">

              <label class="required" for="easyCheckout[newAddress][city]"><?= Yii::t(
                    'main',
                    'Город'
                  ); ?><span class="required">*</span></label>
              <input class="input3 pull-right" form="form-easy-checkout"
                     id="easyCheckout[newAddress][city]" type="text"
                     name="easyCheckout[newAddress][city]"
                     maxlength="128"/>
            </div>
          </div><!--End:Row-->
          <div class="row clearfix f-space10"></div>
          <div class="row">
            <div class="col-md-6">
              <label class="required" for="easyCheckout[newAddress][index]"><?= Yii::t(
                    'main',
                    'Почтовый индекс'
                  ); ?>
                <span class="required">*</span></label>
              <input class="input3 pull-right" form="form-easy-checkout"
                     id="easyCheckout[newAddress][index]" type="text"
                     name="easyCheckout[newAddress][index]"
                     maxlength="128"/>
            </div><!--End:Col-->
            <div class="col-md-6">

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
          </div><!--End:Row-->
          <div class="row clearfix f-space10"></div>
          <div class="row">
            <div class="col-md-6">
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
          </div>

          <div class="row buttons">
            <input type="submit" form="form-easy-checkout"
                   style="right: 20px;position: relative;"
                   value="<?= Yii::t('main', 'Войти') ?>"
                   name="action[newAddress]"
                   class=" btn btn-danger blue-btn bigger pull-right"/>
          </div>
          <br/>
        <? } ?>
    </div>
  </div>
</div>

