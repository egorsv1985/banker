<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 * Рендеринг поисковой выдачи (вобще любой, по категориям, брэндам, пользователю, запросу и т.п.)
 **********************************************************************************************************************/
?>
<? $seo_disable_items_index = DSConfig::getVal('seo_disable_items_index') == 1; ?>
<!--<div class="row clearfix f-space10"></div>-->
<!-- Shop Page title -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="box-heading category-heading">
          <? // Блок вывода описания категории, если это описание есть?>
          <? if (isset(
              $category->{'page_desc_' . Utils::transLang()}
            ) && !empty($category->{'page_desc_' . Utils::transLang()})
          ) { ?>
            <h1><?= $category->{'page_desc_' . Utils::transLang()} ?></h1>
          <? } ?>
          <? // Блок вывода описания бренда, если это описание есть?>
          <? if (isset(
              $brand->{'page_desc_' . Utils::transLang()}
            ) && !empty($brand->{'page_desc_' . Utils::transLang()})
          ) { ?>
            <h1><?= $brand->{'page_desc_' . Utils::transLang()} ?></h1>
          <? } ?>
      </div>
    </div>
  </div>
</div>
<!-- end: Shop Page title -->
<div class="container">
  <div class="row clearfix f-space10"></div>
    <? if (is_object($res)) { ?>
  <div class="row"><!-- row -->
      <? if (isset($res->error) || !isset($res->items) || (isset($res->items) && !count($res->items))) { ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="content">
            <div class="alert alert-danger">
              <h3><?= Yii::t('main', 'По Вашему запросу ничего не найдено, уточните Ваш запрос') ?></h3>
            </div>
          </div><!--End:Content-->
        </div><!--End:Col-->

      <? } else { ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-block">
          <div class="box-heading category-heading">
                <span>
                    <? if (isset($res->total_results) && ($res->total_results > 0) && isset($pages)) { ?>
                        <? /*<h1>*/ ?>
                        <?= Yii::t('main', 'Показано') ?>
                        <?= $pages->currentPage * $pages->pageSize + 1 ?> - <?= ($pages->currentPage *
                          $pages->pageSize) + count(
                          $res->items
                        ) ?>
                        <?= Yii::t('main', 'из') ?>
                        <?= $res->total_results ?>
                        <? /*</h1>*/ ?>
                    <? } //else { ?>
                    <? /* <div class="alert alert-warning"><?= Yii::t('main', 'Ничего не найдено') ?></div> */ ?>
                    <? //} ?>
                </span>
            <ul class="nav nav-pills pull-right">
              <li class="ass">
                  <? if (isset($res->dsSrcLangQuery) && ($res->dsSrcLangQuery)) { ?>
                    <div style="position: relative;">
                        <?= Yii::t('main', 'Поисковый запрос') ?>&nbsp;:&nbsp; <?= $res->dsSrcLangQuery ?>
                    </div>
                  <? } ?>
              </li>
                <?
                if (!isset($res->searchSortParameters) || !is_array($res->searchSortParameters)) {
                    throw new Exception('$res->searchSortParameters undefined!');
                }
                $sortOrders = $res->searchSortParameters;
                if ($sortOrders && count($sortOrders)) {
                    ?>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#">
                        <? $fAction = Yii::app()->createUrl('/' . $this->id . '/index', $params);
                        $sort_by =
                          ((isset($params['sort_by']) && (isset($sorts[$params['sort_by']]))) ? $params['sort_by'] :
                            'popularity_desc');
                        echo $sortOrders[$sort_by];
                        ?><i class="fa fa-sort fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <? foreach ($sortOrders as $sort => $sortName) {
                            if ($sort == $sort_by) {
                                continue;
                            } ?>
                          <li class="raiting-sells">
                            <a rel="nofollow" href="<?= Yii::app()->createUrl(
                              '/' . $this->id . '/index',
                              array_merge($params, ['sort_by' => $sort])
                            ) ?>"><?= $sortName ?>
                            </a>
                          </li>
                        <? } ?>
                    </ul>
                  </li>
                <? } ?>
              <li class="view-list<?= (isset($params['original']) && ($params['original'] == 'on')) ? 'active' : '' ?>">
                <a rel="nofollow" title="<?= Yii::t('main', 'Товары со скидкой') ?>" href="<?=
                Yii::app()->createUrl(
                  '/' . $this->id . '/index',
                  (isset($params['original']) && ($params['original'] == 'on')) ?
                    array_merge($params, ['original' => 'off']) :
                    array_merge($params, ['original' => 'on'])
                ) ?>">
                  <i class="fa fa-gift fa-fw"></i>
                </a>
              </li>
                <? if ($this->id !== 'seller') { ?>
                  <li class="view-list<?= (isset($params['not_unique']) && ($params['not_unique'] == 'on')) ? 'active' :
                    '' ?>">
                    <a rel="nofollow" title="<?= Yii::t('main', 'Повторяющиеся товары') ?>" href="<?=
                    Yii::app()->createUrl(
                      '/' . $this->id . '/index',
                      (isset($params['not_unique']) && ($params['not_unique'] == 'on')) ?
                        array_merge($params, ['not_unique' => 'off']) :
                        array_merge($params, ['not_unique' => 'on'])
                    ) ?>">
                      <i class="fa fa-copy fa-fw"></i>
                    </a>
                  </li>
                  <li class="view-list<?= (isset($params['recommend']) && ($params['recommend'] == '1')) ? 'active' :
                    '' ?>">
                    <a rel="nofollow" title="<?= Yii::t('main', 'Рекомендованные товары') ?>" href="<?=
                    Yii::app()->createUrl(
                      '/' . $this->id . '/index',
                      (isset($params['recommend']) && ($params['recommend'] == '1')) ?
                        array_merge($params, ['recommend' => '0']) :
                        array_merge($params, ['recommend' => '1'])
                    ) ?>">
                      <i class="fa fa-bell-o fa-fw"></i>
                    </a>
                  </li>
                <? } ?>
            </ul>
          </div><!--End:Box-Heading-->
        </div><!--End:Col-->

      <? } ?>


      <? if (isset($res->total_results) && ($res->total_results > 0) && isset($pages)) { ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="box-content">

        <div class="box-products"><!-- Вывод товаров -->

          <!-- Filter bar -->

          <div class="page-sidebar-filter">
              <? $this->widget(
                'application.components.widgets.SearchParams',
                [
                  'type'         => $this->id,
                  'params'       => $this->params['params'],
                  'cids'         => $this->params['cids'],
                  'bids'         => $this->params['bids'],
                  'groups'       => $this->params['groups'],
                  'filters'      => $this->params['filters'],
                  'multiFilters' => $this->params['multiFilters'],
                  'suggestions'  => $this->params['suggestions'],
                  'priceRange'   => $this->params['priceRange'],
                  'items'        => (isset($res->items) && count($res->items) > 0) ? $res->items : false,
                ]
              ); ?>
          </div>

          <!-- End: Filter bar -->

            <? foreach ($res->items as $i => $item) { ?>
              <div class="box-product"><!-- Блок вывода товара-->
                  <? $this->widget(
                    'application.components.widgets.SearchItem',
                    [
                      'searchResItem' => $item,
                      'imageFormat'   => '_240x240.jpg',
                        //'newLine'       => $newLine,
                      'catPath'       => (isset($category->url) ? $category->url : ''),
                      'searchCat'     => $res->cid,
                      'searchQuery'   => $res->dsSrcLangQuery,
                    ]
                  ); ?><!-- End: Блок товара товароа-->
              </div>

            <? } ?>

        </div><!-- End:Product-box-->
      </div><!--End:Col-->
        <? } ?>

        <? if (isset($res->total_results) && ($res->total_results > 0) && isset($pages)) { ?>
          <span class="pull-left">
                    <?= Yii::t('main', 'Показано') ?>
              <?= $pages->currentPage * $pages->pageSize + 1 ?>
                    - <?= ($pages->currentPage * $pages->pageSize) + count(
                $res->items
              ) ?>
              <?= Yii::t('main', 'из') ?>
              <?= $res->total_results ?>
                </span>
        <? } ?>

        <? if ($pages) { ?><!-- Пагинатор -->
      <div class="pull-right">
          <? $this->renderPartial(
            '/search/pagination',
            [
              'pages' => $pages,
            ]
          ); ?>
      </div>
    <? } ?>
    </div><!--End:Col-->

      <? } ?>
  </div><!-- End: (If) row -->
