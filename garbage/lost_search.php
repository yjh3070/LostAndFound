<?php
    include ('connect.php');

    $subject = $_POST['subject'];
    $datefilter = $_POST['datefilter'];
    $type = $_POST['type'];
    $place = $_POST['place'];

    if($subject != ""){
        $search_subject = 'subject like "%'.$subject.'%"';
    }
    else{
        $search_subject = "";
    }

    if($datefilter != ""){
        $date = explode(" - ", $datefilter);
        $dateString0 = date("Y-m-d", strtotime($date[0]));
        $dateString1 = date("Y-m-d", strtotime($date[1]));
        $search_datefilter = 'date >= "'.$dateString0.'" and date <= "'.$dateString1.'"';
    }
    else
        $search_datefilter = "";

    if($type != "")
        $search_type = 'type_id = '.$type;
    else
        $search_type = "";

    if($place != "")
        $search_place = 'place = "'.$place.'"';
    else
        $search_place = "";

    $search_query = 'select * from lost where ';
    if($search_subject != "")
        $search_query = $search_query.$search_subject;

    if($search_subject != "" && $search_datefilter != "")
        $search_query = $search_query.' and ';

    if($search_datefilter != "")
        $search_query = $search_query.$search_datefilter;

    if(($search_subject != "" || $search_datefilter != "") && $search_type != "")
        $search_query = $search_query.' and ';
    
    if($search_type != "")
        $search_query = $search_query.$search_type;

    if(($search_subject != "" || $search_type != "" || $search_datefilter != "") && $search_place != "")
        $search_query = $search_query.' and ';

    if($search_place != "")
        $search_query = $search_query.$search_place;
    // $search_result = mysqli_query($con, $search_query);
    // $search_row = mysqli_fetch_array($search_result);

    $_SESSION['search_query'] = $search_query;

    echo '<script>location.href="lost.php?page=1";</script>';

    mysqli_close($con);
?>