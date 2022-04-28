<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="admin.php">
 * </description>
 **********************************************************************************************************************/
?>
<?php
$this->breadcrumbs = [
  'Favorites' => ['index'],
  'Manage',
];

$this->menu = [
  ['label' => Yii::t('admin', 'Список'), 'url' => ['index']],
  ['label' => Yii::t('admin', 'Добавить'), 'url' => ['create']],
];

Yii::app()->clientScript->registerScript(
  'search',
  "
 $('.search-button').click(function(){
     $('.search-form').toggle();
     return false;
 });
 $('.search-form form').submit(function(){
     $.fn.yiiGridView.update('favorite-grid', {
         data: $(this).serialize()
     });
     return false;
 });
 "
);
?>

<h1>Manage Favorites</h1>

<p>
    <?= Yii::t('admin', 'Вы можете использовать операторы сравнения') ?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>
    &gt;=</b>, <b>&lt;&gt;</b>
  or <b>=</b>)</p>

<?php echo CHtml::link(Yii::t('admin', 'Advanced Search'), '#', ['class' => 'search-button btn']); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial(
      '_search',
      [
        'model' => $model,
      ]
    ); ?>
</div><!-- search-form -->

<?php $this->widget(
  'bootstrap.widgets.TbGridView',
  [
    'id' => 'favorite-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
      'id',
      'uid',
      'num_iid',
      'date',
      'cid',
      'express_fee',
        /*
        'price',
        'promotion_price',
        'pic_url',
        'seller_rate',
        */
      [
        'class' => 'bootstrap.widgets.TbButtonColumn',
      ],
    ],
  ]
); ?>
