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

    function list_all_lecturers()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $input = file_get_contents("php://input");
        $decode = json_decode($input, true);

        $class_lecturer = new ClassLecturer();
        $results = $class_lecturer->query("SELECT * FROM classes_lecturers WHERE class_id = :class_id", ['class_id'=>$decode['class_id']],  ['get_user']);

        echo json_encode($results);
    }

    function search_lecturers()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $input = file_get_contents("php://input");
        $decode = json_decode($input, true);

        $user = new User();
        $search_input = '%' . $decode['search_input'] . '%';
        $results = $user->query("SELECT * FROM users WHERE (CONCAT(firstname, ' ', lastname) LIKE :name) && school_id = :school_id", [
            'name'=>$search_input,
            'school_id'=>Auth::getSchool_id()
        ]);

        $class_lecturer = new ClassLecturer();
        foreach($results as $key => $row)
        {
            $added = $class_lecturer->query("SELECT * FROM classes_lecturers WHERE class_id = :class_id && user_id = :user_id", [
                'class_id'=>$decode['class_id'],
                'user_id'=>$row->user_id
            ]);

            if($added) {
                $results[$key]->added = true;
            }
            else {
                $results[$key]->added = false;
            }
        }

        echo json_encode($results);
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