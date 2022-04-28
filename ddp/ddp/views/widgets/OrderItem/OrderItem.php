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

Yii::app()->clientScript->registerScriptFile(
  $this->frontThemePath . '/js/ui/' . (YII_DEBUG ? 'jquery.ui.spinner.js' : 'minified/jquery.ui.spinner.min.js'),
  CClientScript::POS_BEGIN
);

$inAdmin = preg_match('/\/admin\//i', $_SERVER['REQUEST_URI']);
?>

<? if (is_a($item, 'customCart')) {
    $source_price = $item->price_no_discount;
    $sum = $item->sum;
    $sumResUserPrice = $item->sumResUserPrice;
    $sum_no_discount = $item->sum_no_discount;
    $sum_no_discountResUserPrice = $item->sum_no_discountResUserPrice;
} else {
    $actualPrice = (
    (isset($item->calculated_actualPrice) && ($item->calculated_actualPrice > 0))
      ? $item->calculated_actualPrice
      : $item->source_promotion_price);
    $actualExpressFee = (
    (isset($item->calculated_actualExpressFee) && ($item->calculated_actualExpressFee) > 0)
      ? $item->calculated_actualExpressFee
      : $item->express_fee);
    $actualNum = ((isset($item->actual_num) && $item->actual_num) ? $item->actual_num : $item->num);
    $currencyDate = ((isset($item->textdate) && $item->textdate) ? strtotime(
      $item->textdate
    ) : false);
    $resUserPrice = Formulas::getUserPrice(
      [
        'dsSource'     => $item->ds_source,
        'price'        => $item->source_price,
        'count'        => 1,
        'deliveryFee'  => $item->express_fee,
        'postageId'    => 0,
        'currencyDate' => $currencyDate,
        'sellerNick'   => false,
      ]
    );
    $source_price = $resUserPrice->price;
    $resUserPrice = Formulas::getUserPrice(
      [
        'dsSource'     => $item->ds_source,
        'price'        => $actualPrice,
        'count'        => $actualNum,
        'deliveryFee'  => $actualExpressFee,
        'postageId'    => 0,
        'currencyDate' => $currencyDate,
        'sellerNick'   => false,
      ]
    );
    $sum = $resUserPrice->price;
    $sumResUserPrice = $resUserPrice;
    $resUserPrice = Formulas::getUserPrice(
      [
        'dsSource'     => $item->ds_source,
        'price'        => $item->source_price,
        'count'        => $actualNum,
        'deliveryFee'  => $item->express_fee,
        'postageId'    => 0,
        'currencyDate' => $currencyDate,
        'sellerNick'   => false,
      ]
    );
    $sum_no_discount = $resUserPrice->price;
    $sum_no_discountResUserPrice = $resUserPrice;
    if (!is_null($item->actual_lot_express_fee)) {
        $actualLotExpressFeeInCurrency = Formulas::convertCurrency(
          $item->actual_lot_express_fee,
          'cny',
          DSConfig::getCurrency(),
          false,
          $currencyDate
        );
    } else {
        $actualLotExpressFeeInCurrency = Formulas::convertCurrency(
          $actualExpressFee * $actualNum,
          'cny',
          DSConfig::getCurrency(),
          false,
          $currencyDate
        );
    }
} ?>
<? /*
<div class="panel-group" id="accordion-comments-<?= $blockId ?>" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading closed" data-parent="#accordion-comments-<?= $blockId ?>"
             data-target="#heading-accordion-comments-<?= $blockId ?>" data-toggle="collapse">
            <h4 class="panel-title">
                <a <?= ($dataProvider->totalItemCount <= 0) ? ' class="collapsed" ' : ' '; ?> href="#commentsCollapseOne">
                        <?= Yii::t('main', 'Комментарии') ?>
                    <? if ($dataProvider->totalItemCount > 0) {?>
                        : <?= $dataProvider->totalItemCount;?>
                    <? } ?>
                        <!--<span class="op-number" style="float: right;"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>-->
                </a>
            </h4>
        </div>
        <div id="heading-accordion-comments-<?= $blockId ?>"
             class="panel-collapse collapse <?//= ($dataProvider->totalItemCount <= 0) ? '' : ' in'; ?>"
             aria-labelledby="heading-accordion-comments-<?= $blockId ?>">
            <div class="panel-body">
                <div class="comment-block">
                    xxx xxx xxx
                </div><!--End:Comment-block-->
            </div><!--End:Panel-body-->
        </div><!--End:Panel-collapse-->
    </div><!--End:Panel-->
</div><!--End:Panel-group-->
*/ ?>

