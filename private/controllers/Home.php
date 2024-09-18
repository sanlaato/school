<?php

class Home extends Controller
{
    function index()
    {
        //$user = $this->load_model("User");
        $user = new User();
        //$data = $db->query("select * from users");
        //$data = $user->where('firstname', 'Maria');
        $data = $user->findAll();
        $this->view("home", ['rows'=>$data]);
    }
}