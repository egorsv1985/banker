<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="SearchQueryBlock.php">
 * </description>
 * Виджет, реализующий поисковую строку
 * var $cats = - список категорий для фильтра
 * array
 * (
 * 0 => array
 * (
 * 'pkid' => '2'
 * 'cid' => '0'
 * 'parent' => '1'
 * 'status' => '1'
 * 'url' => 'mainmenu-odezhda'
 * 'query' => '女装男装'
 * 'level' => '2'
 * 'order_in_level' => '200'
 * 'view_text' => 'Одежда'
 * 'children' => array
 * (
 * 3 => array(...)
 * 18 => array(...)
 * 31 => array(...)
 * 41 => array(...)
 * 49 => array(...)
 * 60 => array(...)
 * 70 => array(...)
 * 81 => array(...)
 * )
 * )
 * )
 * var $query = '' - поисковый запрос
 * var $cid = '' - cid категории
 **********************************************************************************************************************/
?>
<?
Yii::app()->clientScript->registerScript(
  'lazySearch',
  "
  $('#main-search-block').off('submit').on('submit',function(event) {
  dsProgress('" . Yii::t('main', 'Дождитесь завершения поиска...') . "','" . Yii::t('main', 'Поиск') . "');
  });
",
  CClientScript::POS_END
);
?>
<?php /*
<form action="#" class="search">
  <div class="input-group w-100">
    <input type="text" class="form-control" placeholder="Search">
    <div class="input-group-append">
      <button class="btn btn-primary" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>
</form>
*/ ?>
<!--<div class="searchbar">-->
<div class="row searchbar">
    <?= CHtml::beginForm(['/search/index'], 'get', ['id' => 'main-search-block', 'class' => 'search']) ?>
  <div class="input-group w-100">
    <select class="custom-select" id="category" name="cid">
      <option value="<?= (isset($cid) && ($cid)) ? $cid : 0; ?>"><?= (isset($cid) && ($cid) && (isset($cats[$cid]))) ?
            $cats[$cid]['view_text'] : Yii::t(
              'main',
              'Все категории'
            ) ?></option>
      <option value="<?= 'seller' ?>"><?= Yii::t('main', 'Поиск по нику продавца') ?></option>
      <option value="<?= 0 ?>"><?= Yii::t(
            'main',
            'Все категории'
          ) ?></option>
        <? foreach ($cats as $cat) { ?>
          <option value="<?= $cat['pkid'] ?>"><?= $cat['view_text'] ?></option>
        <? } ?>
    </select>
    <input class="form-control searchinputer photo-search" name="query" autocomplete="off" id="query"
           style="width:50%;"
           data-toggle="tooltip"
           data-placement="left"
           title="<?= Yii::t(
             'main',
             'Введите запрос или знак @ и ник продавца или ссылку на товар или изображение. Двойной клик - для поиска по изображению с диска.'
           ); ?>"
           placeholder="<?= Yii::t('main', 'Поиск, ссылка, фото или @продавец') ?>" value="<?= $query ?>"
           type="search">
    <div class="input-group-append">
        <? /*      <button class="btn btn-primary btn-camera" type="button"
              onclick="$('input.dz-hidden-input').click(); //$(this).blur();" id="serch-by-photo"><i
            class="fa fa-camera fa-fw"></i></button> */ ?>
      <button class="btn btn-warning btn-search" type="button" onclick="submitSearchForm();"><i
            class="fa fa-search fa-fw"></i></button>
    </div>
  </div>
    <?= CHtml::endForm() ?>
</div><!--End:Row-->
<!--</div>-->
<!--End:SearchBar-->

