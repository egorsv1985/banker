<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 * Рендеринг страницы Under construction
 **********************************************************************************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="language" content="en"/>
  <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
  <style type="text/css">
    p {
      font-size: 1.5em;
      font-weight: 700;
      text-align: center;
      font-family: "Arial", Serif;
    }

    .red {
      color: red;
      font-size: 2em;
    }
  </style>
</head>

<body>

<div id="page">
  <img style="position: fixed;top: 60%;left: 21%;"
       src="<?= Yii::app()->request->baseUrl ?>/themes/default/images/under.jpg">
</div>
<div style="width:70%; margin:5% auto;">
  <p class="red">Извините, сервер сейчас перегружен, повторите запрос позже
  </p>
  <p class="red">Sorry, the server is currently overloaded, try again later
  </p>

  <p></p>
</div>
</body>
</html>