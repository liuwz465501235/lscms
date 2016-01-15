jQuery('a[data-power=dialog]').click(openDialog);

function openDialog(){
    var href = this.href; 
    if(href.indexOf('?') >= 0){
        href += "&" + "requestType=dialog";
    }else{
        href += "?" + "requestType=dialog";
    }
    var w = $(this).data('width');
    var h = $(this).data('height');
    
    $('#dialog-iframe').dialog({width: w,height:h});
    $('#dialog-iframe').find("iframe").attr({width: w-40,height:h-70});
    
    $('#dialog-iframe').dialog('open');
    $('#dialog-iframe').find("iframe").attr('src',href);
    return false;
}

function dialogClose(){
    $('#dialog-iframe').find("iframe").attr('src','');
    $('#dialog-iframe').dialog('close');
    location.reload();
}

function dialogClose2(){
    $('#dialog-iframe').find("iframe").attr('src','');
    $('#dialog-iframe').dialog('close');
}
/**
 * 树型结构关闭
 */
function treeDialogClose(treeId){
    dialogClose2();
}
function treeReload(treeId){
    if(!treeId){
        treeId = '#category-list';
    }
    $.ajax({
        url : window.location.href,
        type : 'get',
        success : function(data){
            var html = $(data).find(treeId);
            $(treeId).replaceWith(html);
            $(treeId).treeview({'animated':'normal'});
            $('a[data-power=dialog]').click(openDialog);
            treeListen();
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest.responseText);
        }
    });
}