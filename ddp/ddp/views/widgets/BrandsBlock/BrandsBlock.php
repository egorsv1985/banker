<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="BrandsBlock.php">
 * </description>
 * Виджет отображает карусель логотипов брендов на главной
 * $brands - массив моделей Brands
 * = Array of
 * Array(
 * [id] => 373
 * [name] => Fossil
 * [enabled] => 1
 * [img_src] => brand_logo_27.jpg
 * [vid] => 46470
 * [query] => Fossil
 * [url] => fossil
 * )
 **********************************************************************************************************************/
?>
<? if ($brands) {
    if ($this->beginCache(
      'brandsBlock',
      [
        'duration' => (YII_DEBUG ||
          (Yii::app()->user->inRole(['contentManager', 'superAdmin']))
        ) ? 5 : 1200,
      ]
    )
    ) { ?>
      <div class="box-heading">
            <span>
                <a href="<?= Yii::app()->createUrl('/brand/list') ?>"><?= Yii::t('main', 'Все популярные бренды') ?></a>
            </span>
      </div>
      <div class="box-content">
        <div class="box-products box-brands carousel slide lazy" id="brands" data-ride="carousel">
          <div class="carousel-controls">
            <a class="carousel-control left" data-slide="prev" role="button" href="#brands">
              <i class="fa fa-angle-left fa-fw"></i>
            </a>
            <a class="carousel-control right" data-slide="next" role="button" href="#brands">
              <i class="fa fa-angle-right fa-fw"></i>
            </a>
          </div>
          <div class="carousel-inner">
              <? $i = 0;
              $j = 0;
              foreach ($brands

              as $brand) {
              $j = $j + 1;
              if (!$brand->img_src) {
                  continue;
              }
              $newLineFlag = 0;
              if ($i == 0) {
                  $newLineFlag = 1;
              } elseif ($i % 12 /* 12 - количество элементов в одном слайде. Резиновое.*/ == 0) {
                  $newLineFlag = 2;
              }
              $i = $i + 1;
              ?>
              <? if ($newLineFlag != 0) { ?>
              <? if ($newLineFlag == 2) { ?>
          </div>
            <? } ?>
          <div class="brands-row item<? if ($newLineFlag == 1) {
              echo ' active';
              $active = true;
          } else {
              $active = false;
          } ?>">
              <? } ?>
              <?
              $imgSrc = Yii::app()->request->baseUrl . '/images/brands/' . $brand->img_src;
              if (DSConfig::getVal('seo_img_cache_enabled') == 1) {
                  $imgsubdomains = explode(',', DSConfig::getVal('seo_img_cache_subdomains'));
                  $domain = Yii::app()->getBaseUrl(true);
                  if (is_array($imgsubdomains) && (count($imgsubdomains) > 0)) {
                      $n = $brand->id % count($imgsubdomains);
                      $s = $imgsubdomains[$n];
                      $subdomain = preg_replace('/(http[s]*:\/\/)/i', '//' . $s . '.', $domain);
                  } else {
                      $subdomain = $domain . '.';
                  }
                  $subdomain = preg_replace('/www\./', '', $subdomain);
                  $imgSrc = $subdomain . $imgSrc;
              }
              ?>

            <div class="brand-logo"><a
                  href="<?= Yii::app()->createUrl('/brand/index', ['name' => $brand->url]) ?>">
                <img width="100px" height="100px"
                  <? if ($active) { ?>
                    src="<?= $imgSrc; ?>"
                  <? } else { ?>
                    src="<?= Yii::app()->request->baseUrl ?>/themes/<?=
                    Yii::app()->theme->name ?>/images/zoomloader.gif"
                    data-src="<?= $imgSrc; ?>"
                  <? } ?>
                     alt="<?= CHtml::encode($brand->name); ?>"></a>
            </div>
              <? if ($j >= count($brands)) { ?>
          </div>
        <? break;
        } ?>
            <? } ?>
        </div>
      </div>
      </div>
        <? $this->endCache();
    }
}
?>
<script>
    (function ($) {
        'use strict';
        $('#brands').on('slide.bs.carousel', function (e) {
            try {
                var lazyImages;
                lazyImages = $(e.relatedTarget).find('img[data-src]');
                if (typeof lazyImages !== 'undefined') {
                    $.each(lazyImages,
                        function (i, lazyImg) {
                            $(lazyImg).attr('src', $(lazyImg).attr('data-src'));
                            $(lazyImg).removeAttr('data-src');
                        }
                    );
                }
            } catch (err) {
                console.log('Problems with brands slider lazy');
            }
        });
        $('#brands').carousel({
            interval: 10000
        });
        setTimeout(function () {
            try {
                $('#brands').carousel('pause');
                console.log('Brands paused conventionaly');
            } catch (err) {
                console.log('Problems with brands pause');
            }
        }, 120000);
    })(jQuery);
</script>