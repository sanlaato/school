<?php

class Students extends Controller
{
    function index($id = '')
    {
        echo "this is the students controller " . $id;
    }
}