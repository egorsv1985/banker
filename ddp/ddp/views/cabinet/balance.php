<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="balance.php">
 * </description>
 * Рендеринг состояния счёта и истории платежей в кабинете
 * http://<domain.ru>/ru/cabinet/balance/index
 * var $payments = - платежи
 * CActiveDataProvider#1([modelClass] => 'Payment')
 * var $date_from = '2014-06-06'
 * var $date_to = '2014-07-06'
 **********************************************************************************************************************/
?>
<?
Yii::app()->clientScript->registerScriptFile(
  $this->frontThemePath . '/js/ui/' . (YII_DEBUG ? 'jquery.ui.datepicker.js' : 'minified/jquery.ui.datepicker.min.js'),
  CClientScript::POS_BEGIN
);
?>
<div class="container">
  <div class="clearfix f-space10"></div>
  <div class="row"><!-- row -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="page-title">
        <h2 style="line-height:60px;"><?= $this->pageTitle ?></h2>
      </div>
    </div>
  </div>
  <div class="clearfix f-space10"></div>
  <div class="row">
    <!--
                <a href="<? // Yii::app()->createUrl('/cabinet/balance/payment') ?>">
                    <span><? // Yii::t('main', 'Пополнить счет') ?></span>
                </a>
                <a href="<? // Yii::app()->createUrl('/cabinet/balance/statement') ?>">
                    <span><? // Yii::t('main', 'Информация о счете') ?></span>
                </a>
                <a href="<? // Yii::app()->createUrl('/cabinet/balance/transfer') ?>">
                    <span><? // Yii::t('main', 'Перевод денег на другой счет') ?></span>
                </a>
                -->

    <div class="col-md-3 col-sm-3 col-xs-3 box-block page-sidebar">
      <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
        <? // Виджет меню кабинета
        $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-9 box-block page-sidebar">
      <div class="cabinet-content">
        <div class="alert alert-info"><?= Yii::t('main', 'Номер счета') ?>:&nbsp;<b><?= Yii::app(
                )->user->getPersonalAccount() ?></b></div>
        <div class="alert alert-success"><strong>
                <?= Yii::t('main', 'Ваш текущий баланс') ?>
            : <?=
                Formulas::priceWrapper(
                  Formulas::convertCurrency(
                    Users::getBalance(Yii::app()->user->id),
                    DSConfig::getVal('site_currency'),
                    DSConfig::getCurrency()
                  ),
                  DSConfig::getCurrency()
                ) ?>
          </strong></div>
        <script>
            $(function () {
                $.datepicker.setDefaults($.datepicker.regional['ru']);
                $('#date_from').datepicker({dateFormat: 'yy-mm-dd'});
                $('#date_to').datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>
        <div class="form">
            <? $form = $this->beginWidget(
              'CActiveForm',
              [
                'id'                   => 'balance-date-form',
                'enableAjaxValidation' => false,
                'action'               => Yii::app()->createUrl($this->route),
                'method'               => 'post',
              ]
            );
            ?>

            <?= CHtml::label(Yii::t('main', 'Период с: '), '') ?>
            <?= CHtml::textField('date_from', $date_from, ['id' => 'date_from', 'class' => 'input3']) ?>


            <?= CHtml::label(Yii::t('main', ' по: '), '') ?>
            <?= CHtml::textField('date_to', $date_to, ['id' => 'date_to', 'class' => 'input3']) ?>


            <?= CHtml::submitButton(
              Yii::t('main', 'Показать'),
              ['class' => 'btn btn-info pull-right']
            ); ?>

            <?php $this->endWidget(); ?>
        </div>
        <!--<div class="table table-striped cabinet-table">-->
          <? /*
                $this->widget(
                'booster.widgets.TbGridView',
                array(
                'type' => 'striped',
                'dataProvider' => $gridDataProvider,
                'template' => "{items}",
                'columns' => $gridColumns,
                )
                );
*/ ?>
        <!-- ===================================================================== -->
          <? $this->widget(
            'booster.widgets.TbGridView',
            [
              'id'            => 'payments-grid',
              'type'          => 'striped',
              'dataProvider'  => $payments,
              'enableSorting' => false,
              'pagerCssClass' => 'pagerNoClass',
                /*
                'pager'         => array(
                  'header'         => '',
                  'firstPageLabel' => '&lt;&lt;',
                  'prevPageLabel'  => '&lt;',
                  'nextPageLabel'  => '&gt;',
                  'lastPageLabel'  => '&gt;&gt;',
                ),
                */
              'template'      => '{summary}{items}{pager}',
              'summaryText'   => Yii::t('main', 'Платежи') . ' {start}-{end} ' . Yii::t(
                  'main',
                  'из'
                ) . ' {count}',
              'columns'       => [
                [
                  'name'   => 'id',
                  'header' => Yii::t('admin', 'Транзакция'),
                  'type'   => 'raw',
                  'value'  => function ($data) {
                      return $data['id'];
                  },
                ],
                [
                  'name'   => 'sum',
                  'header' => Yii::t('admin', 'Сумма'),
                  'type'   => 'raw',
                  'value'  => function ($data) {
                      $sum = Formulas::priceWrapper(
                        $data['sum'],
                        DSConfig::getVal('site_currency')
                      );
                      if (DSConfig::getVal('site_currency') != DSConfig::getCurrency()) {
                          $sumInCurr = Formulas::priceWrapper(
                            Formulas::convertCurrency(
                              $data['sum'],
                              DSConfig::getVal('site_currency'),
                              DSConfig::getCurrency(),
                              false,
                              $data['text_date']

                            ),
                            DSConfig::getCurrency()
                          );
                      }
                      if ($data['sum'] > 0) {
                          $class = 'pasitiveTrans';
                      } else {
                          $class = 'negativeTrans';
                      }
                      $result = "<span class='{$class}' title='" . Yii::t('main', 'Сумма в валюте сайта') .
                        "'>{$sum}</span>";
                      if (isset($sumInCurr)) {
                          $result =
                            $result .
                            " <span title='" .
                            Yii::t('main', 'Сумма в текущей валюте по курсу на дату транзакции') .
                            "'>({$sumInCurr})</span>";
                      }
                      return $result;
                  },
                ],
                [
                  'name'   => 'text_date',
                  'header' => Yii::t('admin', 'Дата'),
                ],
                [
                  'name'   => 'description',
                  'header' => Yii::t('admin', 'Описание'),
                ],
              ],
            ]
          );
          ?>
        <!--</div>-->
      </div>
    </div><!--End:Col-->

  </div><!-- /row -->
</div><!-- /container-->