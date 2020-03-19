<?php include('includes/login.php'); ?>
<link href="css/styles.css" rel="stylesheet" type="text/css">


<div class="row index_row">

    <div class="col-md-5 col-sm-12">

        <div class="container-fluid index-login-form">


            <div class="mylogin">
                <div class="slide_one position">
                    <div class="text-box1">
                        <h1>LOGIN</h1>
                    </div>
                </div>

                <form method="post" action="index.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary text-center" name="submit_login">Login</button>

                        <button class=" btn btn-danger button1"> Register</button>
                        <!-- <a href="register_account.php">Register</a>-->
                    </div>
                </form>
            </div>

            <div class="myregister">
                <div class="slide_one position">
                    <div class="text-box1">
                        <h1>REGISTER</h1>
                    </div>
                </div>


                <form role="form" method="post" action="register_account.php" enctype="multipart/form-data">

                    <div class="form-group ">
                        <label for="fname"> First Name</label>
                        <input type="firstName" name="firstName" class="form-control" id="firstName" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword4">Last Name</label>
                        <input type="lastName" name="lastName" class="form-control" id="lastName" placeholder="Enter Last Name" </div>
                            
                            
                            
                            
                        <div class="form-group">
                            <label for="inputEmail4">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword4">Password</label>
                            <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password" required>
                        </div>
                        
                        
                        
                        
                        <!-- Student/Faculty Registry -->
                
            <div class="form-group ">
            <label class="control-label" for="userType"></label>
            
              <select type="userType" name="userType" class="form-control" id="userType" required >
                  <option value="">Are you a student or faculty member?</option>
                  <option value="Student">Student</option>
                  <option value="Faculty">Faculty</option>
              </select>
            </div>
            
          <!-- Admin Registry -->

            <div class="form-group ">
            <label class="control-label " for="admin"></label>
            
              <select type="" name="admin" class="form-control" id="admin" >
                  <option value="">Would you like to become an admin?</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
              </select>
               </div>                       
                        
                     <div class="form-group">

                      <div class="checkbox">
                         <label><input type="checkbox" required> Accept</label>
                        </div>
                        </div>
                    </div>
                    <!-- Register/Cancel Buttons -->
                    <div class="form-group">
                        <div class=" text-center">
                            <button type="submit" class="btn btn-primary " name="submit_registry">Register</button>
                            <button class=" btn btn-danger button2"> LOGIN</button>
                        </div>
                    </div>
            </div>
            </form>


        </div>


    </div>







    <div class="col-md-7   index_page">

        <div class="index_banner1">
            <img src="images/happy_face_one.jfif" alt="" />
        </div>


        <div class="index_banner2">
            <img src="images/lady_watching.jfif" alt="" />
        </div>


        <div class="index_banner3">
            <img src="images/balloon.jfif" alt="" />
        </div>

        <div class="index_banner4">
            <img src="images/happy_face_two.jfif" alt="" />
        </div>


    </div>
</div>



<script>
    $(document).ready(function() {

        $(".myregister").hide();
        $(".button1").click(function() {
            $(".myregister").fadeIn("slow").show();
            $(".mylogin").hide();
        });
        $(".button2").click(function() {
            $(".myregister").hide();
            $(".mylogin").fadeIn("slow").show();
        });

    });

</script>
