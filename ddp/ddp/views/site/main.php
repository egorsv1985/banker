<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="main.php">
 * </description>
 * Главная страница сайта (не путать с лэйаутом)
 * var $itemsPopular = true
 * var $itemsRecommended = true
 * var $itemsRecentUser = false
 * var $itemsRecentAll = true
 **********************************************************************************************************************/
?>
<!-- ========================= SECTION  ========================= -->
<section class="section-name padding-y-sm">
  <div class="container">

    <header class="section-heading">
      <a href="#" class="btn btn-outline-primary float-right">Все...</a>
      <h3 class="section-title">Популярные разделы</h3>
    </header><!-- sect-heading -->

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-block">
            <? include_once __DIR__ . '/_ajaxPopularCategorieslist.php' ?>
        </div>
      </div>

    <div class="row">
      <div class="col-md-3">
        <div href="#" class="card card-product-grid">
          <a href="#" class="img-wrap"> <img src="images/items/1.jpg"> </a>
          <figcaption class="info-wrap">
            <a href="#" class="title">Just another product name</a>
            <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
          </figcaption>
        </div>
      </div> <!-- col.// -->
      <div class="col-md-3">
        <div href="#" class="card card-product-grid">
          <a href="#" class="img-wrap"> <img src="images/items/2.jpg"> </a>
          <figcaption class="info-wrap">
            <a href="#" class="title">Some item name here</a>
            <div class="price mt-1">$280.00</div> <!-- price-wrap.// -->
          </figcaption>
        </div>
      </div> <!-- col.// -->
      <div class="col-md-3">
        <div href="#" class="card card-product-grid">
          <a href="#" class="img-wrap"> <img src="images/items/3.jpg"> </a>
          <figcaption class="info-wrap">
            <a href="#" class="title">Great product name here</a>
            <div class="price mt-1">$56.00</div> <!-- price-wrap.// -->
          </figcaption>
        </div>
      </div> <!-- col.// -->
      <div class="col-md-3">
        <div href="#" class="card card-product-grid">
          <a href="#" class="img-wrap"> <img src="images/items/4.jpg"> </a>
          <figcaption class="info-wrap">
            <a href="#" class="title">Just another product name</a>
            <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
          </figcaption>
        </div>
      </div> <!-- col.// -->
      <div class="col-md-3">
        <div href="#" class="card card-product-grid">
          <a href="#" class="img-wrap"> <img src="images/items/1.jpg"> </a>
          <figcaption class="info-wrap">
            <a href="#" class="title">Just another product name</a>
            <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
          </figcaption>
        </div>
      </div> <!-- col.// -->
      <div class="col-md-3">
        <div href="#" class="card card-product-grid">
          <a href="#" class="img-wrap"> <img src="images/items/2.jpg"> </a>
          <figcaption class="info-wrap">
            <a href="#" class="title">Some item name here</a>
            <div class="price mt-1">$280.00</div> <!-- price-wrap.// -->
          </figcaption>
        </div>
      </div> <!-- col.// -->
      <div class="col-md-3">
        <div href="#" class="card card-product-grid">
          <a href="#" class="img-wrap"> <img src="images/items/3.jpg"> </a>
          <figcaption class="info-wrap">
            <a href="#" class="title">Great product name here</a>
            <div class="price mt-1">$56.00</div> <!-- price-wrap.// -->
          </figcaption>
        </div>
      </div> <!-- col.// -->
      <div class="col-md-3">
        <div href="#" class="card card-product-grid">
          <a href="#" class="img-wrap"> <img src="images/items/4.jpg"> </a>
          <figcaption class="info-wrap">
            <a href="#" class="title">Just another product name</a>
            <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
          </figcaption>
        </div>
      </div> <!-- col.// -->
    </div> <!-- row.// -->

  </div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ========================= -->



