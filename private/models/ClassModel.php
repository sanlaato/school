<?php

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $allowedColumns = [
        'class', 
        'date',
    ];

    protected $beforeInsert = [
        'make_class_id',
        'make_user_id', 
        'make_school_id'
    ];

    protected $afterSelect = [
        'get_user'
    ];

    public function validate($DATA)
    {
        $this->errors = array();

        if(empty($DATA['class']))
        {
            $this->errors['class'] = "Only letters allowed in school name";
        }

        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }

    public function make_class_id($data) {
        $data['class_id'] = random_string(60);
        return $data;
    }

    public function make_user_id($data) {
        if(isset($_SESSION['USER']->user_id)) {
            $data['user_id'] = Auth::getUser_id();
        }
        return $data;
    }

    public function make_school_id($data) {
        if(isset($_SESSION['USER']->school_id)) {
            $data['school_id'] = Auth::getSchool_id();
        }
        return $data;
    }

    public function get_user($data) {

        $user = new User();
        foreach($data as $key => $row) {
            $result = $user->where('user_id', $row->user_id);
            $data[$key]->user = is_array($result) ? $result[0] : false;
        }

        return $data;
    }
}