<?php

class School extends Model
{
    // protected $table = 'users';

    protected $allowedColumns = [
        'school', 
        'date',
    ];

    protected $beforeInsert = [
        'make_user_id', 
        'make_school_id'
    ];

    public function validate($DATA)
    {
        $this->errors = array();

        if(empty($DATA['school']))
        {
            $this->errors['school'] = "Only letters allowed in school name";
        }

        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }

    public function make_user_id($data) {
        if(isset($_SESSION['USER']->user_id)) {
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        return $data;
    }

    public function make_school_id($data) {
        $data['school_id'] = random_string(60);
        return $data;
    }
}