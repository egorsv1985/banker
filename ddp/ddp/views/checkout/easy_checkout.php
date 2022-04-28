<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 * Начало оформления заказа
 **********************************************************************************************************************/
?>

<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="page-title">
        <h3><?
            if ($type == 'order') {
                echo Yii::t('main', 'Оформление заказа - несколько простых шагов');
            } elseif ($type == 'parcel') {
                echo Yii::t('main', 'Оформление посылки - несколько простых шагов');
            }
            ?></h3>
      </div>
    </div><!--End:Col-->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    </div><!--End:Col-->
  </div><!--End:Row-->
</div><!--End:Container-->
<div class="content">
    <?
    if ($type == 'order') {
        if (DSConfig::getVal('parcel_use_parcel_system') == 0) {
            $this->widget(
              'application.components.widgets.EasyCheckoutBlockOrder',
              [
                'item_iid'  => $item_iid,
                'ds_source' => $ds_source,
              ]
            );
        } else {
            $this->widget(
              'application.components.widgets.EasyCheckoutBlockOrderForParcel',
              [
                'item_iid'  => $item_iid,
                'ds_source' => $ds_source,
              ]
            );
        }
    } elseif ($type == 'parcel') {
        $this->widget(
          'application.components.widgets.EasyCheckoutBlockParcel',
          []
        );
    }
    ?>
</div>