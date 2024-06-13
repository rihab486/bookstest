  <div class="container-fluid py-5 mb-5">
            <div class="container">
             
                <div >
                    <div class="row g-5 mb-5 justify-content-center">
                      
                        <div class="col-xl-4 col-lg-6 wow fadeIn" >
                            <div class="d-flex bg-light p-3 rounded">
                               
                                <div class="ms-3">
                                    <h4 class="text-primary ">Register Form</h4>
                                  
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    <div class="row g-5 mb-5 justify-content-center">
                      
                        <div class="col-lg-6 text-align" >
                            <div class="p-5 rounded contact-form">
                                <div class="mb-4">
                                    <input type="text" class="form-control border-0 py-3" id="firstname" placeholder="Your Firstname">
                                </div>
                                <div class="mb-4">
                                    <input type="text" class="form-control border-0 py-3" id="lastname" placeholder="Your Lastname">
                                </div>
                                <div class="mb-4">
                                    <input type="email" class="form-control border-0 py-3" id="email" placeholder="Your Email">
                                </div>
                                <div class="mb-4">
                                    <input type="password" class="form-control border-0 py-3" id="password" placeholder="Your Password">
                                </div>
                              
                                <div class="text-start">
                                    <button class="btn bg-primary text-white py-3 px-5" id="btnregister" type="button">Register</button>
                                        <br>
                                     <span id="msg1" style="display:none;">Please fill in all fields</span>
                                     <span id="msg3" style="display:none;" >Password must be at least 5 characters long</span>
                                     <span id="msg2" style="display:none;" >Exist Email !</span>
                                     <span id="msg4" style="display:none;" >Error !</span>


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

            $("#btnregister").click(function (a) {
                a.preventDefault();
                $("#msg1").hide();
                $("#msg3").hide();
                $("#msg2").hide();
                $("#msg4").hide();
                var firstname = $("#firstname").val(); 
                var lastname = $("#lastname").val(); 
                var email = $("#email").val(); 
                var password = $('#password').val();
               
                // console.log(firstname,email,password);
                if ((firstname == '')||(lastname == '')||(email == '') || (password == '') ) {

                    $("#msg1").attr("style","display:block;color: red;font-size: 14px;margin-top: 20px; text-align:center;");

                }else if( password.length <= 5){
                    $("#msg3").attr("style","display:block;color: red;font-size: 14px;margin-top: 20px; text-align:center;");
                    $("#msg1").attr("style","display:none;");
                    $("#msg2").attr("style","display:none;");
                    $("#msg4").attr("style","display:none;"); 

                } else  {

                    $.ajax({

                    type: "POST",
                    url: "../server/index.php?action=ValidationEmail",
                    
                    data: {email: email},
                    
                    success: function (response) {
                    
                    //console.log('test',response); // Output: 1
                    
                        if (response== 1){
                            $("#msg2").attr("style","display:block;color: red;font-size: 14px;margin-top: 20px; text-align:center;");
                            $("#msg1").attr("style","display:none;");
                            $("#msg3").attr("style","display:none;"); 
                            $("#msg4").attr("style","display:none;"); 

                        }else{

                                        $.ajax({

                                            type: "POST",
                                            url: "../server/index.php?action=insert",
                                            
                                            data: {firstname:firstname, lastname:lastname ,email: email,password:password},
                                        
                                            success: function (response) {
                                        
                                            var resultsValue = response.results;

                                            //console.log('test',resultsValue); // Output: 1
                                        
                                            if (resultsValue== 0){
                                                $("#msg4").attr("style","display:block;color: red;font-size: 14px;margin-top: 20px; text-align:center;");
                                                $("#msg1").attr("style","display:none;");
                                                $("#msg2").attr("style","display:none;"); 
                                                $("#msg3").attr("style","display:none;"); 

                                            }else{
                                                window.location.href = './index.php?page=login';

                                            }}

                                            });
                    
                            
                            }
                        }

                         })
                }



                
                
      
           })});
</script>