jQuery(document).ready(function ($) {

    $('#fullwidth').click(function () {
        $('.container').css('width:100%;');
        return false;
    });


    $('#style-switch h2 a').click(function (e) {
        e.preventDefault();
        var div = $('#style-switch');
        //console.log(div.css("left"));
        if (div.css('left') === '-195px') {
            $('#style-switch').animate({left: '0px'});
        } else {
            $('#style-switch').animate({left: '-195px'});
        }
    });
    $('.colors li a').click(function (e) {
        e.preventDefault();
        $(this).parent().parent().find('a').removeClass('active');
        $(this).addClass('active');
    });
});
