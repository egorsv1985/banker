<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="FavoritesMenuBlock.php">
 * </description>
 * Виджет, реализующий раздел "Избранное" в менню категорий
 * var $favoriteMenu = - собственно, массив масивов категорий главного меню.
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
<? $type = 'favorite'; ?>
  <div class="favoritesMenu"
       style="overflow-y:scroll;max-height:310px;"> <? // Стиль для прокруки длинного меню в меню избранного ?>
    <ul>
        <? if (isset($favoriteMenu)) {
            foreach ($favoriteMenu as $id => $menu) {
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

<? /*
<script>

    var maxHeight = 400;

    $(function(){

        $(".favoritesMenu > ul > li").function() {

            var $container = $(this),
                $list = $container.find("ul"),
                $anchor = $container.find("a"),
                height = $list.height() * 1.1,     // проверяем, достаточно ли свободного места внизу
                multiplier = height / maxHeight; // необходим для более быстрого движения, если список длиннее

            // сохраняем высоту здесь, так что она восстанавливается при покидании мыши
            $container.data("origHeight", $container.height());

            // сохраняем цвет наведения, пока открыто выпадающее меню
            $anchor.addClass("hover");

            // проверяем, появился ли список непорседственно под родительским списком
            $list
                .show()
                .css({
                    paddingTop: $container.data("origHeight")
                });

            // Не применяем анимацию, если список короче максимального
            if (multiplier > 1) {
                $container
                    .css({
                        height: maxHeight,
                        overflow: "hidden"
                    })
                    .mousemove(function(e) {
                        var offset = $container.offset();
                        var relativeY = ((e.pageY - offset.top) * multiplier) - ($container.data("origHeight") * multiplier);
                        if (relativeY > $container.data("origHeight")) {
                            $list.css("top", -relativeY + $container.data("origHeight"));
                        };
                    });
            }

        }, function() {

            var $el = $(this);

            // возвращаем все как было
            $el
                .height($(this).data("origHeight"))
                .find("ul")
                .css({ top: 0 })
                .hide()
                .end()
                .find("a")
                .removeClass("hover");

        });

        // Добавляем нижнюю стрелку только для тех пунктов, у которых есть дочернее меню
        $(".favoritesMenu > ul:has('li')").each(function() {
            $(this).find("a:first").append("<img src='images/down-arrow.png' />");
        });

    });

</script>
*/ ?>