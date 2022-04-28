<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="delivery.php">
 * </description>
 * Выбор службы доставки при оформлении заказа
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 clo-md-12 col-sm-12 col-xs-12">
      <div class="page-title"><h4><?= Yii::t('main', 'Оформление заказа') ?></div>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-lg-12 clo-md-12 col-sm-12 col-xs-12">
      <div class="content">
        <h4><?= $this->pageTitle ?></h4>

          <? if (is_array($delivery) && (count($delivery) > 0)) { ?>
              <? $checkout_weight_needed = DSConfig::getVal('checkout_weight_needed') == 1; ?>
            <form id="delivery" class="delivery" action="<?= Yii::app()->createUrl('/checkout/delivery') ?>"
                  method="post">
                <? foreach ($delivery

                as $i => $del) { ?>
              <div class="jumbotron text-center"
                   style="display: inline-block; width: 33%; height: 250px; vertical-align: top;">
                <div class="checkbox">
                  <label data-toggle="tooltip" data-placement="bottom"
                         title="<?= Yii::t('main', $del->description) ?>">

                    <img id="<?= $del->id ?>" src="<?= $this->frontThemePath ?>/images/tick.png"
                         style="visibility: hidden; width: 44px; height: 33px">

                    <input name="CheckoutForm[delivery]" value="<?= $del->id ?>" type="radio"
                           onclick="mFunc (this, '<?= $del->id ?>')">

                    <div class="Jumbo">
                        <?= Yii::t('main', $del->name) ?>
                    </div><!--End:Alert-->

                    <div class="text-center delivPrice">
                        <? if ($del->summ > 0 && $checkout_weight_needed) { ?>
                          <h2><?= Formulas::priceWrapper(
                                Formulas::convertCurrency(
                                  $del->summ,
                                  DSConfig::getVal('site_currency'),
                                  DSConfig::getCurrency()
                                )
                              ); ?>
                          </h2>
                        <? } ?>
                    </div><!--End:DelivPrice-->

                  </label>
                </div><!--End:CheckBox-->
              </div><!--End:Jumbo-->
                <? } ?><!--End:Foreach-->
              <hr/>
              <div class="next-btn">
                <input type="hidden" name="step" value="3"/>
                  <?= CHtml::submitButton(
                    Yii::t('main', 'Продолжить оформление заказа'),
                    ['class' => 'btn btn-danger bigger', 'style' => 'float: right;']
                  ) ?>
              </div>
            </form>

          <? } else { ?>

            <div class="lable lable-danger"><b><?= Yii::t(
                      'main',
                      'К сожалению, доставка в выбранную Вами страну или регион с указанными Вами параметрами временно не производится.'
                    ) ?></b></div>

            <div class="delivery-more">
              <a href="<?= Yii::app()->createUrl('/article/index', ['url' => 'dostavka']) ?>">
                  <?= Yii::t('main', 'Подробнее об условиях доставки') ?>
              </a>
            </div>
          <? } ?>
      </div><!--End:Col-->
    </div><!--End:Row-->
  </div><!--End:content-->
  <script type="text/javascript">
      function mFunc(x, y) {
          /*document.getElementById ('#delivery').innerHTML = 'Место под форму';*/
          if (self.ICON) ICON.style.visibility = 'hidden';
          ICON = document.getElementById(y);
          //alert (ICON);
          ICON.style.visibility = 'visible';
          //alert ('123');
          /*document.getElementsByName ('myFrame') [0].src = x.value;*/
      }
  </script>
</div><!--End:Container-->
