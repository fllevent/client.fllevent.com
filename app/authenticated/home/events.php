<?php
    include 'header.php';
?>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Your Events</h4>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Your Events</h4>
                                <h6 class="card-subtitle">This is the place that all of your events will show up for you to manage</h6>
                                <!-- <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Table With Outside Padding</h6> -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Event Name</th>
                                                <th scope="col">Location</th>
                                                <th scope="col">Year</th>
                                                <th scope="col">Edit Event</th>
                                                <th scope="col">Remove Event</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ch = curl_init("http://10.5.0.4:8000/api/v1/event/allevents");
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                curl_setopt($ch, CURLOPT_HEADER, 0);
                                                $data = curl_exec($ch);
                                                curl_close($ch);

                                                $eventsObj = json_decode($data, true);

                                                for ($i = 0; $i <= count($eventsObj) -1; $i++) {
                                                    if ($eventsObj[$i]["Owner"] == $_SESSION["userID"]) {
                                                        $EventID = $eventsObj[$i]["EventID"];
                                                        $EventName = $eventsObj[$i]["EventName"];
                                                        echo "
                                                        <th> $EventID </th>
                                                        <th><a href='result?event-teamnumber=$EventName'>$EventName</a></th>
                                                        <th> N/A </th>
                                                        <th> 2018 </th>
                                                        <th><a href='result?event-teamnumber=$EventName' class='btn btn-primary' role='button'>Edit</a></th>
                                                        <th><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#remove-confirm'>Remove</button></th>
                                                      
                                                         </tr>
                                                        "; 
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

        <!-- Modal -->
        <div class="modal fade" id="remove-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Event conformation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>This is permanent there is no recovery</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger"><a href='/authenticated/home/removeevent?eventname=<?php echo $EventName; ?>' >Remove the Event</a></button>
              </div>
            </div>
          </div>
        </div>
<?php
    include 'footer.php';
?>