<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 * Главная страница кабинета
 * http://<domain.ru>/ru/cabinet
 * var $user = - данные о пользователе
 * var $ordersByStatuses = array - заказы по статусам
 * (0 => array(
 * 'id' => '21'
 * 'value' => 'IN_PROCESS'
 * 'name' => 'В процессе обработки'
 * 'descr' => 'Статус по умолчанию для всех новых заказов. Присваивается автоматически.'
 * 'manual' => '1'
 * 'aplyment_criteria' => 'select oo.id from orders oo where oo.status in (\'PAUSED\')
 * and (uid=:uid or :uid is null) and (manager=:manager or :manager is null)'
 * 'auto_criteria' => ''
 * 'order_in_process' => '0'
 * 'enabled' => '1'
 * 'count' => '36'
 * 'lastdate' => '1402398695'
 * 'totalsum' => '12920.15'
 * 'totalpayed' => '11056.76'
 * 'totalnopayed' => '-1863.39'
 * ))
 **********************************************************************************************************************/
?>

<?
$isEmpty = true;
foreach ($ordersByStatuses as $orderByStatus) {
    if ($orderByStatus['count'] > 0) {
        $isEmpty = false;
        break;
    }
} ?>
<div class="container">
  <div class="clearfix f-space10"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2><?= Yii::t('main', 'Добро пожаловать') ?>, <?= Yii::app()->user->fullname ?>
          <a href="<?= Yii::app()->createUrl('/cabinet/profile') ?>" class="edit-link"
             title="<?= Yii::t('main', 'Настроить профиль') ?>">
            <span class="pull-right"><i class="fa fa-sliders fa-2x color1"></i></span>
          </a>
        </h2>
      </div>
    </div>
  </div>

  <div class="clearfix f-space10"></div>

  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
      <div class="rec-banner blue">
        <div class="banner"><i class="fa fa-user"></i>
          <h3><?= Yii::t('main', 'Номер счета') ?></h3>
          <p><?= Yii::app()->user->getPersonalAccount() ?></p>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
      <div class="rec-banner red">
        <div class="banner"><i class="fa fa-cubes"></i>
          <h3><?= Yii::t('main', 'промо-код') ?></h3>
          <p><?= Users::getPromoByUid(Yii::app()->user->id) ?></p>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
      <div class="rec-banner darkblue">
        <div class="banner"><i class="fa fa-money"></i>
          <h3><?= Yii::t('main', 'Остаток на счете') ?></h3>
          <p><?=
              Formulas::priceWrapper(
                Formulas::convertCurrency(
                  Users::getBalance(Yii::app()->user->id),
                  DSConfig::getVal('site_currency'),
                  DSConfig::getCurrency()
                ),
                DSConfig::getCurrency()
              ); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
      <div class="rec-banner lightblue">
        <div class="banner"><i class="fa fa-user-secret"></i>
          <h3><?= Yii::t('main', 'Ваш менеджер') ?></h3>
            <? if ($user->manager != null) { ?>
              <p>
                  <?= $user->manager->fullname ?>
              </p>
            <? } else { ?>
              <br/><p> <?= Yii::t('main', 'Не назначен') ?> </p>
            <? } ?>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
      <div class="rec-banner darkblue">
        <div class="banner"><i class="fa fa-envelope"></i>
          <h3><?= Yii::t('main', 'EMail менеджера') ?></h3>
            <? if ($user->manager != null) { ?><p><a href="mailto:<?= $user->manager->email ?>"
                                                     style="color: white !important;">
                    <?= $user->manager->email ?></a></p><? } else { ?><p style="color: white !important;"><?= Yii::t(
              'main',
              'не назначен'
            ) ?></p><? } ?>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
      <div class="rec-banner black">
        <div class="banner"><i class="fa fa-skype"></i>
          <h3>Skype <?= Yii::t('main', 'менеджера') ?></h3>
            <? if ($user->manager != null) { ?><p><a href="skype:<?= $user->manager->skype ?>?chat"
                                                     style="color: white !important;">
                    <?= $user->manager->skype ?></a></p><? } else { ?><p style="color: white !important;"><?= Yii::t(
              'main',
              'не назначен'
            ) ?></p><? } ?>
        </div>
      </div>
    </div>
  </div>

  <div class="clearfix f-space10"></div>

  <div class="row"><!-- row -->
      <? // Блок меню кабинета ?>
    <div class="col-md-3 col-sm-12 col-xs-12 box-block page-sidebar">
      <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
        <? // Виджет меню кабинета
        $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
    </div><!-- /col-->
    <div class="col-md-9 col-sm-12 col-xs-12 main-column box-block">
        <? if (!$isEmpty) { ?>
          <div class="box-heading">
            <span><?= Yii::t('main', 'Распределение ваших заказов по статусам') ?></span>
          </div>
            <? foreach ($ordersByStatuses as $orderByStatus) {
                if ($orderByStatus['count'] > 0) { ?>
                  <div class="blogpost row">
                    <div class="blogcontent">
                      <div class="blogdetails col-md-3 col-xs-12 date hidden-xs hidden-sm">
                        <span><?= $orderByStatus['count'] ?><small><?= Yii::t('main', 'шт') ?></small></span>
                        <span><?= date('d.m.Y H:i', $orderByStatus['lastdate']) ?></span>
                        <a href="/cabinet/orders/index/type/<?= $orderByStatus['value'] ?>" class="btn color2 medium">
                            <?= Yii::t('main', 'Подробнее') ?>
                        </a>
                      </div>
                      <div class="col-md-9 col-xs-12 blog-summery-cabinet">
                        <a class="color1" href="/cabinet/orders/index/type/<?= $orderByStatus['value'] ?>">
                          <h1><?= Yii::t('main', $orderByStatus['name']) ?> (<?= $orderByStatus['count'] ?>
                              <?= Yii::t('main', 'шт') ?>)<!-- 31.03.2014 16:41-->
                          </h1>
                        </a>
                        <span class="bloginfo">
                            <a href="/cabinet/orders/index/type/<?= $orderByStatus['value'] ?>">
                                <i class="fa fa-clock-o"></i> <?= Yii::t('main', 'Последний заказ') ?> <?= date(
                                  'd.m.Y H:i',
                                  $orderByStatus['lastdate']
                                ) ?>
                            </a>
                        </span>
                        <p><?= Yii::t('main', $orderByStatus['descr']) ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix f-space10"></div>
                <? }
            } ?>
            <?
        } else {
            ?>
          <div class="alert alert-info">
            <span><?= Yii::t('main', 'У вас еще нет заказов') ?></span>
          </div>
        <? } ?>
    </div> <!--/col-->
  </div><!-- /row -->
</div><!-- /container-->
