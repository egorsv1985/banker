<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="ShopMenuBlock.php">
 * </description>
 * Виджет, реализующий раздел "Избранное" в менню категорий
 * var $shopMenu = - собственно, массив масивов категорий главного меню.
 * array
 * (
 * 0 => array
 * (
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
 * )
 * var $adminMode = false - рендерить ли в режиме Админки
 **********************************************************************************************************************/
?>
<? $type = 'shop'; ?>
<div class="shopMenu"
     style="overflow-y:scroll;max-height:310px;"> <? // Стиль для прокруки длинного меню в меню избранного ?>
  <ul>
      <? if (isset($shopMenu)) {
          foreach ($shopMenu as $id => $menu) {
              $link = Yii::app()->createUrl('/' . $type . '/' . $menu['cid']);
              ?>
            <li class="item">
                <? if (($menu['cid'] == '0') && ($menu['query'] == '')) { ?>
                  <a
                      href="javascript:void(0);"><?= $menu['view_text'] ?></a>
                    <?
                } else {
                    ?>
                  <a
                      href="<?= $link ?>">
                      <?= $menu['view_text'] ?>
                  </a>
                <? } ?>
            </li>
          <? } ?>
      <? } ?>
    <li class="item"><a href="<?= Yii::app()->createUrl('/' . $type . '/other') ?>">
            <?= Yii::t('main', 'Прочее...') ?>
      </a></li>
  </ul>
</div>