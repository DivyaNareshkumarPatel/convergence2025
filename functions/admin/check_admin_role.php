<?php

if(isset($_COOKIE['admin_student_user'])) {
    echo "student";
}
else {
    echo "faculty";
}

?>