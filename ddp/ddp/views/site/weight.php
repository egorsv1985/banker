<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="translate.php">
 * </description>
 * Форма онлайн-редактирования переводов
 **********************************************************************************************************************/
?>
<?
$form = $this->beginWidget(
  'CActiveForm',
  [
    'id' => 'weight-form',
    'enableAjaxValidation' => false,
  ]
);
?>
  <input name="WeightForm[cid]" id="WeightForm_cid" type="hidden" value=""></input>
  <input name="WeightForm[iid]" id="WeightForm_iid" type="hidden" value=""></input>
  <div class="row">
    <label for="WeightForm_weight"><?= Yii::t('main', 'Введите вес 1 шт. товара в граммах') ?>:</label>
    <input name="WeightForm[weight]" id="WeightForm_weight" type="text" value=""></input>
  </div>
  <div class="row buttons" style="float:right; margin: 20px 5px 0 0;">
    <input type="button" class="blue-btn bigger" value="<?= Yii::t('main', 'Сохранить') ?>"
           onClick="saveWeight();">
  </div>
<?php $this->endWidget(); ?>