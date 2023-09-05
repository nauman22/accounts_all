<?php

class Employee_table_model extends CI_Model 
{
    private $table;

    function __construct() {
        parent::__construct(); 
        $this->$table = "tbl_employee";
    }

    function allposts_count()
    {   
        $query = $this
        ->db
        ->where('is_active',1)
        ->get($this->$table);

        return $query->num_rows();  

    }

    function allposts($limit,$start,$col,$dir)
    {   
        $query = $this
        ->db
        ->where('is_active',1)
        ->limit($limit,$start)
        ->order_by($col,$dir)
        ->get($this->$table);

        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }

    }

    function posts_search($limit,$start,$search,$col,$dir)
    {
        $query = $this
        ->db
        ->where('is_active',1)
        ->like('id',$search)
        ->or_like('user_id',$search)
        ->or_like('type',$search)
        ->or_like('amount',$search)
        ->or_like('date',$search)
        ->limit($limit,$start)
        ->order_by($col,$dir)
        ->get($this->$table);


        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count($search)
    {
        $query = $this
        ->db
        ->where('is_active',1)
        ->like('id',$search)
        ->or_like('user_id',$search)
        ->or_like('type',$search)
        ->or_like('amount',$search)
        ->or_like('date',$search)
        ->get($this->$table);

        return $query->num_rows();
    } 

}