// پیام هشدار
function alerts(message) {
    jAlert(message);
}

function msg(title, message, delay) {
    $.growlUI(title, message, delay);
}

// سوال تایید
function confirms(message) {
    //    var retval = false;
    //    jConfirm(message, 'تاییدیه سامانه', function(r) {
    //        retval = r;
    //    });
    //    return false;

    return confirm(message);

}

// باز و بسته کردن تگ دلخواه
function toggler(togglerId) {
    $('#' + togglerId).toggle(500);
}

// باز  کردن تگ دلخواه
function openMe(openId) {
    $('#' + openId).show(500);
}

//  بستن  تگ دلخواه
function closeMe(closeId) {
    $('#' + closeId).hide(500);
}

function chk(checkboxId, tagId) {

    if ($("#" + checkboxId).is(":checked")) {
        openMe(tagId);

    }
    else {
        closeMe(tagId);
    }

}

// محاسبه تعداد کاراکتر های باقیمانده پیامک
var smsCount = 1;
function smsLeftChar(txtSms, lblLeft, lblSms, lblMax, txtSign) {

    var smsBody = $('#' + txtSms).val(); //+ $('#' + txtSign).val();

    var isPersian = isUnicode(smsBody);
    var maxLen = 0;
    var msgLen = smsBody.length;
    var currentLen = msgLen;

    var charLeft = 0;

    if (isPersian) {
        maxLen = 70;
        $('#' + txtSms).css({ 'direction': 'rtl' });
    }
    else {
        maxLen = 160;
        $('#' + txtSms).css({ 'direction': 'ltr' });
    }

    if (currentLen > maxLen) {

        while (msgLen > maxLen) {
            msgLen -= maxLen;
        }

        if ((msgLen % maxLen) != 0) {
            smsCount = parseInt(Math.floor(currentLen / maxLen)) + 1;

        }
        else {
            smsCount = parseInt(currentLen / maxLen);
        }

    }
    else {
        smsCount = 1;
    }

    $('#' + lblLeft).html(maxLen - msgLen);
    $('#' + lblSms).html(smsCount);
    $('#' + lblMax).html(maxLen);

}

function checkSMSLength(textarea, counterSpan, partSpan, maxSpan, def) {


    var text = document.getElementById(textarea).value;
    var ucs2 = text.search(/[^\x00-\x7E]/) != -1
    if (!ucs2) text = text.replace(/([[\]{}~^|\\])/g, "\\$1");
    var unitLength = ucs2 ? 70 : 160;
    var msgLen = 0;
    msgLen = document.getElementById(textarea).value.length; //+docu def;

    document.getElementById(textarea).style.direction = text.match(/^[^a-z]*[^\x00-\x7E]/ig) ? 'rtl' : 'ltr';

    if (msgLen > unitLength) {
        if (ucs2) unitLength = unitLength - 3;
        else unitLength = unitLength - 7;
    }

    var count = Math.max(Math.ceil(msgLen / unitLength), 1);

    document.getElementById(maxSpan).innerHTML = unitLength;
    document.getElementById(counterSpan).innerHTML = (unitLength * count - msgLen);
    document.getElementById(partSpan).innerHTML = count;


}


// تشخیص یونیکد بودن متن
function isUnicode(str) {
    var letters = [];
    for (var i = 1; i <= str.length; i++) {
        letters[i] = str.substring((i - 1), i);
        if (letters[i].charCodeAt() > 255) { return true; }
    }
    return false;
}

// انتخاب/حذف انتخاب همه سطر ها

var checkflag = "false";
function select_deselectAll() {

    if (chk_Array_IDs != null) {
        if (checkflag == "false") {
            for (i = 0; i < chk_Array_IDs.length; i++) {
                var ref_chk = document.getElementById(chk_Array_IDs[i]);
                if (ref_chk != null)

                    ref_chk.checked = true;
            }
            checkflag = "true";

        }
        else {
            for (i = 0; i < chk_Array_IDs.length; i++) {
                var ref_chk = document.getElementById(chk_Array_IDs[i]);
                if (ref_chk != null)
                    ref_chk.checked = false;
            }
            checkflag = "false";
        }
    }
}

// انتخاب همه سطر ها
function selectAll() {

    if (chk_Array_IDs != null) {

        for (i = 0; i < chk_Array_IDs.length; i++) {
            var ref_chk = document.getElementById(chk_Array_IDs[i]);
            if (ref_chk != null)

                ref_chk.checked = true;
        }

    }
}

