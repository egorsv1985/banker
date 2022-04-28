<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="payment_offline.php">
 * </description>
 * Форма офлайнового платежа
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
        <div id="offline-payment-form">
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
          <title><?=
              CHtml::encode(
                DSConfig::getVal('site_name') . ': ' . Yii::t('main', 'Платёжный документ')
              ) ?></title>
          <link href="//favicon.ico" type="image/x-icon" rel="icon"/>
            <?= PaySystems::preRenderForm($data, $type); ?>
        </div>
      </div>
    </div>

  </div>
</div><br/><br/>
