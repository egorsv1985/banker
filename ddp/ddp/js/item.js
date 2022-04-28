scripts = document.getElementsByTagName('script');
thisFilePath = scripts[scripts.length - 1].src.split('?')[0];      // remove any ?query
var themePath = thisFilePath.split('/').slice(0, -2).join('/');  // remove last filename part of path
delete scripts;
delete thisFilePath;

$(document).ready(function () {
    $('.minus').click(function () {
        var input = $('#num');
        var count = parseInt(input.val()) - 1;
        count = count <= 1 ? 1 : count;
        input.val(count);
        setTimeout(function () {
            getUserPrice(false);
        }, 1500);
        return false;
    });
    $('.plus').click(function () {
        var input = $('#num');
        var count = parseInt(input.val()) + 1;
        input.val(count);
        setTimeout(function () {
            getUserPrice(false);
        }, 1500);
        return false;
    });
});

function reloadSku() {
    var dsSource = $('#dsSource').val();
    var iid = $('#iid').val();
    var count = $('#num').val();
//    var html = $("#small_images").html();
    var params = '';
    var error = false;
    $('.input_params').each(function () {
        var val = $(this).val();
        if (val !== '0') {
            params = params + val + ';';
            $(this).removeClass('error');
        } else {
            error = true;
            $('#buy-btn-buy').prop('disabled', true);
            $('#buy-btn-cart').prop('disabled', true);
            $(this).addClass('error');
        }
    });
//-------------
    var inpProc = $('#inputprops-processed');
    var inputpropsProcessed = inpProc.val();
    if (inputpropsProcessed == params) {
        return false;
    }
    inpProc.val(params);
//-------------
    var url = '/item/getsku?dsSource=' + dsSource + '&iid=' + iid + '&params=' + params + '&count=' + count;

    if (!error) {
        $('#item-count-price').html('<img src="' + themePath + '/images/Hourglass.png">');
        $('#item_num').html('<img src="' + themePath + '/images/Hourglass.png">');
        setTimeout(function () {
            if ($.ajaxq.isRunning('itemData')) {
                console.log('itemData ajax queue aborted');
                $.ajaxq.abort('itemData');
            }
            $.getJSON(url, function (data) {
                    applySku(data);
                    //itemSKU = data;
                }
            );
        }, 750);
    }
}

function loadInputProps() {
    $('#item-input-props').html('<div id="ajax-loader"></div>');
    var iid = $('#iid').val();
    var dsSource = $('#dsSource').val();
    var url = '//' + document.domain + '/item/getinputprops?dsSource=' + dsSource + '&iid=' + iid;
    $.get(url, {
            data: 'html'
        },
        function (data) {
            $('#item-input-props').html(data);
        }
    );
}

function loadSellerRelatedBlock(nick, userid, dsSource, iid) {
    $('#sellerrelated').html('<div id="ajax-loader"></div>');
    var url = '//data.' + document.domain + '/' + $.cookie('front_lang') + '/item/sellerrelatedblock?nick=' + nick + '&userid=' + userid + '&dsSource=' + dsSource + '&iid=' + iid;
    $.ajaxq('itemData',
        {
            url: url,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                $('#sellerrelated').html(data);
            }
        }
    );
}

function loadItemDetails(dsSource, iid) {
    $('#item-detail-block').html('<div id="ajax-loader"></div>');
    var url = '//data.' + document.domain + '/item/detail?dsSource=' + dsSource + '&iid=' + iid;
    $.getq('itemData', url, function (data) {
        $('#item-detail-block').html(data);
    }).always(function () {
        try {
            deferredTranslateDescr.resolve(true);
        } catch (error) {
            console.log('No Bing translation deffered enabled');
        }
    });
}

function loadItemDetailsFromUrl(url) {
    $('#item-detail-block').html('<div id="ajax-loader"></div>');
    var url = '//data.' + document.domain + '/item/detail?url=' + url; //'//' + document.domain +
    $.getq('itemData', url, function (data) {
        $('#item-detail-block').html(data);
    }).always(function () {
        try {
            deferredTranslateDescr.resolve(true);
        } catch (error) {
            console.log('No Bing translation deffered enabled');
        }
    });
}

function getUserPrice(force) {
    var count = $('#num').val();
    var numProc = $('#num-processed');
    var countProcessed = numProc.val();
    if ((countProcessed === count) && !force) {
        return false;
    }
    numProc.val(count);
    var iid = $('#iid').val();
    var dsSource = $('#dsSource').val();
    var price = $('#price_val').val();
    var url = '//' + document.domain + '/item/getuserprice?dsSource=' + dsSource + '&iid=' + iid + '&count=' + count + '&price=' + price;
    $('#item-count-price').html('<img src="' + themePath + '/images/Hourglass.png">');
    if ($.ajaxq.isRunning('itemData')) {
        console.log('itemData ajax queue aborted');
        $.ajaxq.abort('itemData');
    }
    $.get(url, {
            data: 'html'
        },
        function (data) {
            $('#item-count-price').html(data);
        }
    );
    // =========== Detail loading ===============
    var url = '//' + document.domain + '/item/getuserpricedetail?dsSource=' + dsSource + '&iid=' + iid + '&count=' + count + '&price=' + price;
    $('#item-price-detail').html('<img src="' + themePath + '/images/Hourglass.png">');
    $.get(url, {
            data: 'html'
        },
        function (data) {
            $('#item-price-detail').html(data);
        }
    );
    // =========== End of Detail loading ========
}

function loadItemDesc(dsSource, iid) {
    var url = '//' + document.domain + '/item/detail?dsSource=' + dsSource + '&iid=' + iid;
    document.write('<div id="ajax-load"></div>');
    $.get(url, {
            data: 'html'
        },
        function (data) {
            $('#tab-4-content').html(data);
        }
    );
}

function loadItemComments(dsSource, num_iid, seller_id, type) {
//TODO: возможно, здесь сделать запрос с поддомена data
    $('#item-comments-block').html('<div id="ajax-loader"></div>');
    var url = '//' + document.domain + '/item/itemComments?dsSource=' + dsSource + '&num_iid=' + num_iid + '&seller_id=' + seller_id + '&type=' + type;
    $.getq('itemData', url, function (data) {
        $('#item-comments-block').html(data);
    }).always(function () {
        try {
            deferredTranslateComments.resolve(true);
        } catch (error) {
            console.log('No Bing translation deffered enabled');
        }
    });
}