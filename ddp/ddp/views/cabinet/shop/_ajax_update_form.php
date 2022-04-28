<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="_ajax_update_form.php">
 * </description>
 **********************************************************************************************************************/
?>
<div id='shop-update-modal' class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
  <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Update shop #<?php echo $model->id; ?></h3>
  </div>

  <div class="modal-body">

    <div class="form">
        <?php $form = $this->beginWidget(
          'bootstrap.widgets.TbActiveForm',
          [
            'id'                     => 'shop-update-form',
            'enableAjaxValidation'   => false,
            'enableClientValidation' => false,
            'method'                 => 'post',
            'action'                 => ["shop/update"],
            'type'                   => 'horizontal',
            'htmlOptions'            => [
              'onsubmit' => "return false;",
                /* Disable normal form submit */
                //'onkeypress'=>" if(event.keyCode == 13){ update(); } " /* Do ajax call when user presses enter key */
            ],

          ]
        ); ?>
      <fieldset>
        <legend>
          <p class="note">Fields with <span class="required">*</span> are required.</p>
        </legend>

          <?php echo $form->errorSummary(
            $model,
            'Opps!!!',
            null,
            ['class' => 'alert alert-error span12']
          ); ?>

        <div class="control-group">
          <div class="span4">

              <?php echo $form->hiddenField($model, 'id', []); ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'uid'); ?>
                <?php echo $form->textField($model, 'uid'); ?>
                <?php echo $form->error($model, 'uid'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'num_iid'); ?>
                <?php echo $form->textField($model, 'num_iid', ['size' => 20, 'maxlength' => 20]); ?>
                <?php echo $form->error($model, 'num_iid'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'date'); ?>
                <?php echo $form->textField($model, 'date'); ?>
                <?php echo $form->error($model, 'date'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'cid'); ?>
                <?php echo $form->textField($model, 'cid', ['size' => 20, 'maxlength' => 20]); ?>
                <?php echo $form->error($model, 'cid'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'express_fee'); ?>
                <?php echo $form->textField($model, 'express_fee'); ?>
                <?php echo $form->error($model, 'express_fee'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'price'); ?>
                <?php echo $form->textField($model, 'price'); ?>
                <?php echo $form->error($model, 'price'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'promotion_price'); ?>
                <?php echo $form->textField($model, 'promotion_price'); ?>
                <?php echo $form->error($model, 'promotion_price'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'pic_url'); ?>
                <?php echo $form->textField($model, 'pic_url', ['size' => 60, 'maxlength' => 512]); ?>
                <?php echo $form->error($model, 'pic_url'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'seller_rate'); ?>
                <?php echo $form->textField($model, 'seller_rate'); ?>
                <?php echo $form->error($model, 'seller_rate'); ?>
            </div>

          </div>
        </div>

    </div>
    <!--end modal body-->

    <div class="modal-footer">
      <div class="form-actions">

          <?php
          $this->widget(
            'bootstrap.widgets.TbButton',
            [
              'buttonType'  => 'submit',
                //'id'=>'sub2',
              'type'        => 'primary',
              'icon'        => 'ok white',
              'label'       => $model->isNewRecord ? Yii::t('admin', 'Создать') : Yii::t('admin', 'Сохранить'),
              'htmlOptions' => ['onclick' => 'update();'],
            ]
          );

          ?>

      </div>
    </div>
    <!--end modal footer-->
    </fieldset>

      <?php $this->endWidget(); ?>

  </div>

</div><!--end modal-->



