<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="statement.php">
 * </description>
 * Сомнительная страничка с маловнятными данными по счёту - подумать или убрать
 * http://<domain.ru>/ru/cabinet/balance/statement
 **********************************************************************************************************************/
?>
<div class="blue-tabs">
  <a href="<?= Yii::app()->createUrl('/cabinet/balance') ?>">
    <span><?= Yii::t('main', 'Выписка по счету') ?></span>
  </a>
  <a href="<?= Yii::app()->createUrl('/cabinet/balance/payment') ?>">
    <span><?= Yii::t('main', 'Пополнить счет') ?></span>
  </a>

  <div class="active-tab">
    <span><?= $this->pageTitle ?></span>
  </div>
  <a href="<?= Yii::app()->createUrl('/cabinet/balance/transfer') ?>">
    <span><?= Yii::t('main', 'Перевод денег на другой счет') ?></span>
  </a>
</div>
<div class="cabinet-content">
  <p>
    <strong>
        <?= Yii::t('main', 'Ваш текущий баланс') ?>: <?=
        Formulas::priceWrapper(
          Formulas::convertCurrency(
            Users::getBalance(Yii::app()->user->id),
            DSConfig::getVal('site_currency'),
            DSConfig::getCurrency()
          ),
          DSConfig::getCurrency()
        ) ?>
    </strong>
  </p>

  <p><?= Yii::t('main', 'Номер счета') ?>:&nbsp;<b><?= Yii::app()->user->getPersonalAccount() ?></b></p>
</div>