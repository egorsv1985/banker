jQuery(document).ready(function () {
    // Виджет кнопки вверх (Test-Templates)
    // Версия 1.0
    jQuery('body').append('');
    if ($('.search-sidebar-top').length > 0) {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 500) {
                jQuery('.search-sidebar-top').fadeIn();
            } else {
                jQuery('.search-sidebar-top').fadeOut();
            }
        });

        jQuery('.search-sidebar-top').click(function () {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 500);
            return false;
        });

        jQuery('.search-sidebar-top').hover(function () {
            jQuery(this).animate({
                'opacity': '1'
            }).css({'color': '#0000'});
        }, function () {
            jQuery(this).animate({
                'opacity': '0.5'
            }).css({'color': '#ffff'});
        });
    }
    $('.search-sidebar-next a').attr('href', $('.next a').attr('href'));
    $('.search-sidebar-prev a').attr('href', $('.previous a').attr('href'));
});
