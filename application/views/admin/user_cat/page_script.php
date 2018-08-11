<script>
    $("document").ready(function () {


        $("#pagename").change(function () {
            var controllername = $(this).val();
            var group_id = $("#group_id").val();


            $.ajax({
                url:'<?php echo base_url()?>admin/user_cat/get_privileges_controller',
                method:'POST',
                data:{page:controllername,group_id:group_id},
                dataType:'json',
                success:function (r) {

                    var s = r.messages;
                    if (r.result == true) {

                            $("#access_auth_id").val(s.id);
                            $("#create").prop('checked',s.can_create == 1 ? true : false);
                            $("#update").prop('checked',s.can_update == 1 ? true : false);
                            $("#delete").prop('checked',s.can_delete == 1 ? true : false);
                            $("#read").prop('checked',s.can_read == 1 ? true : false);
                            $("#savebutton").html("Güncelle");
                            //demo.showNotification('top', 'right', response.messages, 2);

                    } else {

                        $("#access_auth_id").val("");
                        $("#create").prop('checked',false);
                        $("#update").prop('checked', false);
                        $("#delete").prop('checked', false);
                        $("#read").prop('checked', false);
                        $("#savebutton").html("Ekle");
                         demo.Notification('top', 'right', response.messages, 3);
                    }

                },
                error:function (err) {

                    demo.showNotification('top', 'right', response.messages, 3);
                }
            })
        });

        $("#savebutton").click(function () {

            var group_id = $("#group_id").val();
            var page = $("select#pagename").val();
            var aai = $("#access_auth_id").val();

            if(page ==""){
                demo.showNotification('top', 'right', 'Lütfen sayfa adı seçiniz', 3);
                return false;
            }

            var create = ($("#create").is(":checked") === true) ? 1 : 0;
            var del = ($("#delete").is(":checked") === true) ? 1 : 0;
            var update = ($("#update").is(":checked") === true) ? 1 : 0;
            var read = ($("#read").is(":checked") === true) ? 1 : 0;
            var data = {id: group_id, p: page, c: create, d: del, u: update, r: read, aai:aai};

            $.ajax({
                url: '<?php echo base_url();?>admin/user_cat/group_privileges_save',
                method: "POST",
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.result == true) {
                        $("#myModal").toggle();
                        demo.showNotification('top', 'right', response.messages, 2);
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    } else {
                        demo.showNotification('top', 'right', response.messages, 3);
                    }
                },
                error: function (err) {
                    demo.showNotification('top', 'right', response.messages, 3);
                },

            });

        });

    });


</script>




