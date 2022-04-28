<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="main.php">
 * </description>
 * Лэйаут фронта сайта
 **********************************************************************************************************************/
?>
<!DOCTYPE html>
<!--[if IE 7 ]>
<html class="ie ie7 lte9 lte8 lte7" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= Utils::appLang() ?>"
      lang="<?= Utils::appLang() ?>"><![endif]-->
<!--[if IE 8]>
<html class="ie ie8 lte9 lte8" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= Utils::appLang() ?>"
      lang="<?= Utils::appLang() ?>">    <![endif]-->
<!--[if IE 9]>
<html class="ie ie9 lte9" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= Utils::appLang() ?>"
      lang="<?= Utils::appLang() ?>"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="noIE" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= Utils::appLang() ?>"
      lang="<?= Utils::appLang() ?>">
<!--<![endif]-->

<head>
  <meta charset="UTF-8">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
  <!--<meta content="width=device-width, user-scalable=no" name="viewport">-->
  <!--<meta name="viewport" content="width=device-width, user-scalable=no">-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <link rel="icon" href="<?= $this->frontThemePath ?>/images/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="<?= $this->frontThemePath ?>/images/favicon.ico" type="image/x-icon"/>

  <title><?= $this->pageTitle ?></title>
    <? // Подкеширование DNS для картинок ?>
    <? if (DSConfig::getVal('seo_img_cache_enabled')) { ?>
      <meta http-equiv="x-dns-prefetch-control" content="on">
        <? if (DSConfig::getVal('seo_img_cache_subdomains')) {
            $imgsubdomains = explode(',', DSConfig::getVal('seo_img_cache_subdomains'));
        } else {
            $imgsubdomains = [];
        }
        if (DSConfig::getVal('item_ajax_loading_subdomains')) {
            $itemsubdomains = explode(',', DSConfig::getVal('item_ajax_loading_subdomains'));
        } else {
            $itemsubdomains = [];
        }
        $imgsubdomains = array_merge($imgsubdomains, $itemsubdomains);
        $imgsubdomains[] = 'data';
        $domain = Yii::app()->getBaseUrl(true);
        foreach ($imgsubdomains as $imgsubdomain) { ?>
          <link rel="dns-prefetch"
                href="<?= preg_replace('/(http[s]*:\/\/)/i', '//' . $imgsubdomain . '.', $domain); ?>">
        <? }
    } ?>
    <? /* Подключение css и javaScript, которые используются во всех представлениях фронта,
          для сомнительного удобства вынесено в отдельные файлы.*/
    ?>
    <? $this->renderPartial('//layouts/dropshopGlobalCss', [], false, false, false); ?>
    <? $this->renderPartial('//layouts/dropshopGlobalJs', [], false, false, false); ?>
  <script type="text/javascript" src="<?= $this->frontThemePath ?>/js/main.js?v=<?= Search::$intversion ?>"></script>

  <!-- Сообщение для IE ниже восьмого -->
    <?
    if (!function_exists('maxsite_testIE')) {
        function maxsite_testIE()
        {
            $user_agent = Yii::app()->request->userAgent;
            $browserIE = false;
            if (stristr($user_agent, 'MSIE 7.0')) {
                $browserIE = true;
            } // IE7
            if (stristr($user_agent, 'MSIE 6.0')) {
                $browserIE = true;
            } // IE6
            if (stristr($user_agent, 'MSIE 5.0')) {
                $browserIE = true;
            } // IE5
            return $browserIE;
        }
    }
    ?>
    <?php
    if (maxsite_testIE()) {
        echo '
    <div class="ie">' .
          Yii::t(
            'main',
            'Внимание! Вы используете Internet Explorer версии 8 или ниже. Возможна некорректная работа сайта!'
          ) . '<br />
  ' . Yii::t('main', 'Рекомендуем установить другой браузер, например:') . '
  <a href="http://opera.com/">Opera</a>, <a href="http://www.mozilla-europe.org/ru/products/firefox/">Firefox</a>, <a href="http://www.google.com.ua/intl/ru/chrome/">Google Chrome</a>
  </div>
  ';
    }
    ?>
    <? //TODO: Что это, почему в head и вобще в main.php? ?>
    <? /*
    <!-- API VK -->
    <!-- Put this script tag to the <head> of your page -->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

    <script type="text/javascript">
        VK.init({apiId: 5238544, onlyWidgets: true});
    </script>
    <!-- END : API VK -->
*/ ?>
  <!-- API Facebook-->
    <? /*
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    */ ?>
  <!--END : API Facbook-->
</head>

<body>
<!-- Header -->
<header class="section-header">
    <? // Header part for ALL pages
    $this->renderPartial('//layouts/header', [], false, false, false); ?>
    <? if ($this->id == 'site' && $this->action->id == 'index') { ?>
        <? // Header for main page
        $this->renderPartial('//layouts/_header_for_main', [], false, false, false);
    } else {
        $this->renderPartial('//layouts/_header_for_other', [], false, false, false);
    } ?>
</header>
<!-- end: Header -->
<? // Блок вывода всплывающих сообщений, если они есть?>
<? $this->widget('application.components.widgets.MessagesBlock') ?>
<? //====================================================================================================================?>
<?= $content ?>
<? //====================================================================================================================?>
<? // Footer part for ALL pages
$this->renderPartial('//layouts/footer', [], false, false, false); ?>


<? // Диалог корректировки переводов - используется повсеместно?>
<? if ((Yii::app()->user->checkAccess('site/translate'))) { ?>
    <? /* $this->beginWidget(
      'booster.widgets.TbModal',
      array('id' => 'translationDialog')
    );
    */ ?>
  <div class="modal fade" id="translationDialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <a class="close" data-dismiss="modal">&times;</a>
          <h4><?= Yii::t('main', 'Редактирование перевода') ?></h4>
        </div>
        <div class="modal-body">
            <? $this->renderPartial('//site/translate', []); ?>
        </div>
        <div class="modal-footer">
        </div>

      </div>
    </div>
  </div>
    <? /* $this->endWidget(); ?>*/ ?>
<? } ?>

<? //Ленивая загрузка изображений. Используется в самых разных местах?>
<? if (DSConfig::getVal('site_images_lazy_load') == 1) { ?>
  <script type="text/javascript"
          src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'jquery.lazyload.js' :
            'jquery.lazyload.min.js' ?>"></script>
  <script type="text/javascript">
      $(function () {
          // Disabling any price and detail blocks
          $('img.lazy').each(function () {
              $(this).parents('div.product-block').children('div.product-meta').each(function () {
                  $(this).hide();
              });
              $(this).parents('div.product-block').children('div.product-sale').each(function () {
                  $(this).hide();
              });
          });

          // Callback enabling any price and detail blocks
          function onLazyLoad(element, el_left, settings) {
              $(element).parents('div.product-block').children('div.product-meta').each(function () {
                  $(this).show();
              });
              $(element).parents('div.product-block').children('div.product-sale').each(function () {
                  $(this).show();
              });
          }

          $('img.lazy').show().lazyload({
              load: onLazyLoad,
              effect: 'fadeIn',
              effect_speed: 500,
              skip_invisible: false,
              threshold: 200
//                failure_limit: 60,
//                event : 'load'
          });
      });
  </script>
<? } ?>
</body>
</html>