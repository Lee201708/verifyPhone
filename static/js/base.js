// window.onload = function () {
//     alert("hello");
//
// }

$(document).ready(function () {
    $("#query").click(function () {
        var phoneNum = $("#phone-num").val();
        if (phoneNum.length == 11) {
            IMMOC.GLOBAL.AJAX('api.php', 'post', {'tel' : phoneNum}, 'json', IMMOC.APPS.QUERYPHONE.AJAXCALLBACK)
        }
    })

});

var IMMOC = IMMOC || {};
IMMOC.GLOBAL = {};
IMMOC.APPS = {};

IMMOC.GLOBAL.AJAX = function (url, method, params, dataType, callback) {
    $.ajax({
        url : url,
        async:false,
        method : method,
        data : params,
        dataType : dataType,
        success : callback,
        error : function () {
            alert('请求异常');
        }
    });
};
IMMOC.APPS.QUERYPHONE = {};
IMMOC.APPS.QUERYPHONE.AJAXCALLBACK = function (data) {
    if (data.code == 200) {
        IMMOC.APPS.QUERYPHONE.SHOWINFO(data);
    } else {
        IMMOC.APPS.QUERYPHONE.HIDEINFO();
        alert(data.msg);
    }
};
IMMOC.APPS.QUERYPHONE.SHOWINFO = function (data) {
    $('#phoneInfo').show();
    $('#query-phone').text(data.telString);
    $('#query-pro').text(data.province);
    $('#query-cat').text(data.carrier);
};
IMMOC.APPS.QUERYPHONE.HIDEINFO = function () {
    $('#phoneInfo').hide();
};