<? $this->widget(
  'application.components.widgets.SearchItemsList',
  [
    'id'                         => 'PopularItemslist',
    'title'                      => '<span style="position:relative;">'
      . CHtml::link(
        Yii::t('main', 'Популярные товары'),
        'javascript:void(0);',
        [
          'onclick' => 'window.location.href="' .
            Yii::app()->createUrl('/search/searchByList', ['dataType' => 'itemsPopular']) .
            '"',
        ]
      ) . '</span>',
    'controlAddToFavorites'      => true,
    'controlAddToFeatured'       => true,
    'controlDeleteFromFavorites' => false,
    'lazyLoad'                   => true,
    'dataType'                   => 'itemsPopular',
    'pageSize'                   => 8,
    'imageFormat'                => '_240x240.jpg',
    'template'                   => '{pager}{items}',
    'disableItemForSeo'          => DSConfig::getVal('seo_disable_items_index') == 1,
    'prevPageLabel'              => '<i class="fa fa-angle-left fa-fw"></i>',
    'nextPageLabel'              => '<i class="fa fa-angle-right fa-fw"></i>',
    'pagerCssClass'              => 'box-heading',
    'showEmptyPager'             => true,
    'itemsCssClass'              => 'row items',
    'itemsTagName'               => 'div',
  ]
);