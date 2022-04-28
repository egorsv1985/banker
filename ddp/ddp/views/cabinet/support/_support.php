<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="_support.php">
 * </description>
 **********************************************************************************************************************/
?>
<?php
$category_values = [
  1 => Yii::t('main', 'Общие вопросы'),
  2 => Yii::t('main', 'Вопросы по моему заказу'),
  3 => Yii::t('main', 'Рекламация'),
  4 => Yii::t('main', 'Возврат денег'),
  5 => Yii::t('main', 'Оптовые заказы'),
];
return [

  'elements' => [
    'theme'    => [
      'type'      => 'text',
      'maxlength' => 256,
      'style'     => 'width:350px;',
    ],
    'text'     => [
      'type'  => 'textarea',
      'style' => 'width:350px;',
    ],
    'category' => [
      'type'  => 'dropdownlist',
      'items' => $category_values,
      'style' => 'width:150px;',
    ],
    'order_id' => [
      'type'      => 'text',
      'maxlength' => 500,
      'style'     => 'width:350px;',
    ],
    'file'     => [
      'type'      => 'file',
      'id'        => 'file_support',
      'maxlength' => 256,
      'style'     => 'width:350px;',
      'hint'      => '<p>' . Yii::t('main', 'Размер файла не должен превышать 1 Мб.') . '</p>',
    ],
  ],
  'buttons'  => [
    'submit' => [
      'type'  => 'submit',
      'label' => Yii::t('main', 'Отправить вопрос'),
      'class' => 'blue-btn bigger',
      'style' => 'float: left;margin: 25px 0 25px 30%;',
    ],
      /*    'button' => array(
            'type'  => 'button',
            'id'    => 'remove_file_support',
            'label' => Yii::t('main', 'Удалить файл'),
            'style' => 'float:right;margin: 25px 30% 25px 0px;',
            'class' => 'blue-btn bigger'
          ),
      */
  ],
];