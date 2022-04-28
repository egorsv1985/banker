<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="address.php">
 * </description>
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="row clearfix f-space10"></div>
  <div class="row">
      <? // Блок меню кабинета ?>
    <div class="col-md-3 col-sm-3 col-xs-3 box-block page-sidebar">
      <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
        <? // Виджет меню кабинета
        $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
      <div class="cabinet-content">
          <?
          $addressesDataProvider = new Addresses();
          $addressesDataProvider->uid = Yii::app()->user->id;
          $addressesDataProvider->enabled = 1;
          $addressesDataProvider->is_delivery_point = 1; // Это нормально, потом работает логика OR
          $this->widget(
            'booster.widgets.TbGridView',
            [
              'id'           => 'users-addresses-grid',
              'type'         => 'striped',
              'dataProvider' => $addressesDataProvider->search(25),
              'type'         => 'striped condensed responsive',
              'template'     => '{summary}{pager}{items}{pager}',
              'columns'      => [
                [
                  'name'   => 'address',
                  'header' => Yii::t('main', 'Адрес'),
                  'type'   => 'raw',
                  'value'  => function ($data) use ($countries) { ?>
                      <?= $countries[$data->country] ?>
                    ,<? if ($data->region) { ?>&nbsp;<?= $data->region ?>,<? } ?>
                    &nbsp;<?= $data->city ?>,<br/><?= $data->index ?>,&nbsp;<?= $data->address ?>
                  <? },
                ],
              [
                'name'   => 'uid',
                'header' => Yii::t('main', 'Получатель'),
                'type'   => 'raw',
                'value'  => function ($data) { ?>
                    <?= $data->fullname ?>
                <? },
              ],
              [
                'name'   => 'phone',
                'header' => Yii::t('main', 'Телефон'),
                'type'   => 'raw',
                'value'  => function ($data) { ?>
                    <?= $data->phone ?>
                <? },
              ],
              [
                'name'   => 'is_delivery_point',
                'header' => Yii::t('main', 'Офис'),
                'type'   => 'raw',
                'value'  => function ($data) { ?>
                    <?= ($data->is_delivery_point ? Yii::t('main', 'да') : '') ?>
                <? },
              ],
                [
                  'type'        => 'raw',
                  'value'       => function ($data) { ?>
                      <? if ((Yii::app()->user->id == $data->uid)
                        || Yii::app()->user->inRole(['superAdmin', 'topManager'])
                      ) { ?>
                      <a href='<?= Yii::app()->createUrl(
                        '/cabinet/profile/updateaddress',
                        ['id' => $data->id]
                      ) ?>' class='btn btn-xs btn-default'
                         title='<?= Yii::t('admin', 'Редактировать') ?>'><i class='fa fa-cog'
                                                                            style='color: #000'></i></a>
                      <a href='<?= Yii::app()->createUrl(
                        '/cabinet/profile/deleteaddress',
                        ['id' => $data->id]
                      ) ?>' class='btn btn-xs btn-default'
                         title='<?= Yii::t('admin', 'Удалить') ?>'><i class='fa fa-trash'
                                                                      style='color: #000'></i></a>
                      <? } else { ?>
                      &nbsp;
                      <? } ?>
                  <? },
                  'htmlOptions' => ['style' => 'width:70px;'],
                ],
              ],
            ]
          );
          ?>
        <br/><br/>
        <div class="row buttons pull-right">
          <input type="hidden" id="hidden_address"
                 value="<?= Yii::app()->createUrl('/cabinet/profile/createaddress') ?>"/>
            <?= CHtml::button(
              Yii::t('main', 'Добавить адрес'),
              [
                'id'    => 'add_address',
                'class' => 'btn btn-danger blue-btn bigger',
                'style' => 'bottom:10px;position:relative;',
              ]
            ); ?>
        </div>
      </div>
    </div>

  </div>
</div>

