$(function(){
    treeListen();
});
//加载树形结构监听
function treeListen(){
    $('[data-toggle=popover]').popover({trigger: 'hover'});
    //删除按钮
    $('[data-power=delete]').click(function(){
        if (confirm('确定要删除这条数据吗?')){
            var treeId = $(this).parents('[data-note=tree-view]').attr('id');
            $.ajax({
                url : $(this).attr('href'),
                type : 'POST',
                success : function(data){
                    treeId = "#" + treeId;
                    var html = $(data).find(treeId);
                    $(treeId).replaceWith(html);
                    jQuery(treeId).treeview({'animated':'normal'});
                    jQuery('a[data-power=dialog]').click(openDialog);
                    treeListen();
                },
                error : function(XMLHttpRequest, textStatus, errorThrown){
                    alert(XMLHttpRequest.responseText);
                }
            });
        }
        return false;
    });
    //记录数组展开状态
    $('[data-note=tree-view]').find('li').click(function(){
        var ul = $(this).parents('[data-note=tree-view]');
        var tree = '';
        if (jQuery.cookie('tree-' + ul.attr('id')) != null) {
            tree = jQuery.cookie('tree-' + ul.attr('id'));
        }
        var p = new RegExp("," + this.id + ",", "gi");
        tree = tree.replace(p, ',');
        $(this).find('li').each(function() {
            var cls = $(this).parents('li').attr('class');
            if (!cls.match(/collapsable/)) {
                var p = new RegExp("," + this.id + ",", "gi");
                tree = tree.replace(p, ',');
            }
        });
        var cls = $(this).attr('class');
        if (cls.match(/collapsable/)) {
            if (tree == '') {
                tree = "," + this.id + ",";
            } else {
                tree += this.id + ",";
            }
            $(this).find('li').each(function() {
                var p = new RegExp("," + this.id + ",", "gi");
                tree = tree.replace(p, ',');
                if ($(this).attr('class').match(/collapsable/)) {
                    tree += this.id + ",";
                }
            });
        }
        if (tree == ',')
            tree = null;
        var tree = jQuery.cookie('tree-' + ul.attr('id'), tree);
    });
    $('[data-note=tree-view]').find(':checkbox').change(function(){
        if(this.checked){
            $(this).parents('li').children('label').children(':checkbox').prop('checked',this.checked);
        }
        $(this).parent('label').next('ul').find(':checkbox').prop('checked',this.checked);
    });
    $('[data-note=close-dialog]').click(function(){
        clearTreeData();
        parent.dialogClose2();
        return false;
    });
}
//删除记录
function deleteItem() {
}
//删除树形缓存数据
function clearTreeData(){
    $('[data-note=tree-view]').each(function(){
        jQuery.cookie('tree-' + this.id,null);
    });
}