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

      <div class="cabinet-content">
        <div class="form">
            <?
            $form = $this->beginWidget(
              'booster.widgets.TbActiveForm',
              [
                'id'                     => 'form-email-events',
                'enableAjaxValidation'   => false,
                'enableClientValidation' => false,
                'method'                 => 'post',
                'action'                 => Yii::app()->createUrl('/cabinet/profile/mailevents', []),
                  /* 'htmlOptions'            => array(
                  'onsubmit' => "return false;",// Disable normal form submit
                  ),
                  */
                'clientOptions'          => [
                  'validateOnType'   => false,
                  'validateOnSubmit' => false,
                ],
              ]
            );
            $this->widget(
              'booster.widgets.TbGridView',
              [
                'id'            => 'EventsAndSubscroptionsForUser-grid',
                'type'          => 'striped',
                'dataProvider'  => $eventsAndSubscroptionsForUserDataProvider,
                'enableSorting' => false,
                'template'      => '{items}',
                'columns'       => [
                  [
                    'name'   => 'name',
                    'header' => Yii::t('admin', 'Событие'),
                    'type'   => 'raw',
                    'value'  => function ($data) {
                        $result = Yii::t('main', $data['name']);
                        if (preg_match('/(?:manager|менеджер|закупщик)/ius', $result)) {
                            $result = "<strong>{$result}</strong>";
                        }
                        return $result;
                    },
                  ],
                  [
                    'name'   => 'enable',
                    'type'   => 'raw',
                    'header' => Yii::t('admin', 'Включено'),
                    'value'  => function ($data) {
                        ?>
                      <input name='events[<?= $data['id'] ?>][subscribe]'
                             type="checkbox" <?= ($data['enable'] ? ' checked="checked"' : '') ?>/>
                        <?
                    },
                  ],
                ],
              ]
            );
            ?>
          <div class="row buttons">
            <input type="submit" form="form-email-events"
                   value="<?= Yii::t('main', 'Сохранить') ?>"
                   name="aplyEmailEvents"
                   class="btn btn-danger blue-btn bigger pull-right"/>
          </div>
            <? $this->endWidget('CActiveForm'); ?>
        </div>
      </div>

    </div><!--/col-->

  </div><!--/row-->
</div><!--/container-->
<br/><br/>