<div class="row">
  <div class="cart-table">
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <? /* Status Block*/ ?>
      <div class="product-image" style="display: inline-block; position: relative;">
        <ul class="hoverbox" style="display: inline-block;">
          <li>
            <a href="<?= Yii::app()->createUrl(
              '/item/index',
              ['iid' => $item->iid, 'dsSource' => $item->ds_source]
            ) ?>" <?= ($inAdmin) ? 'target="_blank"' : '' ?>>
                <? if ($lazyLoad) { ?>
                  <img class="lazy" src="<?= $this->frontThemePath ?>/images/zoomloader.gif"
                       data-original="<?= Img::getImagePath($item->pic_url, $imageFormat) ?>" alt=""
                       title=""/>
                  <noscript><img src="<?= Img::getImagePath($item->pic_url, $imageFormat) ?>" alt=""/>
                  </noscript>
                <? } else { ?>
                  <img src="<?= Img::getImagePath($item->pic_url, $imageFormat) ?>" alt="" title=""/>
                <? } ?>
              <img class="preview" style="display: none"
                   src="<?= Img::getImagePath($item->pic_url, $imageFormat) ?>" alt="" title=""/>
            </a>
          </li>
        </ul>
      </div><!--End:Product-image-->
        <? // Вывод параметров для корзины
        if (is_a($item, 'customCart') && ($item->num > 0) && !$readOnly && $allowDelete) { ?>
            <? if (isset($item->top_item) && isset($item->top_item->input_props) && (is_array(
                  $item->top_item->input_props
                ) || $item->top_item->input_props instanceof ArrayAccess)
            ) { ?>
            <dl style="overflow: hidden;">
                <? foreach ($item->top_item->input_props as $pid => $input_prop) { ?>
                  <dt style="float:left;width:120px; margin-right: 4px;">
                    <strong><?= $input_prop->name ?>:</strong></dt>
                  <dd>
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
                    <select
                        name="selectedProps[<?= $item->id ?>][<?= $pid ?>]"<?= (!$propSelected) ?
                      ' style="background-color: #ffa6bc"' :
                      '' ?>>
                      <option value="<?= $pid ?>:0" style="color: red;"><?= Yii::t(
                            'main',
                            'Не выбрано'
                          ) ?></option>
                        <? if (isset($input_prop->childs) && is_array($input_prop->childs)) {
                            foreach ($input_prop->childs as $child) { ?>
                              <option <?= (preg_match(
                                '/(?:^|;)' . $pid . ':' . $child->vid . '(?:$|;)/',
                                $item->input_props
                              )) ? ' selected ' : '' ?>
                                  value="<?= $pid . ':' . $child->vid ?>"><?= $child->name ?></option>
                                <?
                            }
                        } ?>
                    </select>
                  </dd>
                <? } ?>
            </dl>
            <? } ?>
        <? } else { //Вывод параметров для прочих случаев (не для корзины)
            if (isset($item->input_props_array)) {
                $input_props_array = $item->input_props_array;
            } else {
                $input_props_array = $item->getDecodedInputProps();//json_decode($item->input_props);
            }
            if (!$input_props_array || ($input_props_array == null)) {
                $input_props_array = [];
            }
            ?>
          <ul style="overflow: hidden;">
              <? foreach ($input_props_array as $name => $value) { ?>
                <li style="float:left;width:120px; margin-right: 4px;">
                  <strong><?= (is_a($item, 'customCart') || (preg_match(
                          '/editTranslation|<translation/s',
                          $value->name
                        ))) ? $value->name : Yii::app()->DVTranslator->translateText(
                        (is_object($value->name) ? $value->name->source : $value->name),
                        (is_object($value->name) ? $value->name->sourceLang : 'zh'),
                        Utils::appLang(),
                        'prop'
                      ); ?>
                  </strong>:
                </li>
                <ul>
                  <li>
                      <?= (is_a($item, 'customCart') || (preg_match(
                          '/editTranslation|<translation/s',
                          $value->value
                        ))) ? $value->value : Yii::app()->DVTranslator->translateText(
                        (is_object($value->value) ? $value->value->source : $value->value),
                        (is_object($value->value) ? $value->value->sourceLang : 'zh'),
                        Utils::appLang(),
                        'propval'
                      ); ?>
                  </li>
                </ul>
              <? } ?>
          </ul>
        <? } ?>
    </div><!--End:Col-->

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="cart-info">
          <? if (!is_a($item, 'customCart')) { ?>
            <div style="display: inline-block;">
              <strong><?= Yii::t('main', 'Лот №') ?>:</strong> <?= $item->oid . '-' . $item->id ?>
              <br/>
              <strong><?= Yii::t('main', 'Статус') ?>:</strong> <span
                  class="status-text<?= (in_array(
                    $item->status,
                    OrdersItemsStatuses::getOrderItemExcludedStatusesArray()
                  )) ? ' red' : '' ?>"><?= Yii::t('main', $item->status_text); ?></span>
            </div>
            <hr/>
          <? } ?>
        <div class="cart-info-text">
            <?= (is_a($item, 'customCart') || (strpos(
                  $item->title,
                  '<translation'
                ) === 0)) ? $item->title : Yii::app()->DVTranslator->translateText(
              $item->title,
              'zh-CHS',
              Utils::appLang(),
              'item_title'
            ); ?>

        </div>
          <? /*
                        <? if (is_a($item, 'customCart')) { ?>
                            <textarea placeholder="<?= Yii::t('main', 'Ваш комментарий к лоту') ?>"
                                      name="description[<?= $item->id ?>]"><?= $item->desc ?></textarea>
                        <? } ?>
                */ ?>
        <input type="hidden" name="iid[<?= $item->id ?>]" value="<?= $item->iid ?>"/>
        <input type="hidden" name="params[<?= $item->id ?>]"
               value="<?= (isset($item->props)) ? $item->props : $item->input_props ?>"/>

      </div><!--End:Cart-info-->

    </div><!--End:Col-->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

      <div class="row">
        <div class="col-md-4">
          <label><?= Yii::t('main', 'Количество') ?>:</label>
        </div><!--End:Col-->
        <div class="col-md-8">
            <? if ((!$readOnly) && ($allowDelete)) { ?>
              <div class="remove">
                <a href="<?= Yii::app()->createUrl('/cart/delete', ['id' => $item->id]) ?>">
                    <?= Yii::t('main', 'Удалить') ?>
                  <span class="ui-icon ui-icon-close" style="display:inline-block;"></span>
                </a>
              </div>
            <? } ?>

          <input <?= ($readOnly) ? 'readonly' : '' ?>
              type="text" name="num[<?= $item->id ?>]"
              id="num<?= $item->id ?>" class="input3 pull-right"
              value="<?= (isset($item->actual_num) && $item->actual_num) ? $item->actual_num : $item->num ?>"/>

        </div><!--End:Col-->
        <div class="col-md-4">
          <label <?= (DSConfig::getVal('checkout_weight_needed') != 1) ? 'hidden="hidden"' : '' ?>><?=
              Yii::t('main', 'Вес 1 шт, грамм') ?>:</label>
        </div><!--End:Col-->
        <div class="col-md-8">
          <input <?= ($readOnly) ? 'readonly' : '' ?>
              type="text" name="weight[<?= $item->id ?>]"
              id="weight<?= $item->id ?>" class="input3 pull-right"
              value="<?= (isset($item->calculated_actualWeight) && $item->calculated_actualWeight) ?
                $item->calculated_actualWeight :
                $item->weight ?>"
            <?= (DSConfig::getVal('checkout_weight_needed') != 1) ? 'hidden="hidden"' : '' ?>/>
        </div><!--End:Col-->
        <div class="col-md-12">
          <label><?= Yii::t('main', 'В т.ч. доставка от продавца') ?>:</label>
          &nbsp;
          <label class="">
            <div class="cost">
                <?=
                (isset($item->status) && (in_array(
                    $item->status,
                    OrdersItemsStatuses::getOrderItemExcludedStatusesArray()
                  ))) ? Yii::t('main', '-') : Formulas::priceWrapper(
                  $actualLotExpressFeeInCurrency
                ) ?>
            </div>
          </label>
        </div>

        <div class="col-md-12">
          <div class="sum pull-left" style="font-size: 200%; color: red; padding: 15px;">
              <? if ($sum != $sum_no_discount) { ?>
                <s>
                                <span title="<?= (Yii::app()->user->inRole('superAdmin') && is_object(
                                    $sum_no_discountResUserPrice
                                  )) ? $sum_no_discountResUserPrice->report() : ''; ?>">
                                                    <?= Formulas::priceWrapper(
                                                      (isset($item->status) && (in_array(
                                                          $item->status,
                                                          OrdersItemsStatuses::getOrderItemExcludedStatusesArray()
                                                        ))) ? 0 : $sum_no_discount
                                                    ) ?>
                                                </span>
                </s>
              <? } ?>
          </div>

          <div class="sum pull-right" style="font-size: 250%; color: #00b4ff; padding: 15px;">
                                <span title="<?=
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
          </div>

        </div><!--End:Col-->
      </div><!--End:Row-->
    </div><!--End:Col-->
  </div><!--End:Cart-table-->
