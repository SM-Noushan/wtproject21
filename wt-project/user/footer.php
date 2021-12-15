    <footer class="py-2 bg-dark" id="footer" style="clear: both; position: relative; height: 75px; margin-top: 220px;">
        <p class="m-6 text-center text-white">Developed by Group 02</p>
        <p class="m-0 text-center text-white">Webtech [P] Fall-21/22</p>
    </footer>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.login').click(function(event){
                event.stopPropagation();
                event.stopImmediatePropagation();
                $('#loginModal').modal('show');
                return false;
            });

            $('#loginButton').click(function(){
                var username = $('#email').val();
                var password = $('#pass').val();

                if(username == '' || password == ''){
                    $('#help').html("Empty fields not allowed");
                }
                else{
                    //ajax
                    $.ajax({
                        url: "/wt-project/user/loginprocess.php",
                        method: "post",
                        dataType: "text",
                        data:{username:username, password:password},
                        success:function(msg){
                            if(msg == 1){
                                window.location.href = window.location.href;
                            }
                            else{
                                $('#help').html("Invalid username or password");
                            }
                        }
                    });
                }
            });

            livecart();
                function livecart(){
                    //ajax to update cart
                    $.ajax({
                        url: "/wt-project/user/livecart.php",
                        method: "post",
                        dataType: "text",
                        success:function(data){
                            $('#livecart').html(data);
                        }
                    });
                }

            //$('button[type=button]').click(function(){
                $('.xbtn').click(function(){
                var id = $(this).attr("id");
                var bookid = $('#bookid'+id+'').val();
                var bookname = $('#bookname'+id+'').val();
                var price = $('#price'+id+'').val();
                var image = $('#image'+id+'').val();
                var quantity = 1;
                var action = "add-to-cart";

                //ajax
                $.ajax({
                    url: "/wt-project/user/cartprocess.php",
                    method: "post",
                    dataType: "text",
                    data:{bookid:bookid, bookname:bookname, price:price, image:image, quantity:quantity, action:action},
                    success:function(msg){
                        livecart();
                        $('#status').html(msg);
                        window.setTimeout(function(){
                            $(".alert").fadeTo(500,0).slideUp(500,function(){
                                $(this).remove();
                            });
                        }, 2000);
                    }
                });
            });
        });

        $(document).ready(function(){
          $('#cartmsg').delay(2000).fadeOut(300);
        });

        $('#checkout').click(function(){
            $('#checkoutform').addClass('was-validated')
        });
    </script>
</body>
</html>