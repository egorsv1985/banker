<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="CategoriesMenuBlock.php">
 * </description>
 * Виджет основного меню категорий
 * $mainMenu = массив описаний категорий с массивами описаний дочерних категорий
 * Array
 * (
 * [0] => Array
 * (
 * [pkid] => 2 - PK категории из таблицы categories_ext
 * [cid] => 0 - cid категории
 * [parent] => 1 - PK родительской категории, 1 - корень
 * [status] => 1 - вкл/выкл
 * [url] => mainmenu-odezhda - часть URL категории
 * [query] => 女装男装 - запрос на китайском языке
 * [level] => 2 - уровень в дереве категорий, начиная с 1 для корня
 * [order_in_level] => 200 - порядок вывода категории в уровне
 * [view_text] => Одежда - название категории
 * [children] => Array (...) - массив аналогичных структур для подкатегорий
 * )
 **********************************************************************************************************************/
?>
<?
//menu3d CSS
//Yii::app()->clientScript->registerCssFile($this->frontThemePath . '/css/menu3d.css'); //rel='stylesheet'

// menu3d
//Yii::app()->clientScript->registerScriptFile($this->frontThemePath . '/js/menu3d.js', CClientScript::POS_HEAD);
?>

<? //=================================================================================================================?>
<?
if (!function_exists('createMenuLink')) {
    function createMenuLink($menu, $level = 1)
    {
        $seo_catalog_depth = DSConfig::getVal('seo_catalog_depth');
        // Проверять на url потом где-то тут
        if ($level == 1) {
            ?>
          <a class="menu-item-level1"
             href="<?=
             (($menu['cid'] == '0') && ($menu['query'] == '')) ? 'javascript:void(0);' : Yii::app()
               ->createUrl('/category/index', ['name' => $menu['url']]) ?>"
            <?= ($seo_catalog_depth > 0 ? '' : 'rel="nofollow"') ?>
          ><? if ($menu['decorate']) { ?>
                  <?= $menu['decorate']; ?>
              <? } else { ?>
                  <? //<i class="fa fa-files-o"></i> ?>
              <img src="<?= Img::getImagePath(
                Img::imglibSearchUrl('/icons/', $menu['view_text']),
                '_32x32.png'
              ) ?>"
                   style="width:32px;position:relative;top:12px;left:4px;-webkit-filter: invert(100%);filter: invert(100%);"/>
              <? } ?>
            <p class="menu-item-level1-text"><?= $menu['view_text'] ?></p>
              <?= ((isset($menu['children']) && count(
                  $menu['children']
                ) > 0) ? ' <i class="fa fa-angle-right"></i>' : '') ?></a>
            <?
        } elseif ($level == 2) {
            ?>
          <a class="menu-item-level2"
             href="<?=
             (($menu['cid'] == '0') && ($menu['query'] == '')) ? 'javascript:void(0);' : Yii::app()
               ->createUrl('/category/index', ['name' => $menu['url']]) ?>"
            <?= ($seo_catalog_depth > 1 ? '' : 'rel="nofollow"') ?>>
              <?= $menu['view_text'] ?></a>
            <?
        } elseif ($level == 3) {
            ?>
          <a class="menu-item-level3" <?= (mb_strlen(
            $menu['view_text']
          ) > 22 ? 'title="' . $menu['view_text'] . '"' : '') ?>
             href="<?=

             (($menu['cid'] == '0') && ($menu['query'] == '')) ? 'javascript:void(0);' : Yii::app()
               ->createUrl('/category/index', ['name' => $menu['url']]) ?>"
            <?= ($seo_catalog_depth > 2 ? '' : 'rel="nofollow"') ?>>
              <?= $menu['view_text'] ?>
              <?=
              (false && isset($menu['children']) && count(
                  $menu['children']
                ) > 0) ? ' <i class="fa fa-angle-right"></i>' : '' ?></a>
            <?
        }
    }
}
?>
<? /*
<div class="menu-heading visible-sm">

    <span>
        <i class="fa fa-bars"></i>
        <?= Yii::t('main', 'Меню')?>
    </span>

</div>
*/ ?>
<ul>
  <!-- Пункт меню ВСЕ КАТЕРГОРИИ -->
  <li><a class="menu-item-level1" href="<?= Yii::app()->createUrl('/category/list') ?>">
      <img src="<?= Img::getImagePath(Img::imglibSearchUrl('/icons/', 'Все категории'), '_32x32.png') ?>"
           style="width:32px;position:relative;top:12px;left:4px; -webkit-filter: invert(100%); filter: invert(100%);"/>
      <p class="menu-item-level1-text"><?= Yii::t('main', 'Все категории') ?></p>

    </a>
  </li>
  <li>
    <div class="dropdown-menu">
      <div class="content">

        <div class="menu-columns flyout-menu">
          <ul>
            <li><?= cms::pageLink('about') ?></li>
            <li><?= cms::pageLink('features') ?></li>
            <li><?= cms::pageLink('zakaz_tovarov') ?></li>
            <li><?= cms::pageLink('dostavka') ?></li>
            <li><?= cms::pageLink('oplata') ?></li>
            <li><?= cms::pageLink('faq') ?></li>
            <li><?= cms::pageLink('contacts') ?></li>
          </ul>
        </div>

      </div>
    </div>
  </li>
    <? if (isset($mainMenu)) {
        foreach ($mainMenu as $id => $menu) {
            if ($this->topLevelCount <= 0) {
                break;
            }
            $this->topLevelCount = $this->topLevelCount - 1;
            ?>
          <!-- Menu Item -->
          <li><? createMenuLink($menu); ?>
            <div class="dropdown-menu">
              <!-- Sub Menu -->
              <div class="content">

                  <? foreach ($menu['children'] as $id2 => $items2) { ?>
                    <div class="row">
                      <div class="col-md-12">
                          <? createMenuLink($items2, 2); ?><br/>

                          <? if (isset($items2['children']) && count($items2['children']) > 0) { ?>
                            <div class="menu-columns">
                              <ul>
                                  <?
                                  $imgPath = MainMenu::getCategoryImage(
                                    $items2['children'],
                                    '_160x160.jpg'
                                  );
                                  if ($imgPath) {
                                      ?>
                                    <li><img data-src="<?= $imgPath ?>"/></li>
                                  <? } ?>

                                  <? foreach ($items2['children'] as $item3) { ?>

                                    <li><? createMenuLink($item3, 3); ?></li>
                                  <? } ?>
                              </ul>
                            </div>
                          <? } ?>
                      </div>
                    </div>
                  <? } ?>
              </div>
              <!-- end: Sub Menu -->
            </div>
          </li>
          <!-- end:  Menu Item -->
        <? }
    } ?>
</ul>
<script>
    (function ($) {
        'use strict';
        $('#menuMega').menu3d({
            title: '<?=Yii::t('main', 'Категории')?>',
            lazyImages: true,
            // Animation curve
            easing: 'default',//'default',
            //Animation keyframe for hover in
            hoverIn: 'fadeIn',//'fadeIn','slide'
            //Animation keyframe for hover out
            hoverOut: 'fadeOut',//'fadeOut' 'slide'
            // Duration per element
            speed: 700,
            hoverInTimeout: 300,
            hoverOutTimeout: 1000
        });
    })(jQuery);
</script>
