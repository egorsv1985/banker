<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="userBlock.php">
 * </description>
 * Рендеринг блока пользователя в лэйауте
 * var $guest = false
 * var $user = 'Root'
 **********************************************************************************************************************/
?>
<? if ($guest) { ?>
    <li><a class="dropdown-item" href="<?= Yii::app()->createUrl('/user/register') ?>">
      <i class="fa fa-sign-in fa-fw"></i>
        <?= Yii::t('main', 'Регистрация') ?>
    </a></li>
  <li>
    <a class="dropdown-item" href="<?= Yii::app()->createUrl('/user/login') ?>">
      <i class="fa fa-key fa-fw"></i>
        <?= Yii::t('main', 'Войти') ?>
    </a>
  </li>
    <?
} else {
    ?>
  <li>
    <a class="dropdown-item" href="<?= Yii::app()->createUrl('/cabinet') ?>">
      <i class="fa fa-user fa-fw"></i>
        <?= $user ?>
    </a>
  </li>
    <? if (Yii::app()->user->checkAccess('admin/main/*')) { ?>
    <li>
    <a class="dropdown-item" href="<?= Yii::app()->createUrl('/admin/main') ?>"><?= Yii::t(
              'main',
              'Панель управления'
            ) ?></a>
    </li>
    <? } ?>
  <li>
    <a class="dropdown-item" href="<?= Yii::app()->createUrl('/cabinet/balance/payment') ?>"><?= Yii::t(
            'main',
            'Пополнить счёт'
          ) ?></a>
  </li>
     <div class="dropdown-divider"></div>
  <li>
    <a class="dropdown-item" href="<?= Yii::app()->createUrl('/user/logout') ?>">
      <i class="fa fa-sign-out fa-fw"></i>
        <?= Yii::t('main', 'Выйти') ?>
    </a>
  </li>
<? } ?>