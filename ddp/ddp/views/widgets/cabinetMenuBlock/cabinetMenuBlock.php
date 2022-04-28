<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="cabinetMenuBlock.php">
 * </description>
 * Виджет отображает левое вертикальное меню кабинета
 * newAnswer = 3 - количество новых обращений
 **********************************************************************************************************************/
?>
<div class="f-space10"></div>
<? $action = Yii::app()->request->requestUri ?>
<div class="box-content">
  <div class="panel-group" id="cabinetcategories">
    <div class="panel panel-default">
        <? $opened = preg_match('/(?:\/cabinet$|\/mailevents)/isu', $action) ?>
      <div
          class="panel-heading <?= ($opened ? 'opened' : 'closed') ?>" data-parent="#cabinetcategories"
          data-toggle="collapse"
          data-target="#collapseOne">
        <h4 class="panel-title">
          <a href="javascript:void(0);">
            <span class="fa <?= ($opened ? 'fa-arrow-down' : 'fa-arrow-right') ?>"></span>
              <?= Yii::t('main', 'Личный кабинет') ?>
          </a>
        </h4>
      </div>
      <div class="panel-collapse collapse<?= ($opened ? ' in' : '') ?>" id="collapseOne">
        <div class="panel-body">
          <ul>
            <li class="item"><a href="<?= Yii::app()->createUrl('/cabinet') ?>"><?= Yii::t(
                      'main',
                      'Общая информация'
                    ) ?></a>
            </li>
            <li class="item">
              <a href="<?= Yii::app()->createUrl('/cabinet/profile/mailevents') ?>">
                  <?= Yii::t('main', 'E-mail оповещения') ?></a>
            </li>

              <? if (Yii::app()->user->checkAccess('admin/main/*')) { ?>
                <li class="item"><a href="<?= Yii::app()->createUrl('/admin/main') ?>"><?= Yii::t(
                          'main',
                          'Панель управления'
                        ) ?></a>
                </li>
              <? } ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
        <? $opened = preg_match('/(?:orders\/index\/type)/is', $action); ?>
      <div class="panel-heading <?= ($opened ? 'opened' : 'closed') ?>" data-parent="#cabinetcategories"
           data-target="#collapseTwo" data-toggle="collapse">
        <h4 class="panel-title">
          <a href="javascript:void(0);">
            <span class="fa <?= ($opened ? 'fa-arrow-down' : 'fa-arrow-right') ?>"></span>
              <?= Yii::t('main', 'Ваши заказы') ?>
          </a>
        </h4>
      </div>
      <div class="panel-collapse collapse<?= ($opened ? ' in' : '') ?>" id="collapseTwo">
        <div class="panel-body">
          <ul>
              <?
              $ordersByStatuses = OrdersStatuses::getAllStatusesListAndOrderCount(Yii::app()->user->id);
              foreach ($ordersByStatuses as $orderByStatus) {
                  if ($orderByStatus['count'] > 0) { ?>
                    <li class="item"><a href="<?= Yii::app()->createUrl(
                          '/cabinet/orders/index/type/' . $orderByStatus['value']
                        ) ?>"><?= Yii::t(
                              'main',
                              $orderByStatus['name']
                            ) . '<br/>' . $orderByStatus['count'] . ' ' . Yii::t(
                              'main',
                              'шт.'
                            ) . ' ' . date('d.m.Y H:i', $orderByStatus['lastdate']) ?></a></li>
                  <? }
              } ?>
          </ul>
        </div>
      </div>
    </div>
      <? /* Parcels */ ?>
      <? if (DSConfig::getVal('parcel_use_parcel_system')) { ?>
        <div class="panel panel-default">
            <? $opened = preg_match('/(?:(?:parcels|parcelsCart)\/)/is', $action); ?>
          <div class="panel-heading <?= ($opened ? 'opened' : 'closed') ?>" data-parent="#cabinetcategories"
               data-target="#collapseParcels" data-toggle="collapse">
            <h4 class="panel-title">
              <a href="javascript:void(0);">
                <span class="fa <?= ($opened ? 'fa-arrow-down' : 'fa-arrow-right') ?>"></span>
                  <?= Yii::t('main', 'Ваши посылки') ?>
              </a>
            </h4>
          </div>
          <div class="panel-collapse collapse<?= ($opened ? ' in' : '') ?>" id="collapseParcels">
            <div class="panel-body">
              <ul>
                <li class="item"><a href="<?= Yii::app()->createUrl(
                      '/cabinet/parcelsCart/index'
                    ) ?>"><?= Yii::t(
                          'main',
                          'Корзина посылки'
                        ); ?></a>
                  <span class="categorycount"><?= ParcelsCart::getUserCart(false, false, null, 0) ?></span>
                </li>
                <li class="item"><a href="<?= Yii::app()->createUrl(
                      '/cabinet/parcels/create'
                    ) ?>"><?= Yii::t(
                          'main',
                          'Добавить в корзину'
                        ); /*. '<br/>' . $orderByStatus['count'] . ' ' . Yii::t(
                                  'main',
                                  'шт.'
                                ) . ' ' . date('d.m.Y H:i', $orderByStatus['lastdate']) */ ?></a>
                  <span class="categorycount"><?= ParcelsCart::getUserItemsReadyForParcel(false, 0) ?></span>
                </li>
                  <?
                  $parcelsByStatuses = ParcelsStatuses::getAllStatusesListAndParcelCount(Yii::app()->user->id);
                  foreach ($parcelsByStatuses as $parcelByStatus) {
                      if ($parcelByStatus['count'] > 0) { ?>
                        <li class="item "><a href="<?= Yii::app()->createUrl(
                              '/cabinet/parcels/index/type/' . $parcelByStatus['value']
                            ) ?>"><?= Yii::t(
                                  'main',
                                  $parcelByStatus['name']
                                ) . '<br/>' . $parcelByStatus['count'] . ' ' . Yii::t(
                                  'main',
                                  'шт.'
                                ) . ' ' . date('d.m.Y H:i', $parcelByStatus['lastdate']) ?></a></li>
                      <? }
                  } ?>
              </ul>
            </div>
          </div>
        </div>
      <? } ?>
      <? /* End of Parcels */ ?>
      <? /* Favorites */ ?>
    <div class="panel panel-default">
        <? $opened = preg_match('/(?:favorite\/list)/is', $action); ?>
      <div class="panel-heading <?= ($opened ? 'opened' : 'closed') ?>" data-parent="#cabinetcategories"
           data-target="#collapseThree" data-toggle="collapse">
        <h4 class="panel-title">
          <a href="javascript:void(0);">
            <span class="fa <?= ($opened ? 'fa-arrow-down' : 'fa-arrow-right') ?>"></span>
              <?= Yii::t('main', 'Избранное') ?>
          </a>
        </h4>
      </div>
      <div class="panel-collapse collapse<?= ($opened ? ' in' : '') ?>" id="collapseThree">
        <div class="panel-body">
            <? // Блок категорий избранного, который выводится ниже меню категорий?>
            <?
            $this->widget(
              'application.components.widgets.FavoritesMenuBlock',
              [
                'adminMode' => false,
              ]
            );
            ?>
        </div>
      </div>
    </div>
      <? /* Shop */ ?>
      <? if (DSConfig::getVal('local_shop_mode') !== 'off') { ?>
        <div class="panel panel-default">
            <? $opened = preg_match('/(?:shop\/list)/is', $action); ?>
          <div class="panel-heading <?= ($opened ? 'opened' : 'closed') ?>" data-parent="#cabinetcategories"
               data-target="#collapseThreeShop" data-toggle="collapse">
            <h4 class="panel-title">
              <a href="javascript:void(0);">
                <span class="fa <?= ($opened ? 'fa-arrow-down' : 'fa-arrow-right') ?>"></span>
                  <?= Yii::t('main', 'Витрина') ?>
              </a>
            </h4>
          </div>
          <div class="panel-collapse collapse<?= ($opened ? ' in' : '') ?>" id="collapseThreeShop">
            <div class="panel-body">
                <? // Блок категорий витрины, который выводится ниже меню категорий?>
                <?
                $this->widget(
                  'application.components.widgets.ShopMenuBlock',
                  [
                    'adminMode' => false,
                  ]
                );
                ?>
            </div>
          </div>
        </div>
      <? } ?>
      <? /* End of Shop */ ?>
    <div class="panel panel-default">
        <? $opened = preg_match('/balance\/(?:index|payment|transfer)/is', $action) ?>
      <div
          class="panel-heading <?= ($opened ? 'opened' : 'closed') ?>" data-parent="#cabinetcategories"
          data-target="#collapseFour" data-toggle="collapse">
        <h4 class="panel-title">
          <a href="javascript:void(0);">
            <span class="fa <?= ($opened ? 'fa-arrow-down' : 'fa-arrow-right') ?>"></span>
              <?= Yii::t('main', 'Ваш счёт') ?>
          </a></h4>
      </div>
      <div class="panel-collapse collapse<?= ($opened ? ' in' : '') ?>" id="collapseFour">
        <div class="panel-body">
          <ul>
            <li class="item"><a href="<?= Yii::app()->createUrl('/cabinet/balance/index') ?>"><?= Yii::t(
                      'main',
                      'Выписка по счету'
                    ) ?></a></li>
            <li class="item"><a href="<?= Yii::app()->createUrl('/cabinet/balance/payment') ?>"><?= Yii::t(
                      'main',
                      'Пополнить счёт'
                    ) ?></a></li>
            <li class="item"><a href="<?= Yii::app()->createUrl('/cabinet/balance/transfer') ?>"><?= Yii::t(
                      'main',
                      'Перевод средств на другой счет'
                    ) ?></a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
        <? $opened = preg_match('/profile\/(?:index|email|password|address)/is', $action); ?>
      <div
          class="panel-heading <?= ($opened ? 'opened' : 'closed') ?>" data-parent="#cabinetcategories"
          data-target="#collapseFive" data-toggle="collapse">
        <h4 class="panel-title">
          <a href="javascript:void(0);">
            <span class="fa <?= ($opened ? 'fa-arrow-down' : 'fa-arrow-right') ?>"></span>
              <?= Yii::t('main', 'Профиль') ?>
          </a>
        </h4>
      </div>
      <div class="panel-collapse collapse<?= ($opened ? ' in' : '') ?>" id="collapseFive">
        <div class="panel-body">
          <ul>
            <li class="item"><a href="<?= Yii::app()->createUrl('/cabinet/profile/index') ?>">
                    <?= Yii::t('main', 'Личные данные') ?></a>
            </li>
            <li class="item"><a href="<?= Yii::app()->createUrl('/cabinet/profile/email') ?>">
                    <?= Yii::t('main', 'Изменить E-mail') ?></a>
            </li>
            <li class="item"><a href="<?= Yii::app()->createUrl('/cabinet/profile/password') ?>">
                    <?= Yii::t('main', 'Изменить пароль') ?></a>
            </li>
            <li class="item"><a href="<?= Yii::app()->createUrl('/cabinet/profile/address') ?>">
                    <?= Yii::t('main', 'Список адресов') ?></a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
        <? $opened = preg_match('/(?:cabinet\/support)/is', $action); ?>
      <div class="panel-heading <?= ($opened ? 'opened' : 'closed') ?>" data-parent="#cabinetcategories"
           data-target="#collapseSix" data-toggle="collapse">
          <? $history = Yii::t('main', 'История обращений');
          $countMess = ($newAnswer) ? '(' . $newAnswer . ')' : '';
          $history = $history . $countMess;
          ?>
        <h4 class="panel-title">
          <a href="javascript:void(0);">
            <span class="fa <?= ($opened ? 'fa-arrow-down' : 'fa-arrow-right') ?>"></span>
              <?= Yii::t('main', 'Служба поддержки') ?>
          </a>
          <span class="categorycount"><?= $newAnswer ?></span>
        </h4>
      </div>
      <div class="panel-collapse collapse<?= ($opened ? ' in' : '') ?>" id="collapseSix">
        <div class="panel-body">
          <ul>
            <li class="item"><a href="<?= Yii::app()->createUrl('/tools/question') ?>">
                    <?= Yii::t('main', 'Задать вопрос') ?>
              </a>
            </li>
            <li class="itemLable"
            ">
            <a href="<?= Yii::app()->createUrl('/cabinet/support/history') ?>">
                <?= $history ?>
            </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
