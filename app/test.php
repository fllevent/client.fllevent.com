echo("event#2");
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