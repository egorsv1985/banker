<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="payment_online.php">
 * </description>
 * Форма онлайнового платежа
 **********************************************************************************************************************/
?>
<div class="blue-tabs">
  <a href="<?= Yii::app()->createUrl('/cabinet/balance') ?>">
    <span><?= Yii::t('main', 'Информация о счёте') ?></span>
  </a>

  <div class="active-tab">
    <span><?= $this->pageTitle ?></span>
  </div>
  <a href="<?= Yii::app()->createUrl('/cabinet/balance/statement') ?>">
    <span><?= Yii::t('main', 'Информация о счете') ?></span>
  </a>
  <a href="<?= Yii::app()->createUrl('/cabinet/balance/transfer') ?>">
    <span><?= Yii::t('main', 'Перевод денег на другой счет') ?></span>
  </a>
</div>
<div class="cabinet-content">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title><?= CHtml::encode(DSConfig::getVal('site_name') . ': ' . Yii::t('main', 'Пополнение счёта')) ?></title>
  <link href="//favicon.ico" type="image/x-icon" rel="icon"/>
    <?= PaySystems::preRenderForm($data, $type); ?>
</div>