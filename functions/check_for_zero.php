<?php

$no_of_events = $_POST['no_of_events'];

if($no_of_events == 0) {
    echo 0;
}
else {
    echo 1;
}

?>