<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 * Начало оформления заказа
 **********************************************************************************************************************/
?>
<div class="content" xmlns="http://www.w3.org/1999/html">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12">
        <div style="" class="page-title box-heading">
          <h3 style="position: relative; top: 35px;"><?= Yii::t('main', 'Оформление заказа') ?><h3>
        </div>
          <? /*
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">

            </div><!--End:col-->
        */ ?>
      </div><!--End:col-->
    </div><!--End:Row-->
    <div class="row">

        <? if (count($addresses)) { ?>
      <script>
          $(function () {
              $('#change_address').click(function () {
                  $('input[type=radio]').each(function (el) {
                      if ($(this).attr('checked')) {
                          var val = $(this).attr('value');
                          window.location.assign(val);
                      }
                  });
                  return false;
              });
              $('#href_address').click(function () {
                  var val = $('#href_address_hidden').attr('value');
                  window.location.assign(val);
              });
          });
      </script>

      <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="row clearfix f-space10"></div><!--Отступ для блоков -->
        <div class="alert alert-danger alert-dismissable text-center"><?= Yii::t(
              'main',
              'Выберите адрес доставки из списка или добавте новый'
            ); ?></div>
        <div class="alert alert-info alert-dismissable text-center">
            <?= Yii::t(
              'main',
              'Вы можете добавить несколько адресов и при оформлении заказов выбирать необходимый адрес из списка ранее добавленых'
            ); ?></div>
      </div><!--End:Col-->

      <div class="col-md-8 col-lg-8 col-sm-6 col-xs-12">

        <div class="page-title"><h4 style="position: relative; top: 45px;"><?= Yii::t(
                  'main',
                  'Список адресов'
                ) ?></h4></div>

        <table class="cabinet-table">
          <tr>
            <th></th>
            <th><?= Yii::t('main', 'Адрес') ?></th>
            <th><?= Yii::t('main', 'Получатель') ?></th>
            <th><?= Yii::t('main', 'Телефон') ?></th>
          </tr>
            <?php
            $i = 1;
            ?>
            <? foreach ($addresses as $address) { ?>
              <tr>
                <td style="padding-left: 25px;">
                  <input type="radio" name="address" <? if ($i == 1) {
                      echo "checked";
                  } ?> value="<?=
                  Yii::app()->createUrl(
                    'checkout/choose_address/',
                    ['id' => $address['id']]
                  ) ?>"/>
                </td>
                <td><?= $countries[$address['country']] ?>,&nbsp;<?= $address['index'] ?>
                  ,&nbsp;<?= $address['address'] ?></td>
                <td><?= $address['fullname'] ?></td>
                <td><?= $address['phone'] ?></td>

              </tr>
                <? $i++; ?>
            <? } ?>
        </table>

        <div class="row buttons">
          <input type="hidden" id="href_address_hidden"
                 value="<?= Yii::app()->createUrl('checkout/add_address') ?>"/>
          <button type="submit" id="href_address" style="margin-right: 25px;"
                  value=<?= Yii::t('main', "Hовый адрес") ?> name="Checkout"
                  class="btn btn-danger"><?= Yii::t('main', "Hовый адрес") ?></button>

          <button type="submit" id="change_address" value=<?= Yii::t('main', "Далее") ?> name="Checkout"
                  class="btn btn-info"><?= Yii::t('main', "Далее") ?></button>

            <? } else { ?>

          <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
            <h3 class="addAdrTitle"><?= Yii::t('main', 'Добавить новый адрес') ?></h3>
            <div class="form addAdrForm">
              <!--<form class="form-horizontal" role="form">-->
              <div class="form-group">
                  <?= $form ?>
              </div>
            </div><!--</form>-->
          </div><!--End:Col-->
          <div class="col-md-8 col-lg-8 col-sm-6 col-xs-12">

            <div class="row clearfix f-space20"></div><!--Отступ для блоков -->

            <div class="alert alert-danger alert-dismissable text-center">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h3><i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Вы не
                добавили ни одного адреса доставки !</h3>
            </div><!--End:Alert-->

            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="fa fa-info-circle fa-3x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Для
                добавления адреса</h4>
              <ul><strong>
                  <li> <?= Yii::t(
                        'main',
                        'Для совершения заказа необходим хотя бы один адрес доставки.'
                      ); ?> </li>
                  <li> <?= Yii::t(
                        'main',
                        'Обратите внимание, при заполнении формы поля отмеченые'
                      ); ?> <i style="color: red"> * </i> <?= Yii::t(
                        'main',
                        'обязательны для заполнения'
                      ); ?></li>
                  <li> <?= Yii::t(
                        'main',
                        'Вы можете добавить несколько адресов и позднее выбирать необходимый из списка.'
                      ); ?></li>
                </strong>
              </ul>
            </div><!--End:Alert-->

              <? } ?>
          </div><!--End:COl-->
        </div><!--End:Row-->
      </div><!--End:Container-->
    </div><!--End:Content-->