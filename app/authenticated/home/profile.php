<?php
    include 'header.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
   
        $userName = trim($_POST["username"]);
    
        $password = trim($_POST['pass']);
           
        $password = trim($_POST['pass-confirm']);
    
        if ($_POST["pass"] != $_POST["pass-confirm"]) {
            $password_err = "please match passwords";
            $repeatPassword_err = "please match passwords";
        }
    
        if( empty($password_err) && empty($repeatPassword_err)) {
            
            $registerUrl = 'http://10.5.0.4:8000/api/v1/auth/user/updateuser';
            $registerData = array('UserID' => $_SESSION["userID"],
                                  'Password' => $password,
                                  'UserName' => $userName,
                                //   'Level' => 1, 
                                  );
        
            // use 1 'http' even if you send the request to https://...
            $registeroptions = array(
              'http' => array(
                  'header' => 'Authorization: Bearer '. $_SESSION["token"],
                  'method'  => 'POST',
                  'content' => http_build_query($registerData)
              )
            );
            $registerContext  = stream_context_create($registeroptions);
            $registerResult = file_get_contents($registerUrl, false, $registerContext);
    
            $registerResult = json_decode($registerResult, true);

        }
    }

?>        
<!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Profile Page</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7">
                        <!-- <div class="text-right upgrade-btn">
                            <a href="https://wrappixel.com/templates/xtremeadmin/" class="btn btn-danger text-white" target="_blank">Upgrade to Pro</a>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">User Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="username" placeholder="<?php echo $_SESSION["username"]; ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">New Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="pass" placeholder="your password" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="pass-confirm" placeholder="your password" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <p>blanks will not change</p>
                                            <button type="submit" class="btn btn-success">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Fllevent © 2018-2019
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
<?php
    include 'footer.php';
?>