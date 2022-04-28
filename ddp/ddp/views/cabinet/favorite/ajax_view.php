<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="ajax_view.php">
 * </description>
 **********************************************************************************************************************/
?>
<?php
$this->widget(
  'bootstrap.widgets.TbButton',
  [
    'buttonType'  => 'button',
    'type'        => 'primary',
    'icon'        => 'plus white',
    'label'       => Yii::t('admin', 'Создать'),
    'htmlOptions' => ['onclick' => 'renderCreateForm();'],
  ]
);
echo " ";
$this->widget(
  'bootstrap.widgets.TbButton',
  [
    'buttonType'  => 'button',
    'type'        => 'primary',
    'icon'        => 'edit white',
    'label'       => Yii::t('admin', 'Правка'),
    'htmlOptions' => ['onclick' => 'renderUpdateForm(' . $model->id . ');'],
  ]
);

echo " ";
$this->widget(
  'bootstrap.widgets.TbButton',
  [
    'buttonType'  => 'button',
    'type'        => 'primary',
    'icon'        => 'trash white',
    'label'       => Yii::t('admin', 'Удалить'),
    'htmlOptions' => ['onclick' => 'delete_record(' . $model->id . ');'],
  ]
);

echo " ";
$this->widget(
  'bootstrap.widgets.TbButton',
  [
    'buttonType'  => 'button',
    'type'        => 'primary',
    'icon'        => 'print white',
    'label'       => Yii::t('admin', 'Печать'),
    'htmlOptions' => ['onclick' => 'print();'],
  ]
);

echo "<div class='printableArea'>";
echo "<h1>View favorite #" . $model->id . "</h1><hr />";

$this->widget(
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
);
echo "</div>";