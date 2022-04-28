<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="_view.php">
 * </description>
 **********************************************************************************************************************/
?>
<div class="view">

  <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), ['view', 'id' => $data->id]); ?>
  <br/>

  <b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
    <?php echo CHtml::encode($data->uid); ?>
  <br/>

  <b><?php echo CHtml::encode($data->getAttributeLabel('num_iid')); ?>:</b>
    <?php echo CHtml::encode($data->num_iid); ?>
  <br/>

  <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
    <?php echo CHtml::encode($data->date); ?>
  <br/>

  <b><?php echo CHtml::encode($data->getAttributeLabel('cid')); ?>:</b>
    <?php echo CHtml::encode($data->cid); ?>
  <br/>

  <b><?php echo CHtml::encode($data->getAttributeLabel('express_fee')); ?>:</b>
    <?php echo CHtml::encode($data->express_fee); ?>
  <br/>

  <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
    <?php echo CHtml::encode($data->price); ?>
  <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('promotion_price')); ?>:</b>
	<?php echo CHtml::encode($data->promotion_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pic_url')); ?>:</b>
	<?php echo CHtml::encode($data->pic_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seller_rate')); ?>:</b>
	<?php echo CHtml::encode($data->seller_rate); ?>
	<br />

	*/
    ?>

</div>