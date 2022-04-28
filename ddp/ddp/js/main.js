scripts = document.getElementsByTagName('script');
thisFilePath = scripts[scripts.length - 1].src.split('?')[0];      // remove any ?query
var themePath = thisFilePath.split('/').slice(0, -2).join('/');  // remove last filename part of path
delete scripts;
delete thisFilePath;

function dsAlert(text, title, uidlg) {
    if ((text != undefined) && (text.length > 0)) {
        if (!uidlg) {
            alert(text);
        } else {
            bootbox.dialog({
                message: text,
                title: title,
                buttons: {
                    success: {
                        label: 'OK',
                        className: 'btn-default',
                        callback: function () {
                        }
                    },
                }
            });
        }
    }
}

function dsConfirm(text, title, uidlg) {
    if ((text != undefined) && (text.length > 0)) {
        if (!uidlg) {
            return confirm(text);
        } else {
            return confirm(text);
            /*            var dfd = $.Deferred();
             bootbox.confirm(
             {
             message: text,
             title: title
             }, function (result) {
             dfd.resolve(result)
             return dfd.promise();
             });
             */
        }
    }
}

function dsProgress(text, title) {
    if ((text != undefined) && (text.length > 0)) {
        bootbox.dialog({
            message: '<div class=\'img-loader\'>' + text + '<img src=\'' + themePath + '/images/Hourglass.png\' style=\'width: 160px; height: 160px;\'></div>',
            title: title,
            closeButton: false,
            //buttons: {
            //}
        });
    }
}

/*
 function dsProgress(text, title) {
 if ((text != undefined) && (text.length > 0)) {
 bootbox.alert('<img src="/images/load-icon.gif">');
 }
 }
 */
function clearCart(message) {
    if (!message) {
        message = 'Вы действительно хотите полностью очистить корзину?';
    }
    if (confirm(message)) {
        var url = '/cart/deleteAll';
        //$.post(url,null,function(data){alert(data);},"text");
        var cartTable = document.getElementById('cart-table');
        if ((cartTable !== undefined) && (cartTable != null)) {
            cartTable.style.visibility = 'hidden';
        }
        var cartEmpty = document.getElementById('cart-empty');
        if (cartEmpty !== undefined && (cartEmpty != null)) {
            cartEmpty.style.visibility = 'visible';
        }
        $.post(url)
            .done(function (data) {
                location.reload();
            });
    }
}

function clearParcelsCart(message) {
    if (!message) {
        message = 'Вы действительно хотите полностью очистить корзину посылки?';
    }
    if (confirm(message)) {
        var url = '/cabinet/parcelsCart/deleteAll';
        //$.post(url,null,function(data){alert(data);},"text");
        var cartTable = document.getElementById('cart-table');
        if ((cartTable !== undefined) && (cartTable != null)) {
            cartTable.style.visibility = 'hidden';
        }
        var cartEmpty = document.getElementById('cart-empty');
        if (cartEmpty !== undefined && (cartEmpty != null)) {
            cartEmpty.style.visibility = 'visible';
        }
        $.post(url)
            .done(function (data) {
                location.reload();
            });
    }
}

$(document).ready(function () {
    $('#add_address').click(function () {
        var val = $('#hidden_address').val();
        window.location.assign(val);
    });
    enableOnlineTranslationsEditing();
});

function loadCatalogMenu(lang, topLevelCount) {
    var menuPlaceholder = $('#menuMega');
    if (menuPlaceholder.length > 0) {
        $.ajax({
            url: '//data.' + document.domain + '/category/menu/lang/' + lang + '/topLevelCount/' + topLevelCount,
            cache: true,
            //crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            dataType: 'html',
            success: function (data) {
                menuPlaceholder.html(data);
            }
        });
    }
}


