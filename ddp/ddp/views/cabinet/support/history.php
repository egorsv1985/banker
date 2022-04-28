<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="history.php">
 * </description>
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="row">
    <div class="row clearfix f-space10"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="page-title">
        <h2><?= $this->pageTitle ?></h2>
      </div>
    </div>
  </div>
  <div class="row clearfix f-space10"></div>
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
        <? // Виджет меню кабинета
        $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
      <div class="cabinet-content">
        <div class="cabinet-table">
            <? $this->widget(
              'booster.widgets.TbGridView',
              [
                'id'           => 'question-grid',
                'dataProvider' => $model->search(),
                'filter'       => $model,
                'pager'        => [
                  'header'         => '',
                  'firstPageLabel' => '&lt;&lt;',
                  'prevPageLabel'  => '&lt;',
                  'nextPageLabel'  => '&gt;',
                  'lastPageLabel'  => '&gt;&gt;',
                ],
                'template'     => '{summary}{items}{pager}',
                'summaryText'  => Yii::t('main', 'Обращения') . ' {start}-{end} ' . Yii::t(
                    'main',
                    'из'
                  ) . ' {count}',
                'columns'      => [
                  [
                    'name'  => 'id',
                    'type'  => 'raw',
                    'value' => 'CHtml::link("Q0000".$data->id, array("/cabinet/support/view", "id"=>$data->id))',
                  ],
                  [
                    'name'   => 'category',
                    'filter' => [
                      1 => Yii::t('main', 'Общие вопросы'),
                      2 => Yii::t('main', 'Вопросы по моему заказу'),
                      3 => Yii::t('main', 'Рекламация'),
                      4 => Yii::t('main', 'Возврат денег'),
                      5 => Yii::t('main', 'Оптовые заказы'),
                    ],
                    'value'  => '$data->text_category',
                  ],
                  'theme',
                  [
                    'name'  => 'date',
                    'type'  => 'raw',
                    'value' => 'date("d.m.Y H:i",$data->date)',
                  ],
                  [
                    'name'  => 'date_change',
                    'type'  => 'raw',
                    'value' => '$data->date_change!=null ? date("d.m.Y H:i",$data->date_change) : date("d.m.Y H:i",$data->date)',
                  ],
                  [
                    'name'   => 'status',
                    'filter' => [
                      1 => Yii::t('main', 'На рассмотрении'),
                      2 => Yii::t('main', 'Получен ответ'),
                      3 => Yii::t('main', 'Закрыто'),
                    ],
                    'value'  => '$data->text_status',
                  ],
                ],
              ]
            );
            ?>
        </div>
      </div>
    </div>

  </div>