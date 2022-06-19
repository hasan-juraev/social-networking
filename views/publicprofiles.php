<div class="container">
    <div class="row py-5">
        <div class="col-md-8">
            
            
    
            <?php if(isset($_GET['userid'])){ ?>

            <?php displayTweets($_GET['userid']); ?>

            <?php } else {?>

                <h2>Active Users</h2>
                <?php displayUsers(); ?>

            <?php } ?>            
        </div>

        <div class="col-md-4">

            <?php displaySearch(); ?>

            <hr>

            <?php displayTweetBox(); ?>

        </div>

    </div>
</div>