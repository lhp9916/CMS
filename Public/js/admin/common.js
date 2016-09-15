/**
 * Created by lhp on 2016/9/11.
 */
/*
 添加按钮操作
 */
$("#button-add").click(function () {
    var url = SCOPE.add_url;
    window.location.href = url;
});

$("#singcms-button-submit").click(function () {
    var data = $("#singcms-form").serializeArray();//获取到整个表单的内容
    postData = {};
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    $.post(url, postData, function (result) {
        if (result.status == 1) {
            return dialog.success(result.message, jump_url);
        } else if (result.status == 0) {
            return dialog.error(result.message);
        }
    }, 'json');
});

//编辑
$('.singcms-table #singcms-edit').on('click', function () {
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url;
    window.location.href = url + '&id=' + id;
});

//删除
$('.singcms-table #singcms-delete').on('click', function () {
    var id = $(this).attr('attr-id');
    var url = SCOPE.set_status_url;
    var message = $(this).attr('attr-message');
    var a = $(this).attr('attr-a');
    data = {};
    data['id'] = id;
    data['status'] = -1;
    layer.open({
        type: 0,
        title: '是否提交',
        btn: ['yes', 'no'],
        icon: 3,
        closeBtn: 2,
        content: "是否确定" + message,
        scrollbar: true,
        yes: function () {
            todelete(url, data);
        }
    });
});
function todelete(url, data) {
    $.post(
        url,
        data,
        function (result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            } else if (result.status == 1) {
                return dialog.success(result.message, '');
            }
        }, 'json');
}

//排序
$('#button-listorder').click(function () {
    var data = $("#singcms-listorder").serializeArray();
    postData = {};
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    var url = SCOPE.listorder_url;
    $.post(url, postData, function (result) {
        if (result.status == 0) {
            return dialog.error(result.message, result['data']['jump_url']);
        } else if (result.status == 1) {
            return dialog.success(result.message, result['data']['jump_url']);
        }
    }, "json");
});
