<div class="panel-heading closed" data-parent="#checkout-options" data-target="#anchor-payment"
     data-toggle="collapse">
  <h4 class="panel-title" id="title-payment">
    <a href="#a"> <span class="fa fa-money"></span>
        <?= Yii::t('main', 'Выберете способ оплаты') ?>
    </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-right"
                                                         aria-hidden="true"></i></span>
  </h4>
</div>
<div class="panel-collapse collapse" id="anchor-payment">
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

        <div class="blogpost row product-chooser-item"
             onclick="writeToHeader('title-payment','<?= Yii::t(
               'main',
               'Способ оплаты'
             ) . ': ' . $paySystem->name_ru; ?>')">
          <div class="blogcontent ">
            <div class="blogdetails col-md-3 col-xs-12 date date-easy" style="height: 170px;">
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
                     onclick="function() {paySystemChanged(); writeToHeader('title-payment','<?= Yii::t(
                       'main',
                       'Способ оплаты'
                     ) . ': ' . $paySystem->name_ru; ?>');}"
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