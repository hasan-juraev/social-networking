<?php
    // functions
    include("functions.php");
    
    // header
    include("views/header.php");

    if ($_GET['page'] == 'timeline') {
        
        include("views/timeline.php");

    } else if($_GET['page'] == 'yourtweets'){

        include("views/ytweets.php");
        
    } else if($_GET['page'] == 'search'){
        
        include("views/search.php");
        
    } else if($_GET['page'] == 'publicprofiles'){
        
        include("views/publicprofiles.php");
        
    } else{
        // home
        include("views/home.php");
    }
        
    // footer
    include("views/footer.php");
?>