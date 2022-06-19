

<?php 
    session_start();

    // database connection
    $link = mysqli_connect("localhost", "root", "", "twitter");

    if(mysqli_connect_errno()){

        exit();
    }

    // logout
    if(isset($_GET['function']) == "logout"){

        session_unset();
    }

    // function 2 min ago etc
    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    // display tweets function
    function displayTweets($type) {

        global $link;

        if($type == 'public'){

            $whereClause = "";
        
        } else if($type == 'isFollowing') {

            $query = "SELECT * FROM isFollowing WHERE `follower` = " .mysqli_real_escape_string($link, isset($_SESSION['id']));
            $result = mysqli_query($link, $query);

            $whereClause = "";

            while($row = mysqli_fetch_assoc($result)){

                if($whereClause == "") $whereClause = "WHERE";
                else $whereClause .= " OR ";

                $whereClause.= " userid = " .$row['isFollowing'];
            }

        } else if($type == 'yourtweets'){          

            $whereClause = "WHERE `userid`= ". mysqli_real_escape_string($link, $_SESSION['id']);

        }  else if($type == 'search'){          

            echo '<p>Showing search results for "'.mysqli_real_escape_string($link, $_GET['q']).'":</p>';
            $whereClause = "WHERE tweet LIKE '%". mysqli_real_escape_string($link, $_GET['q'])."%'";
            
        } else if(is_numeric($type)){          

            $whereClause = "WHERE userid = ".mysqli_real_escape_string($link, $type);
            $userQuery = "SELECT * FROM user WHERE `id` = ".mysqli_real_escape_string($link, $type)." LIMIT 1";
            $userQueryResult = mysqli_query($link, $userQuery);

            $user = mysqli_fetch_assoc($userQueryResult);

            echo "<h2>".mysqli_real_escape_string($link, $user['email']). "'s Tweets</h2>";
 
            
        }






        $query = "SELECT * FROM tweets ".$whereClause." ORDER BY `date_time` DESC LIMIT 10";

        $result = mysqli_query($link, $query);        

        if(mysqli_num_rows($result) == 0){

            echo "There are no results";

        } else {

            while($row = mysqli_fetch_assoc($result)){

              $userQuery = "SELECT * FROM user WHERE `id` = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
               $userQueryResult = mysqli_query($link, $userQuery);

                $user = mysqli_fetch_assoc($userQueryResult);
                
                echo "<div class=\"tweet\"><p><a href='?page=publicprofiles&userid=" .$user['id']."'>".$user['email']. "</a><span class=\"text-danger\"> ".time_since(time() - strtotime($row['date_time']))." ago</span></p>";

                echo "<p>".$row['tweet']."</p>";

                echo "<p><a href='#' class='toggleFollow' data-userId='".$row['userid']."'> Follow </a></p></div>";
            
                // below part is not done, because it is not working, when there is no Session variable

            //    echo $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower= ".mysqli_real_escape_string($link, isset($_SESSION['id']))." AND isFollowing= " .mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";


            //     $isFollowingResult = mysqli_query($link, $isFollowingQuery);
                
            //     if(mysqli_num_rows($isFollowingResult) > 0){   

            //        echo "Unfollow";

            //     } else{

            //         echo "Follow";
            //     }

            //     echo "</a></p></div>";

            
            }
        }

    }

    function displaySearch(){
        echo "<form class=\"form-inline\">       
        <div class=\"form-group \"> 
            <input type='hidden' name='page' value='search'>       
          <input type=\"text\" name=\"q\" class=\"form-control mr-1\" id=\"search\" placeholder='search'>
        </div>
        <button type=\"submit\" class=\"btn btn-primary \">Search tweets</button>
      </form>";
    }

    function displayTweetBox(){

        if(isset($_SESSION['id']) > 0){
            echo "
            <div id='tweetSuccess' class='alert alert-success'> Your tweet was posted successfuly!</div>
            <div id='tweetFail' class='alert alert-danger'></div>
            <div class=\"form\">
                <div class=\"form-group mb-2\">         
                <textarea type=\"text\" class=\"form-control\" id=\"tweetContent\"> </textarea>
                </div>
            
                <button id='postTweetButton' class=\"btn btn-primary mb-2\">Post Tweet</button>
            </div>";
        }
    }

    function displayUsers(){

        global $link;

        $query = "SELECT * FROM user LIMIT 10";

        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)){
            echo  "<p><a href='?page=publicprofiles&userid=".$row['id']."'>".$row['email']."</a></p>";
        }
    }
    
?>
