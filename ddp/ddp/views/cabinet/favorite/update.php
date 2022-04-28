<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="update.php">
 * </description>
 **********************************************************************************************************************/
?>
<?php
$this->breadcrumbs = [
  'Favorites' => ['index'],
  $model->id  => ['view', 'id' => $model->id],
  'Update',
];

?>

  <h1>Update Favorite <?php echo $model->id; ?></h1>
  <hr/>

<?php
$this->beginWidget(
  'zii.widgets.CPortlet',
  [
    'htmlOptions' => [
      'class' => '',
    ],
  ]
);
$this->widget(
  'bootstrap.widgets.TbMenu',
  [
    'type'  => 'pills',
    'items' => [
      [
        'label'       => Yii::t('admin', 'Создать'),
        'icon'        => 'icon-plus',
        'url'         => Yii::app()->controller->createUrl('create'),
        'linkOptions' => [],
      ],
        //array('label'=>Yii::t('admin','Список'), 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
      [
        'label'       => Yii::t('admin', 'Правка'),
        'icon'        => 'icon-edit',
        'url'         => Yii::app()->controller->createUrl('update', ['id' => $model->id]),
        'active'      => true,
        'linkOptions' => [],
      ],
    ],
  ]
);
$this->endWidget();
?>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>