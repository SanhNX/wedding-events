
function expandAddPage() {

    if ($('#btn-add').hasClass('open')) {
        $('#btn-add').removeClass('open');
        $('#admin-tab').animate({height: 0}, function() {
            $('#admin-tab').css({display: 'none'});
        });
        $('#btn-add').text('Thêm');
    }
    else {
        $('#admin-tab').css({display: 'block', height: 0}).animate({height: 550});
        $('#btn-add').addClass('open');
        $('#btn-add').text('Hủy');
    }
}
function deleteFeedAjax(id) {
    var r = confirm("Xác nhận xóa!")
    if (r == true) {
        $.ajax({
            url: "module/ajax-delete.php",
            type: "POST",
            data: {type: '4', id: id},
            cache: false,
            success: function(response) {
                location.reload();
//                alert(response);
            }
        });
    }
}
function editFeedAjax(id) {
    $('#admin-tab').css({display: 'block', height: 0}).animate({height: 550});
    $('#btn-add').addClass('open');
    $('#btn-add').text('Hủy');
    $.ajax({
        url: "module/ajax-edit.php",
        type: "POST",
        data: {type: '4', id: id},
        cache: false,
        success: function(response) {
//                location.reload();
            var obj = JSON.parse(response);
            $(".nicEdit-main").html(obj.Noidung);
            $("#txtName").val(obj.Tieude);
        }
    });
    //alert($('#item-'+id)[0].childNodes[0].innerText);


}
function ddChange() {
    var id= $("#cboAddress").val();
    $("#cboSubAddress").html("");
    $.ajax({
        url: "module/ajax-get.php",
        type: "POST",
        data: {type: 'listDD', id: id},
        cache: false,
        success: function(response) {
            if(response=='')return ;
            var obj = JSON.parse(response);
            
            for (var i=0;i<obj.list.length;i++) {
                var opt = document.createElement('option');
                $(opt).val(obj.list[i].Id);
                $(opt).text(obj.list[i].Ten);
                $("#cboSubAddress").append(opt);
            }
        }
    });
}