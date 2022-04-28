<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 * Представление для отображения статических страниц (cms)
 * Нaпример, по ссылке http://<domain.ru>/ru/article/oplata
 * var $article = stdClass#1
 * (
 * [title] => 'Способы оплаты'
 * [description] => 'Способы оплаты'
 * [keywords] => 'Способы оплаты'
 * [content] => HTML-контент страницы
 * )
 **********************************************************************************************************************/
?>
<div class="row clearfix f-space10"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2><?= (isset($article->title) ? $article->title : '') ?></h2>
      </div>
    </div>
  </div>
</div>

<div class="row clearfix f-space10"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
        <?= isset($article->content) ? $article->content : '' ?>
    </div>
  </div>
</div>
<div class="row clearfix f-space30"></div>
