<?php

class Users extends Controller
{
    function index()
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

        $classes_lecturer = new ClassLecturer();
        foreach($results as key $result)
        {
            $added = $classes_lecturer->query("SELECT * FROM classes_lecturers WHERE class_id = :class_id && user_id = :user_id", [
                "class_id"=>$decode['class_id'],
                "user_id"=>$result->user_id
            ])

            if($added) {
                $result['added'] = true;
            }
            else {
                $result['added'] = false;
            }
        }

        echo json_encode($results);
    }
}