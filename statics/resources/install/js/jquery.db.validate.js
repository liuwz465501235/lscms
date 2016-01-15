$(function(){
    //检查事件函数
    checkEventValue('#dbHost' , '.dbHost', '数据库服务器不能为空,一般为localhost' , '数据库服务器地址, 一般为本地:localhost');
    checkEventValue('#dbName' , '.dbName', '数据库名不能为空' , '请先创建数据库');
    checkEventValue('#dbUsername' , '.dbUsername', '数据库用户名不能为空,一般为root' , '');
    checkEventValue('#dbPassword' , '.dbPassword', '数据库密码不能为空' , '');
    checkEventValue('#username' , '.username', '管理员帐号不能为空' , '');
    checkEventValue('#password' , '.password', '管理员密码不能为空' , '');
    checkEventValue('#passwordRe' , '.passwordRe', '重复密码不能为空' , '');
    checkEventEmail('#email' , '.email', '邮箱格式不正确' , '');
    checkEventCompare('#password' , '#passwordRe' , '.passwordRe' , '两个值不一致' , '');
    //表单提交
    $('button[type="submit"]').click(function(){
        var r1 = checkValue('#dbHost' , '.dbHost', '数据库服务器不能为空,一般为localhost' , '数据库服务器地址, 一般为本地:localhost');
        var r2 = checkValue('#dbName' , '.dbName', '数据库名不能为空' , '请先创建数据库');
        var r3 = checkValue('#dbUsername' , '.dbUsername', '数据库用户名不能为空,一般为root' , '');
        var r4 = checkValue('#dbPassword' , '.dbPassword', '数据库密码不能为空' , '');
        var r5 = checkValue('#username' , '.username', '管理员帐号不能为空' , '');
        var r6 = checkValue('#password' , '.password', '管理员密码不能为空' , '');
        var r7 = checkValue('#passwordRe' , '.passwordRe', '重复密码不能为空' , '');
        var r8 = checkValue('#email' , '.email', '邮箱不能为空' , '');
        var r9 = checkEmail('#email' , '.email', '邮箱格式不正确' , '');
        var r10 = checkCompare('#password' , '#passwordRe' , '.passwordRe' , '两个值不一致' , '');
        if(r1===false || r2===false || r3===false || r4===false || r5===false || r6===false || r7===false || r8===false || r9===false || r10===false) {
            return false
        }
        return true;
    });
});

/**
 * 在添加事件时监听对象
 * @param {type} cObj
 * @param {type} eObj
 * @param {type} errorMsg
 * @param {type} msg
 * @returns {undefined}
 */
function checkEventValue(cObj , eObj , errorMsg , msg) {
    $(document).on("change blur" , cObj , function(){
        var selectorValue = $(this).val();
        if(typeof selectorValue=='undefined' || selectorValue==null || selectorValue=='') {
            $(eObj).addClass('cnote').html(errorMsg);
            return false;
        } else {
            $(eObj).removeClass('cnote').html(msg);
            return true;
        }
    });
}


/**
 * 检查空值
 * @param {type} 表单对象
 * @param {type} 错误对象
 * @returns {undefined}
 */
function checkValue(cObj , eObj , errorMsg , msg) {
    var selectorValue = $(cObj).val();
    if(typeof selectorValue=='undefined' || selectorValue==null || selectorValue=='') {
        $(eObj).addClass('cnote').html(errorMsg);
        return false;
    } else {
        $(eObj).removeClass('cnote').html(msg);
        return true;
    }
}

/**
 * 事件上监听邮箱格式
 * @param {type} cObj
 * @param {type} eObj
 * @param {type} errorMsg
 * @param {type} msg
 * @returns {undefined}
 */
function checkEventEmail(cObj , eObj , errorMsg , msg) {
    $(document).on("change blur" , cObj , function(){
        var selectorValue = $(cObj).val();
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/
        if( !reg.test(selectorValue) ) {
            $(eObj).addClass('cnote').html(errorMsg);
            return false;
        } else {
            $(eObj).removeClass('cnote').html(msg);
            return true;
        }
    });
}


/**
 * 检测邮箱格式
 * @param {type} cObj
 * @param {type} eObj
 * @param {type} errorMsg
 * @returns {undefined}
 */
function checkEmail(cObj , eObj , errorMsg , msg) {
    var selectorValue = $(cObj).val();
    var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/
    if( !reg.test(selectorValue) ) {
        $(eObj).addClass('cnote').html(errorMsg);
        return false;
    } else {
        $(eObj).removeClass('cnote').html(msg);
        return true;
    }
}

/**
 * 在事件中监听两个值是否一致
 * @param {type} oObj
 * @param {type} rObj
 * @param {type} eObj
 * @param {type} errorMsg
 * @param {type} msg
 * @returns {undefined}
 */
function checkEventCompare(oObj , rObj , eObj , errorMsg , msg) {
    $(document).on("change blur" , rObj , function(){
        var nVal = $(oObj).val();
        var reVal = $(this).val();
        if(nVal != reVal) {
            $(eObj).addClass('cnote').html(errorMsg);
            return false;
        } else {
            $(eObj).removeClass('cnote').html(msg);
            return true;
        }
    });
}

/**
 * 检测两个值是否一值
 * @param {type} oObj
 * @param {type} rObj
 * @param {type} eObj
 * @param {type} errorMsg
 * @param {type} msg
 * @returns {undefined}
 */
function checkCompare(oObj , rObj , eObj , errorMsg , msg) {
    var nVal = $(oObj).val();
    var reVal = $(rObj).val();
    if(nVal != reVal) {
        $(eObj).addClass('cnote').html(errorMsg);
        return false;
    } else {
        $(eObj).removeClass('cnote').html(msg);
        return true;
    }
}

