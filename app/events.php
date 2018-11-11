<?php 
include 'head.php';

?>
    <h2 class="text-center">Events</h2>
    <div class="table-responsive px-5">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Event Name</th>
            <th>Location</th>
            <th>Year</th>
          </tr>
        </thead>
        <tbody>         
          <?php
          $ch = curl_init("http://192.168.1.113:4000/api/events");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HEADER, 0);
          $data = curl_exec($ch);
          curl_close($ch);
          
          $eventsObj = json_decode($data, true);
            
          for ($i = 0; $i <= count($eventsObj) -1; $i++) {
              $EventID = $eventsObj[$i]["EventID"];
              $EventName = $eventsObj[$i]["EventName"];
              echo "
              <th>$EventID</th>
              <th><a href='resulte.php?event-teamnumber=$EventName'>$EventName</a></th>
              <th> N/A </th>
              <th> N/A </th>
              </tr>
              ";   
          }
          ?>

        </tbody>
      </table>

<?php
include 'foot.php'

?>