</div><!-- End: container-->
<? //====================================================================================================================?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-column box-block">
        <? include_once __DIR__ . '/_ajaxRecentAllItemslist.php' ?>
    </div>
  </div>
</div>
<!-- Виджет кнопки вверх (Test-Templates) -->
<div class="search-sidebar">
  <div class="search-sidebar-top" data-toggle="tooltip"
       data-original-title="<?= Yii::t('main', 'Перейти к началу страницы') ?>"><i class="fa fa-arrow-up"></i></div>
  <div class="search-sidebar-next" data-toggle="tooltip"
       data-original-title="<?= Yii::t('main', 'Следующая страница') ?>"><a href="#"><i
          class="fa fa-arrow-right"></i></a>
  </div>
  <div class="search-sidebar-prev" data-toggle="tooltip"
       data-original-title="<?= Yii::t('main', 'Предыдущая страница') ?>"><a href="#"><i
          class="fa fa-arrow-left"></i></a>
  </div>
</div>

<? //Скрипт кнопки вверх, назад-вперёд в поисковых выдачах ?>
<script defer src="<?= $this->frontThemePath ?>/js/up.js" type="text/javascript"></script>

<? if (isset($res->debugMessages)) {
    $this->renderPartial(
      '/search/debug',
      [
        'debugMessages' => $res->debugMessages,
      ]
    );
} ?>
