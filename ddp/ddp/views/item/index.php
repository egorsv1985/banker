<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 * Рендеринг карты товара
 **********************************************************************************************************************/
?>
<?
Yii::app()->clientScript->registerCssFile(
  $this->frontThemePath . '/css/' . (YII_DEBUG ? 'magiczoomplus.css' : 'magiczoomplus.min.css'),
  'screen'
);
Yii::app()->clientScript->registerCssFile(
  $this->frontThemePath . '/css/' . (YII_DEBUG ? 'magicscroll.css' : 'magicscroll.min.css'),
  'screen'
);
Yii::app()->clientScript->registerScriptFile(
  $this->frontThemePath . '/js/' . (YII_DEBUG ? 'magicscroll.js' : 'magicscroll.min.js'),
  CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScriptFile(
  $this->frontThemePath . '/js/' . (YII_DEBUG ? 'magiczoomplus.js' : 'magiczoomplus.min.js'),
  CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScriptFile(
  $this->frontThemePath . '/js/item.js?v=' . Search::$intversion,
  CClientScript::POS_HEAD
);

Yii::app()->clientScript->registerScriptFile(
  $this->frontThemePath . '/js/ui/' . (YII_DEBUG ? 'jquery.ui.selectable.js' : 'minified/jquery.ui.selectable.min.js'),
  CClientScript::POS_BEGIN
);

// Подключаем онлайн-перевод описания при помощи Microsoft Bing translator
// Детали смотрим на https://www.bing.com/widget/translator
if (!Yii::app()->request->isPostRequest &&
  !Yii::app()->request->isAjaxRequest &&
  !(isset($this->preLoading) && $this->preLoading)
) {
    if (Yii::app()->request->isSecureConnection) {
        $microsoftTranslateScriptUrl =
          'https://www.microsoftTranslator.com/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**';
        $microsoftTranslateScriptPath = $this->frontThemeAbsolutePath . '/js/ssl.microsoftTranslate.js';
        $microsoftTranslateScriptLocalUrl = $this->frontThemePath . '/js/ssl.microsoftTranslate.js';
    } else {
        $microsoftTranslateScriptUrl =
          'http://www.microsoftTranslator.com/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**';
        $microsoftTranslateScriptPath = $this->frontThemeAbsolutePath . '/js/microsoftTranslate.js';
        $microsoftTranslateScriptLocalUrl = $this->frontThemePath . '/js/microsoftTranslate.js';
    }
    if (file_exists($microsoftTranslateScriptPath)) {
        $fileTime = filectime($microsoftTranslateScriptPath);
    } else {
        $fileTime = 0;
    }
    $fileEdge = (time() - $fileTime);
    if ($fileEdge > 3600) { //3600
        $data = Utils::getHttpDocument($microsoftTranslateScriptUrl);
        if (isset($data->body) && $data->body) {
            $result = file_put_contents($microsoftTranslateScriptPath, $data->body);
        }
    }
    if (file_exists($microsoftTranslateScriptPath)) {
        Yii::app()->clientScript->registerScriptFile(
          $microsoftTranslateScriptLocalUrl,
          CClientScript::POS_HEAD
        );
    } else {
        Yii::app()->clientScript->registerScriptFile(
          $microsoftTranslateScriptUrl,
          CClientScript::POS_HEAD
        );
    }
    if (Utils::appLang() != 'zh') {
// Проставляем атрибут translate="no" для тех блоков, которые НЕ нужно переводить
        Yii::app()->clientScript->registerScript(
          'ms-translator-prepare',
          "$('header').attr('translate','no');
          $('.mz-zoom-window').attr('translate','no');
          $('.modal').attr('translate','no');
          $('.footer').attr('translate','no');
        ",
          CClientScript::POS_END
        );
        ?>
      <script>
          var deferredTranslateComments = $.Deferred();
          var deferredTranslateDescr = $.Deferred();
      </script>
        <?
// Собственно, вызываем перевод.
// Microsoft.Translator.Widget.TranslateElement = function (from, to, document.documentElement, onProgress(), onError(), onComplete(), onRestoreOriginal(), timeOut, showFloater)
        Yii::app()->clientScript->registerScript(
          'ms-translator-run',
          "
          $.when(deferredTranslateComments,deferredTranslateDescr).then(function(){
        setTimeout(function(){
        try {
        Microsoft.Translator.Widget.TranslateElement('zh-CHS', '" . Utils::appLang() . "',document.documentElement, null, null, null, null, 100000, false);
        } catch (err) {
         console.log('Problems with online translation detected');
        }
                  }, 1000);
          });
	  ",
          CClientScript::POS_READY
        );
    }
}

?>
<? $seo_disable_items_index = DSConfig::getVal('seo_disable_items_index') == 1; ?>
<!--Вывод контента карты товара-->

<!-- Подключим стиля для карты товара темы **DDP** -->
<? Yii::app()->clientScript->registerCssFile(
    $this->frontThemePath . '/css/dds-item-styles.css'
);
?>
<!-- стиля для карты товара темы **DDP** -->

<div class="container" translate="no">
  <div class="row no-gutters">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="item-cat-path box-heading"><!-- Вывод блока категории товара в меню -->
        <strong><a href="#"><?= Yii::t('main', 'Главная') ?> / </strong><?= ($item->top_item->cat_path ?
            $item->top_item->cat_path :
            Yii::t('main', 'прочее')) ?>
      </div><!--Item-cat-path-->
    </div><!--End:Col-->
  </div><!--End:Row-->
</div><!--End:Container-->

<div class="clearfix-reset"></div><!-- Сбросим отступы -->
<!-- ### -->

<div class="container">
    <!--
    <nav class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><ya-tr-span data-index="33-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Home" data-translation="Главная" data-type="trSpan">Главная</ya-tr-span></a></li>
        <li class="breadcrumb-item"><a href="#"><ya-tr-span data-index="34-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Category name" data-translation="Название категории" data-type="trSpan">Название категории</ya-tr-span></a></li>
        <li class="breadcrumb-item"><a href="#"><ya-tr-span data-index="35-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Sub category" data-translation="Подкатегория" data-type="trSpan">Подкатегория</ya-tr-span></a></li>
        <li class="breadcrumb-item active" aria-current="page"><ya-tr-span data-index="36-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Items" data-translation="Товары" data-type="trSpan">Товары</ya-tr-span></li>
    </ol> 
    </nav>
-->
<div class="row">
<div class="col-xl-12 col-md-12 col-sm-12">


<main class="card">
	<div class="row no-gutters">
		<aside class="col-sm-6 border-right">
            <article class="gallery-wrap"> 
            <div class="img-big-wrap">
              <div> <a href="<?= $this->frontThemePath . '/img/item-ddt.png'; ?>" data-fancybox=""><img src="<?= $this->frontThemePath . '/img/item-ddt.png'; ?>"></a></div>
            </div> <!-- slider-product.// -->
            <div class="img-small-wrap">
              <div class="item-gallery"> <img src="<?= $this->frontThemePath . '/img/item-ddt.png'; ?>"></div>
              <div class="item-gallery"> <img src="<?= $this->frontThemePath . '/img/item-ddt.png'; ?>"></div>
              <div class="item-gallery"> <img src="<?= $this->frontThemePath . '/img/item-ddt.png'; ?>"></div>
              <div class="item-gallery"> <img src="<?= $this->frontThemePath . '/img/item-ddt.png'; ?>"></div>
            </div> <!-- slider-nav.// -->
            </article> <!-- gallery-wrap .end// -->
            <? /** Виджет *слайдер* с дропшопа **/
               /**     
                    Yii::app()->controller->renderPartial(
                        'item_images',
                            [
                            'item' => $item,
                            ],
                         false,
                        false
                    ); 
                     
            **/
            ?>
		</aside>
		<aside class="col-sm-6">
            <article class="card-body">
            <!-- short-info-wrap -->
            	<h3 class="title mb-3">
                    <ya-tr-span data-index="37-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="<?= $item->top_item->title ?>" data-translation="<?= $item->top_item->title ?>" data-type="trSpan"><?= $item->top_item->title ?></ya-tr-span>
                </h3>
            
            <div class="mb-3"> 
            	<var class="price h3 text-warning"> 
            		<span class="currency"></span>
                    <span class="num">
                        <? Yii::app()->controller->renderPartial(
                               'item_price',
                               ['item' => $item,],
                               false,
                               false
                           ); 
                        ?>
                    </span>
            	</var> 
            	<span><ya-tr-span data-index="38-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="/per kg" data-translation="/за кг" data-type="trSpan">/за кг</ya-tr-span></span> 
            </div> <!-- price-detail-wrap .// -->
            <dl>
              <dt><ya-tr-span data-index="39-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Description" data-translation="Описание" data-type="trSpan">Описание</ya-tr-span></dt>
              <dd><p><ya-tr-span data-index="40-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Here goes description consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. " data-translation="Here goes description consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. " data-type="trSpan" data-selected="false">Here goes description consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </ya-tr-span><ya-tr-span data-index="40-1" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Ut enim ad minim veniam, quis nostrud exercitation ullamco " data-translation="Ut enim ad minim veniam, quis nostrud exercitation ullamco " data-type="trSpan" data-selected="false">Ut enim ad minim veniam, quis nostrud exercitation ullamco </ya-tr-span></p></dd>
            </dl>
            <div>
                    <? if (!$this->preLoading) {
                                Yii::app()->controller->renderPartial(
                                  'item_form',
                                  [
                                    'item'        => $item,
                                    'ajax'        => $ajax,
                                    'input_props' => $input_props,
                                  ],
                                  false,
                                  false
                                );
                            } ?>
                    </div>
            <dl class="row">
              <dt class="col-sm-3"><ya-tr-span data-index="41-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Model#" data-translation="Модель#" data-type="trSpan">Модель#</ya-tr-span></dt>
              <dd class="col-sm-9">12345611</dd>
            
              <dt class="col-sm-3"><ya-tr-span data-index="42-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Color" data-translation="Цвет" data-type="trSpan">Цвет</ya-tr-span></dt>
              <dd class="col-sm-9"><ya-tr-span data-index="43-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Black and white " data-translation="Черно - белое " data-type="trSpan">Черно - белое </ya-tr-span></dd>
            
              <dt class="col-sm-3"><ya-tr-span data-index="44-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Delivery" data-translation="Доставка" data-type="trSpan">Доставка</ya-tr-span></dt>
              <dd class="col-sm-9"><ya-tr-span data-index="45-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Russia, USA, and Europe " data-translation="Россия, США и Европа " data-type="trSpan">Россия, США и Европа </ya-tr-span></dd>
            </dl>
            <div class="rating-wrap">
            
            	<ul class="rating-stars">
            		<li style="width:80%" class="stars-active"> 
            			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
            			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
            			<i class="fa fa-star"></i> 
            		</li>
            		<li>
            			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
            			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
            			<i class="fa fa-star"></i> 
            		</li>
            	</ul>
            	<div class="label-rating"><ya-tr-span data-index="46-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="132 reviews" data-translation="132 отзыва" data-type="trSpan">132 отзыва</ya-tr-span></div>
            	<div class="label-rating"><ya-tr-span data-index="47-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="154 orders " data-translation="154 приказа " data-type="trSpan">154 приказа </ya-tr-span></div>
            </div> <!-- rating-wrap.// -->
            <hr>
            	<div class="row">
            		<div class="col-sm-5">
            			<dl class="dlist-inline">
            			  <dt><ya-tr-span data-index="48-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Quantity: " data-translation="Количество: " data-type="trSpan">Количество: </ya-tr-span></dt>
            			  <dd> 
            			  	<select class="form-control form-control-sm" style="width:70px;">
            			  		<option> 1 </option>
            			  		<option> 2 </option>
            			  		<option> 3 </option>
            			  	</select>
            			  </dd>
            			</dl>  <!-- item-property .// -->
            		</div> <!-- col.// -->
                    
                    
                    
            		<div class="col-sm-7">
            			<!--
                        <dl class="dlist-inline">
            				  <dt><ya-tr-span data-index="49-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Size: " data-translation="Размер: " data-type="trSpan">Размер: </ya-tr-span></dt>
            				  <dd>
            				  	<label class="form-check form-check-inline">
            					  <input class="form-check-input" name="inlineRadioOptions" id="inlineRadio2" value="option2" type="radio">
            					  <span class="form-check-label"><ya-tr-span data-index="50-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="SM" data-translation="SM" data-type="trSpan">SM</ya-tr-span></span>
            					</label>
            					<label class="form-check form-check-inline">
            					  <input class="form-check-input" name="inlineRadioOptions" id="inlineRadio2" value="option2" type="radio">
            					  <span class="form-check-label"><ya-tr-span data-index="50-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="MD" data-translation="MD" data-type="trSpan">MD</ya-tr-span></span>
            					</label>
            					<label class="form-check form-check-inline">
            					  <input class="form-check-input" name="inlineRadioOptions" id="inlineRadio2" value="option2" type="radio">
            					  <span class="form-check-label"><ya-tr-span data-index="50-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="XXL" data-translation="XXL" data-type="trSpan">XXL</ya-tr-span></span>
            					</label>
            				  </dd>
            			</dl>
                        -->
            		</div> <!-- col.// -->
            	</div> <!-- row.// -->
            	<hr>
            	<a href="#" class="btn  btn-warning"> <i class="fa fa-envelope"></i><ya-tr-span data-index="51-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Contact Supplier " data-translation=" Свяжитесь С Поставщиком " data-type="trSpan"> Свяжитесь С Поставщиком </ya-tr-span></a>
            	<a href="#" class="btn  btn-outline-warning"><ya-tr-span data-index="51-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Start Order " data-translation="Для Начала Заказа " data-type="trSpan">Для Начала Заказа </ya-tr-span></a>
            <!-- short-info-wrap .// -->
            </article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</main> <!-- card.// -->

<!-- PRODUCT DETAIL -->
<article class="card mt-3">
    <!-- Info: Nav -->
    
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="pills-salers-tab" data-toggle="pill" href="#pills-salers" role="tab" aria-controls="pills-salers" aria-selected="true">Продавцы</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-itemprops-tab" data-toggle="pill" href="#pills-itemprops" role="tab" aria-controls="pills-itemprops" aria-selected="false">Характеристики</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-filedownload-tab" data-toggle="pill" href="#pills-filedownload" role="tab" aria-controls="pills-filedownload" aria-selected="false">Скачать файл</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-iteminfo-tab" data-toggle="pill" href="#pills-iteminfo" role="tab" aria-controls="pills-iteminfo" aria-selected="false">Описание</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-rate-tab" data-toggle="pill" href="#pills-rate" role="tab" aria-controls="pills-rate" aria-selected="false">Отзывы</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-mincost-tab" data-toggle="pill" href="#pills-mincost" role="tab" aria-controls="pills-mincost" aria-selected="false">Уценка</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-salers" role="tabpanel" aria-labelledby="pills-salers-tab">
    Здесь таблица предложений продавцов
  </div>
  <div class="tab-pane fade" id="pills-itemprops" role="tabpanel" aria-labelledby="pills-itempropse-tab">
    <ul id="_description3" itemprop="description">
        <? foreach ($item->top_item->item_attributes as $attribute) { ?>
            <li class="block">
                <span><strong><?= $attribute->prop; ?>:</strong><?= $attribute->val; ?></span>
            </li>
        <? } ?>
     </ul>
  </div>
  <div class="tab-pane fade" id="pills-filedownload" role="tabpanel" aria-labelledby="pills-filedownload-tab">
    Скачать файл
  </div>
  <div class="tab-pane fade" id="pills-iteminfo" role="tabpanel" aria-labelledby="pills-iteminfo-tab">
    Описание
  </div>
  <div class="tab-pane fade" id="pills-rate" role="tabpanel" aria-labelledby="pills-rate-tab">
  <!------------- Блоги ОТЗЫВЫ ------>
    <?
        if (!$this->preLoading) {
            if (DSConfig::getVal('blogs_enabled') == 1) { ?>
              <div class="clear"></div>
              <div id="blog-attached-block" translate="no">
        
                  <?
                  $this->widget(
                    'application.components.widgets.BlogAttachedBlock',
                    [
                      'pageSize' => 1000,
                      'category' => Yii::t('main', 'Обзоры товаров'),
                        // Текст на русском, обозначаюший название категории по умолчанию для этого аттача
                      'title'    => Yii::t('main', 'Обзор товара') . ' Art.' . $item->top_item->num_iid,
                        //Тэг для этого аттача, например - item345345345 или category345345
                      'tag'      => '@item-review-' . $item->top_item->num_iid,
                        //Тэг для этого аттача, например - item345345345 или category345345
                        //Предварительно отрендеренный шаблон отзыва
                      'body'     => Yii::app()->controller->renderPartial('item_review', ['item' => $item], true, false),
                    ]
                  );
                  ?>
            <!-- ещё ОТЗЫВЫ еще какие-то -->      
                  <? if (!$this->preLoading) {
            Yii::app()->controller->renderPartial('item_info', ['item' => $item], false, false);
            ?>
            <? if (isset($itemRelated->items)) {
                ?>
            <div class="clear"></div>
            <div class="block" id="seller-related-block">
              <div class="seller-block" translate="no">
                  <?
                  Yii::app()->controller->renderPartial(
                    'itemRelatedBlock',
                    ['itemRelated' => $itemRelated],
                    false,
                    false
                  );
                  ?>
              </div>
            </div>
                <?
            }
        } ?>
        
              </div>
            <? }
        } ?>
  </div>
  <div class="tab-pane fade" id="pills-mincost" role="tabpanel" aria-labelledby="pills-mincost-tab">
    Уценка
    </div>
</div><!-- Tab content //

<!-- PRODUCT DETAIL // -->

        </div> <!-- col // -->
    </div> <!-- row.// -->
</div><!--End::Container-->


          
            <div class="row clearfix f-space10"></div><!--отступ для блока-->

            <? /* Кнопки социальных сетей */ ?>
            <div style="margin: 0 0 10px 10px; display: inline-block; position: relative;">
                <!-- Vkontakte Script -->
                <? /*
                <div id="vk_like" style="display: inline-block; position: relative;">
                  <script defer src="//vk.com/js/api/openapi.js?136"
                     onload="
                     VK.init({apiId: 5238544, onlyWidgets: true});
                     VK.Widgets.Like('vk_like', {type: 'button'});"
                  ></script>
                </div>
                <!--END:Vidget-VK-->
                */ ?>

                <? /*


                <!-- Put this div tag to the place, where the Like block will be -->
                    <div id="vk_like"></div>
                    <script type="text/javascript">
                    VK.Widgets.Like("vk_like", {type: "button"});
                    </script>
                */ ?>
                <? if (!$this->preLoading) { ?>
                  <!--Vidget-OK-->
                    <? /*
                <div id="ok_shareWidget" style="display: inline-block; position: relative;"></div>
                <script>
                    !function (d, id, did, st) {
                        var js = d.createElement("script");
                        js.defer = true;
                        js.src = "https://connect.ok.ru/connect.js";
                        js.onload = js.onreadystatechange = function () {
                            if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                                if (!this.executed) {
                                    this.executed = true;
                                    setTimeout(function () {
                                        OK.CONNECT.insertShareWidget(id, did, st);
                                    }, 0);
                                }
                            }
                        };
                        d.documentElement.appendChild(js);
                    }(document, "ok_shareWidget", "http://market.info92.ru", "{width:170,height:30,st:'rounded',sz:20,ck:3}");
                </script>
                */ ?>
                  <!--END:Vidget-OK-->
                  <!--Vidget-Facebook-->
                  <!-- <div class="fb-like" data-href="http://market.info92.ru" data-layout="button_count" data-action="like"
                        data-show-faces="true" data-share="true"
                        style="display: inline-block; position: relative; top: -6px; left: 35px"></div> -->
                  <!--END:Vidget-Facebook-->
                <? } ?>
                <? /*
                <script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>
                <!-- Put this script tag to the place, where the Share button will be -->
                <script type="text/javascript">
                    document.write(VK.Share.button(false, {
                        type: "round_nocount",
                        text: "<?=Yii::t('main','Сохранить')?>"
                    }));
                </script>
*/ ?>

<!-- Виджет кнопки вверх (Test-Templates) -->
                <div class="search-sidebar">
                    <? //data-toggle="tooltip"?>
    <div class="search-sidebar-top" style="display: block; opacity: 0.5;" data-toggle="tooltip"
         title="<?= Yii::t('main', 'Перейти к началу страницы') ?>"><i class="fa fa-arrow-up"></i></div>
    <div class="search-sidebar-images" data-toggle="tooltip" title="<?= Yii::t('main', 'Перейти к изображениям') ?>"><a
          href="#item-info-images"><i class="fa fa-file-image-o"></i></a></div>
    <div class="search-sidebar-comments" data-toggle="tooltip"
         title="<?= Yii::t('main', 'Перейти к комментариям') ?>"><a
          href="#item-info-comments"><i class="fa fa-comments-o"></i></a></div>

</div>
<script type="text/javascript" src="<?= $this->frontThemePath ?>/js/up.js"></script>
            </div>
            <div class="row clearfix f-space10"></div><!--отступ для блока-->
            
            
            <div class="item-params"><!-- Информация о продавце -->
                <?
                if (!$this->preLoading) {
                    Yii::app()->controller->renderPartial(
                      'seller_info',
                      [
                        'item'   => $item,
                        'seller' => $seller,
                      ],
                      false,
                      false
                    );
                } ?>
            </div><!-- End: Col -->
    </div><!-- End: row-->
</div><!--End: Container-->

<!--------------------------------------------------->
</div></div></div></div></div></div></div></div></div>
<!--------------------------------------------------->
<? //========================== блог ======================================== ?>
<? /*
if (!$this->preLoading) {
    if (DSConfig::getVal('blogs_enabled') == 1) { ?>
        <div class="clear"></div>
        <div id="blog-attached-block">

            <?
            $this->widget(
              'application.components.widgets.BlogAttachedBlock',
              array(
                'pageSize' => 1000,
                'category' => Yii::t('main', 'Обзоры товаров'),
                  // Текст на русском, обозначаюший название категории по умолчанию для этого аттача
                'title'    => Yii::t('main', 'Обзор товара') . ' Art.' . $item->top_item->num_iid,
                  //Тэг для этого аттача, например - item345345345 или category345345
                'tag'      => '@item-review-' . $item->top_item->num_iid,
                  //Тэг для этого аттача, например - item345345345 или category345345
                  //Предварительно отрендеренный шаблон отзыва
                'body'     => Yii::app()->controller->renderPartial('item_review', array('item' => $item), true, false),
              )
            );
            ?>
        </div>
    <? }
} */ ?>
<? //======================================================================== ?>



        <? //======================== Товары продавца ================================================== ?>
        <?
        if (!$this->preLoading) {
            if (DSConfig::getVal('search_use_seller_related_in_item') == 1) { ?>
              <div class="clear"></div>
              <div class="block" id="seller-related-block" style="margin:7px;">
                <div class="seller-block" translate="no">
                  <div id="sellerrelated"></div>
                    <? if (!Yii::app()->request->isPostRequest &&
                      !Yii::app()->request->isAjaxRequest &&
                      !(isset($this->preLoading) && $this->preLoading)
                    ) { ?>
                      <script>
                          <? if (isset($seller->user_id)) {
                              $userid = $seller->user_id;
                          } elseif (isset($item->top_item->seller_id)) {
                              $userid = $item->top_item->seller_id;
                          } else {
                              $userid = 0;
                          } ?>
                          setTimeout(
                              loadSellerRelatedBlock('<?=$item->top_item->nick?>', '<?=$userid?>', '<?=$item->top_item->ds_source?>', '<?=$item->top_item->num_iid?>'),
                              1000);
                      </script>
                    <? } ?>
                </div>
              </div>
            <? }
        } ?>
        <? //=========================================================================================== ?>
      <div class="row clearfix f-space20"></div>
        <? if (!Yii::app()->user->isGuest) { ?>
            <? /*<div class="panel-default"><div class=" panel-heading"><h3><?= Yii::t('main', 'Недавно Вы смотрели') ?></h3></div></div>*/ ?>
          <div class="products-list featured" translate="no" style="width: 100%">
              <? include_once __DIR__ . '/_ajaxRecentUserItemslistForItem.php' ?>
          </div>
        <? } ?>

      <div class="row clearfix f-space20"></div>

    </div><!-- End: Col -->

  </div><!-- End: row-->
    <? /**/ ?>
</div><!-- End: Container -->
<!------------ PROFILLER --------------------->
<? 
/** $this->widget('application.components.widgets.ProfilerBlock', []); ?>
<? if (isset($item->top_item->debugMessages)) {
    $this->renderPartial(
      'debug',
      [
        'debugMessages' => $item->top_item->debugMessages,
      ]
    );
} 
**/
?>

