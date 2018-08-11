</div>
</div>
<footer class="footer ">

    <div class="container">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="#">
                        GY
                    </a>
                </li>


            </ul>
        </nav>
        <div class="copyright pull-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
            <i class="material-icons">favorite</i>
            <a href="#">Web Master Gökhan Y.</a>
        </div>
    </div>


</footer>


</div>

</div>

</body>

</html>

<?php $this->load->view('admin/inc/script'); ?>

<script type="text/javascript">
    $().ready(function () {
        demo.checkFullPageBackgroundImage();

        setTimeout(function () {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 200)
    });
</script>

