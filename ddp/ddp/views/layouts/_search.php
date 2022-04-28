<div class="left-col">
    <? // Вывод параметров поиска в поисковых же страницах?>
    <? $this->widget(
      'application.components.widgets.SearchParams',
      [
        'type'         => $this->id,
        'userRateUrl'  => (isset($this->params['userRateUrl']) ? $this->params['userRateUrl'] : false),
        'params'       => $this->params['params'],
        'cids'         => $this->params['cids'],
        'bids'         => $this->params['bids'],
        'groups'       => $this->params['groups'],
        'filters'      => $this->params['filters'],
        'multiFilters' => $this->params['multiFilters'],
        'suggestions'  => $this->params['suggestions'],
        'priceRange'   => $this->params['priceRange'],
      ]
    );
    ?>
    <? // Вертикальный список категорий на главной и в поисковых страницах ?>
  <h4 class="page-title"><?= Yii::t('main', 'Категории товаров') ?></h4>

  <div id="main-cats-menu-ajax"><span style="text-align: center;"><img
          src="<?= $this->frontThemePath ?>/images/ajax-loader.gif"></span>
  </div>
    <? if (Yii::app()->user->notInRole('guest')) { ?>
      <h4 class="page-title"><?= Yii::t('main', 'Избранное') ?></h4>
      <div id="favorites-menu">
          <? // Блок категорий избранного, который выводится ниже меню категорий?>
          <?
          $this->widget(
            'application.components.widgets.FavoritesMenuBlock',
            [
              'adminMode' => false,
            ]
          );
          ?>
      </div>
    <? } ?>
    <? // Блок профайлера?>
    <? $this->widget('application.components.widgets.ProfilerBlock', []); ?>
</div>
<div class="main-col" id="content">
    <? //Здесь выводится контент представления контроллера ?>
    <?= $content ?>
</div>
<? //Скрипт кнопки вверх, назад-вперёд в поисковых выдачах ?>
<script defer src="<?= $this->frontThemePath ?>/js/up.js" type="text/javascript"></script>
