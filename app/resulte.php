<?php 
include 'head.php';

$event_teamnumber = $_GET["event-teamnumber"];

if (is_numeric($event_teamnumber)) {
  $ch_name = curl_init("http://10.5.0.4:8000/api/team/$event_teamnumber");
          curl_setopt($ch_name, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch_name, CURLOPT_HEADER, 0);
          $data_name = curl_exec($ch_name);
          curl_close($ch_name);
          
          $resulteObj = json_decode($data_name, true);
} else {
  $ch_number = curl_init("http://10.5.0.4:8000/api/event/$event_teamnumber");
          curl_setopt($ch_number, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch_number, CURLOPT_HEADER, 0);
          $data_number = curl_exec($ch_number);
          curl_close($ch_number);
          
          $resulteObj = json_decode($data_number, true);
}

?>
    <h2 class="text-center"><?php echo $eventName ?></h2>
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
          if (is_numeric($event_teamnumber)) {
            if ($resulteObj == null) {
              echo "Event not found error null one";
            } else if ($resulteObj == "null") {
              echo "Event not found error null two";
            } else {
                $MatchID = $resulteObj[0]["MatchID"];
                $TeamNumber = $resulteObj[0]["TeamNumber"];
                $MatchOne = $resulteObj[0]["MatchScoreOne"];
                $MatchTwo = $resulteObj[0]["MatchScoreTwo"];
                $MatchThree = $resulteObj[0]["MatchScoreThree"];

                echo "
                  <th>$MatchID</th>
                  <th>$TeamNumber</th>
                  <th>$MatchOne</th>
                  <th>$MatchTwo</th>
                  <th>$MatchThree</th>
                  </tr>
                  ";
            }
          } else {
            if ($resulteObj == null) {
              echo "Event not found error null one";
            } else if ($resulteObj == "null") {
              echo "Event not found error null two";
            } else if ($resulteObj[0]["Match"] == null) {
              echo "Event not found error matchs not found";
            } else {
              for ($i = 0; $i <= count($resulteObj[0]["Match"]) -1; $i++) {
                $MatchID = $resulteObj[0]["Match"][$i]["MatchID"];
                $TeamNumber = $resulteObj[0]["Match"][$i]["TeamNumber"];
                $MatchOne = $resulteObj[0]["Match"][$i]["MatchScoreOne"];
                $MatchTwo = $resulteObj[0]["Match"][$i]["MatchScoreTwo"];
                $MatchThree = $resulteObj[0]["Match"][$i]["MatchScoreThree"];

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
          }
          ?>
        </tbody>
      </table>

<?php
include 'foot.php'

?>