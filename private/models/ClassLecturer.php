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
}