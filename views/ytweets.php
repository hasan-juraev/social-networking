<div class="container">

    <div class="row py-5">

        <div class="col-md-8">
            
            <h2>Your tweets</h2>
            

            <!-- display tweets from database -->
            <?php   displayTweets('yourtweets'); ?>
            
        </div>

        <div class="col-md-4">

            <?php displaySearch(); ?>

            <hr>

            <?php displayTweetBox(); ?>

        </div>

    </div>

</div>