<script>
    //=== Yandex spellchecker and corrector ====
    function submitSearchForm() {
        console.log('Yandex speller: Try to check...');
        <? if (in_array(Utils::appLang(), ['ru', 'en'])) { ?>
        var query = $('#query').val().trim().replace(/\r\n|\n\r|\n|\r/g, '\n');
        if (!query.match(/http[s]*|select|delete|[\/\\<>#@&*\.\$!]/i)) {
            var lines = query.split('\n');
            lines.forEach(function (line) {
                if (line.length) {
                    try {
                        $.ajax({
                            url: '//speller.yandex.net/services/spellservice.json/checkText?text=' + line + '&options=2583',
                            dataType: 'json',
                            success: function (data) {
                                fixQuerySyntaxErrorsCallback(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.log('Yandex speller: Can\'t access (error)');
                                $('#main-search-block').submit();
                            },
                            fail: function (jqXHR, textStatus, errorThrown) {
                                console.log('Yandex speller: Can\'t access (fail)');
                                $('#main-search-block').submit();
                            }
                        });
                        /*                        $.getScript('//123speller.yandex.net/services/spellservice.json/checkText?text=' + line + '&options=2583&callback=fixQuerySyntaxErrorsCallback')
                                                    .fail(function (jqxhr, settings, exception) {
                                                        console.log('Yandex speller: Can\'t access.');
                                                    });
                        */
                    } catch (e) {
                        console.log('Yandex speller: Can\'t access (catch)');
                        $('#main-search-block').submit();
                    }
                }
            });
        } else {
            $('#main-search-block').submit();
        }
        <? } else { ?>
        $('#main-search-block').submit();
        <? } ?>
    }

    $('#query').keypress(function (event) {
        if (event.which == 13) {
            submitSearchForm();
            return false;
        }
    });

    fixQuerySyntaxErrorsCallback = function (data) {
        try {
            var originalVal = $('#query').val().trim();
            var correctedVal = originalVal;
            data.forEach(function (elem) {
                correctedVal = correctedVal.replace(
                    elem['word'],
                    elem['s'][0] || elem['word']
                );
            });
            if (originalVal != correctedVal) {
                if (dsConfirm('<?=Yii::t(
                  'main',
                  'Возможно, в запросе допущены ошибки'
                )?>:\n\n' + correctedVal + '\n\n<?=Yii::t(
                  'main',
                  'Исправить?'
                )?>',
                    '<?=Yii::t('main', 'Проверка запроса')?>', false
                )) {
                    $('#query').val(correctedVal);
                }
            }
            $('#main-search-block').submit();
        } catch (e) {
            $('#main-search-block').submit();
        }
    };

</script>
<script defer src="<?= $this->frontThemePath . '/js/' . (YII_DEBUG ? 'dropzone.js' : 'dropzone.min.js') ?>"
        onload="
            try {
            $('#query').dropzone({
            url: '/search/searchByImage',//'https://s.taobao.com/image'
            paramName: 'imgfile',// 	The name of the file param that gets transferred. Defaults to file. NOTE: If you have the option uploadMultiple set to true, then Dropzone will append [] to the name.
            parallelUploads: 1,// 	How many file uploads to process in parallel (See the Enqueuing file uploads section for more info)
            maxFilesize: 1,// 	in MB
            uploadMultiple: false,// 	Whether Dropzone should send multiple files in one request. If this it set to true, then the fallback file input element will have the multiple attribute as well. This option will also trigger additional events (like processingmultiple). See the events section for more information.
            previewsContainer: null,//	defines where to display the file previews – if null the Dropzone element is used. Can be a plain HTMLElement or a CSS selector. The element should have the dropzone-previews class so the previews are displayed properly.
            clickable: '.photo-search',// If true, the dropzone element itself will be clickable, if false nothing will be clickable. Otherwise you can pass an HTML element, a CSS selector (for multiple elements) or an array of those.
            createImageThumbnails: false,
            maxFiles: 1,// 	if not null defines how many files this Dropzone handles. If it exceeds, the event maxfilesexceeded will be called. The dropzone element gets the class dz-max- files-reached accordingly so you can provide visual feedback.
            acceptedFiles: 'image/jpeg,image/png',
            autoProcessQueue: true, // 	When set to false you have to call myDropzone.processQueue() yourself in order to upload the dropped files. See below for more information on handling queues.
            dictInvalidFileType: '<?= Yii::t('main', 'Неправильный тип файла. Поддерживаются jpg и png.'); ?>',
            dictFileTooBig: '<?= Yii::t('main', 'Файл слишком большой. Максимальный размер: 1 мегабайт'); ?>',
            addedfile: function (file) {
            dsProgress('<?= Yii::t('main', 'Дождитесь завершения поиска...') ?>', '<?= Yii::t(
          'main',
          'Поиск по изображению'
        ) ?>');
            },
            success: function (file, data) {
            this.removeFile(file);
            var $match = data.indexOf('http');
            if ($match == 0) {
            window.setTimeout(function () {
            window.location.href = data;
            }, 1000);
            } else {
            dsAlert(data, '<?= Yii::t('main', 'Ошибка поиска по изображению (1)') ?>', true);
            }
            },
            error: function (file, errorMessage) {
            this.removeFile(file);
            var $match = errorMessage.indexOf('http');
            if ($match == 0) {
            window.setTimeout(function () {
            window.location.href = errorMessage;
            }, 1000);
            } else {
            dsAlert(errorMessage, '<?= Yii::t('main', 'Ошибка поиска по изображению (2)') ?>', true);
            }
            }
            });
            } catch (err) {
            console.log('Err in dropzone');
            }
            "
></script>

<script defer="defer" src="<?= $this->frontThemePath .
'/js/' .
(YII_DEBUG ? 'jquery.autocomplete.js' : 'jquery.autocomplete.min.js') ?>"
        onload="$('#query').dvautocomplete('/suggestions', {
autoFill: false,
delay: 600,
minChars: 3,
matchSubset: 1,
matchContains: 0,
cacheLength: 1,
selectFirst: false,
formatItem: liFormat,
maxItemsToShow: -1,
width:400,
onItemSelect: selectItem
/*
autoFill – когда Вы начинаете вводить текст, в поле ввода будет подставлено (и выделено) первое подходящее значение из списка. Если Вы продолжаете вводить текст, в поле ввода и далее будет подставляться подходящее значение, но уже с учетом введенного Вами текста. (По умолчанию: false).
inputClass – этот класс будет добавлен к элементу ввода. (По умолчанию: «ac_input»).
resultsClass – класс для UL, который будет содержать элементы результата (элементы LI). (По умолчанию: «ac_results»).
loadingClass – класс для элемента ввода, в то время, когда происходит обработка данных на сервере. (По умолчанию: «ac_loading»).
lineSeparator – символ, который разделяет строки в данных, возвращаемых сервером. (По умолчанию: «\n»).
cellSeparator – символ, который разделяет «ячейки» в строках данных, возвращаемых сервером. (По умолчанию: «|»).
minChars – минимальное число символов, которое пользователь должен напечатать перед тем, как будет активизирван запрос. (По умолчанию: 1).
delay – задержка в миллисекундах. Если в течение этого времени пользователь не нажимал клавиши, активизируется запрос. Если используется локальный запрос (к данным, находящимся непосредственно в файле), задержку можно сильно уменьшить. Например до 40ms. (По умолчанию: 400).
cacheLength – число ответов от сервера, сохраняемых в кэше. Если установлено в 1 – кэширование данных отключено. Никогда не устанавливайте меньше единицы. (По умолчанию: 1).
matchSubset – использовать ли кэш для уточнения запросов. Использование этой опции может сильно снизить нагрузку на сервер и увеличить производительность. Не забудьте при этом еще и установить для cacheLength значение побольше. Например 10. (По умолчанию: 1).
matchCase – использовать ли сравнение чувствительное к регистру символов (только если Вы используете кэширование). (По умолчанию: 0).
maxItemsToShow – ограничивает число результатов, которые будут показаны в выпадающем списке. Если набор данных содержит сотни элементов, может быть неудобно показывать весь список пользователю. Рекомендованное значение 10. (По умолчанию: -1).
extraParams – дополнительные параметры, которые могут быть переданы на сервер. Если Вы напишете {page:4}, то строка запроса к обработчику на сервере будет сформирована следующим образом: my_handler.php?q=foo&page=4 (По умолчанию: {}).
width – устанавливает ширину выпадающего списка. По умолчанию ширина выпадающего списка определена шириной элемента ввода. Однако, если ширина элемента ввода небольшая, а строки выпадающего списка содержат большое количество символов – эта опция вполне может пригодиться. (По умолчанию: 0).
selectFirst – если установить в true, то по нажатию клавиши Tab или Enter будет выбрано то значение, которое в данный момент установлено в элементе ввода. Если же имеется выбранный вручную («подсвеченный») результат из выпадающего списка, то будет выбран именно он. (По умолчанию: false).
selectOnly – если установить в true и в выпадающем списке только одно значение, оно будет выбрано по нажатию клавиши Tab или Enter, даже если этот пункт не был выбран пользователем с помощью клавиатуры или указателя мыши. Заметьте, что эта опция отменяет действие опции selectFirst. (По умолчанию: false).
formatItem – JavaScript функция, которая поможет обеспечить дополнительную разметку элементов выпадающего списка. Функция будет вызываться для каждого элемента LI. Возвращаемые от сервера данные могут быть отображены в элементах LI выпадающего списка (см. второй пример). Принимает три параметра: строка результата, позиция строки в списке результатов, общее число элементов в списке результатов. (По умолчанию: none).
onItemSelect – JavaScript функция, которая будет вызвана, когда элемент списка выбран. Принимает единственный параметр – выбранный элемент LI. Выбранный элемент будет иметь дополнительный атрибут «extra», значением которого будет являться массив всех ячеек строки, которая была получена в качестве ответа от сервера. (По умолчанию: none).
*/
});"
></script>
<script>
    //==== Suggestions processing ====
    function liFormat(row, i, num) {
        //$res.$row[$lang].'|'.$row['res_count'].'|'.$row['type'].'|'.$row['cid'].'|'.$row['query']
        var result = row[0] + '<span class="qnt">' + row[1] + '&nbsp;</span>';
        return result;
    }

    function selectItem(li) {
        var sValue = '';
        if (li == null) {
            sValue = 'Ничего не выбрано!';
        }
        if (!!li.extra) {
            sValue = JSON && JSON.parse(li.extra[1]) || $.parseJSON(li.extra[1]);
            //$('#query').val(sValue['query']);
            //$('#category').val(sValue['cid']);
            var action = $('#main-search-block').attr('action');
            action = action + '?cid=' + sValue['cid'];
            if (sValue['query'] != '') {
                action = action + '&query=' + sValue['query'];
            }
            window.location.replace(action);
        } else {
            sValue = li.selectValue;
        }
    }

    //== End suggestions ===========================
</script>