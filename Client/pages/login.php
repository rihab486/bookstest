  <!-- Contact Start -->

  <div class="container-fluid py-5 mb-5">
            <div class="container">
             
                <div >
                    <div class="row g-5 mb-5 justify-content-center">
                      
                        <div class="col-xl-4 col-lg-6 wow fadeIn" >
                            <div class="d-flex bg-light p-3 rounded">
                               
                                <div class="ms-3">
                                    <h4 class="text-primary">Login Form</h4>
                                  
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    <div class="row g-5 mb-5 justify-content-center">
                      
                        <div class="col-lg-6 text-align" >
                            <div class="p-5 rounded contact-form">
                               
                                <div class="mb-4">
                                    <input type="email" id="email" class="form-control border-0 py-3" placeholder="Your Email">
                                </div>
                                <div class="mb-4">
                                    <input type="password" id="password" class="form-control border-0 py-3" placeholder="Your Password">
                                </div>
                               
                                <div class="text-start">
                                    <button class="btn bg-primary text-white py-3 px-5 inline-elements" id="btnlogin" type="button">Signin</button>
                                    <a href="./index.php?page=register" class="nav-item nav-link inline-elements">Create Account</a>

                                    <br>
                                     <span id="msg1" style="display:none;">Please fill in all fields</span>
                                     <span id="msg2" style="display:none;" >Failed Password or Email!</span>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- Contact End -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
            $(document).ready(function () {

            $("#btnlogin").click(function (a) {
                a.preventDefault();
                $("#msg1").hide();
                $("#msg2").hide();
              
                var email = $("#email").val(); 
                var password = $('#password').val();
               
                if ((email == '') || (password == '') ) {

                    $("#msg1").attr("style","display:block;color: red;font-size: 14px;margin-top: 20px; text-align:center;");
                    $("#msg2").attr("style","display:none;");
            
                } else {

                    $.ajax({

                    type: "POST",
                    url: "../server/index.php?action=login",
                    data: {email: email,password:password},
                    success: function (response) {
                    console.log("test response",response)
                    if (response.error == 0){

                        $("#msg2").attr("style","display:block;color: red;font-size: 14px;margin-top: 20px; text-align:center;");
                        $("#msg1").attr("style","display:none;");
                    }
                    else{
                        $("#msg2").attr("style","display:none;");
                         var users = response.user;
                         var iduser =users.id
                         var firstname =users.firstname
                         var lastname =users.lastname
                         var email =users.email
                        // Sending the JavaScript variables to PHP

                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "../server/session_handler.php", true);
                        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                        xhr.send(JSON.stringify({
                            iduser: iduser,
                            firstname: firstname,
                            lastname: lastname,
                            email: email
                        }));


                        // console.log('userbyid',iduser);
                        window.location.href = './index.php?page=account';       

                        
                    }
                  
                    }

                    })
                }



                
                
      
           })});
</script>