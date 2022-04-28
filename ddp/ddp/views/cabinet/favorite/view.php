<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="view.php">
 * </description>
 **********************************************************************************************************************/
?>
<?php
$this->breadcrumbs = [
  'Favorites' => ['index'],
  $model->id,
];
?>

<h1>View Favorite #<?php echo $model->id; ?></h1>
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
        'linkOptions' => [],
      ],
        //array('label'=>Yii::t('admin','Поиск'), 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
      [
        'label'       => Yii::t('admin', 'Печать'),
        'icon'        => 'icon-print',
        'url'         => 'javascript:void(0);return false',
        'linkOptions' => ['onclick' => 'printDiv();return false;'],
      ],

    ],
  ]
);
$this->endWidget();
?>
<div class='printableArea'>

    <?php $this->widget(
      'bootstrap.widgets.TbDetailView',
      [
        'data'       => $model,
        'attributes' => [
          'id',
          'uid',
          'num_iid',
          'date',
          'cid',
          'express_fee',
          'price',
          'promotion_price',
          'pic_url',
          'seller_rate',
        ],
      ]
    ); ?>
</div>
<style type="text/css" media="print">
  body {
    visibility: hidden;
  }

  .printableArea {
    visibility: visible;
  }
</style>
<script type="text/javascript">
    function printDiv() {

        window.print();

    }
</script>
