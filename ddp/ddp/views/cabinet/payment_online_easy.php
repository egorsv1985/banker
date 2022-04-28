<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="payment_online.php">
 * </description>
 * Форма онлайнового платежа
 **********************************************************************************************************************/
?>
<!DOCTYPE html PUBLIC  "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= Utils::appLang() ?>" lang="<?= Utils::appLang() ?>">
<head>
  <!--[if IE]>
  <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title><?= CHtml::encode(DSConfig::getVal('site_name') . ': ' . Yii::t('main', 'Пополнение счёта')) ?></title>
  <link rel="icon" href="<?= $this->frontThemePath ?>/images/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="<?= $this->frontThemePath ?>/images/favicon.ico" type="image/x-icon"/>
    <? // Подкеширование DNS для картинок ?>
    <? if (DSConfig::getVal('seo_img_cache_enabled')) { ?>
      <meta http-equiv="x-dns-prefetch-control" content="on">
        <? $imgsubdomains = explode(',', DSConfig::getVal('seo_img_cache_subdomains'));
        $domain = Yii::app()->getBaseUrl(true);
        foreach ($imgsubdomains as $imgsubdomain) { ?>
          <link rel="dns-prefetch"
                href="<?= preg_replace('/(http[s]*:\/\/)/i', '//' . $imgsubdomain . '.', $domain); ?>">
        <? }
    } ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
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
            'Внимание! Вы используете Internet Explorer версии 8 или ниже. Возможнf некорректная работа сайта!'
          ) . '<br />
  ' . Yii::t('main', 'Рекомендуем установить другой браузер, например:') . '
  <a href="http://opera.com/">Opera</a>, <a href="http://www.mozilla-europe.org/ru/products/firefox/">Firefox</a>, <a href="http://www.google.com.ua/intl/ru/chrome/">Google Chrome</a>
		</div>
  ';
    }
    ?>

</head>
<body>
<?= PaySystems::preRenderForm($data, $type); ?>
</body>
<script>
    try {
        var form = document.getElementsByTagName('form');
        if (form.length > 0) {
            form[0].setAttribute('target', '_self');
            form[0].submit();
            form[0].style.display = 'none';
        }
        var link = document.querySelectorAll('a');
        if (link.length > 0) {
            link[0].setAttribute('target', '_self');
            var href = link[0].getAttribute('href');
            window.location.href = href;
            link[0].style.display = 'none';
        }
    } catch (e) {
        alert('Payment form or link not fount or incorrect!');
    }

</script>
</html>
