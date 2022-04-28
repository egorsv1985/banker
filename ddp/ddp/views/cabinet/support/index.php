<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="row clearfix f-space10"></div>
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
        <? // Виджет меню кабинета
        $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
      <div class="cabinet-content">
        <h3><?= Yii::t('main', 'Задать вопрос в службу поддержки') ?>:</h3>

        <p style="text-align:center; color:red"><?=
            Yii::t(
              'main',
              'Символом * отмечены поля, обязательные для заполнения'
            ) ?>.</p>

        <div class="form">
            <?= $form ?>
        </div>
      </div>
      <div class="content" style="background-color: #EEE"><?= cms::customContent('support') ?></div>
    </div>

  </div>
</div>
