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

    function add_lecturer()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $input = file_get_contents("php://input");
        $decode = json_decode($input, true);
        
        $decode['date'] = date("Y-m-d H:i:s");
        $decode['disabled'] = 0;

        $class_lecturer = new ClassLecturer();
        if($class_lecturer->validate($decode))
        {
            $class_lecturer->insert($decode);
        }
            

        echo json_encode($decode);
    }
}

?>