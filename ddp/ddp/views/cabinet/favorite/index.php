<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="index.php">
 * </description>
 **********************************************************************************************************************/
?>
<?
$this->breadcrumbs = [
  'Favorites',
];

Yii::app()->clientScript->registerScript(
  'search',
  "
 $('.search-button').click(function(){
     $('.search-form').slideToggle('fast');
     return false;
 });
 $('.search-form form').submit(function(){
     $.fn.yiiGridView.update('favorite-grid', {
         data: $(this).serialize()
     });
     return false;
 });
 "
);

?>

<h1>Favorites</h1>
<hr/>

<?
$this->beginWidget(
  'zii.widgets.CPortlet',
  [
    'htmlOptions' => [
      'class' => '',
    ],
  ]
);
$this->widget(
  'bootstrap.widgets.TbMenu',
  [
    'type'  => 'pills',
    'items' => [
      [
        'label'       => Yii::t('admin', 'Создать'),
        'icon'        => 'icon-plus',
        'url'         => 'javascript:void(0);',
        'linkOptions' => ['onclick' => 'renderCreateForm()'],
      ],
        //array('label'=>Yii::t('admin','Список'), 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
      [
        'label'       => Yii::t('admin', 'Поиск'),
        'icon'        => 'icon-search',
        'url'         => '#',
        'linkOptions' => ['class' => 'search-button'],
      ],
      [
        'label'       => Yii::t('admin', 'PDF'),
        'icon'        => 'icon-download',
        'url'         => Yii::app()->controller->createUrl('GeneratePdf'),
        'linkOptions' => ['target' => '_blank'],
        'visible'     => true,
      ],
      [
        'label'       => Yii::t('admin', 'Excel'),
        'icon'        => 'icon-download',
        'url'         => Yii::app()->controller->createUrl('GenerateExcel'),
        'linkOptions' => ['target' => '_blank'],
        'visible'     => true,
      ],
    ],
  ]
);
$this->endWidget();
?>

<div class="search-form" style="display:none">
    <?php $this->renderPartial(
      '_search',
      [
        'model' => $model,
      ]
    ); ?>
</div><!-- search-form -->

<? $this->widget(
  'bootstrap.widgets.TbGridView',
  [
    'id'           => 'favorite-grid',
    'dataProvider' => $model->search(),
    'type'         => 'striped bordered condensed',
    'template'     => '{summary}{pager}{items}{pager}',
    'columns'      => [
      'id',
      'uid',
      'num_iid',
      'date',
      'cid',
      'express_fee',
        /*
        'price',
        'promotion_price',
        'pic_url',
        'seller_rate',
        */
      [

        'type'        => 'raw',
        'value'       => '"
		      <a href=\'javascript:void(0);\' onclick=\'renderView(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'icon-eye-open\'></i></a>
		      <a href=\'javascript:void(0);\' onclick=\'renderUpdateForm(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'icon-pencil\'></i></a>
		      <a href=\'javascript:void(0);\' onclick=\'delete_record(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'icon-trash\'></i></a>
		     "',
        'htmlOptions' => ['style' => 'width:150px;'],
      ],

    ],
  ]
);

$this->renderPartial("_ajax_update");
$this->renderPartial("_ajax_create_form", ["model" => $model]);
$this->renderPartial("_ajax_view");

?>

<script type="text/javascript">
    function delete_record(id) {

        if (!confirm("<?=Yii::t('main', 'Вы уверены, что хотите удалить эту запись?')?>"))
            return;

        //  $('#ajaxtest-view-modal').modal('hide');

        var data = 'id=' + id;


        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("admin/favorite/delete"); ?>',
            data: data,
            success: function (data) {
                if (data == 'true') {
                    $('#favorite-view-modal').modal('hide');
                    $.fn.yiiGridView.update('favorite-grid', {});

                } else
                    alert('deletion failed');
            },
            error: function (data) { // if error occured
                alert(JSON.stringify(data));
                alert('Error occured, please try again');
                //  alert(data);
            },

            dataType: 'html'
        });

    }
</script>

<style type="text/css" media="print">
  body {
    visibility: hidden;
  }

  .printableArea {
    visibility: visible;
  }
</style>
<script type="text/javascript">
    function printDiv() {

        window.print();

    }
</script>
 

