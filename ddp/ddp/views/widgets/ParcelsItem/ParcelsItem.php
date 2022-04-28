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
<? /*<input type="hidden" name="params[<?= $item->id ?>]"
       value="<?= (isset($item->props)) ? $item->props : (isset($item->input_props)? $item->input_props : '') ?>"/>
*/ ?>
  <div class="row">
    <div class="product">
      <div class="col-md-2 col-sm-3 hidden-xs p-wr">
        <div style="position: absolute;padding: 5px 10px;" class="red">ID:<? if ($inAdmin) {
                if ($this->renderType == 'cart') {
                    echo OrdersItems::getAdminLink($item->iid);
                } elseif ($this->renderType == 'create') {
                    echo OrdersItems::getAdminLink($item->id);
                } elseif ($this->renderType == 'order') {
                    echo OrdersItems::getAdminLink($item->iid);
                } elseif ($this->renderType == 'parcel') {
                    echo OrdersItems::getAdminLink($item->iid);
                } else {
                    //echo OrdersItems::getAdminLink($item->id);
                }
            } else {
                if ($this->renderType == 'cart') {
                    echo '<a style="color:red !important;" href="' . Yii::app()->createUrl(
                        '/cabinet/orders/view',
                        ['id' => $item->oid]
                      ) . '">' . $item->oid . '-' . $item->iid . '</a>';
                } elseif ($this->renderType == 'create') {
                    echo '<a style="color:red !important;" href="' . Yii::app()->createUrl(
                        '/cabinet/orders/view',
                        ['id' => $item->oid]
                      ) . '">' . $item->oid . '-' . $item->id . '</a>';
                } elseif ($this->renderType == 'order') {
                    echo '<a style="color:red !important;" href="' . Yii::app()->createUrl(
                        '/cabinet/orders/view',
                        ['id' => $item->oid]
                      ) . '">' . $item->oid . '-' . $item->id . '</a>';
                } elseif ($this->renderType == 'parcel') {
                    echo '<a style="color:red !important;" href="' . Yii::app()->createUrl(
                        '/cabinet/orders/view',
                        ['id' => $item->oid]
                      ) . '">' . $item->oid . '-' . $item->id . '</a>';
                } else {
                    /*
                    echo '<a style="color:red !important;" href="' . Yii::app()->createUrl(
                        '/cabinet/orders/view',
                        array('id' => $item->oid)
                      ) . '">' . $item->oid . '-' . $item->id . '</a>';
                    */
                }
            } ?>
        </div>
        <div class="product-attrb-wr">
          <div class="product-attrb">
            <div class="image" style="height: 190px !important;top:20px;position: relative;">
              <a class="img" <? if ($inAdmin) {
                  echo Order::getAdminLink($item->oid);
              } else {
                  echo 'href="' . Yii::app()->createUrl(
                      '/cabinet/orders/view',
                      ['id' => $item->oid]
                    ) . '"';
              } ?>
                <?= (!$inAdmin) ? 'target="_blank"' : '' ?>>
                  <? if ($this->lazyLoad) { ?>
                    <img class="lazy"
                         src="<?= Yii::app()->request->baseUrl ?>/themes/<?=
                         /* Yii::app()->theme->name ?>/images/zoomloader.gif" */
                         Yii::app()->theme->name ?>/images/Hourglass.png"
                         data-original="<?= Img::getImagePath($item->pic_url, $imageFormat) ?>" alt=""
                         title="<?= Yii::t('main', 'Просмотр заказа') ?>">
                    <noscript><img itemprop="image"
                                   src="<?= Img::getImagePath($item->pic_url, $imageFormat) ?>"
                                   alt=""
                                   title="<?= Yii::t('main', 'Просмотр заказа') ?>"
                      ></noscript>
                  <? } else { ?>
                    <img src="<?= Img::getImagePath($item->pic_url, $imageFormat) ?>" alt=""
                         title="<?= Yii::t('main', 'Просмотр заказа') ?>">
                  <? } ?>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-7 col-xs-9 p-wr">
        <div class="product-attrb-wr">
          <div class="product-meta">
            <div class="name" style="padding: 10px;">
              <h3><?= (strpos(
                      $item->title,
                      '<translation'
                    ) === 0) ? $item->title : Yii::app()->DVTranslator->translateText(
                    $item->title,
                    'zh-CHS',
                    Utils::appLang(),
                    'item_title'
                  ); ?></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 hidden-sm hidden-xs p-wr">
        <div class="product-attrb-wr">
            <? // Вывод параметров для корзины ?>
            <?
            if (isset($item->input_props)) {
            $input_props_array = $item->getDecodedInputProps();//json_decode($item->input_props);
            if (!$input_props_array || ($input_props_array == null)) {
                $input_props_array = [];
            }
            ?>
          <div class="product-meta">
              <? foreach ($input_props_array as $name => $value) { ?>
                <div class="att">
                            <span class="size"><?= (preg_match(
                                  '/editTranslation|<translation/s',
                                  $value->name
                                )) ? $value->name : Yii::app()->DVTranslator->translateText(
                                  (is_object($value->name) ? $value->name->source : $value->name),
                                  (is_object($value->name) ? $value->name->sourceLang : 'zh'),
                                  Utils::appLang(),
                                  'prop'
                                ); ?>:
                                <span class="input4"><?= (preg_match(
                                      '/editTranslation|<translation/s',
                                      $value->value
                                    )) ? $value->value : Yii::app()->DVTranslator->translateText(
                                      (is_object($value->value) ? $value->value->source : $value->value),
                                      (is_object($value->value) ? $value->value->sourceLang : 'zh'),
                                      Utils::appLang(),
                                      'propval'
                                    ); ?>
                                </span>
                            </span>
                </div>
              <? } ?>

              <? } ?>
            <div class="att">
                    <span class="size">
                        <?= Yii::t('main', 'Статус') ?>:
                        <span class="input4">
                            <?= Yii::t('main', $item->status_text); ?>
                        </span>
                    </span>
            </div>
          </div>
            <? //==================================================================================================================?>
        </div>
      </div>
      <div class="col-md-3 hidden-sm hidden-xs p-wr">
        <div class="product-attrb-wr">
          <div class="product-attrb">
            <div class="qtyinput">
              <div class="quantity-inp number-spinner" data-toggle="tooltip" title=""
                   data-original-title="<?= Yii::t('main', 'Количество') ?>">
                <input class="quantity custom-select"
                       autocomplete="off" <?= ($readOnly) ? 'readonly' : '' ?>
                       type="number" name="num[<?= $item->id ?>]"
                       id="num<?= $item->id ?>"
                       min="1" max="<?= $item->num ?>"
                       value="<?
                       if ($this->renderType == 'cart') {
                           echo $item->num;
                       } elseif ($this->renderType == 'create') {
                           echo $item->num_remain;
                       } elseif ($this->renderType == 'order') {
                           echo $item->num;
                       } elseif ($this->renderType == 'parcel') {
                           echo $item->num;
                       } else {
                           echo $item->num;
                       }
                       ?>"/>
                  <? if (!in_array($this->renderType, ['order', 'parcel'])) { ?>
                    <div class="quantity-txt minusbtn input-prepend data-dwn" data-dir="dwn">
                      <a class="qty qtyminus" data-dir="dwn">
                        <i class="fa fa-minus fa-fw"></i>
                      </a>
                    </div>
                    <div class="quantity-txt plusbtn input-append data-up" data-dir="up">
                      <a class="qty qtyplus" data-dir="up">
                        <i class="fa fa-plus fa-fw"></i>
                      </a>
                    </div>
                  <? } ?>
              </div>
                <?
                if ($this->renderType == 'cart') {
                    echo Yii::t('main', 'Остаток в лоте заказа');
                } elseif ($this->renderType == 'create') {
                    echo Yii::t('main', 'Уже в посылках и корзине');
                } elseif ($this->renderType == 'order') {
                    echo Yii::t('main', 'Остаток в лоте заказа');
                } elseif ($this->renderType == 'parcel') {
                    //echo Yii::t('main', 'Остаток в лоте заказа');
                } else {
                    echo Yii::t('main', 'Остаток в лоте заказа');
                }
                ?>: <?
                if ($this->renderType == 'cart') {
                    echo $item->num_remain;
                } elseif ($this->renderType == 'create') {
                    echo $item->num_lot - $item->num_remain;
                } elseif ($this->renderType == 'order') {
                    echo $item->num_lot - $item->num_remain;
                } elseif ($this->renderType == 'parcel') {
                    //echo $item->num;
                } else {
                    echo $item->num;
                }
                ?>
            </div>
              <? if (!in_array($this->renderType, ['parcel'])) { ?>
                <div class="wgtinput">
                  <div class="quantity-inp" data-toggle="tooltip" title=""
                       data-original-title="<?= Yii::t('main', 'Вес лота в посылке') ?>">
                      <?= Yii::t('main', 'Вес в посылке') ?>:
                    <span id="weight<?= $item->id ?>"><?
                        if ($this->renderType == 'cart') {
                            $_weight = $item->calculated_itemWeight * $item->num;
                        } elseif ($this->renderType == 'create') {
                            $_weight = $item->calculated_itemWeight * $item->num_remain;
                        } elseif ($this->renderType == 'order') {
                            $_weight = $item->calculated_itemWeight * $item->num;
                        } elseif ($this->renderType == 'parcel') {
                            //$_weight = $item->calculated_itemWeight * $item->num;
                        } else {
                            //$_weight = $item->calculated_itemWeight * $item->num;
                        }
                        echo Formulas::weightWrapper($_weight)
                        ?></span>
                  </div>
                </div>
              <? } ?>
          </div>
        </div>
      </div>
        <? if (!in_array($this->renderType, ['order', 'parcel'])) { ?>
          <div class="col-md-1 col-sm-2 col-xs-3 p-wr">
            <div class="product-attrb-wr">
              <div class="product-attrb">
                  <? if ($this->renderType == 'cart') { ?>
                      <? if ((!$readOnly) && ($allowDelete)) { ?>
                      <div class="remove">
                        <a href="<?= Yii::app()->createUrl(
                          '/cabinet/parcelsCart/delete',
                          ['id' => $item->id]
                        ) ?>"
                           class="color2" data-toggle="tooltip" data-placement="left"
                           data-original-title="<?= Yii::t('main', 'Удалить') ?>">
                          <i class="fa fa-trash-o fa-2x color2" style="color: red;"></i></a>
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
                  <? } elseif ($this->renderType == 'create') { ?>
                    <div class="cart">
                      <a id="cart-add-<?= $item->id ?>" href="<?= Yii::app()->createUrl(
                        '/cabinet/parcelsCart/add',
                        ['id' => $item->id, 'num' => $item->num_remain]
                      ) ?>"
                         title="<?= Yii::t('main', 'Добавить в посылку') ?>">
                        <i class="fa fa-cart-arrow-down fa-2x"
                           style="color: deepskyblue !important;"></i></a>
                    </div>

                    <div class="checkbox" data-toggle="tooltip"
                         data-original-title="<?= Yii::t('main', 'Выбрать для добавления в посылку') ?>">
                      <label style="font-size: 1.5em">
                        <input type="checkbox" autocomplete="off" name="cart[<?= $item->id ?>]"
                               value="1">
                        <span class="cr"><i class="cr-icon fa fa-cart-plus fa-fw color1"></i></span>
                      </label>
                    </div>
                  <? } else { ?>
                  <? } ?>
              </div><!--/ product-attrb-->
            </div><!--/ product-attrb-wr-->
          </div><!--/col -->
        <? } ?>
    </div><!--product-->
  </div><!-- end: row-product -->
  <div class="row clearfix f-space20"></div>

<? if ($this->renderType != 'order') { ?>
  <script>
      $(function () {
          var action;
          $('.number-spinner div').mousedown(function () {
              qty = $(this);
              //alert(qty.attr('data-dir'));
              inp = qty.closest('.number-spinner').find('input');
              //alert(input.val());
              //input = div.closest('.number-spinner').find('input');
              //qty.closest('.number-spinner').find('div').prop("disabled", false);

              if (qty.attr('data-dir') === 'up') {
                  action = setInterval(function () {
                      if (inp.attr('max') == undefined || parseInt(inp.val()) < parseInt(inp.attr('max'))) {
                          inp.val(parseInt(inp.val()) + 1);
                          //alert(inp.val());
                      } else {
                          qty.prop('disabled', true);
                          clearInterval(action);
                      }
                  }, 50);
              } else {
                  action = setInterval(function () {
                      if (inp.attr('min') == undefined || parseInt(inp.val()) > parseInt(inp.attr('min'))) {
                          inp.val(parseInt(inp.val()) - 1);
                          //alert(inp.val());
                      } else {
                          qty.prop('disabled', true);
                          clearInterval(action);
                      }
                  }, 50);
              }
          }).mouseup(function () {
              clearInterval(action);
          });
      });
  </script>
<? } ?>