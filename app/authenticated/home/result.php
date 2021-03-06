<?php
    include 'header.php';

    $event_teamnumber = $_GET["event-teamnumber"];

    $ch_number = curl_init("http://10.5.0.4:8000/api/v1/event/singleevent/$event_teamnumber");
              curl_setopt($ch_number, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch_number, CURLOPT_HEADER, 0);
              $data_number = curl_exec($ch_number);
              curl_close($ch_number);

              $resultObj = json_decode($data_number, true);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $url = 'http://10.5.0.4:8000/api/v1/auth/matches/addmatch';

        $eventData = array('TeamName' => $_POST["team-name"],
                           'TeamNumber' => $_POST["team-number"],
                           'EventName' => $_GET["event-teamnumber"],
                           'MatchScoreOne' => $_POST["match-1"],
                           'MatchScoreTwo' => $_POST["match-2"],
                           'MatchScoreThree' => $_POST["match-3"],
                           'Year' => "2018",
                            );

        $options = array('http' => array(
          'method'  => 'POST',
          'header' => 'Authorization: Bearer '. $_SESSION["token"],
          'content' => http_build_query($eventData)
        ));
        $context  = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);


        $result = json_decode($result, true);

        $ch_number = curl_init("http://10.5.0.4:8000/api/v1/event/singleevent/$event_teamnumber");
              curl_setopt($ch_number, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch_number, CURLOPT_HEADER, 0);
              $data_number = curl_exec($ch_number);
              curl_close($ch_number);

              $resultObj = json_decode($data_number, true);

        // echo "<script>location.reload();</script>";
        
    }
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
                        <h4 class="page-title">Events</h4>
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
                            <h4 class="card-title"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTeam"> Create Team  </button></h4>
                                <!-- <h6 class="card-subtitle"></h6> -->
                                <!-- <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Table With Outside Padding</h6> -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Team Number</th>
                                            <th>Team Name</th>
                                            <th>Match #1</th>
                                            <th>Match #2</th>
                                            <th>Match #3</th>
                                            <th>Update Team</th>
                                            <th>Remove Team</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if ($resultObj == null) {
                                                    echo "Event not found error null one";
                                                } else if ($resultObj == "null") {
                                                  echo "Event not found error null two";
                                                } else if ($resultObj[0]["Match"] == null) {
                                                  echo "No matches found";
                                                } else {
                                                  for ($i = 0; $i <= count($resultObj[0]["Match"]) -1; $i++) {
                                                    $MatchID = $resultObj[0]["Match"][$i]["MatchID"];
                                                    $TeamNumber = $resultObj[0]["Match"][$i]["TeamNumber"];
                                                    $TeamName = $resultObj[0]["Match"][$i]["TeamName"];
                                                    $MatchOne = $resultObj[0]["Match"][$i]["MatchScoreOne"];
                                                    $MatchTwo = $resultObj[0]["Match"][$i]["MatchScoreTwo"];
                                                    $MatchThree = $resultObj[0]["Match"][$i]["MatchScoreThree"];
                                                  
                                                    echo "
                                                      <th>$MatchID</th>
                                                      <th>$TeamNumber</th>
                                                      <th>$TeamName<?th>
                                                      <th>$MatchOne</th>
                                                      <th>$MatchTwo</th>
                                                      <th>$MatchThree</th>
                                                      <th><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editteam'>Edit</button></th>
                                                      <th><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#remove-team'>Remove</button></th>
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
<div class="modal fade" id="editteam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h1>Any Blank Will Not be Changed</h1>
        <form method="post" action="/authenticated/services/editmatch?id=<?php echo $MatchID;?>&referance=<?php echo $_SERVER["REQUEST_URI"]; ?>">
            <div class="form-group">
              <label for="team-number" class="col-form-label">Team Number:</label>
              <input type="number" name="team-number"  class="form-control" id="team-number">
            </div>
            <div class="form-group">
              <label for="team-name" class="col-form-label">Team Name:</label>
              <input type="text" name="team-name" class="form-control" id="team-name">
            </div> 
            <div class="form-group">
              <label for="match-1" class="col-form-label">Match 1:</label>
              <input type="number" name="match-1" class="form-control" id="match-1">
            </div> 
            <div class="form-group">
              <label for="match-2" class="col-form-label">Match 2:</label>
              <input type="number" name="match-2" class="form-control" id="match-2">
            </div> 
            <div class="form-group">
              <label for="match-3" class="col-form-label">Match 3:</label>
              <input type="number" name="match-3"  class="form-control" id="match-3">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Team</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="createTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"] ;?>">
            <div class="form-group">
              <label for="team-number" class="col-form-label">Team Number:</label>
              <input type="number" name="team-number"  class="form-control" id="team-number">
            </div>
            <div class="form-group">
              <label for="team-name" class="col-form-label">Team Name:</label>
              <input type="text" name="team-name" class="form-control" id="team-name">
            </div> 
            <div class="form-group">
              <label for="match-1" class="col-form-label">Match 1:</label>
              <input type="number" name="match-1" class="form-control" id="match-1">
            </div> 
            <div class="form-group">
              <label for="match-2" class="col-form-label">Match 2:</label>
              <input type="number" name="match-2" class="form-control" id="match-2">
            </div> 
            <div class="form-group">
              <label for="match-3" class="col-form-label">Match 3:</label>
              <input type="number" name="match-3"  class="form-control" id="match-3">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Team</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="remove-team" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Team conformation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>This is permanent there is no recovery</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger"><a href='/authenticated/services/removematch?teamnumber=<?php echo $TeamNumber ?>&referance=<?php echo $_SERVER["REQUEST_URI"] ?>' >Remove the Team</a></button>
              </div>
            </div>
          </div>
        </div>

<?php
    include 'footer.php';
?>