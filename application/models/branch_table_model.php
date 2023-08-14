<?php

class Branch_table_model extends CI_Model 
{

    function __construct() {
        parent::__construct(); 

    }

    function allposts_count()
    {   
        $query = $this
        ->db
        ->where('is_active',1)
        ->get('tbl_branches');

        return $query->num_rows();  

    }

    function allposts($limit,$start,$col,$dir)
    {   
        $query = $this
        ->db
        ->where('is_active',1)
        ->limit($limit,$start)
        ->order_by($col,$dir)
        ->get('tbl_branches');

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
        ->or_like('name',$search)
        ->or_like('remarks',$search)
        ->limit($limit,$start)
        ->order_by($col,$dir)
        ->get('tbl_branches');


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
        ->or_like('name',$search)
        ->or_like('remarks',$search)
        ->get('tbl_branches');

        return $query->num_rows();
    } 

}