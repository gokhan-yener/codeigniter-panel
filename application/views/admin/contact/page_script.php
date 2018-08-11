
<script src="<?php echo base_url("assets/"); ?>admin/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    CKEDITOR.replace( 'editor3' );
</script>


<!-- DataTables.net Plugin, full documentation here: https://datatables.net/-->
<script src="<?php echo base_url();?>assets/admin/default/js/plugins/jquery.datatables.js"></script>


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
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            }

        });

    });

</script>





