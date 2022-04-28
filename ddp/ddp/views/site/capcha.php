<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="capcha.php">
 * </description>
 * Рендеринг капчи
 **********************************************************************************************************************/
?>
<? Yii::app()->clientScript->registerMetaTag('noindex', 'robots'); ?>
<div class="page-title">

    <?= Yii::t('main', 'Требуется подтверждение') ?>

</div>

<div class="capcha">
  <script type="text/javascript">
      function refreshCapcha() {
          $('#J_CheckCode').attr('src', '<?=$imageUrl?>' + '&unique=' + new Date().valueOf());
      }
  </script>

  <form action="/site/capcha" method="POST">
    <p>
      <img width="85" height="35" id="J_CheckCode" src="<?= $imageUrl ?>" align="absmiddle">
      <a href="javascript:void(0);" onclick="refreshCapcha()" class="newCheckCode"><?= Yii::t(
            'main',
            'Обновить'
          ) ?></a><br>
      <input class="checkcode" name="code" type="text" id="check"/>
      <input class="submit" type="submit" value="<?= Yii::t('main', 'Отправить') ?>">
      <input name="session" value="<?= $inputParams['session'] ?>" type="hidden">
      <input name="rand" value="<?= $inputParams['rand'] ?>" type="hidden">
      <input name="ip" value="<?= $inputParams['ip'] ?>" type="hidden">
      <input name="how" value="<?= $inputParams['how'] ?>" type="hidden">
      <input name="app" value="<?= $inputParams['app'] ?>" type="hidden">
      <input name="v" value="<?= $inputParams['v'] ?>" type="hidden">
      <input name="w" value="<?= $inputParams['w'] ?>" type="hidden">
      <input name="back" value="<?= $inputParams['back'] ?>" type="hidden">
    </p>
  </form>
</div>
