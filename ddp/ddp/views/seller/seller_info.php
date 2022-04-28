<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="seller_info.php">
 * </description>
 * Рендеринг информации о продавце
 **********************************************************************************************************************/
?>
  <span><?= Yii::t('main', 'Рейтинг продавца') ?>&nbsp;:&nbsp;</span>
<? if ($sellerInfo && isset($sellerInfo->seller->sales)) { ?>
  <span class="rating"><i
        class="i-rating rating_<?= DSGSeller::getCrownsFromSales($sellerInfo->seller->sales) - 1; ?>"></i></span>
<? } else { ?>
    <?= Yii::t('main', 'скрыт продавцом'); ?>
<? } ?>

<? if ($sellerInfo && isset($sellerInfo->seller->rates) && count(
    $sellerInfo->seller->rates
  )
) { ?>
    <? if (isset($sellerInfo->seller->rates['description_q'])) { ?>
    <br/>
    <span><?= Yii::t('main', 'Описание товаров') ?>:</span>
    <span class="pull-right"><?= round($sellerInfo->seller->rates['description_q'], 2) ?></span>
    <? } ?>
    <? if (isset($sellerInfo->seller->rates['service_q'])) { ?>
    <br/>
    <span><?= Yii::t('main', 'Сервис и обслуживание') ?>:</span>
    <span class="pull-right"><?= round($sellerInfo->seller->rates['service_q'], 2) ?></span>
    <? } ?>
    <? if (isset($sellerInfo->seller->rates['delivery_q'])) { ?>
    <br/>
    <span><?= Yii::t('main', 'Скорость отправки товара') ?>:</span>
    <span class="pull-right"><?= round($sellerInfo->seller->rates['delivery_q'], 2) ?></span>
    <? } ?>
<? } ?>
<? if ($sellerInfo && isset($sellerInfo->seller->reviews) && count(
    $sellerInfo->seller->reviews
  )
) { ?>
  <br/>
  <label><?= Yii::t('main', 'Отзывы о продавце') ?>:</label>
    <? if (isset($sellerInfo->seller->reviews['positive'])) { ?>
    &nbsp;<span style="color: green;">+<?= $sellerInfo->seller->reviews['positive'] ?></span>
    <? } ?>
    <? if (isset($sellerInfo->seller->reviews['normal'])) { ?>
    &nbsp;/&nbsp;<?= $sellerInfo->seller->reviews['normal'] ?>
    <? } ?>
    <? if (isset($sellerInfo->seller->reviews['negative'])) { ?>
    &nbsp;/&nbsp;<span style="color: red;">-<?= $sellerInfo->seller->reviews['negative'] ?></span>
    <? } ?>
<? } ?>