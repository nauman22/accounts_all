<?php
      
class Std_table_model extends CI_Model 
{
       
    function __construct() {
        parent::__construct(); 
        
    }

    function allposts_count()
    {   
        $query = $this
                ->db
              //  ->where('is_active',1)
                //->group_by('id')
                ->get('tblstd');
    
        return $query->num_rows();  

    }
    
    function allposts($limit,$start,$col,$dir)
    {   
        
        if($limit == "-1"){
            $limit = 10000;
        }
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->where('status is NULL or status = 0')
                //->group_by('id')
                ->get('tblstd');
        
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
       if(strtolower($search) == strtolower("Struck OFF") || strtolower($search) == strtolower("Quit") || strtolower($search) == strtolower("Leave wiht all dues paid")){
          if(strtolower($search) == strtolower("Struck OFF")){
             $search =1; 
          }
          else if(strtolower($search) == strtolower("Quit")){
             $search =2; 
          } 
          else if(str