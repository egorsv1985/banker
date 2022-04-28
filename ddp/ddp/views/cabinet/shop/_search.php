<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="_search.php">
 * </description>
 **********************************************************************************************************************/
?>
<?php $form = $this->beginWidget(
  'bootstrap.widgets.TbActiveForm',
  [
    'id' => 'search-shop-form',
    'enableAjaxValidation' => false,
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
  ]
); ?>


<?php echo $form->textFieldRow($model, 'id', ['class' => 'span5']); ?>

<?php echo $form->textFieldRow($model, 'uid', ['class' => 'span5']); ?>

<?php echo $form->textFieldRow($model, 'num_iid', ['class' => 'span5', 'maxlength' => 20]); ?>

<?php echo $form->textFieldRow($model, 'date', ['class' => 'span5']); ?>

<?php echo $form->textFieldRow($model, 'cid', ['class' => 'span5', 'maxlength' => 20]); ?>

<?php echo $form->textFieldRow($model, 'express_fee', ['class' => 'span5']); ?>

<?php echo $form->textFieldRow($model, 'price', ['class' => 'span5']); ?>

<?php echo $form->textFieldRow($model, 'promotion_price', ['class' => 'span5']); ?>

<?php echo $form->textFieldRow($model, 'pic_url', ['class' => 'span5', 'maxlength' => 512]); ?>

<?php echo $form->textFieldRow($model, 'seller_rate', ['class' => 'span5']); ?>

<div class="form-actions">
    <?php $this->widget(
      'bootstrap.widgets.TbButton',
      [
        'buttonType' => 'submit',
        'type'       => 'primary',
        'icon'       => 'search white',
        'label'      => Yii::t('admin', 'Поиск'),
      ]
    ); ?>
    <?php $this->widget(
      'bootstrap.widgets.TbButton',
      [
        'buttonType' => 'button',
        'type'       => 'danger',
        'icon'       => 'icon-remove-sign white',
        'label'      => Yii::t('admin', 'Сброс'),
      ]
    ); ?>
</div>

<?php $this->endWidget(); ?>


<?php /* Alexys $cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/themes/admin/css/jquery-ui.css');
*/
?>
<script>
    $('.btnreset').click(function () {
        $(':input', '#search-shop-form').each(function () {
            var type = this.type;
            var tag = this.tagName.toLowerCase(); // normalize case
            if (type == 'text' || type == 'password' || tag == 'textarea') this.value = '';
            else if (type == 'checkbox' || type == 'radio') this.checked = false;
            else if (tag == 'select') this.selectedIndex = '';
        });
    });
</script>

