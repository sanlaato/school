<?php

class Classes extends Controller
{
    function index($message = "")
    {
        if(!Auth::logged_in())
        {
            echo "Access Denied!";
        }

        $class = new ClassModel();
        $data = $class->where('school_id', Auth::getSchool_id(),['get_user']);
        echo json_encode($data);
    }
}

?>