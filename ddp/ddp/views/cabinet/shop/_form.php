<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="_form.php">
 * </description>
 **********************************************************************************************************************/
?>
<div class="form">
    <?php $form = $this->beginWidget(
      'bootstrap.widgets.TbActiveForm',
      [
        'id' => 'shop-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => [
          'enctype' => 'multipart/form-data',
        ],
      ]
    ); ?>
  <fieldset>
    <legend>
      <p class="note">Fields with <span class="required">*</span> are required.</p>
    </legend>

      <?php echo $form->errorSummary($model, 'Opps!!!', null, ['class' => 'alert alert-error span12']); ?>

    <div class="control-group">
      <div class="span4">

          <?php echo $form->textFieldRow($model, 'uid', ['class' => 'span5']); ?>

          <?php echo $form->textFieldRow($model, 'num_iid', ['class' => 'span5', 'maxlength' => 20]); ?>

          <?php echo $form->textFieldRow($model, 'date', ['class' => 'span5']); ?>

          <?php echo $form->textFieldRow($model, 'cid', ['class' => 'span5', 'maxlength' => 20]); ?>

          <?php echo $form->textFieldRow($model, 'express_fee', ['class' => 'span5']); ?>

          <?php echo $form->textFieldRow($model, 'price', ['class' => 'span5']); ?>

          <?php echo $form->textFieldRow($model, 'promotion_price', ['class' => 'span5']); ?>

          <?php echo $form->textFieldRow($model, 'pic_url', ['class' => 'span5', 'maxlength' => 512]); ?>

          <?php echo $form->textFieldRow($model, 'seller_rate', ['class' => 'span5']); ?>

      </div>
    </div>

    <div class="form-actions">
        <?php $this->widget(
          'bootstrap.widgets.TbButton',
          [
            'buttonType' => 'submit',
            'type'       => 'primary',
            'icon'       => 'ok white',
            'label'      => $model->isNewRecord ? Yii::t('admin', 'Создать') : Yii::t('admin', 'Сохранить'),
          ]
        ); ?>
        <?php $this->widget(
          'bootstrap.widgets.TbButton',
          [
            'buttonType' => 'reset',
            'icon'       => 'remove',
            'label'      => Yii::t('admin', 'Сброс'),
          ]
        ); ?>
    </div>
  </fieldset>

    <?php $this->endWidget(); ?>

</div>
