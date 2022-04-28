<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="list.php">
 * </description>
 * Рендеринг списка категорий
 * http://<domain.ru>/ru/category/list
 * var $categories = array - массив, описывающий категории
 * ( 0 => array (
 * 'pkid' => '2'
 * 'cid' => '0'
 * 'parent' => '1'
 * 'status' => '1'
 * 'url' => 'mainmenu-odezhda'
 * 'query' => '女装男装'
 * 'level' => '2'
 * 'order_in_level' => '200'
 * 'view_text' => 'Одежда'
 * 'children' => array
 * (
 * 3 => array(...)
 * 18 => array(...)
 * 31 => array(...)
 * 41 => array(...)
 * 49 => array(...)
 * 60 => array(...)
 * 70 => array(...)
 * 81 => array(...)
 * )
 * )
 **********************************************************************************************************************/
?>
<div class="row clearfix f-space10"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2><?= $this->pageTitle ?></h2>
      </div>
    </div>
  </div>
  <div class="row clearfix f-space10"></div>
    <? $mainMenu = $categories;
    $seo_catalog_depth = DSConfig::getVal('seo_catalog_depth'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel-group" id="accordion">
          <? if (isset($mainMenu)) { ?>
              <? foreach ($mainMenu as $id => $menu) { ?>
                  <? $type = 'category'; ?>
                  <? $link = Yii::app()->createUrl('/' . $type . '/index', ['name' => $menu['url']]); ?>
              <div class="panel panel-default">
                <div class="panel-heading" style="padding: 15px 10px;">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#<?= 'Cat-list-top-menu-list-' . $menu['pkid'] ?>">
                      <i class="fa fa-arrow-down" aria-hidden="true"></i>&nbsp;&nbsp;
                        <?= $menu['view_text'] ?> <? //наименование категории ?>
                    </a>
                  </h4>
                </div><!--End:Panel-heading--->
                <div class="row clearfix f-space10"></div>
                  <? if (isset($menu['children']) && count($menu['children']) > 0) { ?>
                    <div id="<?= 'Cat-list-top-menu-list-' . $menu['pkid'] ?>" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div style="background: #2c3e50;">
                            <? if (isset($menu['children']) && count($menu['children']) > 0) {
                                foreach ($menu['children'] as $id2 => $items2) { ?>
                                    <? if (isset($items2) && isset($items2['url'])) { ?>
                                    <div class="row">
                                      <div class="col-lg-12 col-md-12 col-sm-12 co-xs-12 pull-left menu-columns"
                                           style="padding: 10px;">
                                            <span>
                                                    <a style="color: white; font-size: 20px;"
                                                       href="<?= Yii::app()->createUrl('/' . $type . '/index',
                                                         ['name' => $items2['url']]
                                                       ) ?>" <?= ($seo_catalog_depth > 1 ? '' : 'rel="nofollow"') ?>>
                                                        <b><?= $items2['view_text'] ?></b>
                                                    </a>
                                            </span>
                                        <ul class="cat-menu" style="color: white; font-size: 16px;">
                                            <?
                                            $imgPath = MainMenu::getCategoryImage(
                                              $items2['children'],
                                              '_160x160.jpg',
                                              true,
                                              true
                                            );
                                            if ($imgPath) {
                                                ?>
                                              <li style="border-top: none; padding: 5px; width: 170px; height: 170px;">
                                                <img src="<?= $imgPath ?>" style="width: 160px; height: 160px;"/>
                                              </li>
                                            <? } ?>
                                            <? if (isset($menu['children']) && count(
                                                $menu['children']
                                              ) > 0
                                            ) { ?>
                                                <? if (isset($items2['children']) && count(
                                                    $menu['children']
                                                  ) > 0
                                                ) {
                                                    foreach ($items2['children'] as $id3 => $items3) {
                                                        ?>
                                                      <li style="border-top: none;">
                                                        <a class="cat-menu-item-level3"
                                                           style="color: white; text-decoration: none;"
                                                           href="<?=
                                                           Yii::app()->createUrl('/' . $type . '/index',
                                                             ['name' => $items3['url']]
                                                           ) ?>" <?= ($seo_catalog_depth > 2 ? '' :
                                                          'rel="nofollow"') ?>>
                                                            <?= $items3['view_text'] ?>
                                                        </a>&nbsp;
                                                      </li>
                                                        <?
                                                    }
                                                }
                                            } ?>
                                        </ul>
                                      </div><!--End:Col-->
                                    </div><!--End:Row-->
                                    <? } ?>
                                <? } ?>
                            <? } ?>
                        </div>
                      </div><!--End:Panel-body-->
                    </div><!--End:Collapse-->
                  <? } ?>
              </div><!--End:Panel-->
              <? } ?>
          <? } ?>
      </div><!--End:Pabel-group-->
    </div><!--End:Col-->
  </div><!--End:Row-->
</div><!--End:Container-->
<!--------------------------------------------------------------------->
</div></div></div></div></div></div></div></div></div></div></div></div>
<!--------------------------------------------------------------------->
<div class="row clearfix f-space10"></div>
