<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="password.php">
 * </description>
 **********************************************************************************************************************/
?>
<div class="row clearfix f-space10"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2><?= $this->pageTitle ?></h2>
      </div>
    </div><!--End:Col -->
  </div><!--End:Row -->
  <div class="row clearfix f-space10"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="form">
        <p><?= Yii::t('main', 'Для восстановления пароля введите ваш EMail') ?></p>
        <form method="POST">
          <input name="UserForm[email]" type="text" class="input3"/>
          <input name="UserForm[doGo]" type="submit" class="btn btn-success" value="<?= Yii::t('main', 'Далее') ?>"/>
        </form>
      </div>
    </div><!--End:Col -->
  </div><!--End:Row -->
</div><!--End:Container -->
<div class="row clearfix f-space10"></div>