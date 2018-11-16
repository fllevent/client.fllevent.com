<?php 
include 'head.php';

$ch_name = curl_init("http://10.5.0.4:8000/api/team/allteams");
          curl_setopt($ch_name, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch_name, CURLOPT_HEADER, 0);
          $data_name = curl_exec($ch_name);
          curl_close($ch_name);
          
          $resultObj = json_decode($data_name, true);

?>
    <h2 class="text-center">Teams</h2>
    <div class="table-responsive px-5">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Team Number</th>
            <th>Match #1</th>
            <th>Match #2</th>
            <th>Match #3</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if ($resultObj == null) {
              echo "Event not found error null one";
            } else if ($resultObj == "null") {
              echo "Event not found error null two";
            } else {
                for ($i = 0; $i <= count($resultObj); $i++){
                    $MatchID = $resultObj[$i]["MatchID"];
                    $TeamNumber = $resultObj[$i]["TeamNumber"];
                    $MatchOne = $resultObj[$i]["MatchScoreOne"];
                    $MatchTwo = $resultObj[$i]["MatchScoreTwo"];
                    $MatchThree = $resultObj[$i]["MatchScoreThree"];

                    echo "
                      <th>$MatchID</th>
                      <th>$TeamNumber</th>
                      <th>$MatchOne</th>
                      <th>$MatchTwo</th>
                      <th>$MatchThree</th>
                      </tr>
                      ";
                }
            }
          ?>
        </tbody>
      </table>

<?php
include 'foot.php'

?>