<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="login.php">
 * </description>
 **********************************************************************************************************************/
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h3><?= Yii::t('main', 'ВОЙДИТЕ ИЛИ ЗАРЕГИСТРИРУЙТЕСЬ') ?></h3>
      </div>
    </div><!--End:Col-->
  </div><!--End:Row-->

  <!-- Login -->
  <div class="row">
    <div class="col-md-6 col-xs-12">

      <h3 class="color2"><?= Yii::t('main', 'Авторизация') ?></h3>

      <div class="box-content login-box">

        <form action="login" method="post">
            <?
            $loginByPhone = (boolean) DSConfig::getVal('login_use_phone_as_login');
            if (!$loginByPhone) {
                ?>
              <input type="text" value="" placeholder="<?= Yii::t('main', 'Введите e-mail') ?>" class="input4"
                     name="UserForm[email]">
            <? } else { ?>
              <input type="text" value="" placeholder="<?= Yii::t('main', 'Введите телефон или e-mail') ?>"
                     class="input4"
                     name="UserForm[email]">
            <? } ?>
          <input type="password" value="" placeholder="<?= Yii::t('main', 'Введите пароль') ?>" class="input4"
                 name="UserForm[password]">
          <label class="checkbox" for="checkbox1">
            <input type="checkbox" value="" id="checkbox1" data-toggle="checkbox"
                   class="pull-left" style="margin-left: 10px;" name="UserForm[rememberMe]">
            <span class="pull-left"><?= Yii::t('main', 'Запомнить меня') ?></span>
          </label>
          <button class="btn medium color2 pull-right" style="position: relative; top: 20px;"
                  name="UserForm[doGo]"><?= Yii::t('main', 'Войти') ?>
          </button>
          <br/><br/>
          <p class="fp-link pull-left"><a href="<?= $this->createUrl('/user/password') ?>" class="color2"><?= Yii::t(
                    'main',
                    'Забыли пароль?'
                  ) ?></a></p>
        </form>

          <? // echo $form->render();?>
          <? /*
            return array(
              'activeForm'           => array(
                'class'                => 'booster.widgets.TbActiveForm',
              ),
              'elements' => array(
                'email'      => array(
                  'type'      => 'text',
                  'maxlength' => 32,
                  'attributes'=>array('class'=>'input4'),
                ),
                'password'   => array(
                  'type'      => 'password',
                  'maxlength' => 32,
                  'attributes'=>array('class'=>'input4'),
                ),
                'rememberMe' => array(
                  'type' => 'checkbox',
                  'attributes'=>array('class'=>'chekbox'),
                )
              ),
              'buttons'  => array(
                'doGo' => array(
                  'type'  => 'submit',
                  'class' => 'btn color1 normal',
                  'label' => Yii::t('main', 'Вход'),
                ),
              ),
            );
            */ ?>

      </div>
    </div>
    <!-- end: Login -->
    <!-- Register -->

    <div class="col-md-6 col-xs-12">

      <h3 class="color2"><?= Yii::t('main', 'Вы еще не зарегистрированны?') ?></h3>

      <div class="box-content register-box">

        <div class="alert alert-warning"><?= Yii::t('main', 'Регистрация займет у Вас не больше') ?>
          <strong><?= Yii::t('main', 'пяти минут') ?></strong> <?= Yii::t('main', 'и Вам станет доступно') ?>:
        </div>
        <ul>
          <li><i class="fa fa-check fa-fw color2"></i> <?= Yii::t('main', 'Быстрое и простое оформление заказов') ?>.
          </li>
          <li><i class="fa fa-check fa-fw color2"></i> <?= Yii::t('main', 'Детальная история Ваших заказов') ?>.
          </li>
          <li><i class="fa fa-check fa-fw color2"></i> <?= Yii::t('main', 'Отслеживание состояния Ваших заказов') ?>.
          </li>
          <li><i class="fa fa-check fa-fw color2"></i> <?= Yii::t('main', 'Улучшенная корзина для повторных заказов') ?>
            .
          </li>
        </ul>
        <!--
        <form>
            <button class="btn medium color2 pull-left" style="position: relative; top: 10px;">Зарегистрироваться</button>
            <p class="fp-link pull-right"><a href="#a" class="color2">Продолжить как
                    ГОСТЬ</a></p>
        </form>

         <br/>
         <a href="<? //= $this->createUrl('/user/password') ?>"><?= Yii::t('main', 'Забыли пароль?') ?></a>
        -->
        <a class="btn btn-danger control normol color2 pull-right"
           style="padding: 15px; position: relative; bottom: 10px;"
           href="<?= $this->createUrl('/user/register') ?>"><?= Yii::t('main', 'Зарегистрироваться') ?></a>
        <!------------------------------------->
          <? /* ?>
        <? $form = $this->beginWidget('CActiveForm', array(
            'id' => 'form-easy-checkout',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'method' => 'post',
            'action' => Yii::app()->createUrl('checkout/easy', array('item' => $this->item_iid)),
            'clientOptions' => array(
              'validateOnType' => false,
              'validateOnSubmit' => false,
            ),
          )
        ); ?>
        <? */ ?>
        <!------------------------------------->
          <? /*
        <div style="display: none;">
            <input type="radio" name="easyCheckout[reorder]" value="0" onclick="extSubmit('anchor-reorder');"
                   <? if (empty($this->post) || !isset($this->post['easyCheckout']['reorder']) ||
                   $this->post['easyCheckout']['reorder'] == 0) { ?>checked<? } ?> />
        </div>
        */ ?>
        <!------------------------------------->
      </div><!--End:Box-content-->
    </div><!--End:Col-->
  </div><!--End:Row-->
</div><!--End:Container-->


