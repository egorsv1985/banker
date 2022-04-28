<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="YMLReport.php">
 * </description>
 **********************************************************************************************************************/
?>
<?
echo '<?xml version="1.0" encoding="UTF-8" ?>'; //UTF-8
?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="<?= date('Y-m-d H:i') ?>">
  <shop>
    <name><?= DSConfig::getVal('site_name') ?></name>
    <company><?= DSConfig::getVal('site_name') ?></company>
    <url>http://<?= DSConfig::getVal('site_domain') ?>/</url>
    <currencies>
      <currency id="RUR" rate="1" plus="0"/>
    </currencies>
    <categories>
        <? if (isset($exportData->categories) && is_array($exportData->categories)) {
            foreach ($exportData->categories as $cat) {
                ?>
              <category
                  id="<?= $cat['cid'] ?>"<?= ($cat['parent'] > 0) ? ' parentId="' . $cat['parent'] . '"' : '' ?>>
                <![CDATA[<?= $cat['name'] ?>]]>
              </category>
                <?
            }
        } ?>
      <category id="0"><?= Yii::t('main', 'Прочее') ?></category>
    </categories>
    <local_delivery_cost>0</local_delivery_cost>
    <offers>
        <? if (isset($exportData->items) && is_array($exportData->items)) {
            foreach ($exportData->items as $baseItem) {
//--------------------
                set_time_limit(300);
                try {
                    $itemEx = unserialize($baseItem->dsg_item);
                    if (!$itemEx) {
                        continue;
                    }
                } catch (Exception $e) {
                    continue;
                }
                ?>
              <offer id="<?= $itemEx->num_iid ?>" type="vendor.model" available="true">
                <url><![CDATA[http://<?= DSConfig::getVal('site_domain') ?>/item/<?= $itemEx->num_iid ?>]]>
                </url>
                <price><?= min($itemEx->price, $itemEx->promotion_price) + $itemEx->express_fee ?></price>
                <currencyId>RUR</currencyId>
                <categoryId><?= (isset($exportData->categoriesDistinct[$itemEx->cid])) ?
                      $exportData->categoriesDistinct[$itemEx->cid] :
                      0 ?></categoryId>
                  <? if (isset($itemEx->item_imgs->item_img) && (count($itemEx->item_imgs->item_img) > 0)) {
                      foreach ($itemEx->item_imgs->item_img as $item_img) {
                          ?>
                        <picture><?= $item_img->url ?></picture>
                          <?
                      }
                  } else {
                      ?>
                    <picture><?= $itemEx->pic_url ?></picture>
                  <? } ?>
                <delivery>true</delivery>
                <local_delivery_cost>0</local_delivery_cost>
                  <? $brand = '';
                  foreach ($itemEx->item_attributes as $attribute) {
                      if (preg_match('/бр[еэ]нд/isu', $attribute->prop)) {
                          $brand = $brand . Utils::removeOnlineTranslation($attribute->val) . ' ';
                      }
                  }
                  ?>
                <name>
                  <![CDATA[<?=
                    Yii::app()->DVTranslator->translateText(
                      $itemEx->title,
                      'zh-CHS',
                      'ru',
                      'item_title',
                      false,
                      true,
                      false
                    ); ?>
                  ]]>
                </name>
                <vendor><![CDATA[<?= ($brand) ? $brand : 'noname' ?>]]></vendor>
                <model><?= $itemEx->num_iid ?></model>
                <description><![CDATA[<?= Item::getDescriptionFromUrl($itemEx->descUrl, true) ?>]]>
                </description>
                  <? foreach ($itemEx->item_attributes as $attribute) { ?>
                    <param
                        name="<?=
                        Utils::removeOnlineTranslation(
                          $attribute->prop
                        ) ?>"><![CDATA[<?= Utils::removeOnlineTranslation($attribute->val) ?>]]></param>
                  <? } ?>
                  <? /*               <barcode>1234567890120</barcode>
               <cpa>1</cpa>
               <rec>123123,1214,243</rec>
               <expiry>P5Y</expiry>
               <weight>2.07</weight>
               <dimensions>100/25.45/11.112</dimensions>
               <param name="Максимальный формат">А4</param>
               <param name="Технология печати">термическая струйная</param>
               <param name="Тип печати">Цветная</param>
               <param name="Количество страниц в месяц" unit="стр">1000</param>
               <param name="Потребляемая мощность" unit="Вт">20</param>
               <param name="Вес" unit="кг">2.73</param>
*/
                  ?>
              </offer>
                <?
            }
        } ?>
    </offers>
  </shop>
</yml_catalog>