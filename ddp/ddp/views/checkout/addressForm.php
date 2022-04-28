<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="_address.php">
 * </description>
 * Параметры формы создания нового адреса доставки
 **********************************************************************************************************************/
?>
<?php
return [
  'elements' => [
    'step'     => [
      'type'  => 'hidden',
      'value' => '1',
    ],
    'fullname' => [
      'type'      => 'text',
      'maxlength' => 512,
    ],
    'country'  => [
      'type'   => 'dropdownlist',
      'items'  => Deliveries::getCountries(),
      'prompt' => Yii::t('main', 'Выбрать'),
    ],
    'index'    => [
      'type'      => 'text',
      'maxlength' => 32,
    ],
    'city'     => [
      'type'      => 'text',
      'maxlength' => 128,
    ],
    'address'  => [
      'type' => 'textarea',
      'rows' => '10',
    ],
    'region'   => [
      'type'      => 'text',
      'maxlength' => 128,
    ],
    'phone'    => [
      'type'      => 'text',
      'mahlength' => 32,
    ],
  ],
  'buttons'  => [
    'submit' => [
      'type'  => 'submit',
      'label' => Yii::t('main', 'Добавить'),
      'class' => 'blue-btn bigger',
      'style' => 'float:left',
    ],
    'reset'  => [
      'type'    => 'reset',
      'label'   => Yii::t('main', 'Отмена'),
      'onclick' => 'window.history.back()',
      'class'   => 'blue-btn bigger',
      'style'   => 'float:right;',
    ],
  ],
];