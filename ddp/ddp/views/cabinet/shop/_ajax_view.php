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
<div id='shop-view-modal' class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

  <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

    <div id="shop-view-modal-container">
    </div>

  </div>

</div><!--end modal-->
<script>
    function renderView(id) {

        var data = 'id=' + id;

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("admin/shop/view"); ?>',
            data: data,
            success: function (data) {
                $('#shop-view-modal-container').html(data);
                $('#shop-view-modal').modal('show');
            },
            error: function (data) { // if error occured
                alert(JSON.stringify(data));
                alert('Error occured, please try again');
            },

            dataType: 'html'
        });

    }
</script>