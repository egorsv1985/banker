<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="_ajax_view.php">
 * </description>
 **********************************************************************************************************************/
?>
<div id='favorite-view-modal' class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

  <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

    <div id="favorite-view-modal-container">
    </div>

  </div>

</div><!--end modal-->
<script>
    function renderView(id) {

        var data = 'id=' + id;

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("admin/favorite/view"); ?>',
            data: data,
            success: function (data) {
                $('#favorite-view-modal-container').html(data);
                $('#favorite-view-modal').modal('show');
            },
            error: function (data) { // if error occured
                alert(JSON.stringify(data));
                alert('Error occured, please try again');
            },

            dataType: 'html'
        });

    }
</script>