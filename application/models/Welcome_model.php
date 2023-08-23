<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_model extends CI_Model {

    function get_dashboard_data($tbl_name="vw_cash_register"){

        $response = array();
        $first_date = date('Y-m-d',strtotime('first day of this month'));
        $last_date = date('Y-m-d',strtotime('last day of this month'));
        // Daily Income 
        $this->db->select_sum('amount');
        //$this->db->from('vw_cash_register');
        $this->db->where('date >= ',$first_date);
        $this->db->where('date <=',$first_date);
        $this->db->where('is_active',1);
        $this->db->where('type_id',1);                     
        $this->db->group_by('id');                     
        $q = $this->db->get('tbl_cash_register'); 
        $response['daily_income'] = $q->result_array();
        // Monthly Income

        $this->db->select_sum('amount');
        // $this->db->from('vw_cash_register');
        $this->db->where('date >=',$first_date);
        $this->db->where('date <=',$last_date);
        $this->db->where('is_active',1);
        $this->db->where('type_id',1);
        $this->db->group_by('id');  
        $q = $this->db->get('tbl_cash_register');
        //echo $this->db->last_query();
        //exit();
        $response['monthly_income'] = $q->result_array();

        // over all income
        $this->db->select_sum('amount');
        // $this->db->from('vw_cash_register');
        //$this->db->where('date >=',$first_date);
        // $this->db->where('date <=',$last_date);
        $this->db->where('is_active',1);
        $this->db->where('type_id',1);
        $this->db->group_by('id');  
        $q = $this->db->get('tbl_cash_register');
        //echo $this->db->last_query();
        //exit();
        $response['overall_income'] = $q->result_array();

        // Daily Expenses

        $this->db->select_sum('amount');
        //$this->db->from('vw_cash_register');
        $this->db->where('date ',$first_date);
        $this->db->where('is_active',1);
        $this->db->where('type_id != ',1);
        $this->db->group_by('id');  
        $q = $this->db->get('tbl_cash_register');
        $response['daily_expenses'] = $q->result_array();

        // Monthly Expenses

        $this->db->select_sum('amount');
        // $this->db->from('vw_cash_register');
        $this->db->where('date >=',$first_date);
        $this->db->where('date <=',$last_date);
        $this->db->where('is_active',1);
        $this->db->where('type_id != ',1);
        $this->db->group_by('id');  
        $q = $this->db->get('tbl_cash_register');
        $response['monthly_expenses'] = $q->result_array();

        // Overall Expenses

        $this->db->select_sum('amount');
        // $this->db->from('vw_cash_register');
        // $this->db->where('date >=',$first_date);
        // $this->db->where('date <=',$last_date);
        $this->db->where('is_active',1);
        $this->db->where('type_id != ',1);
        //$this->db->group_by('id');  
        $q = $this->db->get('tbl_cash_register');
        $response['overall_expenses'] = $q->result_array();
        //echo  $this->db->last_query();
        // exit();

        $this->db->select('*');
        // $this->db->from('vw_cash_register');
        $this->db->where('is_active',1);
        $q = $this->db->get('tbl_category');


        $this->db->select('sum(amount) as amount_,name');
        // $this->db->from('vw_cash_register');
        $this->db->where('tbl_cash_register.is_active',1);
        $this->db->where('tbl_cash_register.date between "2022-09-01" and "2022-09-30"');
        $this->db->from('tbl_cash_register');
        $this->db->join('tbl_category','tbl_cash_register.category_id = tbl_category.id');
        $this->db->group_by('tbl_cash_register.category_id'); 
        // $this->db->where('is_active',1);
        $q = $this->db->get();
        //   echo $this->db->last_query();
        //   exit();
        $response['cat_data'] = $q->result_array();

        $this->db->select('sum(amount) as amount_');
        // $this->db->from('vw_cash_register');
        $this->db->where('tbl_cash_register.is_active',1);
        $this->db->where('tbl_cash_register.date between "2022-09-01" and "2022-09-30"');
        $this->db->from('tbl_cash_register');
        $this->db->join('tbl_category','tbl_cash_register.category_id = tbl_category.id');
        // $this->db->group_by('tbl_cash_register.category_id'); 
        // $this->db->where('is_active',1);
        $q = $this->db->get();
        //   echo $this->db->last_query();
        //   exit();
        $response['cat_data_sum'] = $q->result_array();
        //  print_r($response['category_list']);
        //  exit();
        return $response;
    }
    function get_data($tbl_name){

        $response = array();

        // Select record
        $this->db->select('*');
        $q = $this->db->get($tbl_name);
        $response = $q->result_array();

        return $response;
    }
    function get_barchart_dashboard(){
        $response = array();

        // Select record
        $this->db->select('(select name from tbl_type where id =tbl_cash_register.type_id)as  type_name, SUM(amount) as amount');
        $this->db->where('is_active',1);
        $this->db->group_by('type_id') ;
        $q = $this->db->get('tbl_cash_register');
        $response = $q->result_array();
        // echo $this->db->last_query();
        // exit();
        return $response;
    }
    function get_piechart_dashboard(){
        $response = array();

        // Select record
        $this->db->select(' (select name from tbl_category where id =tbl_cash_register.category_id) as name , SUM(amount) as amount');
        $this->db->where('is_active',1);
        $this->db->where('category_id >',0);
        $this->db->group_by('category_id') ;
        $q = $this->db->get('tbl_cash_register');
        $response = $q->result_array();
        //  echo $this->db->last_query();
        //  exit();
        return $response;
    }
    function get_task(){
        $response = array();

        // Select record
        $this->db->select('(select name from tbl_user where id=tbl_task.user_id  ) as emp_name ,tbl_task.*');
        $this->db->where('is_active',1);
        //$this->db->where('category_id >',0);
        //$this->db->group_by('category_id') ;
        $q = $this->db->get('tbl_task');
        $response = $q->result_array();
        // echo $this->db->last_query();
        // exit();
        return $response;
    }
    function crud(){

        $menu_id=$this->input->post('menu_id');
        $row_id=$this->input->post('row_id');
        $button_id=$this->input->post('button_id');
        $table = "";
        if($menu_id == 2){
            $table="tbl_cash_register";
        } else
            if($menu_id == 3){
                $table="tbl_category";
            } else
                if($menu_id == 4){
                    $table="tbl_head";
                } else
                    if($menu_id == 6){
                        $table="tbl_mode";
                    } else
                        if($menu_id == 8){
                            $table="tbl_type";
                        } else
                            if($menu_id == 10){
                                $table="tbl_user";
                            } else
                                if($menu_id == 12){
                                    $table="tbl_company";
                                } else
                                    if($menu_id == 14){
                                        $table="tbl_bank";
                                    } else
                                        if($menu_id == 15){
                                            $table="tbl_asset";
                                        } else
                                            if($menu_id == 22){
                                                $table="tbl_branch";
                                            } 
                                            /*$date =date('Y-m-d H:i:s', strtotime('2010-10-12 15:09:00') );
                                            $data = array(
                                            'name'=>$name,
                                            'description'=>$description,
                                            'remarks'=>$remarks,
                                            'edate'=>$date,
                                            'ekpo'=>1,
                                            'is_active'=>1
                                            ); */

                                            if($button_id == 1){
            $this->db->where('is_active','1');
            $this->db->where('id',$row_id);
            $this->db->select('*');
            $q = $this->db->get($table);
            $response = $q->result_array();
            return $response;
        } else
            if($button_id == 2){
                $data = array(
                    'is_active'=>0,
                    'ckpo'=>2,
                    'cdate'=>date('Y-m-d H:i:s')
                );
                // $this->db->where('is_active','1');
                $this->db->where('id',$row_id);
                // $this->db->set('is_active',0);
                // $this->db->select('*');
                $q = $this->db->update($table,$data);
                // $response = $q->result_array();
                return $q;
            }
            //$response =   $this->db->insert($table,$data);


            return $response;
    }
    function get_menu($menu){

        $response = array();
        $this->db->where('is_active','1');
        $this->db->where('name',$menu);
        $this->db->order_by('id', 'DESC');  //actual field name of id

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_menu');
        $response = $q->result_array();

        return $response;
    }
    function get_type($id){

        $response = array();
        $this->db->where('is_active','1');
        $this->db->order_by('id', 'DESC');  //actual field name of id

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_type');
        $response = $q->result_array();

        return $response;
    }
    function get_report_type($id){

        $response = array();
        $this->db->where('is_active','1');
        $this->db->order_by('id', 'DESC');  //actual field name of id

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_report_type');
        $response = $q->result_array();

        return $response;
    }
    function get_company($id){

        $response = array();
        $this->db->where('is_active','1');
        $this->db->order_by('id', 'DESC');  //actual field name of id

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_company');
        $response = $q->result_array();

        return $response;
    }   
    function get_single_company($id){

        $response = array();
        $this->db->where('is_active','1','id',$id);
        $this->db->order_by('id', 'DESC');  //actual field name of id

        // Select record
        $this->db->select('name');
        $q = $this->db->get('tbl_company');
        $response = $q->result_array();

        return $response;
    }  

    function get_branch($id){

        $response = array();
        $this->db->where('is_active','1');
        $this->db->order_by('id', 'DESC');  //actual field name of id

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_branch');
        $response = $q->result_array();
        /*echo $this->db->last_query();
        exit();*/
        return $response;
    }

    function get_Company_branches($id){

        $response = array();
        $this->db->where('is_active','1','company_id',$id);
        $this->db->order_by('id', 'ASC');  //actual field name of id

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_branch');
        $response = $q->result_array();
        /*echo $this->db->last_query();
        exit();*/
        return $response;
    } 

    function get_serialnumber($collectiondate){


        $response = array();
        $arraywhere = array('is_active' => 1, 'date' => $collectiondate);
        $this->db->where($arraywhere);
        //$this->db->where('is_active','1','date',$collectiondate);
        // Select record
        $this->db->select_max('srno');
        $q = $this->db->get('tbl_cash_register');
        $response = $q->result_array();

        if($response[0]['srno'] == "")
        {
            $response[0]['srno'] = 1;
        }
        else
        {
            $response[0]['srno'] = $response[0]['srno']+1;
        }
        /*echo $response[0]['srno'];
        exit(); */
       /* echo $this->db->last_query();
        exit(); */    
        return $response[0]['srno'];
    } 
    function get_branches_employee($id){

        $response = array();
        $q = $this->db->query("SELECT u.name, b.user_id AS id FROM tbl_branch b JOIN tbl_user u ON b.user_id = u.id WHERE b.id = $id;");
        /*echo $this->db->last_query();
        exit();*/
        $response = $q->result_array();
        return $response;
    } 

    function get_account($id){

        $response = array();

        $this->db->where('is_active','1');
        $this->db->order_by('id', 'DESC');  //actual field name of id
        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_bank');
        $response = $q->result_array();

        return $response;
    }
    function get_head($id){

        $response = array();
        $this->db->where('is_active','1');
        $this->db->order_by('id', 'DESC');  //actual field name of id

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_head');
        $response = $q->result_array();

        return $response;
    }
    function get_category($id){

        $response = array();
        $this->db->where('is_active','1');
        $this->db->order_by('id', 'DESC');  //actual field name of id

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_category');
        $response = $q->result_array();

        return $response;
    }
    function get_mode($id){

        $response = array();
        $this->db->where('is_active','1');
        $this->db->order_by('id', 'DESC');  //actual field name of id

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_mode');
        $response = $q->result_array();

        return $response;
    }
    function get_single_user($id){

        $response = array();
        $this->db->where('is_active','1','id',$id);
        $this->db->order_by('id', 'DESC');  //actual field name of id
        // Select record
        $this->db->select('name');
        $q = $this->db->get('tbl_user');
        $response = $q->result_array();
        /*echo $this->db->last_query();
        exit();*/
        return $response;
    }
    function get_user($id){

        $response = array();
        $this->db->where('is_active','1');
        $this->db->order_by('id', 'DESC');  //actual field name of id
        // Select record
        $this->db->select('*');
        $q = $this->db->get('tbl_user');
        $response = $q->result_array();

        return $response;
    }
    function get_menu_all($userId){

        $response = array();
        $query = $this->db->query("SELECT *, m.id as menu_id FROM tbl_menu m left join tbl_user_rights t on m.id = t.menu_id WHERE m.is_active = 1 and t.user_id = $userId ");
        // echo $this->db->last_query();
        // exit();
        $count =  $query->num_rows();
        if($count>0){
            $response = $query->result_array();    
        }
        //print_r($response);
        return $response;
    }
    function get_menu_all_user(){
        $userid=$this->input->post('userid');
        // echo   $userid;
        $response = array();
        $query = $this->db->query("SELECT *, m.id as menu_id FROM tbl_menu m left join tbl_user_rights t on m.id = t.menu_id WHERE m.is_active = 1  and t.user_id = $userid");
        $count =  $query->num_rows();
        if($count>0){
            $response = $query->result_array();    
        }
        //print_r($response);
        return $response;
    }
    function get_single_menu($userid,$menuid){

        // echo   $userid;
        $response = array();
        $query = $this->db->query("SELECT  show_menu,add_record,edit_record,delete_record FROM tbl_user_rights  WHERE is_active = 1  and user_id = $userid and menu_id = $menuid");
        //echo $this->db->last_query();
        // exit();   
        $count =  $query->num_rows();
        //echo $count; 
        // exit();
        if($count>0){
            $response = $query->result_array();    
        }
        // print_r($response);
        // exit();
        return $response; 
    }
    function get_menu_user($userid){

        // echo   $userid;
        $response = array();
        $query = $this->db->query("SELECT *, m.id as menu_id FROM tbl_menu m left join tbl_user_rights t on m.id = t.menu_id WHERE m.is_active = 1  and t.user_id = $userid");
        $count =  $query->num_rows();
        if($count>0){
            $response = $query->result_array();    
        }

        //print_r($response);
        return $response;
    }
    function add_user_rights(){


        $userid=$this->input->post('userid');
        $menu_id=$this->input->post('menu_id');
        $menu_type=$this->input->post('menu_type');
        $status=$this->input->post('status');
        // echo "status:".$status;
        $query = $this
        ->db
        ->where('is_active',1)
        ->where('user_id',$userid)
        ->where('menu_id',$menu_id)
        ->get('tbl_user_rights');

        $isInsert =  $query->num_rows();
        if($status == "true"){
            $status = 1;
        } else {
            $status = 0;
        }
        // echo "2 status:".$status;
        $date =date('Y-m-d H:i:s');

        if($isInsert <= 0){
            $show_menu = 0;
            $add_record = 0;
            $edit_record = 0;
            $delete_record = 0;
            if($menu_type == 'show_menu'){
                $show_menu = $status;
            } 
            if($menu_type == 'add_record'){
                $add_record = $status;
            }
            if($menu_type == 'edit_record'){
                $edit_record = $status;
            }
            if($menu_type == 'delete_record'){
                $delete_record = $status;
            }
            $data = array(
                'user_id'=>$userid,
                'menu_id'=>$menu_id,
                'show_menu'=>$show_menu,
                'add_record'=>$add_record,
                'edit_record'=>$edit_record,
                'delete_record'=>$delete_record,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );
            $response =   $this->db->insert('tbl_user_rights',$data);
        }   else{
            if($menu_type == 'show_menu'){
                $show_menu = $status;
                $data = array(
                    'show_menu'=>$show_menu,
                    'cdate'=>$date,
                    'ckpo'=>2,
                    'is_active'=>1
                );
                $this->db->where('user_id',$userid)  ;
                $this->db->where('menu_id',$menu_id)  ;

                $response =   $this->db->update('tbl_user_rights',$data);
                //echo $this->db->last_query();
            } 
            else if($menu_type == 'add_record'){
                $add_record = $status;
                $data = array(
                    'add_record'=>$add_record,
                    'cdate'=>$date,
                    'ckpo'=>2,
                    //  'is_active'=>1
                );
                $this->db->where('user_id',$userid)  ;
                $this->db->where('menu_id',$menu_id)  ;
                $response =   $this->db->update('tbl_user_rights',$data);

            }
            else if($menu_type == 'edit_record'){
                $edit_record = $status;
                $data = array(
                    'edit_record'=>$edit_record,
                    'cdate'=>$date,
                    'ckpo'=>2,
                    //  'is_active'=>1
                );
                $this->db->where('user_id',$userid)  ;
                $this->db->where('menu_id',$menu_id)  ;
                $response =   $this->db->update('tbl_user_rights',$data);

            }
            else if($menu_type == 'delete_record'){
                $delete_record = $status;
                $data = array(
                    'delete_record'=>$delete_record,
                    'cdate'=>$date,
                    'ckpo'=>2,
                    //  'is_active'=>1
                );
                $this->db->where('user_id',$userid)  ;
                $this->db->where('menu_id',$menu_id)  ;
                $response =   $this->db->update('tbl_user_rights',$data);
            }
        }

        return $response;
    }
    function add_task(){

        $user_id=$this->input->post('userid');
        $heading=$this->input->post('heading');
        $title=$this->input->post('title');
        $note=$this->input->post('note');
        $assign_date=$this->input->post('assign_date');
        $completion_date=$this->input->post('completion_date');
        $final_date=$this->input->post('final_date');
        $description=$this->input->post('description');
        $remarks=$this->input->post('remarks');

        //  echo $name;
        $date =date('Y-m-d H:i:s');
        $id =$this->input->post('id');
        //  echo $id;
        $response = false;

        if($id>0){
            $data = array(
                'user_id'=>$user_id,
                'name'=>$heading,
                'title'=>$title,

                'description'=>$description,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>1,
                //  'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_category',$data);
        } else{

            $data = array(
                'name'=>$name,
                'description'=>$description,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );
            $response =   $this->db->insert('tbl_category',$data);
            //print_r($response);
            // $this->db->last_query();  
        }




        return $response;
    }
    function login(){
        $email =$this->input->post('email');
        $pwd=$this->input->post('pwd'); 
        $response = array();
        $query = $this
        ->db
        // ->where('is_active',1)
        ->where('email',$email)
        ->where('pwd',$pwd)
        ->get('tbl_user');


        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
        //$q = $this->db->query("SELECT * FROM tbl_user  where email = $email and pwd = $pwd");
        // $response = $q->result_array();
        //print_r($response);
        // return $response;  
    }
    function add_cash_register(){
        $company =$this->input->post('company_id');
        $branch_id =$this->input->post('branch_id');
        $srno =$this->input->post('srno');
        $date_=$this->input->post('date');
        $type=$this->input->post('type');
        $account=$this->input->post('account');
        $head=$this->input->post('head');
        $category=$this->input->post('category');
        $mode=$this->input->post('mode');
        $emp=$this->input->post('emp');
        $amount=$this->input->post('amount');
        $description=$this->input->post('description');
        $remarks=$this->input->post('remarks');

        $id =$this->input->post('id');
        // echo $amount ;
        // exit();
        if($id>0){
            $date =date('Y-m-d H:i:s');
            $data = array(

                'company_id'=>$company,
                'branch_id'=>$branch_id,
                'srno'=>$srno,
                'date'=>$date_,
                'type_id'=>$type,
                'bank_id'=>$account,
                'head_id'=>$head,
                'category_id'=>$category,
                'mode_id'=>$mode,
                'user_id'=>$emp,
                'amount'=>$amount,
                'description'=>$description,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>2,
                //'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_cash_register',$data);
            /*echo $this->db->error();
            exit();*/
            $insert_id = $id;                    

            //$insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else{

            $date =date('Y-m-d H:i:s');
            $data = array(

                'company_id'=>$company,
                'branch_id'=>$branch_id,
                'srno'=>$srno,
                'date'=>$date_,
                'type_id'=>$type,
                'bank_id'=>$account,
                'head_id'=>$head,
                'category_id'=>$category,
                'mode_id'=>$mode,
                'user_id'=>$emp,
                'amount'=>$amount,
                'description'=>$description,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );
            $response =   $this->db->insert('tbl_cash_register',$data);
            /*echo $this->db->last_query();
            exit();*/
            /* print_r($this->db->error());
            exit(); */
            $insert_id = $this->db->insert_id();
            return $insert_id;

        }
    }
    function add_asset(){
        $name=$this->input->post('name');
        $address=$this->input->post('address');
        $longitude=$this->input->post('longitude');
        $purchasing_date=$this->input->post('purchasing_date');
        $seller_name=$this->input->post('seller_name');
        $seller_address=$this->input->post('seller_address');
        $seller_cnic=$this->input->post('seller_cnic');
        $seller_cell=$this->input->post('seller_cell');

        $remarks=$this->input->post('remarks');
        $date =date('Y-m-d H:i:s');
        $id =$this->input->post('id');

        if($id>0){
            $data = array(
                'name'=>$name,
                'address'=>$address,
                'longitude'=>$longitude,
                'purchasing_date'=>$purchasing_date,
                'seller_name'=>$seller_name,
                'seller_address'=>$seller_address,
                'seller_cnic'=>$seller_cnic,
                'seller_cell'=>$seller_cell,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>1,
                'is_active'=>1
            );
            $this->db->where('id',$id);
            $insert_id =   $this->db->update('tbl_asset',$data);
            if($insert_id == true){
                $insert_id =   $id;                    
            }
        } else{
            $data = array(
                'name'=>$name,
                'address'=>$address,
                'longitude'=>$longitude,
                'purchasing_date'=>$purchasing_date,
                'seller_name'=>$seller_name,
                'seller_address'=>$seller_address,
                'seller_cnic'=>$seller_cnic,
                'seller_cell'=>$seller_cell,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );

            $this->db->insert('tbl_asset',$data);
            $insert_id = $this->db->insert_id();   
        }


        return $insert_id;

        //return $response;
    }
    function add_bank(){
        $name=$this->input->post('name');
        $address=$this->input->post('address');
        $iban=$this->input->post('iban');
        $swfit=$this->input->post('swift');
        $account_no=$this->input->post('account_no');
        $description=$this->input->post('description');
        $remarks=$this->input->post('remarks');
        $date =date('Y-m-d H:i:s');
        $id =$this->input->post('id');

        if($id>0){
            $data = array(
                'name'=>$name,
                'address'=>$address,
                'iban'=>$iban,
                'swift'=>$swfit,
                'account_no'=>$account_no,
                'description'=>$description,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>1,
                'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_bank',$data);
        }
        else{
            $data = array(
                'name'=>$name,
                'address'=>$address,
                'iban'=>$iban,
                'swift'=>$swfit,
                'account_no'=>$account_no,
                'description'=>$description,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );

            $response =   $this->db->insert('tbl_bank',$data);   
        }



        return $response;
    }
    function add_company(){
        $name=$this->input->post('name');
        $address=$this->input->post('address');
        $lic_name=$this->input->post('lic_name');
        $lic_no=$this->input->post('lic_no');
        $company_start_date=$this->input->post('company_start_date');
        $company_last_date=$this->input->post('company_last_date');
        $est_start_date=$this->input->post('est_start_date');
        $est_end_date=$this->input->post('est_end_date');
        $office_ijari_start_date=$this->input->post('office_ijari_start_date');
        $office_ijari_end_date=$this->input->post('office_ijari_end_date');
        $description=$this->input->post('description');
        $remarks=$this->input->post('remarks');
        $date =date('Y-m-d H:i:s');
        $id =$this->input->post('id');

        if($id>0){
            $data = array(
                'name'=>$name,
                'address'=>$address,
                'lic_name'=>$lic_name,
                'lic_no'=>$lic_no,
                'company_start_date'=>$company_start_date,
                'company_last_date'=>$company_last_date,
                'est_start_date'=>$est_start_date,
                'est_end_date'=>$est_end_date,
                'office_ijari_start_date'=>$office_ijari_start_date,
                'office_ijari_end_date'=>$office_ijari_end_date,
                'description'=>$description,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>1,
                'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_company',$data);
        } else{
            $data = array(
                'name'=>$name,
                'address'=>$address,
                'lic_name'=>$lic_name,
                'lic_no'=>$lic_no,
                'company_start_date'=>$company_start_date,
                'company_last_date'=>$company_last_date,
                'est_start_date'=>$est_start_date,
                'est_end_date'=>$est_end_date,
                'office_ijari_start_date'=>$office_ijari_start_date,
                'office_ijari_end_date'=>$office_ijari_end_date,
                'description'=>$description,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );

            $response =   $this->db->insert('tbl_company',$data);
        }

        return $response;
    }

    function add_branch(){



        $company_id =$this->input->post('company_id');
        $branch_name=$this->input->post('branch_name');
        $user_id=$this->input->post('user_id');
        $branch_price=$this->input->post('branch_price');
        $row_permit_start_date=$this->input->post('row_permit_start_date');
        $row_permit_end_date=$this->input->post('row_permit_end_date');
        $plot_utilization_start_date=$this->input->post('plot_utilization_start_date');
        $plot_utilization_end_date=$this->input->post('plot_utilization_end_date');
        $plot_utilization_price=$this->input->post('plot_utilization_price');
        $building_permit_start_date=$this->input->post('building_permit_start_date');
        $building_permit_end_date=$this->input->post('building_permit_end_date');
        $building_permit_price=$this->input->post('building_permit_price');
        $project_start_date=$this->input->post('project_start_date');
        $project_end_date=$this->input->post('project_end_date');
        $parking_ijari_start_date=$this->input->post('parking_ijari_start_date');
        $parking_ijari_end_date=$this->input->post('parking_ijari_end_date');
        $remarks=$this->input->post('remarks');
        $date =date('Y-m-d H:i:s');
        $id =$this->input->post('id');

        if($id>0)
        {
            $data = array(
                'company_id'=>$company_id,
                'branch_name'=>$branch_name,
                'user_id'=>$user_id,
                'branch_price'=>$branch_price,
                'row_permit_start_date'=>$row_permit_start_date,
                'row_permit_end_date'=>$row_permit_end_date,
                'plot_utilization_start_date'=>$plot_utilization_start_date,
                'plot_utilization_end_date'=>$plot_utilization_end_date,
                'plot_utilization_price'=>$plot_utilization_price,
                'building_permit_start_date'=>$building_permit_start_date,
                'building_permit_end_date'=>$building_permit_end_date,
                'building_permit_price'=>$building_permit_price,
                'project_start_date'=>$project_start_date,
                'project_end_date'=>$project_end_date,
                'parking_ijari_start_date'=>$parking_ijari_start_date,
                'parking_ijari_end_date'=>$parking_ijari_end_date,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>1,
                'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_branch',$data);
        } 
        else
        {
            $data = array(
                'company_id'=>$company_id,
                'branch_name'=>$branch_name,
                'user_id'=>$user_id,
                'branch_price'=>$branch_price,
                'row_permit_start_date'=>$row_permit_start_date,
                'row_permit_end_date'=>$row_permit_end_date,
                'plot_utilization_start_date'=>$plot_utilization_start_date,
                'plot_utilization_end_date'=>$plot_utilization_end_date,
                'plot_utilization_price'=>$plot_utilization_price,
                'building_permit_start_date'=>$building_permit_start_date,
                'building_permit_end_date'=>$building_permit_end_date,
                'building_permit_price'=>$building_permit_price,
                'project_start_date'=>$project_start_date,
                'project_end_date'=>$project_end_date,
                'parking_ijari_start_date'=>$parking_ijari_start_date,
                'parking_ijari_end_date'=>$parking_ijari_end_date,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );


            $response = $this->db->insert('tbl_branch',$data);
            /*print_r($this->db->error());
            exit();*/



        }

        return $response;
    }

    function add_head(){
        $name=$this->input->post('name');
        $description=$this->input->post('description');
        $remarks=$this->input->post('remarks');
        $date =date('Y-m-d H:i:s' );
        $id =$this->input->post('id');
        $response = false;
        if($id>0){
            $data = array(
                'name'=>$name,
                'description'=>$description,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>1,
                'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_head',$data);
        } else{
            $data = array(
                'name'=>$name,
                'description'=>$description,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );

            $response =   $this->db->insert('tbl_head',$data);
        }

        return $response;
    }
    function add_mode(){
        $name=$this->input->post('name');
        $description=$this->input->post('description');
        $remarks=$this->input->post('remarks');
        $date =date('Y-m-d H:i:s' );
        $id =$this->input->post('id');

        if($id>0){
            $data = array(
                'name'=>$name,
                'description'=>$description,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>1,
                'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_mode',$data);
        } else{
            $data = array(
                'name'=>$name,
                'description'=>$description,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );

            $response =   $this->db->insert('tbl_mode',$data);
        }

        return $response;
    }
    function add_type(){
        $name=$this->input->post('name');
        $description=$this->input->post('description');
        $remarks=$this->input->post('remarks');
        $date =date('Y-m-d H:i:s' );
        $id =$this->input->post('id');

        if($id>0){
            $data = array(
                'name'=>$name,
                'description'=>$description,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>1,
                'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_type',$data);
        } else{
            $data = array(
                'name'=>$name,
                'description'=>$description,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1
            );

            $response =   $this->db->insert('tbl_type',$data);
        }

        return $response;
    }
    function add_profile(){
        $name=$this->input->post('name');
        $father_name=$this->input->post('father_name');
        $cnic=$this->input->post('cnic');
        $desig=$this->input->post('desig');
        //if(strlen($this->input->post('dob'))>4){
        $dob=date('Y-m-d', strtotime($this->input->post('dob')) );//$this->input->post('dob');    


        $cell_no=$this->input->post('cell_no');
        $guardian_cell=$this->input->post('guardian_cell');
        $home_cell=$this->input->post('home_cell');
        $emergency_cell=$this->input->post('emergency_cell');
        $address=$this->input->post('address');
        $salary=$this->input->post('salary');
        $bank_name=$this->input->post('bank_name');
        $bank_account_no=$this->input->post('bank_account_no');
        $iban=$this->input->post('iban');
        $pwd=$this->input->post('pwd');
        $note=$this->input->post('note');
        $description=$this->input->post('description');
        $email=$this->input->post('email');
        $remarks=$this->input->post('remarks');


        $visa_entry_date=$this->input->post('visa_entry_date');
        $visa_expiry_date=$this->input->post('visa_expiry_date');
        $labour_entry_date=$this->input->post('labour_entry_date');
        $labour_expiry_date=$this->input->post('labour_expiry_date');
        $pasport_issue_date=$this->input->post('pasport_issue_date');
        $pasport_expiry_date=$this->input->post('pasport_expiry_date');
        $id_card_issue_date=$this->input->post('id_card_issue_date');
        $id_card_expiry_date=$this->input->post('id_card_expiry_date');



        $date =date('Y-m-d H:i:s');
        $id =$this->input->post('id');

        if($id>0){
            $data = array(
                'name'=>$name,
                'father_name'=>$father_name,
                'cnic'=>$cnic,
                'desig'=>$desig,
                'cell_no'=>$cell_no,
                'guardian_cell'=>$guardian_cell,
                'home_cell'=>$home_cell,
                'emergency_cell'=>$emergency_cell,
                'address'=>$address,
                'salary'=>$salary,
                'bank_name'=>$bank_name,
                'bank_account_no'=>$bank_account_no,
                'iban'=>$iban,
                'pwd'=>$pwd,
                'note'=>$note,
                'description'=>$description,
                'email'=>$email,
                'father_name'=>$father_name,
                'remarks'=>$remarks,
                'dob'=>$dob,
                'cdate'=>$date,
                'ckpo'=>1,
                'is_active'=>1,


                'visa_entry_date'=>$visa_entry_date,
                'visa_expiry_date'=>$visa_expiry_date,
                'labour_entry_date'=>$labour_entry_date,
                'labour_expiry_date'=>$labour_expiry_date,
                'pasport_issue_date'=>$pasport_issue_date,
                'pasport_expiry_date'=>$pasport_expiry_date,
                'id_card_issue_date'=>$id_card_issue_date,
                'id_card_expiry_date'=>$id_card_expiry_date
            );
            $this->db->where('id',$id);
            $insert_id =   $this->db->update('tbl_user',$data);
            return $insert_id;
        } else{
            $data = array(
                'name'=>$name,
                'father_name'=>$father_name,
                'cnic'=>$cnic,
                'desig'=>$desig,
                'cell_no'=>$cell_no,
                'guardian_cell'=>$guardian_cell,
                'home_cell'=>$home_cell,
                'emergency_cell'=>$emergency_cell,
                'address'=>$address,
                'salary'=>$salary,
                'bank_name'=>$bank_name,
                'bank_account_no'=>$bank_account_no,
                'iban'=>$iban,
                'pwd'=>$pwd,
                'note'=>$note,
                'description'=>$description,
                'email'=>$email,
                'father_name'=>$father_name,
                'remarks'=>$remarks,
                'dob'=>$dob,
                'edate'=>$date,
                'ekpo'=>1,
                'is_active'=>1,

                'visa_entry_date'=>$visa_entry_date,
                'visa_expiry_date'=>$visa_expiry_date,
                'labour_entry_date'=>$labour_entry_date,
                'labour_expiry_date'=>$labour_expiry_date,
                'pasport_issue_date'=>$pasport_issue_date,
                'pasport_expiry_date'=>$pasport_expiry_date,
                'id_card_issue_date'=>$id_card_issue_date,
                'id_card_expiry_date'=>$id_card_expiry_date
            );

            $response =   $this->db->insert('tbl_user',$data);
            $insert_id = $this->db->insert_id();

            return $insert_id;
        }
        //return $response;
    }
    public function excel_importData($data) {

        $res = $this->db->insert_batch('excel_data',$data);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }

    }




}