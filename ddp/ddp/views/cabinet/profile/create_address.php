<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="create_address.php">
 * </description>
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="row clearfix f-space10"></div>
  <div class="row">
      <? // Блок меню кабинета ?>
    <div class="col-md-3 col-sm-3 col-xs-3 box-block page-sidebar">
      <div class="box-heading"><span><?= Yii::t('main', 'Меню') ?></span></div>
        <? // Виджет меню кабинета
        $this->widget('application.components.widgets.cabinetMenuBlock'); ?>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
      <div class="alert alert-danger">
          <?= Yii::t('main', 'Символом * отмечены поля, обязательные для заполнения.') ?>
        <br/>
          <?= Yii::t(
            'main',
            'Обратите внимание, что текущие изменения не повлияют на адрес в уже сформированном заказе! Чтобы изменить адрес  в сформированном заказе, обратитесь в Службу поддержки'
          ) ?>
      </div>

      <div class="form">
        <form method="post"><? /* action="<?= Yii::app()->createUrl('/cabinet/profile/createaddress') ?>" */ ?>
          <div class="row">
            <div class="col-md-6">
              <label class="required" for="CabinetForm[fullname]"><?= Yii::t(
                    'main',
                    'Фамилия Имя Отчество'
                  ); ?><span
                    class="required">*</span></label>
              <input class="input3 pull-right"
                     id="CabinetForm[fullname]" type="text"
                     name="CabinetForm[fullname]"
                     maxlength="128" value="<?= $model->fullname ?>"/>
                <? if (isset($model->errors['fullname'])) {
                    foreach ($model->errors['fullname'] as $error) { ?>
                      <div><?= $error ?></div>
                    <? }
                } ?>
            </div>
          </div>
          <div class="row clearfix f-space10"></div>
          <div class="row">
            <div class="col-md-6">
              <label class="required" for="CabinetForm[country]"><?= Yii::t(
                    'main',
                    'Страна'
                  ); ?><span
                    class="required">*</span></label>
              <select class="input3 pull-right"
                      id="CabinetForm[country]"
                      name="CabinetForm[country]">
                <option value=""><?= Yii::t('main', 'Выберите страну') ?></option>

                  <? $countries = Deliveries::getCountries(true);
                  if (is_array($countries)) {
                      foreach ($countries as $alpha3 => $country) { ?>
                        <option value="<?= $alpha3 ?>"<?= ($model->country == $alpha3 ? ' selected' :
                          '') ?>><?= $country ?></option>
                      <? } ?>
                  <? } ?>
              </select></div>
              <? if (isset($model->errors['country'])) {
                  foreach ($model->errors['country'] as $error) { ?>
                    <div><?= $error ?></div>
                  <? }
              } ?>
          </div>
          <div class="row clearfix f-space10"></div>
          <div class="row">
            <div class="col-md-6">
              <label class="required" for="CabinetForm[index]"><?= Yii::t(
                    'main',
                    'Почтовый индекс'
                  ); ?><span
                    class="required">*</span></label>
              <input class="input3 pull-right"
                     id="CabinetForm[index]" type="text"
                     name="CabinetForm[index]"
                     maxlength="128" value="<?= $model->index ?>"/>
                <? if (isset($model->errors['index'])) {
                    foreach ($model->errors['index'] as $error) { ?>
                      <div><?= $error ?></div>
                    <? }
                } ?>
            </div>
            <div class="col-md-6">
              <label class="required" for="CabinetForm[city]"><?= Yii::t(
                    'main',
                    'Город'
                  ); ?><span
                    class="required">*</span></label>
              <input class="input3 pull-right"
                     id="CabinetForm[city]" type="text"
                     name="CabinetForm[city]"
                     maxlength="128" value="<?= $model->city ?>"/>
                <? if (isset($model->errors['city'])) {
                    foreach ($model->errors['city'] as $error) { ?>
                      <div><?= $error ?></div>
                    <? }
                } ?>
            </div>
          </div>
          <div class="row clearfix f-space10"></div>
          <div class="row">
            <div class="col-md-6">
              <label class="required"
                     for="CabinetForm[address]"><?= Yii::t(
                    'main',
                    'Адрес'
                  ); ?><span
                    class="required">*</span></label>
              <textarea class="input3 pull-right"
                        id="CabinetForm[address]"
                        name="CabinetForm[address]"
                        rows="1"><?= $model->address ?></textarea>
                <? if (isset($model->errors['address'])) {
                    foreach ($model->errors['address'] as $error) { ?>
                      <div><?= $error ?></div>
                    <? }
                } ?>
            </div>
            <div class="col-md-6">
              <label class="required"
                     for="CabinetForm[region]"><?= Yii::t(
                    'main',
                    'Регион'
                  ); ?><span
                    class="required">*</span></label>
              <input class="input3 pull-right"
                     id="CabinetForm[region]" type="text"
                     name="CabinetForm[region]"
                     maxlength="128" value="<?= $model->region ?>"/>
                <? if (isset($model->errors['region'])) {
                    foreach ($model->errors['region'] as $error) { ?>
                      <div><?= $error ?></div>
                    <? }
                } ?>
            </div>
          </div>
          <div class="row clearfix f-space10"></div>
          <div class="row">
            <div class="col-md-6">
              <label for="CabinetForm[phone]"><?= Yii::t(
                    'main',
                    'Телефон'
                  ); ?></label>
                <? //TODO: потенциально проблеммный input?>
              <input id="CabinetForm[phone]" type="text" name="CabinetForm[phone]"
                     class="input3 pull-right"
                     value="<?= ($model->phone ? $model->phone : Yii::t('main', 'Не указан')) ?>"/>
                <? if (isset($model->errors['phone'])) {
                    foreach ($model->errors['phone'] as $error) { ?>
                      <div><?= $error ?></div>
                    <? }
                } ?>

            </div>
            <div class="col-md-6">
              <div class="pull-right">
                  <? if (Yii::app()->user->inRole(['superAdmin', 'topManager'])) { ?>
                    <label for="CabinetForm[is_delivery_point]"><?= Yii::t(
                          'main',
                          'Адрес пункта выдачи посылок (офис)'
                        ); ?></label>
                    <input id="CabinetFormHidden[is_delivery_point]" type="hidden"
                           value="0"
                           name="CabinetForm[is_delivery_point]"/>
                    <input class="input3"
                           id="CabinetForm[is_delivery_point]" type="checkbox"
                           value="1" <?= $model->is_delivery_point ? 'checked' : '' ?>
                           name="CabinetForm[is_delivery_point]" style="position: relative; top:19px;"/>
                      <? if (isset($model->errors['is_delivery_point'])) {
                          foreach ($model->errors['is_delivery_point'] as $error) { ?>
                            <div><?= $error ?></div>
                          <? }
                      } ?>
                  <? } ?>
              </div>
            </div>
          </div>
          <div class="row clearfix f-space10"></div>
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <div class="row buttons">
                <input type="button"
                       value="<?= Yii::t('main', 'Отмена') ?>"
                       onclick="window.history.back();"
                       class="btn btn-danger red-btn bigger pull-right"/>
                <input type="submit"
                       style="right: 10px;position: relative;"
                       value="<?= Yii::t('main', 'Сохранить') ?>"
                       class="btn btn-danger red-btn bigger pull-right"
                       name="action[newAddress]"/>
              </div>
              <div class="row clearfix f-space20"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row clearfix f-space20"></div>
  </div>
</div>