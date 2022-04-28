<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="sliderBlock.php">
 * </description>
 * Виджет отображает слайдер баннеров на главной
 * $banners - массив моделей banners
 **********************************************************************************************************************/
?>
<div id="iview">
    <? foreach ($banners as $banner) { ?>
        <? if ($banner->html_content) { ?>
            <?= $banner->html_content ?>
        <? } else { ?>
        <div data-iview:image="<?= $this->frontThemePath . $banner['img_src'] ?>">
        </div>
        <? } ?>
    <? } ?>
</div>

<script>
    (function ($) {
        'use strict';
        try {
            $('#iview').iView({
                fx: 'random', // Specify sets like: 'left-curtain,fade,zigzag-top,strip-left-fade'
                easing: 'easeOutQuad', // for the complete list http://jqueryui.com/demos/effect/easing.html
                strips: 20, // Number of strips for strip animations
                blockCols: 10, // Number of block columns for block animations
                blockRows: 5, // Number of block rows for block animations
                captionSpeed: 500, // Caption transition speed
                captionEasing: 'easeInOutSine', // Caption transition easing effect
                captionOpacity: 1, // Caption opacity
                animationSpeed: 500, // Slide transition speed
                pauseTime: 10000, // How long each slide will show
                startSlide: 0, // Set starting Slide (0 index)
                directionNav: true, // Next & Previous navigation
                directionNavHoverOpacity: 0.6, // Fade on hover
                controlNav: true, // 1,2,3,4... navigation
                controlNavNextPrev: true, // previous,next navigation
                controlNavHoverOpacity: 0.6, // Navigation fade on hover
                controlNavThumbs: false, // Show thumbs navigation
                controlNavTooltip: true, // Show tooltip image previewer
                autoAdvance: true, // Force auto transitions
                keyboardNav: true, // Use left & right arrows
                touchNav: true, // Use Touch swipe to change slides
                pauseOnHover: true, // Stop slider while hovering
                nextLabel: 'Next', // To set the string of the next button (Multilanguage use)
                previousLabel: 'Previous', // To set the string of the previous button (Multilanguage use)
                playLabel: 'Play', // To set the string of the play button (Multilanguage use)
                pauseLabel: 'Pause', // To set the string of the pause button (Multilanguage use)
                closeLabel: 'Close', // To set the string of the close button (Multilanguage use)
                randomStart: false, // Start on a random slide
                timer: '360Bar', // Timer style: "Pie", "360Bar" or "Bar"
                timerBg: '#2da5da', // Timer background
                timerColor: '#fff', // Timer color
                timerOpacity: 0.9, // Timer opacity
                timerDiameter: 20, // Timer diameter
                timerPadding: 1, // Timer padding
                timerStroke: 2, // Timer stroke width
                timerBarStroke: 1, // Timer Bar stroke width
                timerBarStrokeColor: '#fff', // Timer Bar stroke color
                timerBarStrokeStyle: 'solid', // Timer Bar stroke style
                timerX: 10, // Timer X position threshold
                timerY: 10, // Timer Y position threshold
                tooltipX: 5, // Tooltip X position threshold
                tooltipY: -5, // Tooltip Y position threshold
            });
        } catch (e) {
            console.log('Slider error!');
        }
        setTimeout(function () {
            try {
                $('#iview').trigger('iView:pause'); //Stop the Slider
                console.log('Slider paused conventionaly');
            } catch (err) {
                console.log('Problems with slider pause');
            }
        }, 120000);
    })(jQuery);
</script>