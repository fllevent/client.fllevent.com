    <?php
        include 'head.php';
    ?>
    
    <section class="hero" >
        <h1 class="display-4 text-center head">Welcome to FllEvent</h1>
        <p class="text-center subhead">Where Live Fll Event Scores Happen&nbsp;</p>
        <p class="hero-fill">Search for you're team number or the event your at to see the latest live results</p>
        <form class="form-inline hero-fill" method="get" action="result">
            <div class="form-group"><input class="form-control" type="text" name = "event-teamnumber" placeholder="Search Team or Event" id="search-input"></div>
            <div class="form-group"><button class="btn btn-primary" type="submit">Search</button></div>
        </form>
        <p class="hero-fill">You can also look at past events that have been recorded to see how others have done in the past</p>
    </section>

    <?php
        include 'foot.php'
    ?>