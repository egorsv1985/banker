<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="OrderItem.php">
 * </description>
 * Виджет отображения лота заказа
 * var $item = OrdersItems#1
 * (
 * [status_text] => 'Не обработан'
 * [calculated_lotPrice] => 330
 * [calculated_lotWeight] => 2400
 * [calculated_lotExpressFee] => 0
 * [calculated_actualPrice] => '0.00'
 * [calculated_actualWeight] => '0.00'
 * [calculated_actualExpressFee] => '0.00'
 * [calculated_operatorProfit] => 0
 * [vars] => array
 * (
 * 'num' => FormulasVar#2
 * (
 * [val] => '6'
 * [description] => 'Заказанное количество штук товаров в лоте'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * 'actual_num' => FormulasVar#3
 * (
 * [val] => '6'
 * [description] => 'Фактическое количество штук товаров в лоте'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * 'calculated_lotPrice' => FormulasVar#4
 * (
 * [val] => 330
 * [description] => 'Стоимость закупки лота в заказе, в юанях'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * 'calculated_lotExpressFee' => FormulasVar#5
 * (
 * [val] => 0
 * [description] => 'Стоимость доставки лота в заказе, в юанях'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * 'calculated_lotWeight' => FormulasVar#6
 * (
 * [val] => 2400
 * [description] => 'Вес лота в заказе'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * 'calculated_actualPrice' => FormulasVar#7
 * (
 * [val] => 0
 * [description] => 'Расчётная стоимость одного товара лота'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * 'calculated_actualWeight' => FormulasVar#8
 * (
 * [val] => 0
 * [description] => 'Расчётный вес одного товара лота'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * 'calculated_actualExpressFee' => FormulasVar#9
 * (
 * [val] => 0
 * [description] => 'Расчётная стоимость доставки одного товара лота'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * 'billing_use_operator_account' => FormulasVar#10
 * (
 * [val] => true
 * [description] => 'Начислять ли бонусы оператору'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * 'billing_operator_profit_model' => FormulasVar#11
 * (
 * [val] => 'FROM_PURCHASE=0.1&FROM_TOTAL=0.05'
 * [description] => 'Параметры начисления бонусов'
 * [params] => array(...)
 * [vars] => array(...)
 * )
 * )
 * [CActiveRecord:_new] => false
 * [CActiveRecord:_attributes] => array
 * (
 * 'id' => '9594'
 * 'oid' => '1916'
 * 'iid' => '15582293584'
 * 'pic_url' => 'http://img02.taobaocdn.com/bao/uploaded/i2/888549075/T2OdO_XzVXXXXXXXXX-888549075.jpg'
 * 'sku_id' => '41572369030'
 * 'props' => '20518:28419;1627207:28338'
 * 'title' => '夏季女装运动裤女薄款运动休闲裤女纯棉卫裤加长裤子直筒宽松显瘦'
 * 'seller_nick' => '凯瑟雅服饰'
 * 'seller_id' => '888549075'
 * 'status' => '1'
 * 'num' => '6'
 * 'weight' => '400'
 * 'express_fee' => '0'
 * 'input_props' => '[{\"name\":\"<translation editable=\\\"1\\\" translated=\\\"0\\\" url=\\\"\\/site\\/translate\\\"
 * type=\\\"prepareProps\\\" from=\\\"zh-CHS\\\" to=\\\"ru\\\" uid=\\\"0\\\" id=\\\"plain0\\\" title=\\\"plain[0]:
 * \\u5c3a\\u5bf8\\\"
 * >\\u5c3a\\u5bf8<translate  onclick=\\\"editTranslation(event,this.parentNode,\'plain\',\'0\');
 * stopPropagation(event); return false;\\\"
 * ><span class=\\\"ui-icon ui-icon-pencil\\\"><span><\\/translate><\\/translation>\",\"value\":\"<translation
 * editable=\\\"1\\\" translated=\\\"0\\\" url=\\\"\\/site\\/translate\\\" type=\\\"prepareProps\\\"
 * from=\\\"zh-CHS\\\" to=\\\"ru\\\" uid=\\\"0\\\" id=\\\"plain0\\\" title=\\\"plain[0]: XXL\\u7801\\\"
 * >XXL\\u7801<translate onclick=\\\"editTranslation(event,this.parentNode,\'plain\',\'0\'); stopPropagation(event);
 * return false;\\\" ><span class=\\\"ui-icon
 * ui-icon-pencil\\\"><span><\\/translate><\\/translation>\",\"name_zh\":\"\\u5c3a\\u5bf8\",\"value_zh\":\"XXL\\u7801\"},{\"name\":\"<translation
 * editable=\\\"1\\\" translated=\\\"0\\\" url=\\\"\\/site\\/translate\\\" type=\\\"prepareProps\\\"
 * from=\\\"zh-CHS\\\" to=\\\"ru\\\" uid=\\\"0\\\" id=\\\"plain0\\\" title=\\\"plain[0]:
 * \\u989c\\u8272\\u5206\\u7c7b\\\" >\\u989c\\u8272\\u5206\\u7c7b<translate
 * onclick=\\\"editTranslation(event,this.parentNode,\'plain\',\'0\'); stopPropagation(event); return false;\\\" ><span
 * class=\\\"ui-icon ui-icon-pencil\\\"><span><\\/translate><\\/translation>\",\"value\":\"<translation editable=\\\"1\\\" translated=\\\"0\\\" url=\\\"\\/site\\/translate\\\" type=\\\"prepareProps\\\" from=\\\"zh-CHS\\\" to=\\\"ru\\\" uid=\\\"0\\\" id=\\\"plain0\\\" title=\\\"plain[0]: \\u590f\\u5b63\\u8584\\u6b3e\\u6d45\\u7070\\u8272\\\" >\\u590f\\u5b63\\u8584\\u6b3e\\u6d45\\u7070\\u8272<translate  onclick=\\\"editTranslation(event,this.parentNode,\'plain\',\'0\'); stopPropagation(event); return false;\\\" ><span class=\\\"ui-icon ui-icon-pencil\\\"><span><\\/translate><\\/translation>\",\"name_zh\":\"\\u989c\\u8272\\u5206\\u7c7b\",\"value_zh\":\"\\u590f\\u5b63\\u8584\\u6b3e\\u6d45\\u7070\\u8272\"}]'
* 'source_price' => '118'
 * 'source_promotion_price' => '55'
 * 'tid' => null
 * 'track_code' => null
 * 'actual_num' => '6'
 * 'actual_lot_weight' => null
 * 'actual_lot_express_fee' => null
 * 'actual_lot_price' => null
 * )
 * [CActiveRecord:_related] => array()
 * [CActiveRecord:_c] => null
 * [CActiveRecord:_pk] => '9594'
 * [CActiveRecord:_alias] => 't'
 * [CModel:_errors] => array()
 * [CModel:_validators] => null
 * [CModel:_scenario] => 'update'
 * [CComponent:_e] => null
 * [CComponent:_m] => null
 * )
 * var $order = false
 * var $readOnly = true
 * var $allowDelete = false
 * var $adminMode = false
 * var $imageFormat = '_200x200.jpg'
 * var $publicComments = true
 * var $lazyLoad = true
 **********************************************************************************************************************/
?>
<?
$inAdmin = preg_match('/\/admin\//i', $_SERVER['REQUEST_URI']);
?>
<!-- product -->
<input type="hidden" name="iid[<?= $item->id ?>]" value="<?= $item->iid ?>"/>
<input type="hidden" name="params[<?= $item->id ?>]"
       value="<?= (isset($item->props)) ? $item->props : $item->input_props ?>"/>

<div class="row">
  <div class="product">
    <!-- <div class="col-md-2 col-sm-3 hidden-xs p-wr">-->
    <div class="col-md-2 col-sm-2 p-wr">
      <div class="product-attrb-wr">
        <div class="product-attrb">
          <div class="image" style="height: 144px;">
            <a class="img" href="<?= Yii::app()->createUrl(
              '/item/index',
              [
                'iid'      => $item->iid,
                'dsSource' => $item->ds_source,
              ]
            ) ?>"
               target="_blank">
              <img style="height: 144px;" src="<?= Img::getImagePath($item->pic_url, $imageFormat) ?>"
                   alt="" title="<?= Yii::t('main', 'Просмотр товара') ?>"></a>
          </div>
        </div>
      </div>
    </div>
    <!--   <div class="col-md-3 col-sm-7 col-xs-9 p-wr">-->
    <div class="col-md-3 col-md-10 col-sm-10 col-xs-10">
      <div class="product-attrb-wr">
        <div class="product-meta">
          <div class="name">
            <h3><a href="<?= Yii::app()->createUrl(
                  '/item/index',
                  [
                    'iid'      => $item->iid,
                    'dsSource' => $item->ds_source,
                  ]
                ) ?>"
                   target="_blank" title="<?= Yii::t('main', 'Просмотр товара') ?>"><?=
                    (is_a($item, 'customCart') || (strpos(
                          $item->title,
                          '<translation'
                        ) === 0)) ? $item->title : Yii::app()->DVTranslator->translateText(
                      $item->title,
                      'zh-CHS',
                      Utils::appLang(),
                      'item_title'
                    ); ?></a></h3>
          </div>

            <?
            $source_price = $item->price_no_discount;
            $sum = $item->sum;
            $sumResUserPrice = $item->sumResUserPrice;
            $sum_no_discount = $item->sum_no_discount;
            $sum_no_discountResUserPrice = $item->sum_no_discountResUserPrice;
            ?>
        </div>
      </div>
    </div>
    <div class="col-md-2 hidden-sm hidden-xs p-wr">
      <div class="product-attrb-wr">
          <? // Вывод параметров для корзины
          if (($item->num > 0) && !$readOnly && $allowDelete) { ?>
              <? if (isset($item->top_item) && isset($item->top_item->input_props) && (is_array(
                    $item->top_item->input_props
                  ) || $item->top_item->input_props instanceof ArrayAccess)
              ) { ?>
                  <? foreach ($item->top_item->input_props as $pid => $input_prop) { ?>
                <br/>
                <div class="att"><!--<span><? /*= $input_prop->name */ ?>:</span>-->
                  <span class="size">
                                        <? // Выбрано ли свойство?
                                        $propSelected = false;
                                        if (isset($input_prop->childs) && is_array($input_prop->childs)) {
                                            foreach ($input_prop->childs as $child) {
                                                if (preg_match(
                                                  '/(?:^|;)' . $pid . ':' . $child->vid . '(?:$|;)/',
                                                  $item->input_props
                                                )) {
                                                    $propSelected = true;
                                                    break;
                                                }
                                            }
                                        }
                                        ?>
                                    <select class="input4"
                                            name="selectedProps[<?= $item->id ?>][<?= $pid ?>]"<?= (!$propSelected) ?
                                      ' style="background-color: #ffa6bc;"' : '' ?>>
                                            <option value="<?= $pid ?>:0">
                                            <!--    --><? /*= Yii::t('main','Не выбрано') */ ?>
                                                <?= $input_prop->name ?>
                                            </option>
                                        <? if (isset($input_prop->childs) && is_array($input_prop->childs)) {
                                            foreach ($input_prop->childs as $child) { ?>
                                              <option <?= (preg_match(
                                                '/(?:^|;)' . $pid . ':' . $child->vid . '(?:$|;)/',
                                                $item->input_props
                                              )) ? ' selected ' : '' ?>
                                                        value="<?= $pid .
                                                        ':' .
                                                        $child->vid ?>"><?= $child->name ?></option>
                                                <?
                                            }
                                        } ?>
                                        </select>
                                    </span>
                </div><!--att-->
                  <? } ?>
              <? } ?>
          <? } ?>
          <? //==================================================================================================================?>
      </div>
    </div>
    <!-- <div class="col-md-2 hidden-sm hidden-xs p-wr">-->
    <div class="col-md-2 col-sm-4 col-xs-12 p-wr">
      <div class="product-attrb-wr">
        <div class="product-attrb">
          <br/>
          <div class="qtyinput">
            <div class="quantity-inp" data-toggle="tooltip" title=""
                 data-original-title="<?= Yii::t('main', 'Количество') ?>">
              <input class="quantity-input" autocomplete="off" <?= ($readOnly) ? 'readonly' : '' ?>
                     type="text" name="num[<?= $item->id ?>]"
                     id="num<?= $item->id ?>"
                     value="<?= (isset($item->actual_num) && $item->actual_num) ? $item->actual_num : $item->num ?>"/>
              <div class="quantity-txt minusbtn"><a href="#a" class="qty qtyminus"><i
                      class="fa fa-minus fa-fw"></i></a></div>
              <div class="quantity-txt plusbtn"><a href="#a" class="qty qtyplus"><i
                      class="fa fa-plus fa-fw"></i></a></div>
            </div>
          </div>
          <br/>
            <? if (DSConfig::getVal('checkout_weight_needed') == 1) { ?>
              <div class="wgtinput">
                <div class="quantity-inp" data-toggle="tooltip" title=""
                     data-original-title="<?= Yii::t('main', 'Вес 1 шт, грамм') ?>">
                  <input class="quantity-input" autocomplete="off" <?= ($readOnly) ? 'readonly' : '' ?>
                         type="text" name="weight[<?= $item->id ?>]"
                         id="weight<?= $item->id ?>"
                         value="<?= (isset($item->calculated_actualWeight) && $item->calculated_actualWeight) ?
                           $item->calculated_actualWeight : $item->weight ?>"/>
                  <div class="quantity-txt minusbtn"><a href="#a" class="qty qtyminus"><i
                          class="fa fa-minus fa-fw"></i></a></div>
                  <div class="quantity-txt plusbtn"><a href="#a" class="qty qtyplus"><i
                          class="fa fa-plus fa-fw"></i></a></div>
                </div>
              </div>
            <? } ?>
        </div>
      </div>
    </div>
    <!--<div class="col-md-2 hidden-sm hidden-xs p-wr">-->
    <div class="col-md-2 col-sm-4 col-xs-8 p-wr">
      <div class="product-attrb-wr">
        <div class="product-attrb">
          <div class="price">
              <? if ($sum != $sum_no_discount) { ?>
                <span class="price-cart" title="<?=
                (Yii::app()->user->inRole('superAdmin') && is_object(
                    $sumResUserPrice
                  )) ? $sumResUserPrice->report() : ''; ?>">
                    <?=
                    Formulas::priceWrapper(
                      (isset($item->status) && (in_array(
                          $item->status,
                          OrdersItemsStatuses::getOrderItemExcludedStatusesArray()
                        ))) ? 0 : $sum
                    ) ?></span>
                <span class="price-old" title="<?=
                (Yii::app()->user->inRole('superAdmin') && is_object(
                    $sum_no_discountResUserPrice
                  )) ? $sum_no_discountResUserPrice->report() : ''; ?>"><?=
                    Formulas::priceWrapper(
                      (isset($item->status) && (in_array(
                          $item->status,
                          OrdersItemsStatuses::getOrderItemExcludedStatusesArray()
                        ))) ? 0 : $sum_no_discount
                    ) ?></span>
              <? } else { ?>
                <span class="price-cart" title="<?=
                (Yii::app()->user->inRole('superAdmin') && is_object(
                    $sum_no_discountResUserPrice
                  )) ? $sum_no_discountResUserPrice->report() : ''; ?>"><?=
                    Formulas::priceWrapper(
                      (isset($item->status) && (in_array(
                          $item->status,
                          OrdersItemsStatuses::getOrderItemExcludedStatusesArray()
                        ))) ? 0 : $sum_no_discount
                    ) ?></span>
              <? } ?>
          </div>
        </div>
          <? if (isset($actualLotExpressFeeInCurrency)) { ?>
            <div class="product-attrb">
              <div class="att">
                <span><?= Yii::t('main', 'В т.ч. доставка от продавца') ?>:</span>
                <span><?= (isset($item->status) && (in_array(
                        $item->status,
                        OrdersItemsStatuses::getOrderItemExcludedStatusesArray()
                      ))) ? Yii::t('main', '-') : Formulas::priceWrapper($actualLotExpressFeeInCurrency) ?>
                              </span>
              </div>
            </div>
          <? } ?>
      </div>
    </div>
    <div class="col-md-1 col-sm-1 col-xs-4 p-wr">
      <div class="product-attrb-wr">
        <div class="product-attrb">
            <? if ((!$readOnly) && ($allowDelete)) { ?>
              <div class="remove">
                <a href="<?= Yii::app()->createUrl('/cart/delete', ['id' => $item->id]) ?>"
                   data-toggle="tooltip" data-placement="left"
                   data-original-title="<?= Yii::t('main', 'Удалить') ?>">
                  <i class="fa fa-trash-o fa-2x" style="color: red;"></i></a>
              </div>
            <? } ?>

            <? if (($item->num > 0) && !$readOnly && $allowDelete) { ?>
              <div class="checkbox" data-toggle="tooltip" data-original-title="<?= Yii::t(
                'main',
                'Оставить лот в корзине после заказа (не удалять)'
              ) ?>">
                <label style="font-size: 1.5em">
                  <input type="hidden" name="store[<?= $item->id ?>]" value="0">
                  <input type="checkbox" autocomplete="off" name="store[<?= $item->id ?>]"
                         value="1" <?= ($item->store) ? ' checked ' : '' ?>>
                  <span class="cr"><i class="cr-icon fa fa-shopping-cart color2"></i></span>
                </label>
              </div>
            <? } ?>

            <? if (($item->num > 0) && !$readOnly && $allowDelete) { ?>
              <div class="checkbox" data-toggle="tooltip"
                   data-original-title="<?= Yii::t('main', 'Не включать лот в текущий заказ') ?>">
                <label style="font-size: 1.5em">
                  <input type="hidden" name="order[<?= $item->id ?>]" value="0">
                  <input type="checkbox" autocomplete="off" name="order[<?= $item->id ?>]"
                         value="1" <?= (!$item->order) ? ' checked ' : '' ?>>
                  <span class="cr"><i class="cr-icon fa fa-cut fa-fw color2"></i></span>
                </label>
              </div>
            <? } ?>
        </div><!--/ product-attrb-->
      </div><!--/ product-attrb-wr-->
    </div><!--/col -->
  </div><!--prosuct-->

  <div class="row" style="background-color: #eeeeee;padding-bottom: 20px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="product-attrb-wr">
          <?= Yii::t('main', 'Комментарий к лоту') ?>
        <textarea placeholder="<?= Yii::t('main', 'Ваш комментарий к лоту') ?>"
                  name="description[<?= $item->id ?>]" class="input4" style="width: 100%;"
                  data-original-title="<?= Yii::t('main', 'Коментарий к лоту') ?>"
                  data-toggle="tooltip"><?= $item->desc ?></textarea>
      </div>
    </div><!-- end: col-->
  </div><!-- end: row-->

</div><!-- end: row-product -->

<div class="row clearfix f-space10"></div>
