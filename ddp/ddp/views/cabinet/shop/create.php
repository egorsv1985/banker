<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="create.php">
 * </description>
 **********************************************************************************************************************/
?>
<?php
$this->breadcrumbs = [
  'Shop' => ['index'],
  'Create',
];

?>

  <h1>Create Shop</h1>
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
        'active'      => true,
        'linkOptions' => [],
      ],
        //array('label'=>Yii::t('admin','Список'), 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
      [
        'label'       => Yii::t('admin', 'Поиск'),
        'icon'        => 'icon-search',
        'url'         => '#',
        'linkOptions' => ['class' => 'search-button'],
      ],
    ],
  ]
);
$this->endWidget();
?>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>