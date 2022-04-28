<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="dropshop.global.js.php">
 * </description>
 * Набор jawaScript, использующегося во всех view
 **********************************************************************************************************************/
?>
<?
// jquery publication - no more needed in Yii 1.17
/* $cs = Yii::app()->clientScript;
$cs->scriptMap['jquery.js'] = $this->frontThemePath .'/js/jquery-1.11.3.js';
$cs->scriptMap['jquery.min.js'] = $this->frontThemePath .'/js/jquery-1.11.3.min.js';
*/
?>
<!-- default styles -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="<?= $this->frontThemePath ?>/js/html5shiv.min.js"></script>
<script src="<?= $this->frontThemePath ?>/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.ui.core.js' :
          'minified/jquery.ui.core.min.js' ?>"></script>
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.ui.widget.js' :
          'minified/jquery.ui.widget.min.js' ?>"></script>

<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.ui.mouse.js' :
          'minified/jquery.ui.mouse.min.js' ?>"></script>
<? /*
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.ui.button.js' : 'minified/jquery.ui.button.min.js' ?>"></script>
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.ui.draggable.js' : 'minified/jquery.ui.draggable.min.js' ?>"></script>
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.ui.position.js' : 'minified/jquery.ui.position.min.js' ?>"></script>
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.ui.resizable.js' : 'minified/jquery.ui.resizable.min.js' ?>"></script>
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.ui.dialog.js' : 'minified/jquery.ui.dialog.min.js' ?>"></script>
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.ui.accordion.js' : 'minified/jquery.ui.accordion.min.js' ?>"></script>
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/<?= YII_DEBUG ? 'jquery.dcjqaccordion.2.9.js' : 'minified/jquery.dcjqaccordion.2.9.min.js' ?>"></script>

*/ ?>
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'jquery.cookie.js' : 'jquery.cookie.min.js' ?>"></script>
<? /*
<script type="text/javascript"
        src="<?= $this->frontThemePath ?>/js/ui/minified/jquery.hoverIntent.minified.js"></script>
*/ ?>
<!-- Bootstrap core JavaScript -->
<!-- Bootstrap4 files-->
<script src="<?= $this->frontThemePath ?>/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<? /* <script src="<?= $this->frontThemePath ?>/js/bootstrap.min.js"></script> */ ?>
<? /* <script src="<?= $this->frontThemePath ?>/js/bootstrap-select.js"></script> */ ?>

<!-- Custom Scripts -->
<script src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'scripts.js' : 'scripts.min.js' ?>"></script>
<script src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'jquery.easing.js' : 'jquery.easing.min.js' ?>"></script>
<!-- menu3d -->
<script src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'menu3d.js' : 'menu3d.min.js' ?>"></script>
<!-- iView Slider -->
<script src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'raphael.js' : 'raphael.min.js' ?>"></script>
<script src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'iview.js' : 'iview.min.js' ?>"></script>

<? /*    <script src="<?= $this->frontThemePath ?>/js/retina-1.1.0.min.js" type="text/javascript"></script> */ ?>

<? /* <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script> */ ?>

<!--[if IE 8]>
    <script type="text/javascript" src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'selectivizr.js' :
  'selectivizr.min.js' ?>"></script>
    <![endif]-->

<script>
    /*
    jQuery(document).ready(function ($) {
        $('.blue-red').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/blue-red.css");
            return false;
        });
        $('.midnight-blue').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/midnight-blue.css");
            return false;
        });
        $('.mono-red').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/mono-red.css");
            return false;
        });
        $('.pinegreen-purple').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/pinegreen-purple.css");
            return false;
        });

        $('.darkmagenta-rosybrown').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/darkmagenta-rosybrown.css");
            return false;
        });

        $('.darkorchid-seagreen').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/darkorchid-seagreen.css");
            return false;
        });

        $('.steel-blue').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/steel-blue.css");
            return false;
        });

        $('.cadetblue-violetred').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/cadetblue-violetred.css");
            return false;
        });

        $('.mediumpurple-seagreen').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/mediumpurple-seagreen.css");
            return false;
        });

        $('.steelblue-leafgreen').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/steelblue-leafgreen.css");
            return false;
        });

        $('.orange-steelblue').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/orange-steelblue.css");
            return false;
        });
        $('.gray').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/gray.css");
            return false;
        });
        $('#reset').click(function () {
            $('#colorstyle').attr('href', "<?= $this->frontThemePath ?>/css/skin/blue-red.css");
            return false;
        });
    }); */
</script>

<!-- plugin: owl carousel  -->
<script src="<?= $this->frontThemePath ?>/plugins/owlcarousel/owl.carousel.min.js"></script>

<!-- custom javascript -->
<script src="<?= $this->frontThemePath ?>/js/script.js" type="text/javascript"></script>
<!-- Bootstrap STAR RAITING -->
<!-- important mandatory libraries -->
<script src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'star-rating.js' : 'star-rating.min.js' ?>"></script>

<!-- optionally if you need to use a theme, then include the theme JS file as mentioned below -->
<!--<script src="<? //= $this->frontThemePath ?>/css/themes/krajee-svg/theme.js"></script>-->

<!-- optionally if you need translation for your language then include locale file as mentioned below -->
<? if (Utils::appLang() != 'en') {
//TODO: Здесь потом проверить, а есть ли файлик в наличии?
    ?>
  <script defer src="<?= $this->frontThemePath ?>/js/locales/<?= Utils::appLang() ?>.js"></script>
<? } ?>
<!-- Bootstrap Datepicker -->
<script src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'bootstrap-datepicker.js' :
  'bootstrap-datepicker.min.js' ?>"></script>

<? //AjaxQ ajax manager?>
<script src="<?= $this->frontThemePath ?>/js/<?= YII_DEBUG ? 'ajaxq.js' : 'ajaxq.min.js' ?>"></script>

