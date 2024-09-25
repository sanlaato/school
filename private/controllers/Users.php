<?php

class Users extends Controller
{
    function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $user = new User();
        $school_id = Auth::getSchool_id();
        $data = $user->query("select * from users where school_id = :school_id && user_rank != 'student'", ['school_id'=>$school_id], ['get_school']);
       
        $this->view("users", ['rows'=>$data]);
    }

    function add()
    {
        $errors = array();
        if(count($_POST) > 0)
        {
            $user = new User();
            if($user->validate($_POST))
            {
                $_POST['date'] = date("Y-m-d H:i:s");

                $user->insert($_POST);
                $this->redirect('users');
            }
            else
            {
                $errors = $user->errors;
            }
        }
        $this->view("users.add", [
            'errors'=>$errors,
        ]);
    }

    function switch_school($school_id)
    {
        Auth::switch_school($school_id);
        $this->redirect('schools');
    }
}