<?php

class Profile extends Controller
{
    function index($user_id)
    {
        $user = new User();
        $row = $user->first('user_id', $user_id);

        $this->view("profile", [
            'row'=>$row,
        ]);
    }
}