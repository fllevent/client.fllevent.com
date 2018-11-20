    <?php
        include 'head.php';
    ?>
    
    <section class="text-center events-mid">
        <h1>Events</h1>
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
                        <th>Event Name</th>
                        <th>Location</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $ch = curl_init("http://10.5.0.4:8000/api/event/allevents");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        $data = curl_exec($ch);
                        curl_close($ch);

                        $eventsObj = json_decode($data, true);

                        for ($i = 0; $i <= count($eventsObj) -1; $i++) {
                            $EventID = $eventsObj[$i]["EventID"];
                            $EventName = $eventsObj[$i]["EventName"];
                            echo "
                            <th><a href='result?event-teamnumber=$EventName'>$EventName</a></th>
                            <th> N/A </th>
                            <th> 2018 </th>
                             </tr>
                            ";   
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
 
<?php
    include 'foot.php'
?>