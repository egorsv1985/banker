<? if ($this->anchor) { ?>
  <script>
      $(document).ready(function () {
          $('#<?=$this->anchor?>').collapse('show');
          location.hash = '#<?=$this->anchor?>';
      });
  </script>
<? } ?>
<script>
    function itemsChanged() {
        $('#total-block-refresh').css('display', 'block');
        $('#total-block').css('display', 'none');
    }

    function extSubmit(anchor) {
        var input = $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'action[anchor]').val(anchor);
        $('#form-easy-checkout').append($(input));
        $('#form-easy-checkout').submit();
    }

    function paySystemChanged() {
        $('#payment_button').removeAttr('disabled');

    }

    $(function () {
        $('div.product-chooser').find('div.product-chooser-item').on('click', function () {
            $(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
            $(this).addClass('selected');
            $(this).find('input[type="radio"]').prop('checked', true);
        });
    });

    function writeToHeader(id, text) {
        $('#' + id + ' a').text(text);
    }
</script>