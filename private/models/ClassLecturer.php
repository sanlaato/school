<?php

class ClassLecturer extends Model
{
    protected $table = 'classes_lecturers';

    protected $allowedColumns = [
        'class_id',
        'user_id',
        'disabled',
        'date',
    ];

    public function validate($DATA)
    {
        $this->errors = array();

        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
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