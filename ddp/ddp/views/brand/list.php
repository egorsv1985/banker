<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="list.php">
 * </description>
 * Рендеринг страницы списка брэндов
 * http://<domain.ru>/ru/article/oplata
 * var $brands = array - массив описаний брэндов
 **********************************************************************************************************************/
?>
<div class="row clearfix f-space10"></div>
<div class="container"> <!--Bigin class Container-->
  <div class="row">
    <div class="col-md-12">
      <div class="page-title"><h3><?= $this->pageTitle ?></h3></div>
    </div>
  </div><!--End ROW-->
  <div class="row clearfix f-space10"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="thumbnail">
        <h4><? foreach ($brands as $alpha => $models) { ?>
            <a href="#<?= $alpha ?>" style="display:inline-block;" class="color1">&nbsp;<?= $alpha ?>
              &nbsp;</a>
            <? } ?>
        </h4>
      </div>
    </div><!--End:Col-->
  </div><!--End ROW-->
  <div class="row clearfix f-space10"></div>
    <? $i = 0; ?>
    <? foreach ($brands

    as $alpha => $models){ ?><!--Foreach-->
  <div class="row">
    <div class="col-md-12">
        <? if ($i % 2 == 0) {
            $class = ' first';
        } else {
            $class = '';
        }
        $i++; ?>
      <div class="thumbnail">
        <div class="link-list<?= $class ?> ">
          <h4><a name="<?= $alpha ?>" class="color1" style="padding: 5px;">&nbsp;<?= $alpha ?>&nbsp;</a></h4>
          <div class="row">
              <?php foreach ($models as $brand) { // Foreach
                  if (!$brand->img_src) {
                      continue;
                  }
                  ?>

                <div class="col-md-1">
                  <a href="<?= $this->createUrl('/brand/index', ['name' => $brand->url]) ?>"
                     data-toggle="tooltip" data-placement="top"
                     title="<?= CHtml::encode($brand->name); ?>">
                    <!--BRAND NAME (data toggle)--><br/>
                    <img class="img-rounded" height="60px" src="/images/brands/<?= $brand->img_src ?>"
                         alt="<?= CHtml::encode($brand->name); ?>"/>
                  </a><br/>
                </div>
              <? } ///////////////////////////////// End Foreach ?>
          </div>
        </div>
      </div>

    </div><!--End:Col-->

  </div><!--End ROW-->
    <? } ?><!--End Foreach-->
</div> <!--End Class Container-->    