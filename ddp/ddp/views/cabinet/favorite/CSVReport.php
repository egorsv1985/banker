<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="CSVReport.php">
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
                  id="<?= $cat['id'] ?>"<?= ($cat['parent'] > 0) ? ' parentId="' . $cat['parent'] . '"' :
                '' ?>><?= $cat['name'] ?></category>
                <?
            }
        } ?>
      <category id="0"><?= Yii::t('main', 'Прочее') ?></category>
    </categories>
    <local_delivery_cost>0</local_delivery_cost>
    <offers>
        <? if (isset($exportData->items) && is_array($exportData->items)) {
            foreach ($exportData->items as $item) {
//--------------------
                ob_start();
                set_time_limit(0);

                try {
                    $itemEx = new Item($item->ds_source, $item->num_iid);
                    if (!$itemEx) {
                        continue;
                    }
                } catch (Exception $e) {
                    continue;
                }
//          $itemRequest = new DSGItem(false);
//          $itemRequest->id = $item->num_iid;
//          $itemRequest->fromCart = true;
//          $itemComplete = $itemRequest->execute('item.taobao.com');
                ?>
              <offer id="<?= $item->num_iid ?>" type="vendor.model" available="true">
                <url>http://<?= DSConfig::getVal('site_domain') ?>/item/<?= $item->num_iid ?></url>
                <price><?=
                    Formulas::convertCurrency(
                      min($item->price, $item->promotion_price),
                      'cny',
                      'rur',
                      2
                    ) ?></price>
                <currencyId>RUR</currencyId>
                <categoryId
                    type="Own"><?= (isset($exportData->categoriesDistinct[$item->cid])) ?
                      $exportData->categoriesDistinct[$item->cid] :
                      0 ?></categoryId>
                <picture><?= $item->pic_url ?></picture>
                <store>true</store>
                <pickup>false</pickup>
                <delivery>true</delivery>
                <local_delivery_cost>0</local_delivery_cost>
                  <? //               <typePrefix>Принтер</typePrefix> ?>
                <vendor><?= DSConfig::getVal('site_name') ?></vendor>
                  <? //               <vendorCode>CH366C</vendorCode> ?>
                <model>ITEM-<?= $item->num_iid ?></model>
                  <? /*               <description>Серия принтеров для людей, которым нужен надежный, простой в использовании
                 цветной принтер для повседневной печати. Формат А4. Технология печати: 4-цветная термальная струйная.
                 Разрешение при печати: 4800х1200 т/д.
               </description> */
                  ?>
                  <? //               <sales_notes>Необходима предоплата.</sales_notes> ?>
                <manufacturer_warranty>true</manufacturer_warranty>
                  <? //<seller_warranty>true</seller_warranty> ?>
                <country_of_origin><?= Yii::t('main', 'Китай') ?></country_of_origin>
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
                ob_end_flush();
            }
        } ?>
    </offers>
  </shop>
</yml_catalog>