<?php

class Classes extends Controller
{
    function index($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $class = new ClassModel();
        if($id != null)
        {
            // show class details
            
            $first = $class->first('class_id', $id, ['get_user']);
            if($first)
            {
                $this->class_details($first);
            }
            else
            {
                $this->redirect('classes');
            }
        }
        else
        {
            // show all classes
            $data = $class->where('school_id', Auth::getSchool_id(),['get_user']);

            $crumbs[] = ['Dashboard', ''];
            $crumbs[] = ['Classes', 'classes'];
    
            $this->view("classes", [
                'rows'=>$data,
                'crumbs'=>$crumbs,
            ]);
        }
    }

    function add()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $errors = array();
        if(count($_POST) > 0)
        {
            $class = new ClassModel();
            if($class->validate($_POST))
            {
                $_POST['date'] = date("Y-m-d H:i:s");

                $class->insert($_POST);
                $this->redirect('/classes');
            }
            else
            {
                $errors = $class->errors;
            }
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = ['Add', 'classes/add'];

        $this->view("classes.add", [
            'errors'=>$errors,
            'crumbs'=>$crumbs,
        ]);
    }

    function edit($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $class = new ClassModel();
        $errors = array();
        if(count($_POST) > 0)
        {
            
            if($class->validate($_POST))
            {
                $class->update($id, $_POST);
                $this->redirect('/classes');
            }
            else
            {
                $errors = $class->errors;
            }
        }

        $row = $class->first('id', $id);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = ['Edit', 'classes/edit'];
        
        $this->view("classes.edit", [
            'row'=>$row,
            'errors'=>$errors,
            'crumbs'=>$crumbs,
        ]);
    }

    function delete($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $class = new ClassModel();
        $errors = array();
        if(count($_POST) > 0)
        {
            $class->delete($id);
            $this->redirect('/classes');
        }

        $row = $class->first('id', $id);
        
        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = ['Delete', 'classes/delete'];

        $this->view("classes.delete", [
            'row'=>$row,
            'crumbs'=>$crumbs,
        ]);
    }

    private function class_details($data)
    {
        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = [$data->class, ''];

        // determine which tab was clicked
        $tab = 'lecturers'; 
        if(isset($_GET['tab']))
        {
            $tab = $_GET['tab'];
        }

        // if search button was clicked
        $results = false;
        if(isset($_POST['search']) && $_POST['name'] != '')
        {
            $user = new User();
            $name = '%' . $_POST['name'] . '%';
            $results = $user->query("SELECT * FROM users WHERE (CONCAT(firstname, ' ', lastname) LIKE :name) && user_rank = 'lecturer' && school_id = :school_id", [
                'name'=>$name,
                'school_id'=>$data->school_id,
            ]);
        }

        $this->view("classes.details", [
            'row'=>$data,
            'crumbs'=>$crumbs,
            'tab'=>$tab,
            'results'=>$results
        ]);
    }
}