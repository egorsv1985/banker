<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="transfer.php">
 * </description>
 * Рендеринг внутреннего перевода средств
 **********************************************************************************************************************/
?>
<!--
<div class="blue-tabs">
    <a href="<? // Yii::app()->createUrl('/cabinet/balance') ?>">
        <span><? // Yii::t('main', 'Выписка по счету') ?></span>
    </a>
    <a href="<? // Yii::app()->createUrl('/cabinet/balance/payment') ?>">
        <span><? // Yii::t('main', 'Пополнить счет') ?></span>
    </a>
    <a href="<? // Yii::app()->createUrl('/cabinet/balance/statement') ?>">
        <span><? // Yii::t('main', 'Информация о счете') ?></span>
    </a>
</div>
-->
<div class="container">
  <div class="clearfix f-space10"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h3><?= $this->pageTitle ?></h3>
      </div>
    </div><!--/col-->
  </div><!--/row-->
  <div class="clearfix f-space10"></div>
  <div class="row">
    <div class="col-md-3">
        <? // Виджет меню кабинета
        $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
    </div><!--/col-->
    <div class="col-md-9">
      <div class="alert alert-success"><?= Yii::t('main', 'Доступно для перевода') ?>: <b><?=
              Formulas::priceWrapper(
                Formulas::convertCurrency(
                  Users::getBalance(Yii::app()->user->id),
                  DSConfig::getVal('site_currency'),
                  DSConfig::getCurrency()
                ),
                DSConfig::getCurrency()
              ) ?></b></div>

      <div class="transfer-form"><?= $form ?></div><!-- Форма перевода -->

    </div><!--/col-md-9-->

  </div><!--/row-->
</div><!--/container-->