// حذف انتخاب همه سطر ها
function deSelectAll() {

    if (chk_Array_IDs != null) {

        for (i = 0; i < chk_Array_IDs.length; i++) {
            var ref_chk = document.getElementById(chk_Array_IDs[i]);
            if (ref_chk != null)

                ref_chk.checked = false;
        }

    }
}


//  انتخاب معکوس سطر ها
function inSelectAll() {

    if (chk_Array_IDs != null) {

        for (i = 0; i < chk_Array_IDs.length; i++) {
            var ref_chk = document.getElementById(chk_Array_IDs[i]);
            if (ref_chk != null)
                if (ref_chk.checked == false)
                    ref_chk.checked = true;
                else
                    ref_chk.checked = false;
        }

    }
}

function select_deselect(chk_Array, chk) {


    if (chk_Array != null) {

        for (i = 0; i < chk_Array.length; i++) {
            var ref_chk = document.getElementById(chk_Array[i]);
            if (ref_chk != null)
                ref_chk.checked = chk;
        }


    }
}

// قرار دادن کاما در فیلد قیمت
function moneyCommaSep(id) {
    var ctrl = document.getElementById(id);
    if (ctrl != null) {
        var separator = ",";
        var int = ctrl.value.replace(new RegExp(separator, "g"), "");
        var regexp = new RegExp("\\B(\\d{3})(" + separator + "|$)");
        do {
            int = int.replace(regexp, separator + "$1");
        }
        while (int.search(regexp) >= 0)
        ctrl.value = int;
    }
}

// حذف کاما
function removeComma(id) {
    var ctrl = document.getElementById(id);
    var separator = ",";
    ctrl.value = ctrl.value.replace(new RegExp(separator, "g"), "");
}


function GetParentIfExists(wnd) {
    var wndOpener = wnd.parent;
    if (!wndOpener) wndOpener = wnd;
    return wndOpener;
}
function OpenPopupWindow(childURL, childName, childFeatures) {
    var wndOpener = GetParentIfExists(window);
    var wndChild;
    wndChild = wndOpener.open(childURL, childName, childFeatures);
    if (wndChild != null) {
        if (g_JS_isWin || !g_JS_isIE)
            wndChild.focus();
    }
}

function popMe(Url, width, height) {
    var wndOpener = GetParentIfExists(window);
    var wndChild;
    wndChild = wndOpener.open(Url, 'X625', 'width=' + width + ',height=' + height + ',top=20,left=100,toolbar=no,scrollbars=yes,resizable=yes');
}

function ajax(myUrl, myData) {
    $.ajax({
        type: "GET",
        url: myUrl,
        data: myData,
        success: function (content) {
            return content;
        },
        error: function () {
            alert('error');
        }
    });
}

function checkSelect() {
    var count = 0;
    if (chk_Array_IDs != null) {

        for (i = 0; i < chk_Array_IDs.length; i++) {
            var ref_chk = document.getElementById(chk_Array_IDs[i]);
            if (ref_chk != null && ref_chk.checked == true) {
                count++;
            }
        }
    }
    if (count == 0) {
        alert("هیچ رکوردی انتخاب نشده است");
        return false;
    }
    else {
        return true;
    }
}

function checkGroup() {
    if (Page_ClientValidate()) {
        var count = 0;
        var checked = 0;
        if (group_Array_IDs != null) {

            for (i = 0; i < group_Array_IDs.length; i++) {
                var ref_chk = document.getElementById(group_Array_IDs[i]);
                if (ref_chk != null && ref_chk.checked == true) {
                    checked++;
                }
                count++;
            }
        }
        if (count == 0) {
            alert("هنوز هیچ گروهی تعریف نشده است\nاز طریق مدیریت گروه ها گروه ایجاد نمایید");
            return false;
        }
        else {
            if (checked == 0) {
                alert("هیچ گروه مخاطبی  انتخاب نشده است");
                return false;
            }
            else {
                return true;
            }
        }
    }
}



function printMe(id) {

    $('#' + id).printElement();

}

function hideMe() {
    parent.$.facebox.close();

}

function clickButton(e, buttonid) {

    var evt = e ? e : window.event;

    var bt = document.getElementById(buttonid);

    if (bt) {

        if (evt.keyCode == 13) {

            bt.click();

            return false;

        }

    }

}