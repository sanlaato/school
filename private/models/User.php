<?php

class User extends Model
{
    // protected $table = 'users';

    protected $allowedColumns = [
        'firstname', 
        'lastname',
        'email',
        'password',
        'gender',
        'user_rank',
        'date',
    ];

    protected $beforeInsert = [
        'make_user_id', 
        'make_school_id',
        'hash_password',
    ];

    protected $afterSelect = [
        'get_school'
    ];

    public function validate($DATA)
    {
        $this->errors = array();

        if(empty($DATA['firstname']) || !preg_match('/^[a-zA-Z]+$/',$DATA['firstname']))
        {
            $this->errors['firstname'] = "Only letters allowed in first name";
        }

        if(empty($DATA['lastname']) || !preg_match('/^[a-zA-Z]+$/',$DATA['lastname']))
        {
            $this->errors['lastname'] = "Only letters allowed in first name";
        }

        // check for email
        if(empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email is not valid";
        }

        // check if email exists
        if(is_array($this->where('email', $DATA['email'])))
        {
            $this->errors['email'] = "That email is already in use";
        }

        $genders = ['male', 'female'];
        if(empty($DATA['gender']) || !in_array($DATA['gender'], $genders))
        {
            $this->errors['email'] = "Gender is not valid";
        }

        $ranks = ['student', 'reception', 'lecturer', 'admin', 'super_admin'];
        if(empty($DATA['user_rank']) || !in_array($DATA['user_rank'], $ranks))
        {
            $this->errors['user_rank'] = "Rank is not valid";
        }

        if(empty($DATA['password']) || $DATA['password'] != $DATA['password2'])
        {
            $this->errors['password'] = "The passwords do not match";
        }

        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }

    public function make_user_id($data) {
        $data['user_id'] = random_string(60);
        return $data;
    }

    public function make_school_id($data) {
        if(isset($_SESSION['USER']->school_id)) {
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }

    public function hash_password($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function get_school($data) {
        $school = new School();
        foreach($data as $key => $row) {
            $result = $school->where('school_id', $row->school_id);
            $data[$key]->school = is_array($result) ? $result[0] : false;
        }
        return $data;
    }
}