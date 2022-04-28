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
<div class="row clearfix f-space10"></div>
<div class="container"> <!--Обложка бутстрапа-->
  <div class="row"> <!--Обложка бутстрапа-->

    <div class="page-title"><h3><?= $this->pageTitle ?></h3></div>

  </div>
  <div class="row clearfix f-space10"></div> <!--Обложка бутстрапа-->

  <div class="row"> <!--Обложка бутстрапа-->
    <div class="col-md-3 col-md-offset-3"></div>
    <div class="col-md-6  col-md-offset-3"> <!--Обложка бутстрапа-->

        <? echo $form->render(); ?>
      <a href="<?= $this->createUrl('/user/register') ?>"><?= Yii::t('main', 'Зарегистрироваться') ?></a>
      <br/>
      <a href="<?= $this->createUrl('/user/password') ?>"><?= Yii::t('main', 'Забыли пароль?') ?></a>

    </div> <!--Конец обложки бутстрапа-->

  </div> <!--Конец обложки бутстрапа-->
</div> <!--Конец обложки бутстрапа-->
<div class="row clearfix f-space10"></div>