function enableOnlineTranslationsEditing() {
    var editableTranslations = $('translation[editable=1]');
    if (editableTranslations.length > 0) {
        console.log('Online translation editing enabled');
        $(editableTranslations).each(function () {
            //$(this).oncontextmenu = function() {return false;};
            $(this).on('contextmenu', function (e) {
                e.preventDefault();
                return false;
            });
            $(this.parentNode).on('contextmenu', function (e) {
                e.preventDefault();
                return false;
            });
            $(this).mousedown(function (e) {
                if (e.which == 3) { //e.button = 2
                    var type = $(this).attr('type');
                    var idAndMode = $(this).attr('id');
                    console.log('Online translation: ' + idAndMode);
                    idAndMode = idAndMode.replace(type, '');
                    var id = idAndMode.replace(/([\d\-]+).+/i, '$1');
                    var mode = idAndMode.replace(/[\d\-]+(.+)/i, '$1');
                    editTranslation(e, this, type, id, mode);
                    stopPropagation(e);
                    return false;
                }
                return true;
            });
        });
    }
}


function editTranslation(evt, obj, type, id, mode) {
//$("#sort_by").change(function() {
//    TranslateForm_cn
    var baseUrl = $(obj).attr('url');
    var to = $(obj).attr('to');
    var pinned = $(obj).attr('pinned');
    var translatorId = id.replace(/-.*/i, '');
    var translatorMode = mode.replace(/-.*/i, '');
    var url = baseUrl + '?type=' + type + '&id=' + translatorId + '&mode=' + translatorMode + '&language=' + to;
    if (url[0] != '/') {
        url = window.location.protocol + '//' + url;
        //url = 'http://' + url+'&jsonp=?';
    }
    $('#TranslateForm_type').val(type);
    if (pinned) {
        $('#TranslateForm_pinned').attr('value', '1');
        $('#TranslateForm_pinned').prop('checked', true);
    } else {
        $('#TranslateForm_pinned').attr('value', '0');
        $('#TranslateForm_pinned').prop('checked', false);
    }
    $('#TranslateForm_mode').val(mode);
    $('#TranslateForm_id').val(id);
    var from = $(obj).attr('from');
    $('#TranslateForm_from').val(from);
    $('#TranslateForm_to').val(to);
    $('#TranslateForm_url').val(url);
    $.getJSON(url, function (data) {
        if ((data !== null) && (data !== undefined) && (data.source != '')) {
            $('#TranslateForm_source').val(data.source);
            $('#TranslateForm_message').val(data.message);
            if (true) {
                var bkrsLink = $('#translate-bkrs-url');
                if (bkrsLink.length) {
                    if (from == 'zh') {
                        var fUrl = 'https://bkrs.info/slovo.php?ch=' + data.source;
                    } else {
                        var fUrl = 'https://bkrs.info/slovo.php?' + from + '=' + data.source;
                    }
                    bkrsLink.attr('href', fUrl);
                }
            } else {
                var iframe = $('#translate-bkrs');
                if (iframe.length) {
                    if (from == 'zh') {
                        var fUrl = 'https://bkrs.info/slovo.php?ch=' + data.source;
                    } else {
                        var fUrl = 'https://bkrs.info/slovo.php?' + from + '=' + data.source;
                    }
                    iframe.attr('src', fUrl);
                }
            }
            $('#translationDialog').modal('show');
            if (evt) {
                stopPropagation(evt);
            }
        } else {
            dsAlert('Перевод не найден!', '', true);
        }
    });
    return false;
}

