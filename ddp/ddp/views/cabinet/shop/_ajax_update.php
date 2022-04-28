<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="_ajax_update.php">
 * </description>
 **********************************************************************************************************************/
?>
<div id="shop-update-modal-container">

</div>

<script type="text/javascript">
    function update() {

        var data = $('#shop-update-form').serialize();

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("admin/shop/update"); ?>',
            data: data,
            success: function (data) {
                if (data !== 'false') {
                    $('#shop-update-modal').modal('hide');
                    $('#shop-update-modal').data('modal', null);
                    $.fn.yiiGridView.update('shop-grid', {});
                }

            },
            error: function (data) { // if error occured
                alert(JSON.stringify(data));

            },

            dataType: 'html'
        });

    }

    function renderUpdateForm(id) {

        $('#shop-view-modal').modal('hide');
        var data = 'id=' + id;

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("admin/shop/update"); ?>',
            data: data,
            success: function (data) {
                // alert("succes:"+data);
                $('#shop-update-modal-container').html(data);
                $('#shop-update-modal').modal('show');
            },
            error: function (data) { // if error occured
                alert(JSON.stringify(data));
                alert('Error occured, please try again');
            },

            dataType: 'html'
        });

    }
</script>
