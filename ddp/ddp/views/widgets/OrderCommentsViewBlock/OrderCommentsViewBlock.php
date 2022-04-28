<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="OrderCommentsViewBlock.php">
 * </description>
 * Собственно, виджет для рендеринга одного комментария
 * var $message = 'test' - текст сообщения
 * var $blockId = 'order-message-view-75'
 * var $isItem = false - выводим комментарий для заказа или для лота? Там разница в логике отображения.
 * var $parentId ='75'
 * var $pageSize =5
 * var $imageFormat ='_200x200.jpg'
 * var $newAttaches = OrdersCommentsAttaches#1
 * (
 * [uploadedFile] => null
 * [CActiveRecord:_new] => true
 * [CActiveRecord:_attributes] => array
 * (
 * 'comment_id' => '75'
 * )
 **********************************************************************************************************************/
?>
<div>
    <?= $message ?>
</div>
<div>
    <? if (!$isItem) { ?>
        <?= OrdersCommentsAttaches::getAttachesPreview($parentId) ?>
        <?
    } else {
        ?>
        <?= OrdersItemsCommentsAttaches::getAttachesPreview($parentId) ?>
    <? } ?>
</div>
<div class="clear"></div>
<div>
    <? /*
    <button class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModalFoto">
        <?= Yii::t('main', 'Добавить фото') ?>
    </button>
    <!--<div id="myModalFoto">-->
        <!-- Modal -->
        <div class="modal fade" id="ModalFoto" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><?= Yii::t('main', 'Добавить фото') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="comment-select">
                        <!--<div class="modal fade" id="myModalFoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
                            <? $form = $this->beginWidget(
                              'booster.widgets.TbActiveForm', array(
                                'id'                     => 'form-img-' . $blockId,
                                'enableAjaxValidation'   => false,
                                'enableClientValidation' => false,
                                'method'                 => 'post',
                                'action'                 => array(Yii::app()->createUrl("/message/addimage")),
                                'type'                   => 'inline',
                                'htmlOptions'            => array(
                                  'enctype' => 'multipart/form-data',
                                  'target'  => 'upload-target-' . $blockId,
                                ),
                              )
                            ); ?>
                            <!--    <fieldset> -->
                            <?= $form->errorSummary($newAttaches, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
                            <!--<div class="comment-select-btn">+</div>-->

                                <iframe hidden="hidden" id="upload-target-<?= $blockId ?>" name="upload-target-<?= $blockId ?>"
                                        src="" style="width:0; height:0; border:0 solid #ffffff;"></iframe>
                                <input type="hidden" value="<?= ($isItem) ? 1 : 0 ?>" name="isItem"/>
                                <input type="hidden" value="<?= $blockId ?>" name="blockId"/>
                                <?= $form->hiddenField($newAttaches, 'comment_id', array()); ?>
                                <?= $form->fileField($newAttaches, 'uploadedFile', array(
                                    'id'       => 'uploadedFile-' . $blockId,
                                    'class'    => 'input3',
                                    'accept'   => 'image/*',
                                    'capture'  => 'camera',
                                    'onchange' => "
                                        var imgForm = $('#form-img-" . $blockId . "');
                                        var grid = imgForm.closest('.grid-view');
                                        imgForm.submit();
                                        setTimeout( function() { // Delay for Chrome
                                        $.fn.yiiGridView.update($(grid).attr('id'));
                                        }, 100);
                                        ",
                                    'title' => Yii::t('main', 'Добавить изображение'),
                                  )
                                ); ?>
                            <? $this->endWidget(); ?>
                        </div>
                    </div><!--End:Modal-body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </div>
            </div>
        </div><!--End:Modal-content-->
    </div><!--End:Modal-->
    <!--  </fieldset> -->
*/ ?>
    <? /*
<form enctype="multipart/form-data" target="upload-target-order-item-message-view-18111" class="form-inline" id="form-img-order-item-message-view-18111" action="/message/addimage" method="post">        <!--    <fieldset> -->
    <div class="comment-select">
        <iframe id="upload-target-order-item-message-view-18111" name="upload-target-order-item-message-view-18111" src="" style="width:0; height:0; border:0 solid #ffffff;" hidden="hidden"></iframe>
        <input value="1" name="isItem" type="hidden">
        <input value="order-item-message-view-18111" name="blockId" type="hidden">

        <input name="OrdersItemsCommentsAttaches[comment_id]" id="OrdersItemsCommentsAttaches_comment_id" value="18111" type="hidden"><input id="ytuploadedFile-order-item-message-view-18111" value="" name="OrdersItemsCommentsAttaches[uploadedFile]" type="hidden"><input id="uploadedFile-order-item-message-view-18111" accept="image/*" capture="camera" onchange="
                var imgForm = $('#form-img-order-item-message-view-18111');
                var grid = imgForm.closest('.grid-view');
                imgForm.submit();
                setTimeout( function() { // Delay for Chrome
                $.fn.yiiGridView.update($(grid).attr('id'));
                }, 100);
            " title="Добавить изображение" name="OrdersItemsCommentsAttaches[uploadedFile]" type="file">
    </div>
    <div class="comment-select-btn">+</div>
</form>
*/ ?>

  <div class="comment-select">
      <? $form = $this->beginWidget(
        'booster.widgets.TbActiveForm', [
          'id'                     => 'form-img-' . $blockId,
          'enableAjaxValidation'   => false,
          'enableClientValidation' => false,
          'method'                 => 'post',
          'action'                 => [Yii::app()->createUrl("/message/addimage")],
          'type'                   => 'inline',
          'htmlOptions'            => [
            'enctype' => 'multipart/form-data',
            'target'  => 'upload-target-' . $blockId,
          ],
        ]
      ); ?>
    <!--    <fieldset> -->
      <?= $form->errorSummary($newAttaches, 'Opps!!!', null, ['class' => 'alert alert-error span12']); ?>
    <!--<div class="comment-select-btn">+</div>-->

    <iframe hidden="hidden" id="upload-target-<?= $blockId ?>" name="upload-target-<?= $blockId ?>"
            src="" style="width:0; height:0; border:0 solid #ffffff;"></iframe>
    <input type="hidden" value="<?= ($isItem) ? 1 : 0 ?>" name="isItem"/>
    <input type="hidden" value="<?= $blockId ?>" name="blockId"/>
      <?= $form->hiddenField($newAttaches, 'comment_id', []); ?>
      <?= $form->fileField($newAttaches, 'uploadedFile', [
          'id'       => 'uploadedFile-' . $blockId,
          'class'    => 'input3',
          'accept'   => 'image/*',
          'capture'  => 'camera',
          'onchange' => "
                                        var imgForm = $('#form-img-" . $blockId . "');
                                        var grid = imgForm.closest('.grid-view');
                                        imgForm.submit();
                                        setTimeout( function() { // Delay for Chrome
                                        $.fn.yiiGridView.update($(grid).attr('id'));
                                        }, 100);
                                        ",
          'title'    => Yii::t('main', 'Добавить изображение'),
        ]
      ); ?>

  </div>
  <div class="comment-select-btn">
    <button class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModalFoto">
        <?= Yii::t('main', 'Добавить фото') ?>
    </button>
  </div>
    <? $this->endWidget(); ?>
    <? /* Какой-то трабл при загрузке фрейма
    <script>
        $('#upload-target-<?=$blockId?>').load(function () {
            $.fn.yiiGridView.update('grid-<?=$blockId?>');
        }).appendTo('body');
    </script>
*/ ?>
</div>