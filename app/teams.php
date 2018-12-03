<?php
    include 'head.php';
    
    $ch_name = curl_init("http://10.5.0.4:8000/api/v1/team/allteams");
    curl_setopt($ch_name, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_name, CURLOPT_HEADER, 0);
    $data_name = curl_exec($ch_name);
    curl_close($ch_name);

    $resultObj = json_decode($data_name, true);

?>
    <section class="text-center events-mid">
        <h1>Teams</h1>
    </section>
    <div class="bg-other">
        <form class="form-inline hero-fill" method="get" action="result">
                <div class="form-group"><input class="form-control" type="text" name = "event-teamnumber" placeholder="Search Team or Event" id="search-input"></div>
                <div class="form-group"><button class="btn btn-primary" type="submit">Search</button></div>
        </form>
        <div class="table-responsive teams-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Team Number</th>
                        <th>Team Name </th>
                        <th>Location</th>
                        <!-- <th>Match #2</th>
                        <th>Match #3</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($resultObj == null) {
                          echo "Event not found error null one";
                        } else if ($resultObj == "null") {
                          echo "Event not found error null two";
                        } else {
                            for ($i = 0; $i <= count($resultObj) -1; $i++){
                                $MatchID = $resultObj[$i]["MatchID"];
                                $TeamNumber = $resultObj[$i]["TeamNumber"];
                                $TeamName = $resultObj[$i]["TeamName"];
                                $MatchOne = $resultObj[$i]["MatchScoreOne"];
                                // $MatchTwo = $resultObj[$i]["MatchScoreTwo"];
                                // $MatchThree = $resultObj[$i]["MatchScoreThree"];
                            
                                echo "
                                  <th><a href='result?event-teamnumber=$TeamNumber'>$TeamNumber</a></th>
                                  <th><a href='result?event-teamnumber=$TeamNumber'>$TeamName</th>
                                  <th> N/A </th>
                                  </tr>
                                  ";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
    include 'foot.php'
?>