function saveTranslation() {
    document.cookie = 'reset-translations-cache=true';
    var spanBlock = $('#TranslateForm_type').val() + $('#TranslateForm_id').val() + $('#TranslateForm_mode').val();
    var message = $('#TranslateForm_message').val();
    var idMask = spanBlock.replace(/-.*/i, '');
    console.log('Online translation mask: ' + idMask);
    $('[id^="' + idMask + '"]').each(
        function () {
            //console.log('Online translation applyed: '+$(this).attr('id'));
            $(this).text(message);
        }
    );
    $('#TranslateForm_id').val($('#TranslateForm_id').val().replace(/-.*/i, ''));
    $('#TranslateForm_mode').val($('#TranslateForm_mode').val().replace(/-.*/i, ''));
    var postform = $('#translation-form').serialize();
    var url = $('#TranslateForm_url').val();
    try {
        var pinnedUrl = url.replace(/^http[s]*:\/\/[a-z0-9\-\.:]+\//i, '/');
        $.post(pinnedUrl, postform);
    } finally {
        $.post(url, postform, function () {
            console.log('Online translation saved: ' + spanBlock);
        });
        $('#translationDialog').modal('hide');
        return false;
    }
}

function editWeight(cid, iid, weight) {
    $('#WeightForm_cid').val(cid);
    $('#WeightForm_iid').val(iid);
    $('#WeightForm_weight').val(weight);
    $('#weightDialog').modal('show');
    return false;
}

function saveWeight() {
    var postform = $('#weight-form').serialize();
    var url = '/site/saveWeight';
    $.post(url, postform);
    $('#weightDialog').modal('hide');
    return false;
}

function stopPropagation(evt) {
    var ev;
    if (evt) {
        ev = evt;
    } else {
        ev = window.event;
    }
    if (ev.stopPropagation) {
        ev.stopPropagation();
    }
    if (ev.cancelBubble != null) {
        ev.cancelBubble = true;
    }
}

function deleteFavorite(dellink, id) {
    var url = $(dellink).attr('href');
    var elem = $('#item' + id);
    $.get(url, null,
        function (data) {
            $(elem).remove();
            dsAlert(data, '', true);
        },
        'text');
}

function addFeatured(addlink, id) {
    var url = $(addlink).attr('href');
    if (typeof url == 'undefined') {
        url = $(addlink).attr('formaction');
    }
    $.get(url, null,
        function (data) {
            dsAlert(data, '', true);
        },
        'text');
}

function addFavorite(addlink, id) {
    var url = $(addlink).attr('href');
    if (typeof url == 'undefined') {
        url = $(addlink).attr('formaction');
    }
    $.get(url, null,
        function (data) {
            dsAlert(data, '', true);
        },
        'text');
}

function addCart(addlink, id) {
    var url = $(addlink).attr('href');
    if (typeof url == 'undefined') {
        url = $(addlink).attr('formaction');
    }
    $.get(url, null,
        function (data) {
            var cartBlock = $('#cart-block-content');
            if (cartBlock.length > 0) {
                cartBlock.load('/cart/block');
            }
            dsAlert(data, '', true);
        },
        'text');
}

function deleteCart(dellink, id) {
    var url = $(dellink).attr('href');
    if (typeof url == 'undefined') {
        url = $(dellink).attr('formaction');
    }
    $.get(url, null,
        function (data) {
            var cartBlock = $('#cart-block-content');
            if (cartBlock.length > 0) {
                cartBlock.load('/cart/block');
            }
            //dsAlert(data, '', true);
        },
        'text');
}

function addParameterToUrl(url, parameterName, parameterValue, atStart/*Add param before others*/) {
    replaceDuplicates = true;
    if (url.indexOf('#') > 0) {
        var cl = url.indexOf('#');
        urlhash = url.substring(url.indexOf('#'), url.length);
    } else {
        urlhash = '';
        cl = url.length;
    }
    sourceUrl = url.substring(0, cl);

    var urlParts = sourceUrl.split('?');
    var newQueryString = '';

    if (urlParts.length > 1) {
        var parameters = urlParts[1].split('&');
        for (var i = 0; (i < parameters.length); i++) {
            var parameterParts = parameters[i].split('=');
            if (!(replaceDuplicates && parameterParts[0] == parameterName)) {
                if (newQueryString == '')
                    newQueryString = '?';
                else
                    newQueryString += '&';
                newQueryString += parameterParts[0] + '=' + (parameterParts[1] ? parameterParts[1] : '');
            }
        }
    }
    if (newQueryString == '')
        newQueryString = '?';

    if (atStart) {
        newQueryString = '?' + parameterName + '=' + parameterValue + (newQueryString.length > 1 ? '&' + newQueryString.substring(1) : '');
    } else {
        if (newQueryString !== '' && newQueryString != '?')
            newQueryString += '&';
        newQueryString += parameterName + '=' + (parameterValue ? parameterValue : '');
    }
    return urlParts[0] + newQueryString + urlhash;
}

function convertCurrency(sum, src, dst) {
    var url = '/site/convertCurrency?sum=' + sum + '&src=' + src + '&dst=' + dst;
    var res = $.ajax({
            url: url,
            global: false,
            type: 'GET',
            data: null,
            dataType: 'text',
            async: false,
            success: function (data) {
                console.log('Currency converted: ' + data);
            }
        }
    ).responseText;
    return res;
}

