<?php

class Model extends Database
{
    public $errors = array();

    public function __construct()
    {
        if(!property_exists($this, 'table'))
        {
            $this->table = strtolower($this::class) . "s";
        }
    }

    public function insert($data)
    {
        // remove unwanted columns
        if(property_exists($this, 'allowedColumns'))
        {
            foreach($data as $key => $column)
            {
                if(!in_array($key, $this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        // run functions before insert
        if(property_exists($this, 'beforeInsert'))
        {
            foreach($this->beforeInsert as $func)
            {
                $data = $this->$func($data);
            }
        }

        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values = implode(',:', $keys);

        $query = "insert into $this->table ($columns) values (:$values)";

        $check = $this->query($query, $data);
        if(is_array($check))
        {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key. "=:" . $key . ",";
        }
        $str = trim($str, ",");

        $data['id'] = $id;
        $query = "update $this->table set $str where id = :id";

        // SUCCESS QUERY return an empty array
        // FAILED QUERY return boolean false 
        $check = $this->query($query, $data);
        if(is_array($check))
        {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "delete from $this->table where id = :id";
        $data['id'] = $id;

        // SUCCESS QUERY return an empty array
        // FAILED QUERY return boolean false 
        $check = $this->query($query, $data);
        if(is_array($check))
        {
            return true;
        }
        return false;
    }

    public function first($column, $value, $afterSelect = array())
    {
        $data = $this->where($column, $value, $afterSelect);

        if($data)
        {
            return $data[0];
        }

        return false;
    }

    public function where($column, $value, $afterSelect = array())
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        $data = $this->query($query, [
            'value'=>$value
        ]);

        if(is_array($data) && count($data) > 0)
        {
            /*
            if(property_exists($this, 'afterSelect'))
            {
                foreach($this->afterSelect as $func)
                {
                    $data = $this->$func($data);
                }
            }
            */

            if(count($afterSelect) > 0)
            {
                foreach($afterSelect as $func)
                {
                    $data = $this->$func($data);
                }
            }

            return $data;
        }
        return false;
    }

    public function findAll($afterSelect = array())
    {
        $query = "select * from $this->table";
        $data = $this->query($query);

        if(is_array($data) && count($data) > 0)
        {
            /*
            if(property_exists($this, 'afterSelect'))
            {
                foreach($this->afterSelect as $func)
                {
                    $data = $this->$func($data);
                }
            }
            */

            if(count($afterSelect) > 0)
            {
                foreach($afterSelect as $func)
                {
                    $data = $this->$func($data);
                }
            }

            return $data;
        }
        return false;
    }
}