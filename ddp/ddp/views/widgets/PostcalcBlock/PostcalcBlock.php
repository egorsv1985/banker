<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="PostcalcBlock.php">
 * </description>
 * Виджет отображает postcalc ;-)
 **********************************************************************************************************************/
?>
<iframe name="postcalc-light" id="postcalc-light" src="/tools/postcalc?selectedCountry=<?= $selected_country; ?>"
        width="100%" height="215px" scrolling="no"
        frameborder="0">

    <?= Yii::t('main', 'Ваш браузер не поддерживает фрэймы...') ?></iframe>