<div class="row clearfix f-space10"></div>
<!--  begin recomended  items -->
<? if ($itemsRecommended) { ?>
  <div class="row clearfix"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-column box-block">
          <? include_once __DIR__ . '/_ajaxRecommendedItemslist.php' ?>
      </div>
    </div>
  </div>
<? } ?>
<!--  begin popular items -->
<? if ($itemsPopular) { ?>
  <div class="row clearfix"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-column box-block">
          <? include_once __DIR__ . '/_ajaxPopularItemslist.php' ?>
      </div>
    </div>
  </div>
<? } ?>
<!--  begin my items -->
<? if ($itemsRecentUser) { ?>
  <div class="row clearfix"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-column box-block">
          <? include_once __DIR__ . '/_ajaxRecentUserItemslist.php' ?>
      </div>
    </div>
  </div>
<? } ?>
<!--  begin all user items -->
<? if ($itemsRecentAll) { ?>
  <div class="row clearfix"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-column box-block">
          <? include_once __DIR__ . '/_ajaxRecentAllItemslist.php' ?>
      </div>
    </div>
  </div>
<? } ?>
<!-- Rectangle Banners -->
<div class="row clearfix f-space20"></div>
<div class="container">
  <div class="row">
      <?= cms::customContent('fs:rectangle_banners') ?>
  </div>
  <!--</div>--><!-- end: container -->
  <!-- end: Rectangle Banners -->
  <!-- Widgets -->
  <div class="row clearfix"></div>
  <!--<div class="container">-->
  <div class="row">
    <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 social">
        <div class="row">
          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 blog-block" style="padding-right: 15px;">
            <!-- Blog widget Box -->

              <? /***************************/ ?>
              <? if (DSConfig::getVal('blogs_enabled') == 1) { ?>
                  <? /*<div class="page-title"><?= Yii::t('main', 'Блоги, обзоры товаров, комментарии') ?>:</div>*/ ?>
                <div class="products-list bloggalery">
                    <?
                    $this->widget(
                      'application.components.widgets.BlogGalleryBlock',
                      [
                        'pageSize' => 1,
                          // 'ajaxUrl' => '/site/index',
                          /*            'condition' =>'t.enabled=1 and (t.start_date is null or t.start_date <= Now()) and (t.end_date is null or t.start_date >= Now())'
                                      'condition' =>'t.category_id=123',
                                      или
                                      'condition' =>'t.category_id in (123,14,125)',
                                      или даже, если не ошибаюсь, так
                                      'condition' =>"categoryName in ('категория 1','категория 2','категория 3')",
                          */
                      ]
                    );
                    ?>
                </div>
              <? } ?>
              <? /***************************/ ?>
          </div><!--End:row--->

          <!-- end: Blog widget Box -->
          <!--<div class="f-space10"></div>-->
        </div><!--End:Col-->
          <? /*
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="rec-banner red" style="position:relative;right:2px;">
                        <div class="banner"><i class="fa fa-headphones"></i>
                            <h3>24/7 Поддержка</h3>
                            <p>Мы бесплатно сопровождаем всё, что мы продаём</p>
                        </div>
                    </div>

                    <div class="rec-banner blue" style="position:relative;top:2px;right:2px;">
                        <div class="banner"><i class="fa fa-headphones"></i>
                            <h3>24/7 Поддержка</h3>
                            <p>Мы бесплатно сопровождаем всё, что мы продаём</p>
                        </div>
                    </div>
                </div><!--End:Col-->
                */ ?>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 twitter-block">
          <!-- VK widget box -->
          <div class="pull-right" style="padding-right: 15px;"> <?= DSconfig::getVal('ext_vkontakte'); ?> </div>
            <? /*<div id="vk_groups">
                    <script defer src="//vk.com/js/api/openapi.js?121"
                            onload="VK.Widgets.Group('vk_groups', {mode: 2, width: '260', height: '349'}, 98531344);"
                    ></script>
                    </div>*/ ?>
          <!-- end: VK widget box -->
        </div><!--End:Col-->
      </div><!--End:Row-->
    </div><!--End:Col-->
  </div><!--End:Row-->
  <?/*
  <div class="f-space10"></div>
  <div class="row">
    <!-- Brands -->
    <div class="col-md-12 main-column box-block brands-block">
        <? $this->widget('application.components.widgets.BrandsBlock'); ?><!-- Рендеринг блока брендов -->
    </div>
  </div>
*/ ?>
  <!-- end: Brands -->
</div>
</div><!-- end: row -->
</div><!-- end: Container -->
<!-- end: Widgets -->
<? /*
<!-- Виджет кнопки вверх (Test-Templates) -->
<div class="search-sidebar">
    <div class="search-sidebar-top" data-toggle="tooltip" data-original-title="<?=Yii::t('main','Перейти к началу страницы')?>"><i class="fa fa-arrow-up"></i></div>
    <?/*
    <div class="search-sidebar-next" data-toggle="tooltip" data-original-title="<?=Yii::t('main','Следующая страница')?>"><a href="#"><i class="fa fa-arrow-right"></i></a></div>
    <div class="search-sidebar-prev" data-toggle="tooltip" data-original-title="<?=Yii::t('main','Предыдущая страница')?>"><a href="#"><i class="fa fa-arrow-left"></i></a></div>
    */ ?>
<? /*
</div>
*/ ?>

