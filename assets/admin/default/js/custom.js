$(document).ready(function () {

    $(".sortable").sortable();

    $( ".sortable" ).on( "sortupdate", function( event, ui ) {
        var data = $(this).sortable("serialize");
        var url = $(this).data("url");

        $.ajax({
            url:url,
            method:"POST",
            data:{'data':data},
            dataType:'json',
            success:function (response) {

                if(response.result == true){
                    demo.showNotification('top','right',"Sıralama Güncellendi",2);
                }else{
                    demo.showNotification('top','right',"Hata Oluştu",3);
                }
            },
            error:function (err) {
                demo.showNotification('top','right',"Hata Oluştu",3);
            }

        })




    });

    $(".isActive").change(function () {

    var dataId = $(this).attr("dataId");
    var url = $(this).attr("dataUrl");

    $.ajax({
        url:url,
        method:"POST",
        data:{id:dataId},
        dataType:'json',
        success:function (response) {

            if(response.result == true){
                demo.showNotification('top','right',"Durum Güncellendi",2);
            }else{
                demo.showNotification('top','right',"Hata Oluştu",3);
            }
        },
        error:function (err) {
            demo.showNotification('top','right',"Hata Oluştu",3);
        }

    })
});

    $('.magnific').magnificPopup({type:'image'});




});


$(".removeBtn").click(function (){


    var dataUrl = $(this).attr("dataUrl");
    //var remove= demo.showSwal('warning-message-and-confirmation');
    swal({
        title: 'Kayıt Silme !!!',
        text: "Silmek istediğinizden emin misiniz?",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Hayır',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        confirmButtonText: 'Evet',
        buttonsStyling: false
    }).then(function() {
        window.location.href=dataUrl;
    })

});




