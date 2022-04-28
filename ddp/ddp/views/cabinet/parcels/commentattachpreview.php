<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="commentattachpreview.php">
 * </description>
 * Рендеринг предварительного просмотра аттача\картинки в комментарии к заказу или лоту
 **********************************************************************************************************************/
?>
<?

Yii::app()->clientScript->registerCssFile(
//Yii::app()->request->baseUrl . '/themes/' . $this->frontTheme . '/css/magiczoomplus.css',
  $this->frontThemePath . '/css/' . (YII_DEBUG ? 'magiczoomplus.css' : 'magiczoomplus.min.css'),
  'screen'
);
Yii::app()->clientScript->registerScriptFile(
//Yii::app()->request->baseUrl . '/themes/' . $this->frontTheme . '/js/magiczoomplus.js',
  $this->frontThemePath . '/js/' . (YII_DEBUG ? 'magiczoomplus.js' : 'magiczoomplus.min.js'),
  CClientScript::POS_HEAD
);
?>
<div class="blocknormal">
  <a href="<?= Yii::app()->createUrl('/img/commentattach', ['isItem' => $isItem, 'id' => $attach->id]) ?>"
     class="MagicZoom"
     data-options="zoomMode: off;
                                             lazyZoom: true;
                                             rightClick: true;
                                             expandCaption: false;
                                             textHoverZoomHint: <?= Yii::t('main', 'Курсор для увеличения') ?>;
                                             textClickZoomHint: <?= Yii::t('main', 'Клик для увеличения') ?>;
                                             textExpandHint: <?= Yii::t('main', '') ?>"
     data-mobile-options="textTouchZoomHint: <?= Yii::t('main', 'Прикоснитесь для увеличения') ?>;
                                            textClickZoomHint: <?= Yii::t('main', 'Два клика для увеличения') ?>;
                                            textExpandHint: <?= Yii::t('main', 'Клик для просмотра') ?>">
    <img style="width:100px;height:auto;margin: 0;"
         src="<?= Yii::app()->createUrl('/img/commentattach', ['isItem' => $isItem, 'id' => $attach->id]) ?>"/></a>
</div>