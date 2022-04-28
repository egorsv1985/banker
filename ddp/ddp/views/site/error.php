<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="error.php">
 * </description>
 * Рендеринг сообщения об ошибке
 **********************************************************************************************************************/
?>
<? Yii::app()->clientScript->registerMetaTag('noindex', 'robots'); ?>
<?
//========================================================
$featured_items = DSConfig::getVal('featured_items');
$featuredTypes = explode(',', $featured_items);
$itemsPopular = (in_array('popular', $featuredTypes));
$itemsRecommended = (in_array('recommended', $featuredTypes));
$itemsRecentUser = (in_array('recentUser', $featuredTypes));
$itemsRecentAll = (in_array('recentAll', $featuredTypes));
//========================================================
?>
<div class="row f-space10"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2>
            <?= Yii::t(
              'main',
              'Ошибка'
            ) ?><?
            if (is_array($error)) {
                if (isset($error['code']) && $error['code']) {
                    echo $error['code'];
                } elseif (isset($error['statusCode']) && $error['statusCode']) {
                    echo $error['statusCode'];
                } else {
                    echo 'unknown';
                }
            } else {
                if (isset($error->code) && $error->code) {
                    echo $error->code;
                } elseif (isset($error->statusCode) && $error->statusCode) {
                    echo $error->statusCode;
                } else {
                    echo 'unknown';
                }
            }
            ?>
        </h2>
      </div>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-md-12">
      <div class="error">
          <?
          /*
          code - the HTTP status code (e.g. 403, 500)
          type - the error type (e.g. 'CHttpException', 'PHP Error')
          message - the error message
          file - the name of the PHP script file where the error occurs
          line - the line number of the code where the error occurs
          trace - the call stack of the error
          source - the context source code where the error occurs
          */
          $mess = 'unknown';
          if (is_array($error) && isset($error['message'])) {
              $mess = @$error['message'];
          } else {
              $mess = @$error->getMessage();
          }
          if (!$mess) {
              $mess = 'unknown';
          }
          if (is_object($error)) {
              echo '<br /><div class="alert alert-danger"> Error: ' .
                CHtml::encode($mess) .
                ' (' .
                get_class($error) .
                ')</div>';
          } else {
              echo '<br /><div class="alert alert-danger">Error: ' . CHtml::encode($mess) . '</div>';
          }
          ?>
      </div>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-md-12">
        <? //CVarDumper::dump($error,10,true)?>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-info">
          <?= cms::customContent('error-main-sorry-message') ?>
      </div>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-md-12">
        <? $this->widget(
          'application.components.widgets.UserNavigationHistory',
          [
            'type' => null,
            'count' => 10,
          ]
        );
        ?>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-md-12">
        <? if ($itemsRecommended) { ?>
          <div class="page-title"><h2><?= Yii::t('main', 'Рекомендованные товары') ?>:</h2></div>
          <div class="row f-space10"></div>
          <div class="products-list featured">
              <? $seo_disable_items_index = DSConfig::getVal('seo_disable_items_index') == 1; ?>
              <? include_once __DIR__ . '/_ajaxRecommendedItemslist.php' ?>
          </div>
        <? } ?>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-md-12">
      <!--  begin popular items -->
        <? if ($itemsPopular) { ?>
          <div class="page-title"><h2><?= Yii::t('main', 'Популярные товары') ?>:</h2></div>
          <div class="row f-space10"></div>
          <div class="products-list featured">
              <? $seo_disable_items_index = DSConfig::getVal('seo_disable_items_index') == 1; ?>
              <? include_once __DIR__ . '/_ajaxPopularItemslist.php' ?>
          </div>
        <? } ?>
    </div><!--End:Col-->
  </div><!--End:Row-->

  <div class="row">
    <div class="col-md-12">
      <!--  begin my items -->
        <? if ($itemsRecentUser) { ?>
          <div class="page-title"><h2><?= Yii::t('main', 'Недавно просмотренные Вами') ?>:</h2></div>
          <div class="row f-space10"></div>
          <hr/>
          <div class="products-list featured">
              <? $seo_disable_items_index = DSConfig::getVal('seo_disable_items_index') == 1; ?>
              <? include_once __DIR__ . '/_ajaxRecentUserItemslist.php' ?>
          </div>
        <? } ?>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row">
    <div class="col-md-12">
      <!--  begin all user items -->
        <? if ($itemsRecentAll) { ?>
          <div class="page-title"><h2><?= Yii::t('main', 'Недавно просмотренные другими') ?>:</h2></div>
          <div class="row f-space10"></div>
          <div class="products-list featured">
              <? $seo_disable_items_index = DSConfig::getVal('seo_disable_items_index') == 1; ?>
              <? include_once __DIR__ . '/_ajaxRecentAllItemslist.php' ?>
          </div>
        <? } ?>
    </div><!--End:Col-->
  </div><!--End:Row-->
</div><!--End:Container-->