</div><!--End:Row-->
<? // Гребанный комментарий к лоту ! ?>
<div class="row">
  <div class="col-md-12">
      <? if (is_a($item, 'customCart')) { ?>
      <? } else { ?>
          <? $this->widget(
            'application.components.widgets.OrderCommentsBlock', [
              'orderId'       => false,
              'orderItemId'   => $item->id,
              'showInternals' => $adminMode ? 1 : 0,
              'public'        => $publicComments,
              'pageSize'      => 5,
              'imageFormat'   => '_200x200.jpg',
            ]
          ); ?>
      <? } ?>
  </div><!--End:Col-->
</div><!--End:Row-->

<? if (!$readOnly || (is_a($item, 'customCart') && $inAdmin)) { ?>
  <script>
      $("#num<?=$item->id?>").spinner({
          down: 'ui-icon-triangle-1-s',
          up: 'ui-icon-triangle-1-n',
          min: 1,
          max: 10000,
          step: 1
          <? if ($this->onChange) {
              echo ', change: function( event, ui ) {' . $this->onChange . '}';
          } ?>
      });
      $("#weight<?=$item->id?>").spinner({
          down: 'ui-icon-triangle-1-s',
          up: 'ui-icon-triangle-1-n',
          min: 0,
          max: 100000,
          step: 100
          <? if ($this->onChange) {
              echo ', change: function( event, ui ) {' . $this->onChange . '}';
          } ?>
      });
  </script>
<? } ?>

