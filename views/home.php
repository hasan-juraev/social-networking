
<div class="container">
    <div class="row py-5">
        <div class="col-md-8">
            <h3 id="header3">Recent tweets</h3>           

            <!-- display tweets from database -->
            <?php   displayTweets("public"); ?>
            
        </div>

        <div class="col-md-4">
        
            <?php displaySearch(); ?>
      
            <hr>
        
            <?php displayTweetBox(); ?>
        
        </div>

    </div>
</div>