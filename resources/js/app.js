require('./bootstrap');
$('body').on('click','.modal-show',function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr("href"),
        method = url.indexOf('edit'),
        title = me.attr("title");
    $('#modal-title').text(title);
    $('#modal-btn-save').show().text(me.hasClass('edit')?'Update Product':'Add Product');
    $.ajax({
        url:url,
        dataType:"html",
        success: function(response){
            $('#modal-body').html(response);
            if(method != -1){
                var src = $('#photo').val();
                $('#uploaded_image').html('<img src="/images/'+src+'" id="image" name="image" width="300" height/>');
            }
        },
        error: function(jqXHR,textStatus,errorThrown){
            if(errorThrown == 'Unauthorized'){
                swal({
                    icon:'error',
                    title:'Oops...',
                    text:'You must logged in to do this !'
                })
                $('#modal').modal('hide');
            }
            else{
                swal({
                    icon:'error',
                    title:'Oops...',
                    text:'Something went wrong!'
                })
                $('#modal').modal('hide');
            }
        }
    });
    $('#modal').modal('show');
});