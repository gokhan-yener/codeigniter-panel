<?php $alert = $this->session->userdata("alert");

if($alert){
    ?>
    <?php $message = $this->session->userdata("alertMessage");?>
    <?php $type = $this->session->userdata("type");?>
    <script>
        $(document).ready(function(){

            // colorid type = ['','info', 'success', 'warning', 'danger', 'rose', 'primary'];
            demo.showNotification('top','right',"<?php echo $message;?>",<?php echo $type;?>);
            //demo.showNotification('top','right',"Hoşgeldin 3",3);


        })

    </script>
    <?php
    $this->session->set_userdata("alert",false);
}?>
