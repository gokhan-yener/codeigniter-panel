
<script src="<?php echo base_url("assets/"); ?>admin/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'editor1' );
</script>



<!-- DataTables.net Plugin, full documentation here: https://datatables.net/-->
<script src="<?php echo base_url();?>assets/admin/default/js/plugins/jquery.datatables.js"></script>
<script src="<?php echo base_url();?>assets/admin/_scripts/dropzone.js"></script>


<script type="text/javascript">

    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Arama",
                "url": "<?php echo base_url()?>assets/admin/_scripts/Turkish.json"
            }

        });

$("#filebtn").on("click",function () {
    $(".btn-file").trigger("click");
    $("#addBtn").prop( "disabled", false );
});

    });

</script>





