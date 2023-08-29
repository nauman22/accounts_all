<?php
      
class Cash_register_table_model extends CI_Model 
{
       
    function __construct() {
        parent::__construct(); 
        
    }

    function allposts_count()
    {   
        $query = $this
                ->db
                ->where('is_active',1)
                ->group_by('id')
                ->get('vw_cash_register');
    
        return $query->num_rows();  

    }
    
    function allposts($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->where('is_active',1)
                ->group_by('id')
                ->get('vw_cash_register');
        
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
                ->like('id',$search)
                ->or_like('category_name',$search)
                ->or_like('date',$search)
                ->or_like('amount',$search)
                ->or_like('description',$search)
                ->where('is_active',1)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->group_by('id')
                ->get('vw_cash_register');
                //echo $this->db->last_query();
                //exit();
       
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
               ->like('id',$search)
                ->or_like('category_name',$search)
                ->or_like('date',$search)
                ->or_like('amount',$search)
                ->or_like('description',$search)
                ->where('is_active',1)
                 ->group_by('id')
                ->get('vw_cash_register');
    
        return $query->num_rows();
    } 
   
}