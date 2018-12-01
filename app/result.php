<?php
    include 'head.php';

    $event_teamnumber = $_GET["event-teamnumber"];
    


    if (is_numeric($event_teamnumber)) {
      $ch_name = curl_init("http://10.5.0.4:8000/api/v1/team/singleteam/$event_teamnumber");
              curl_setopt($ch_name, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch_name, CURLOPT_HEADER, 0);
              $data_name = curl_exec($ch_name);
              curl_close($ch_name);

              $resultObj = json_decode($data_name, true);
    } else {
      $ch_number = curl_init("http://10.5.0.4:8000/api/v1/event/singleevent/$event_teamnumber");
              curl_setopt($ch_number, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch_number, CURLOPT_HEADER, 0);
              $data_number = curl_exec($ch_number);
              curl_close($ch_number);

              $resultObj = json_decode($data_number, true);
    }
?>
    
    <section class="text-center events-mid">
        <h1>Results for <?php echo $event_teamnumber ?></h1>
    </section>
    <div class="bg-other">
      <table class="table">
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
              if ($resultObj == null) {
                echo "Event not found error null one";
              } else if ($resultObj == "null") {
                echo "Event not found error null two";
              } else {
                  $MatchID = $resultObj[0]["MatchID"];
                  $TeamNumber = $resultObj[0]["TeamNumber"];
                  $MatchOne = $resultObj[0]["MatchScoreOne"];
                  $MatchTwo = $resultObj[0]["MatchScoreTwo"];
                  $MatchThree = $resultObj[0]["MatchScoreThree"];
              
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
              if ($resultObj == null) {
                echo "Event not found error null one";
              } else if ($resultObj == "null") {
                echo "Event not found error null two";
              } else if ($resultObj[0]["Match"] == null) {
                echo "Event not found error matchs not found";
              } else {
                for ($i = 0; $i <= count($resultObj[0]["Match"]) -1; $i++) {
                  $MatchID = $resultObj[0]["Match"][$i]["MatchID"];
                  $TeamNumber = $resultObj[0]["Match"][$i]["TeamNumber"];
                  $MatchOne = $resultObj[0]["Match"][$i]["MatchScoreOne"];
                  $MatchTwo = $resultObj[0]["Match"][$i]["MatchScoreTwo"];
                  $MatchThree = $resultObj[0]["Match"][$i]["MatchScoreThree"];
                
                  echo "
                    <th>$MatchID</th>
                    <th><a href='result?event-teamnumber=$TeamNumber'>$TeamNumber</a></th>
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
    </div>

<?php
    include 'foot.php'
?>