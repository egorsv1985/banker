<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="list.php">
 * </description>
 * Просмотр списка избранных товаров в кабинете
 **********************************************************************************************************************/
?>
<br/>
<div class="container">
    <? /*
    <div class="row"><!-- row -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-column box-block">
*/ ?>
    <? /* Экспорт в YML   <div>
        <?= Yii::t('main', 'Категорий для экспорта') . ':' . $categoriesCount; ?>
        <?= Yii::t('main', 'Товаров для экспорта') . ':' . $itemsCount; ?>
    </div> */ ?>
    <? /*
            <? if (isset($favoriteMenu) && is_array($favoriteMenu) && count($favoriteMenu)) { ?>
                <div class="btn-group">
                    <? foreach ($favoriteMenu as $category) { ?>
                        <!--<span class="badge badge-info">-->

                        <a href="<?= Yii::app()->controller->createUrl('list', array('cid' => $category['cid'])) ?>">
                            <button type="button" class="btn btn-default">
                                <?= $category['view_text'] ?>
                            </button>
                        </a>

                        <!--</span>-->
                        &nbsp;
                    <? } ?>
                </div>
            <? } ?>
            <? $this->widget(
              'booster.widgets.TbMenu',
              array(
                  //'itemCssClass'=>'form-item submit',
                'items' => array(
                  array(
                    'label' => Yii::t('admin', 'Очистить весь список'),
                    'icon'  => 'icon-refresh',
                    'url'   => Yii::app()->controller->createUrl('delete', array('id' => -1)),
                  ),
                )
              )
            );
            ?>
            <!--

            <div class="btn-group">
                <button type="button" class="btn btn-default">Левая</button>
                <button type="button" class="btn btn-default">Средняя</button>
                <button type="button" class="btn btn-default">Правая</button>
             </div>

            -->

        </div><!--End:Col-->
    </div><!--End:Row-->
    */ ?>
    <? /*
    <div class="row"><!-- row -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-block page-sidebar">

        </div>

    </div>
    */ ?>
    <? /*
    <div class="row"><!-- row -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 box-block page-sidebar">
            <? // Виджет меню кабинета ?>
            <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
            <? $this->widget('application.components.widgets.cabinetMenuBlock'); ?>

        </div><!-- End:Col-->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 main-column box-block">
        <div class="f-space10"></div>

            <? $this->widget(
              'application.components.widgets.SearchItemsList',
              array(
                'id'                         => 'favorite-itemslist',
				'template'                   => '{pager}{items}{pager}',
                'title'                      => '<span>' . Yii::t('main', 'Избранные товары') . '</span>',
                'showControl'                => true,
                'controlAddToFavorites'      => false,
                'controlAddToFeatured'       => false,
                'controlDeleteFromFavorites' => true,
                'lazyLoad'                   => true,
                'dataType'                   => 'itemsFavorite',
                'pageSize'                   => 36,
                'dataProvider'               => $dataProvider,
                'imageFormat'                => '_240x240.jpg',
                'prevPageLabel'              => '<i class="fa fa-angle-left fa-fw"></i>',
                'nextPageLabel'              => '<i class="fa fa-angle-right fa-fw"></i>',
                'pagerCssClass'              => 'box-heading',
                'showEmptyPager'             => true,
                'itemsCssClass'              => 'row items',
                'itemsTagName'               => 'div',
                'itemBlockClass'             => 'col-lg-4 col-md-4 col-sm-6 col-xs-12',
              )
            );
            ?>

        </div><!--End:Col-->
    </div><!--End:Row -->
    */ ?>
  <div class="row"><!-- row -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-block page-sidebar">
      <div style="float: left;width: 25%">
          <? // Виджет меню кабинета ?>
        <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
          <? $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
      </div>
        <? /*
        </div><!-- End:Col-->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 main-column box-block">
        */ ?>
      <!--<div class="f-space10"></div>-->

        <? $this->widget('application.components.widgets.SearchItemsList', [
            'id'                         => 'favorite-itemslist',
              //'template'                   => '{pager}{items}{pager}',
            'template'                   => '{items}{pager}',
            'title'                      => '<span>' . Yii::t('main', 'Избранные товары') . '</span>',
            'showControl'                => true,
            'controlAddToFavorites'      => false,
            'controlAddToFeatured'       => Yii::app()->user->checkAccess('admin/Featured/Add'),
            'controlDeleteFromFavorites' => true,
            'lazyLoad'                   => true,
            'dataType'                   => 'itemsFavorite',
            'pageSize'                   => 36,
            'dataProvider'               => $dataProvider,
            'imageFormat'                => '_240x240.jpg',
            'prevPageLabel'              => '<i class="fa fa-angle-left fa-fw"></i>',
            'nextPageLabel'              => '<i class="fa fa-angle-right fa-fw"></i>',
              //'pagerCssClass'              => 'box-heading',
            'showEmptyPager'             => true,
            'itemsCssClass'              => 'row items',
            'itemsTagName'               => 'div',
              //'itemBlockClass'             => 'col-lg-4 col-md-4 col-sm-6 col-xs-12',
          ]
        );
        ?>

    </div><!--End:Col-->
  </div><!--End:Row -->

</div><!--End:Container-->
