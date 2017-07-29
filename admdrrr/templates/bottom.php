                    <link rel="stylesheet" href="../../css/admin.css">
                    <style>
                        #menu-text{
                            color: white;
                            font-size: 1.2em
                        }

                        #menu-text:hover{
                            opacity: .2;
                        }

                        .footer-gp{
                            background-color: #4373d3;
                            text-align: center;
                        }
                    </style>
                        
                    </div><!--end of panel-body beginning in top.php-->
                </div>
            </div>
            
        </div>
        <!--FOOTER CONTENT background-color: #2e353d--> 
            <footer class="pull-left footer footer-gp">
                <p class="col-md-12">
                    <!--<hr class="divider">-->
                    <p id='menu-text'>You're logged in as [Admin]</p>
                    <?php date_default_timezone_set('Africa/Lagos');
                    $today = date("M d, Y g:iA"); ?>
                    <p id='menu-text'>&copy; <?php echo date("Y"); ?> <span style="color:gold; text-decoration:none;"> Directorate of Information Technology. Nigerian Air Force.</span> All Rights Reserved.</p>  
                    <p class="footer-links">
                        <a href="#" id='menu-text'>Home |</a>
                        <a href="../logout.php" id='menu-text'>Logout |</a>
                        <a href="#" id='menu-text'>Contact Us</a>
                    </p>
                </p>
                
                
                                       
            </footer>
            <!-- END OF FOOTER CONTENT -->
        
        <script type="text/javascript">
            $(function () {
                $('.navbar-toggle-sidebar').click(function () {
                    $('.navbar-nav').toggleClass('slide-in');
                    $('.side-body').toggleClass('body-slide-in');
                    $('#search').removeClass('in').addClass('collapse').slideUp(200);
                });
            });
        </script>


    </body>
</html>