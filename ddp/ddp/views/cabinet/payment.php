<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="payment.php">
 * </description>
 * Рендеринг начальной формы пополнения счёта
 * http://<domain.ru>/ru/cabinet/balance/payment
 * var $model = CabinetForm
 * var $check = false
 * var $paySystems = array
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="clearfix f-space10"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2><?= $this->pageTitle ?></h2>
      </div>
    </div>
  </div>
  <div class="clearfix f-space10"></div>
  <div class="row">
    <div class="col-md-3">
        <? // Виджет меню кабинета
        $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
    </div><!--/col-->
    <div class="col-md-9">
      <div class="form">
          <?php $form = $this->beginWidget(
            'booster.widgets.TbActiveForm',
            [
              'id' => 'payment-form',
              'enableAjaxValidation' => false,
            ]
          ) ?>

          <?= $form->labelEx($model, 'sum'); ?>
          <?= $form->textField($model, 'sum', ['id' => 'sumInSiteCurr', 'class' => 'input3']
          ); ?>
          <? if (DSConfig::getVal('site_currency') != DSConfig::getCurrency()) { ?>
            &nbsp;&nbsp;<span id="sumInCurr"><?= Formulas::priceWrapper(
                    Formulas::convertCurrency(
                      $model->sum,
                      DSConfig::getVal('site_currency'),
                      DSConfig::getCurrency()
                    ),
                    DSConfig::getCurrency()
                  ) ?></span>
            <script>
                $('#sumInSiteCurr').on('keypress paste', function () {
                    setTimeout(function () {
                        var sum = $('#sumInSiteCurr').val();
                        var src = '<?=DSConfig::getVal('site_currency')?>';
                        var dst = '<?=DSConfig::getCurrency()?>';
                        var res = convertCurrency($.trim(sum), src, dst);
                        $('#sumInCurr').html(res);
                    }, 1000);
                });
            </script>
          <? } ?>
          <?= $form->error($model, 'sum'); ?>

        <!--Спрячем поле ввода телефона-->
        <span style="display: none">
                <?= $form->labelEx($model, 'phone'); ?>
                <?= $form->textField($model, 'phone', ['class' => 'input3']); ?>
                <?= $form->error($model, 'phone'); ?>
</span>

        <div class="buttons">
            <?= CHtml::submitButton(
              Yii::t('main', 'Далее'),
              ['class' => 'btn btn-danger blue-btn bigger pull-right', 'style' => 'position: relative;']
            ) ?>
        </div>

        <div class="payment-systems form-group product-chooser">
          <h3 style="align:center;"><?= Yii::t('main', 'Вариант оплаты') ?>:</h3>
            <? if ($paySystems) {
                foreach ($paySystems as $paySystem) { ?>

                  <div class="row row-line">
                    <div class="col-md-12">
                      <div class="blogpost row product-chooser-item">
                        <div class="blogcontent ">
                          <div class="blogdetails col-md-3 col-xs-12 date date-easy"
                               style="height: 170px;">
                            <img src="<?= $paySystem->logo_img; ?>"
                                 style="height: 140px !important; width: 170px !important; position: relative; top: 0;"/>
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
                            <input class="pay-radio" type="radio" id="<?= $paySystem->int_name; ?>"
                                   value="<?= $paySystem->int_name; ?>" name="preference"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br/>
                <? } ?>
            <? } ?>
        </div>
        <br/>
          <?php $this->endWidget(); ?>
      </div>
    </div>

  </div>
</div><br/><br/>
<script>
    $('.pay-radio').prop('checked', false);
    $(function () {
        $('div.product-chooser').find('div.product-chooser-item').on('click', function () {
            $(this).parent().parent().parent().find('div.product-chooser-item').removeClass('selected');
            $(this).addClass('selected');
            $(this).find('input[type="radio"]').prop('checked', true);
        });
    });
</script>