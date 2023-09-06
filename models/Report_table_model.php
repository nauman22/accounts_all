<?php

class Report_table_model extends CI_Model 
{

    function __construct() {
        parent::__construct(); 

    }

    function allposts_count($p_array)
    {   


         $this->db->select('*');
        //->order_by('id',"desc")
        if(isset($p_array['company'])){
            if($p_array['company'] != 0){
            $this->db->where('company_id', $p_array['company']);    
            }
        }
        if(isset($p_array['branch'])){
            if($p_array['branch'] != 0){
            $this->db->where('branch_id', $p_array['branch']);    
            }
        }
         if(isset($p_array['date_from'])){
            if($p_array['date_from'] != 0){
            $this->db->where('date >=', $p_array['date_from']);    
            }
        } 
        if(isset($p_array['date_to'])){
            if($p_array['date_to'] != 0){
            $this->db->where('date <=', $p_array['date_to']);    
            }
        }
        if(isset($p_array['type'])){
            if($p_array['type'] != 0){
            $this->db->where('type_id =', $p_array['type']);    
            }
        }
        if(isset($p_array['account'])){
            if($p_array['account'] != 0){
            $this->db->where('bank_id =', $p_array['account']);    
            }
        }
        if(isset($p_array['head'])){
            if($p_array['head'] != 0){
            $this->db->where('head_id =', $p_array['head']);    
            }
        }
        if(isset($p_array['category'])){
            if($p_array['category'] != 0){
            $this->db->where('category_id =', $p_array['category']);    
            }
        }
        if(isset($p_array['mode'])){
            if($p_array['mode'] != 0){
            $this->db->where('mode_id =', $p_array['mode']);    
            }
        }
        if(isset($p_array['emp'])){
            if($p_array['emp'] != 0){
            $this->db->where('user_id =', $p_array['emp']);    
            }
        }
         if(isset($p_array['wrkemp'])){
            if($p_array['wrkemp'] != 0){
            $this->db->where('wrkemp =', $p_array['wrkemp']);    
            }
        }
        $this->db->where('is_active',1);
         $this->db->group_by('id');  
        $query = $this->db->get('tbl_cash_register');
        return $query->num_rows();  

    }

    function allposts($limit,$start,$col,$dir,$p_array)
    {   
        if($limit == "-1"){
            $limit = 999999999999;
        }
        $this->db->limit($limit,$start)
        ->order_by($col,$dir);
        //->get('vw_cash_register');

         $this->db->select('(select name from tbl_type where id =tbl_cash_register.type_id ) as type_name,  
         (select name from tbl_bank where id =tbl_cash_register.bank_id ) as bank_name,
         (select name from tbl_head where id =tbl_cash_register.head_id ) as head_name,
         (select name from tbl_category where id =tbl_cash_register.category_id ) as category_name,
         (select branch_name from tbl_branch where id =tbl_cash_register.branch_id ) as branch_name,
         (select name from tbl_user where id =tbl_cash_register.wrkemp ) as work_employee,
         (select name from tbl_user where id =tbl_cash_register.user_id ) as collection_employee,
         (select name from tbl_mode where id =tbl_cash_register.mode_id ) as mode_name,
         (select name from tbl_company where id =tbl_cash_register.company_id ) as company_name,
         type_id,bank_id,head_id,category_id,user_id,mode_id,company_id,remarks,id,date, srno,
         description,amount
         
         ');
        //->order_by('id',"desc")
        if(isset($p_array['company'])){
            if($p_array['company'] != 0){
            $this->db->where('company_id', $p_array['company']);    
            }
        }
        if(isset($p_array['branch'])){
            if($p_array['branch'] != 0){
            $this->db->where('branch_id', $p_array['branch']);    
            }
        }
         if(isset($p_array['date_from'])){
            if($p_array['date_from'] != 0){
            $this->db->where('date >=', $p_array['date_from']);    
            }
        } 
        if(isset($p_array['date_to'])){
            if($p_array['date_to'] != 0){
            $this->db->where('date <=', $p_array['date_to']);    
            }
        }
        if(isset($p_array['type'])){
            if($p_array['type'] != 0){
            $this->db->where('type_id =', $p_array['type']);    
            }
        }
        if(isset($p_array['account'])){
            if($p_array['account'] != 0){
            $this->db->where('bank_id =', $p_array['account']);    
            }
        }
        if(isset($p_array['head'])){
            if($p_array['head'] != 0){
            $this->db->where('head_id =', $p_array['head']);    
            }
        }
        if(isset($p_array['category'])){
            if($p_array['category'] != 0){
            $this->db->where('category_id =', $p_array['category']);    
            }
        }
        if(isset($p_array['mode'])){
            if($p_array['mode'] != 0){
            $this->db->where('mode_id =', $p_array['mode']);    
            }
        }
        if(isset($p_array['emp'])){
            if($p_array['emp'] != 0){
            $this->db->where('user_id =', $p_array['emp']);    
            }
        }
        if(isset($p_array['wrkemp'])){
            if($p_array['wrkemp'] != 0){
            $this->db->where('wrkemp =', $p_array['wrkemp']);    
            }
        }
         $this->db->where('is_active',1);
          $this->db->group_by('id'); 
        $query = $this->db->get('tbl_cash_register');
        //echo $this->db->last_query();
        //exit();
     //   return $query->num_rows(); 
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }

    }

    function posts_search($limit,$start,$search,$col,$dir,$p_array)
    {
        $query = $this
        ->db
        ->like('id',$search)
        ->or_like('name',$search)
        ->or_like('address',$search)
        ->limit($limit,$start)
        ->order_by($col,$dir)
        ->where('is_active',1)
        ->group_by('id')
        ->get('tbl_cash_register');


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
        ->or_like('name',$search)
        ->or_like('address',$search)
        ->group_by('id')
        ->where('is_active',1)
        ->get('tbl_cash_register');

        return $query->num_rows();
    } 

}