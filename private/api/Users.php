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

        echo json_encode($results);
    }
}