<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_model extends CI_Model {
    function check_login(){
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $this->db->select('*');
        //$this->db->from('vw_cash_register');
        // $this->group_start(); //this will start grouping
        $this->db->where('( email ="'.$email.'" or Phone ="'.$email.'" ) ');
        // $this->db->or_where('Phone =',$email);
        // $this->group_end(); 
        $this->db->where('is_active',1);
        $this->db->where('password',$password);                     

        $q = $this->db->get('tbl_reg_user'); 
        // echo $this->db->last_query();
        // exit();
        return $q->result_array();

    }
    function saveMsg(){
        $data = array(
            'firstName'=>$_POST['firstName'],
            'email'=>$_POST['email'],
            'msg'=>$_POST['msg'],
            'status'=>1,
            'is_active'=>1,
            'edate'=>date('Y-m-d H:i:s')

        );

        $response =   $this->db->insert('tblMesg',$data);
        $insert_id = $this->db->insert_id();

        return $insert_id;  
    }
    function user_deposit(){

        $data = array(
            'currency'=>$_POST['currency'],
            'amount'=>$_POST['amount'],
            'plan_id'=>$_POST['plan'],
            'tran_id'=>$_POST['tran_id'],
            'userid'=>$_SESSION['id'],
            'type'=>"Deposit",
            'status'=>1,
            'is_active'=>1,
            'edate'=>date('Y-m-d H:i:s')

        );

        $response =   $this->db->insert('tblamount',$data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }
    function user_kyc(){

        $data = array(
            'userid'=>$_SESSION['id'],
            'number'=>$_POST['number'],
            'type'=>"".$_POST['type']."",
            'status'=>1,
            'is_active'=>1,
            'edate'=>date('Y-m-d H:i:s')

        );

        $response =   $this->db->insert('tblkyc',$data);
        //     echo $this->db->last_query();
        //exit();
        $insert_id = $this->db->insert_id();
        //    echo $insert_id;
        return $insert_id;
    }
    function withdrawl_update(){

        $data = array(
            'userid'=>$_SESSION['id'],
            'amount'=>$_POST['amount'],
            'type'=>"".$_POST['mode']."",
            'status'=>1,
            'is_active'=>1,
            'edate'=>date('Y-m-d H:i:s'),
            'ekpo'=> $_SESSION['id']

        );

        $response =   $this->db->insert('tbl_withdraw',$data);
        //     echo $this->db->last_query();
        //exit();
        $insert_id = $this->db->insert_id();
        //    echo $insert_id;
        return $insert_id;
    }
    function getUserDepositData_admin_kyc(){
        $this->db->select('*, (select first_name from tbl_reg_user where id = tblkyc.userid) as username');

        $this->db->where('is_active',1);
        // $this->db->where('userid',$_SESSION['id']);
        // $this->db->where('type',"Deposit");
        $this->db->order_by("status", "asc");
        $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tblkyc'); 
        //echo $this->db->last_query();
        // exit();
        return $q->result_array();


    }
    function getUserDepositData_admin_widthdraw(){
        $this->db->select('*, (select first_name from tbl_reg_user where id = tbl_withdraw.userid) as username');

        $this->db->where('is_active',1);
        // $this->db->where('userid',$_SESSION['id']);
        // $this->db->where('type',"Deposit");
        $this->db->order_by("status", "asc");
        $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tbl_withdraw'); 
        //echo $this->db->last_query();
        // exit();
        return $q->result_array();


    }
    function getUserDepositData(){
        $this->db->select('*,(select name from tblplan where id = tblamount.plan_id) as plan_name');

        $this->db->where('is_active',1);
        $this->db->where('userid',$_SESSION['id']);
        $this->db->where('type',"Deposit");
        $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tblamount'); 
        // echo $this->db->last_query();
        // exit();
        return $q->result_array();
    }

    function getUserDashboardData(){
        $this->db->select('*,(select name from tblplan where id = tblamount.plan_id) as plan_name');

        $this->db->where('is_active',1);
        $this->db->where('userid',$_SESSION['id']);
        $this->db->where('type',"Deposit");
        //$this->db->where('status',2);
        $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tblamount'); 
        // echo $this->db->last_query();
        // exit();
        return $q->result_array();
    }
    function getUserDepositData_admin(){
        $this->db->select('*,(select name from tblplan where id = tblamount.plan_id) as plan_name');

        $this->db->where('is_active',1);
        // $this->db->where('userid',$_SESSION['id']);
        $this->db->where('type',"Deposit");
        $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tblamount'); 
        // echo $this->db->last_query();
        // exit();
        return $q->result_array();
    }
    function getUserDepositData_admin_amount(){
        $q = $this->db->query('select (select sum(amount) from tblamount where status = 2 ) as DepositAmount , (select sum(amount) from tblamount where status = 3 ) as RejectedAmount , (select sum(amount) from tblamount where status = 4 ) as PendingAmount ');
        return $q->result_array();
    }
    function getUserkyc(){
        $this->db->select('*');

        $this->db->where('is_active',1);
        $this->db->where('userid',$_SESSION['id']);
        //$this->db->where('type',"Deposit");
        $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tblkyc'); 
        // echo $this->db->last_query();
        // exit();
        return $q->result_array();
    }
    function getUserPlan(){
        $this->db->select('*');

        $this->db->where('is_active',1);
        $this->db->where('status',1);
        // $this->db->where('userid',$_SESSION['id']);
        //$this->db->where('type',"Deposit");
        $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tblplan'); 
        // echo $this->db->last_query();
        // exit();
        return $q->result_array();
    }
    function getUserWithdraw(){
        $this->db->select('*');

        $this->db->where('is_active',1);
        $this->db->where('userid',$_SESSION['id']);
        //$this->db->where('type',"Deposit");
        $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tbl_withdraw'); 
        // echo $this->db->last_query();
        // exit();
        return $q->result_array();
    }
    function getUserReward(){
        $this->db->select('*');

        $this->db->where('is_active',1);
        //  $this->db->where('userid',$_SESSION['id']);
        //$this->db->where('type',"Deposit");
        $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tblreward'); 
        // echo $this->db->last_query();
        // exit();
        return $q->result_array();
    }
    function getUserReward_level($userid){
        $this->db->select('*, (SELECT a.first_name from tbl_reg_user a where a.id = tblamount.userid) as username 
        ');

        //$this->db->where('status',2);
        $this->db->where('userid in (select b.id from tbl_reg_user b where b.parrentid = '.$userid.')');
        //$this->db->where('userid',$_SESSION['id']);
        // $this->db->order_by("id", "desc");
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tblamount'); 
        //if($userid == 20001){
      // echo $this->db->last_query();
       //  exit();     
      //  }
          $check = $q->result_array();
        //if($userid == 20001){
       // print_r($q->result_array());
        //exit();
        //}
        if(count($check)>0){
        return $check;    
        } else{
            return false;
        }
        
    }
    function addUserReward(){
        $rewardName=$this->input->post('rewardName');
        $level1_reward=$this->input->post('level1_reward');
        $level2_reward=$this->input->post('level2_reward');
        $level3_reward=$this->input->post('level3_reward');


        $data = array(
            'rewardName'=>$rewardName,
            'level1_reward'=>$level1_reward,
            'level2_reward'=>$level2_reward,
            'level3_reward'=>$level3_reward,


            // 'email'=>$email,
            //'Phone'=>$tel,
            'ekpo'=>$_SESSION['id'],
            'edate'=>date('Y-m-d H:i:s')
        );
        // $this->db->where('is_active','1');
        // $this->db->where('id',$_SESSION['id']);
        // $this->db->set('is_active',0);
        // $this->db->select('*');
        $q = $this->db->insert("tblreward",$data);
        // $response = $q->result_array();

        return $q;
        // echo $this->db->last_query();
        // exit();


    }
    function add_plan(){
        $planName=$this->input->post('planName');
        $currency=$this->input->post('currency');
        $minDeposit=$this->input->post('minDeposit');
        $maxDeposit=$this->input->post('maxDeposit');
        $maxIncome=$this->input->post('maxIncome');
        $minWithdraw=$this->input->post('minWithdraw');
        $roi=$this->input->post('roi');
        $withdrawFee=$this->input->post('withdrawFee');

        $data = array(
            'name'=>$planName,
            'currency'=>$currency,
            'minDeposit'=>$minDeposit,
            'maxDeposit'=>$maxDeposit,
            'maxIncome'=>$maxIncome,
            'minWithdraw'=>$minWithdraw,
            'roi'=>$roi,
            'fee'=>$withdrawFee,

            // 'email'=>$email,
            //'Phone'=>$tel,
            'ckpo'=>$_SESSION['id'],
            'cdate'=>date('Y-m-d H:i:s')
        );
        // $this->db->where('is_active','1');
        // $this->db->where('id',$_SESSION['id']);
        // $this->db->set('is_active',0);
        // $this->db->select('*');
        $q = $this->db->insert("tblplan",$data);
        // $response = $q->result_array();

        return $q;
        // echo $this->db->last_query();
        // exit();


    }
    function updateROI($roi,$id){
         $data = array(
            'current_roi'=>$roi,
          
            'ckpo'=>$_SESSION['id'],
            'cdate'=>date('Y-m-d H:i:s')
        );
        // $this->db->where('is_active','1');
        $this->db->where('id',$id);
        // $this->db->set('is_active',0);
        // $this->db->select('*');
        $q = $this->db->update("tblamount",$data);
    }
    function user_profile_update(){
        $email=$this->input->post('email');
        $tel=$this->input->post('tel');
        $first_name=$this->input->post('first_name');
        $last_name=$this->input->post('last_name');

        $data = array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            // 'email'=>$email,
            //'Phone'=>$tel,
            'ckpo'=>$_SESSION['id'],
            'cdate'=>date('Y-m-d H:i:s')
        );
        // $this->db->where('is_active','1');
        $this->db->where('id',$_SESSION['id']);
        // $this->db->set('is_active',0);
        // $this->db->select('*');
        $q = $this->db->update("tbl_reg_user",$data);
        // $response = $q->result_array();
        if($q){
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $tel;

        }
        return $q;
        // echo $this->db->last_query();
        // exit();


    }
    function admin_status_update($action,$id,$type){

        if($action == 1){
            $status = 2;
        }else if($action == 2){
            $status = 3;
        }
        if($type == 1){
            if($status==2){
            $data = array(

                'status'=>$status,
                'plan_activeDate'=>date('Y-m-d H:i:s'),
                'ckpo'=>$_SESSION['id'],
                'cdate'=>date('Y-m-d H:i:s')
            );     
            } else{
                 $data = array(

                'status'=>$status,

                'ckpo'=>$_SESSION['id'],
                'cdate'=>date('Y-m-d H:i:s')
            );
            }
           
            // $this->db->where('is_active','1');
            $this->db->where('id',$id);
            // $this->db->set('is_active',0);
            // $this->db->select('*');
            $q = $this->db->update("tblamount",$data);   
        }
        else if($type == 2){
            $data = array(

                'status'=>$status,

                'ckpo'=>$_SESSION['id'],
                'cdate'=>date('Y-m-d H:i:s')
            );
            // $this->db->where('is_active','1');
            $this->db->where('id',$id);
            // $this->db->set('is_active',0);
            // $this->db->select('*');
            $q = $this->db->update("tblkyc",$data);
        }
        else if($type == 3){
            $data = array(

                'status'=>$status,

                'ckpo'=>$_SESSION['id'],
                'cdate'=>date('Y-m-d H:i:s')
            );
            // $this->db->where('is_active','1');
            $this->db->where('id',$id);
            // $this->db->set('is_active',0);
            // $this->db->select('*');
            $q = $this->db->update("tbl_withdraw",$data);
        }

        else if($type == 4){
            $data = array(

                'status'=>$status,

                'ckpo'=>$_SESSION['id'],
                'cdate'=>date('Y-m-d H:i:s')
            );
            // $this->db->where('is_active','1');
            $this->db->where('id',$id);
            // $this->db->set('is_active',0);
            // $this->db->select('*');
            $q = $this->db->update("tblplan",$data);
        }else if($type == 5){
            $data = array(

                'status'=>$status,

                'ckpo'=>$_SESSION['id'],
                'cdate'=>date('Y-m-d H:i:s')
            );
            // $this->db->where('is_active','1');
            $this->db->where('id',$id);
            // $this->db->set('is_active',0);
            // $this->db->select('*');
            $q = $this->db->update("tblreward",$data);
        }

        // $response = $q->result_array();
        /* if($q){
        $_SESSION['kin'] = $kin;
        $_SESSION['city'] = $city;
        $_SESSION['country'] = $country;

        }  */
        return $q;
        // echo $this->db->last_query();
        // exit();


    }
    function user_kin_update(){
        $kin=$this->input->post('kin');
        $city=$this->input->post('city');
        $country=$this->input->post('country');


        $data = array(
            'kin'=>$kin,
            'city'=>$city,
            'country'=>$country,
            'ckpo'=>$_SESSION['id'],
            'cdate'=>date('Y-m-d H:i:s')
        );
        // $this->db->where('is_active','1');
        $this->db->where('id',$_SESSION['id']);
        // $this->db->set('is_active',0);
        // $this->db->select('*');
        $q = $this->db->update("tbl_reg_user",$data);
        // $response = $q->result_array();
        if($q){
            $_SESSION['kin'] = $kin;
            $_SESSION['city'] = $city;
            $_SESSION['country'] = $country;

        }
        return $q;
        // echo $this->db->last_query();
        // exit();


    }
    function user_pwd_update(){
        $newpass=$this->input->post('newpass');


        $data = array(
            'password'=>$newpass,
            'ckpo'=>$_SESSION['id'],
            'cdate'=>date('Y-m-d H:i:s')
        );
        // $this->db->where('is_active','1');
        $this->db->where('id',$_SESSION['id']);
        // $this->db->set('is_active',0);
        // $this->db->select('*');
        $q = $this->db->update("tbl_reg_user",$data);
        // $response = $q->result_array();
        if($q){
            $_SESSION['password'] = $newpass;


        }
        return $q;
        // echo $this->db->last_query();
        // exit();


    }


    function checkEmailPwd(){
        $userinput=$this->input->post('userinput');

        $this->db->select('*');
        //$this->db->from('vw_cash_register');
        // $this->group_start(); //this will start grouping
        $this->db->where('( email ="'.$userinput.'" or Phone ="'.$userinput.'" ) ');
        // $this->db->or_where('Phone =',$email);
        // $this->group_end(); 
        $this->db->where('is_active',1);
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tbl_reg_user'); 
        // echo $this->db->last_query();
        //  exit();
        return $q->result_array();

    }
    function checkEmailPwd_($id){
        $userinput=$this->input->post('userinput');

        $this->db->select('*');
        //$this->db->from('vw_cash_register');
        // $this->group_start(); //this will start grouping
        $this->db->where('id ='.$id);
        // $this->db->or_where('Phone =',$email);
        // $this->group_end(); 
        $this->db->where('is_active',1);
        // $this->db->where('password',$password);                     

        $q = $this->db->get('tbl_reg_user'); 
        // echo $this->db->last_query();
        //  exit();
        return $q->result_array();

    }

    function get_dashboard_data($tbl_name="vw_cash_register"){

        $response = array();

        $get_month = $_GET['month'];
        //print_r($get_month);
        // exit();
        if($get_month){
            $date    =    ''.date("Y").'-'.$get_month.'-01';//your given date
            //echo $date;
            // exit();
            $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
            $first_date =  date("Y-m-d",$first_date_find);
            //exit();   
            //echo $first_date;
            //exit();
            $last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
            $last_date = date("Y-m-d",$last_date_find);



        }   else{
            $first_date = date('Y-m-d',strtotime('first day of this month'));
            $last_date = date('Y-m-d',strtotime('last day of this month'));    
        }

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
        $this->db->where('tbl_cash_register.date between "'.$first_date.'" and "'.$last_date.'"');
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
        $this->db->where('tbl_cash_register.date between "'.$first_date.'" and "'.$last_date.'"');
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
    function saveuser(){
        $name=$this->input->post('name');
        $father_name=$this->input->post('father_name');
        $cnic=$this->input->post('cnic');
        $desig=$this->input->post('desig');
        $parrentId=$this->input->post('parrentId');
        //if(strlen($this->input->post('dob'))>4){
        $dob=date('Y-m-d', strtotime($this->input->post('dob')) );//$this->input->post('dob');    


        // echo $parrentId ;

        //exit();
        $first_name=$this->input->post('first_name');
        $last_name=$this->input->post('last_name');
        $email=$this->input->post('email');
        $Phone=$this->input->post('Phone');
        $password=$this->input->post('password');
        $password_repeat=$this->input->post('password_repeat');
        /* $bank_name=$this->input->post('bank_name');
        $bank_account_no=$this->input->post('bank_account_no');
        $iban=$this->input->post('iban');
        $pwd=$this->input->post('pwd');
        $note=$this->input->post('note');
        $description=$this->input->post('description');
        $email=$this->input->post('email');
        $remarks=$this->input->post('remarks');   */

        $date =date('Y-m-d H:i:s');
        $id =$this->input->post('id');

        if($id>0){
            $data = array(
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'email'=>$email,
                'Phone'=>$Phone,
                'password'=>$password,
                /*'guardian_cell'=>$guardian_cell,
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
                'dob'=>$dob,            */
                'edate'=>$date,
                // 'ckpo'=>$_SESSION['id'],
                'is_active'=>1
            );
            $this->db->where('id',$id);
            $insert_id =   $this->db->update('tbl_reg_user',$data);
            return $insert_id;
        } else{
            $data = array(
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'email'=>$email,
                'Phone'=>$Phone,
                'password'=>$password,
                /*'guardian_cell'=>$guardian_cell,
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
                'dob'=>$dob,            */
                'edate'=>$date,
                'parrentid'=>$parrentId,
                // 'ckpo'=>$_SESSION['id'],
                'is_active'=>1
            );

            $response =   $this->db->insert('tbl_reg_user',$data);
            $insert_id = $this->db->insert_id();

            return $insert_id;
        } 
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
        $get_month = $_GET['month'];
        //print_r($get_month);
        // exit();
        if($get_month){
            $date    =    ''.date("Y").'-'.$get_month.'-01';//your given date
            //echo $date;
            // exit();
            $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
            $first_date =  date("Y-m-d",$first_date_find);
            //exit();   
            //echo $first_date;
            //exit();
            $last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
            $last_date = date("Y-m-d",$last_date_find);



        }   else{
            $first_date = date('Y-m-d',strtotime('first day of this month'));
            $last_date = date('Y-m-d',strtotime('last day of this month'));    
        }
        // Select record
        $this->db->select('(select name from tbl_type where id =tbl_cash_register.type_id)as  type_name, SUM(amount) as amount');
        $this->db->where('is_active',1);
        $this->db->where('date >=',$first_date);
        $this->db->where('date <=',$last_date);
        $this->db->group_by('type_id') ;
        $q = $this->db->get('tbl_cash_register');
        $response = $q->result_array();
        // echo $this->db->last_query();
        // exit();
        return $response;
    }
    function get_piechart_dashboard(){
        $response = array();

        $get_month = $_GET['month'];
        //print_r($get_month);
        // exit();
        if($get_month){
            $date    =    ''.date("Y").'-'.$get_month.'-01';//your given date
            //echo $date;
            // exit();
            $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
            $first_date =  date("Y-m-d",$first_date_find);
            //exit();   
            //echo $first_date;
            //exit();
            $last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
            $last_date = date("Y-m-d",$last_date_find);



        }   else{
            $first_date = date('Y-m-d',strtotime('first day of this month'));
            $last_date = date('Y-m-d',strtotime('last day of this month'));    
        }
        // Select record
        $this->db->select(' (select name from tbl_category where id =tbl_cash_register.category_id) as name , SUM(amount) as amount');
        $this->db->where('is_active',1);
        $this->db->where('category_id >',0);
        $this->db->where('date >=',$first_date);
        $this->db->where('date <=',$last_date);
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
                                        } 
                                        else
                                            if($menu_id == 20){
                                                $table="tblstd";
                                            } 
                                            /*$date =date('Y-m-d H:i:s', strtotime('2010-10-12 15:09:00') );
                                            $data = array(
                                            'name'=>$name,
                                            'description'=>$description,
                                            'remarks'=>$remarks,
                                            'edate'=>$date,
                                            'ekpo'=>$_SESSION['id'],
                                            'is_active'=>1
                                            ); */

                                            if($button_id == 1){


            $this->db->where('id',$row_id);
            if($menu_id == 20){
                $this->db->where('(status is NULL or status = 0) ',Null,false) ;
                //$this->db->or_where('status = 0') ;
            }else{
                $this->db->where('is_active','1');    
            }
            $this->db->select('*');
            $q = $this->db->get($table);
            // echo $this->db->last_query();
            //  exit();
            $response = $q->result_array();
            return $response;
        } else
            if($button_id == 2){
                $data = array(
                    'is_active'=>0,
                    'ckpo'=>$_SESSION['id'],
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
    function get_std_class_list($data){
        $class=$this->input->post('class');
        $year=$this->input->post('year');
        $month=$this->input->post('month');
        // echo   $userid;
        $response = array();
        $query = $this->db->query("SELECT * from tblstd WHERE class ='$class' and (status is null or status = 0)");
        //echo $this->db->last_query();
        // exit();  
        $count =  $query->num_rows();
        if($count>0){
            $response = $query->result_array();    
        }
        //print_r($response);
        return $response;
    }
    function get_fee_classwise($class,$year,$month){
        $response = array();
        $query = $this->db->query("SELECT * from tblfee WHERE stdid in (select id from tblstd where class = '$class' and (status is null or status = 0)) and year =$year and month = '$month' ");
        //echo $this->db->last_query();
        // exit();  
        $count =  $query->num_rows();
        if($count>0){
            $response = $query->result_array();    
        }
        //print_r($response);
        return $response;  
    }
    function get_fee($stdid,$year,$month){
        $response = array();
        $query = $this->db->query("SELECT * from tblfee WHERE stdid = $stdid and year =$year and month = '$month' ");
        //echo $this->db->last_query();
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
                'ekpo'=>$_SESSION['id'],
                'is_active'=>1
            );
            $response =   $this->db->insert('tbl_user_rights',$data);
        }   else{
            if($menu_type == 'show_menu'){
                $show_menu = $status;
                $data = array(
                    'show_menu'=>$show_menu,
                    'cdate'=>$date,
                    'ckpo'=>$_SESSION['id'],
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
                    'ckpo'=>$_SESSION['id'],
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
                    'ckpo'=>$_SESSION['id'],
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
                    'ckpo'=>$_SESSION['id'],
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
                'ckpo'=>$_SESSION['id'],
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
                'ekpo'=>$_SESSION['id'],
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
    function add_std(){
        // DebugBreak();
        $class =$this->input->post('class');
        $name =$this->input->post('name');
        $fname =$this->input->post('fname');
        $dob =$this->input->post('dob');
        $bform =$this->input->post('bform');
        $fnic =$this->input->post('fnic');
        $adm_date =$this->input->post('adm_date');
        $section =$this->input->post('section');

        $remarks =$this->input->post('remarks');
        $father_occouption =$this->input->post('father_occouption');
        $status =$this->input->post('status');
        $cell =$this->input->post('cell');
        $reqFee =$this->input->post('reqFee');
        $address =$this->input->post('address');


        $id =$this->input->post('id');
        // echo $amount ;
        // exit();
        if($id>0){
            $date =date('Y-m-d H:i:s');
            $data = array(

                'class'=>$class,
                'name'=>$name,
                'fname'=>$fname,
                'dob'=>$dob,
                'bform'=>$bform,
                'fnic'=>$fnic,
                'adm_date'=>$adm_date,
                'section'=>$section,
                'remarks'=>$remarks,
                'father_occouption'=>$father_occouption,
                'cell'=>$cell,
                'status'=>$status,
                'cdate'=>$date,
                'reqFee'=>$reqFee,
                'address'=>$address,
                'ckpo'=>$_SESSION['id'],
                //'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tblstd',$data);
            //  echo     $this->db->last_query();
            $insert_id = $id;                    

            //$insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else{

            $date =date('Y-m-d H:i:s');
            $data = array(


                'class'=>$class,
                'name'=>$name,
                'fname'=>$fname,
                'dob'=>$dob,
                'bform'=>$bform,
                'fnic'=>$fnic,
                'adm_date'=>$adm_date,
                'section'=>$section,
                'cell'=>$cell,
                'remarks'=>$remarks,
                'father_occouption'=>$father_occouption,
                'status'=>$status,
                'edate'=>$date,
                'reqFee'=>$reqFee,
                'address'=>$address,
                'ekpo'=>$_SESSION['id']
                //'is_active'=>1
            );

            $response =   $this->db->insert('tblstd',$data);
            // echo $this->db->last_query();
            // exit();
            $insert_id = $this->db->insert_id();
            return $insert_id;

        }



    }
    function add_cash_register(){
        $company =$this->input->post('company_id');
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
                'ckpo'=>$_SESSION['id'],
                //'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_cash_register',$data);
            //  echo     $this->db->last_query();
            $insert_id = $id;                    

            //$insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else{

            $date =date('Y-m-d H:i:s');
            $data = array(

                'company_id'=>$company,
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
                'ekpo'=>$_SESSION['id'],
                'is_active'=>1
            );
            $response =   $this->db->insert('tbl_cash_register',$data);
            //echo $this->db->last_query();
            // exit();
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
                'ckpo'=>$_SESSION['id'],
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
                'ekpo'=>$_SESSION['id'],
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
                'ckpo'=>$_SESSION['id'],
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
                'ekpo'=>$_SESSION['id'],
                'is_active'=>1
            );

            $response =   $this->db->insert('tbl_bank',$data);   
        }



        return $response;
    }
    function add_company(){
        $name=$this->input->post('name');
        $address=$this->input->post('address');
        $description=$this->input->post('description');
        $remarks=$this->input->post('remarks');
        $date =date('Y-m-d H:i:s');
        $id =$this->input->post('id');

        if($id>0){
            $data = array(
                'name'=>$name,
                'address'=>$address,
                'description'=>$description,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>$_SESSION['id'],
                'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tbl_company',$data);
        } else{
            $data = array(
                'name'=>$name,
                'address'=>$address,
                'description'=>$description,
                'remarks'=>$remarks,
                'edate'=>$date,
                'ekpo'=>$_SESSION['id'],
                'is_active'=>1
            );

            $response =   $this->db->insert('tbl_company',$data);
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
                'ckpo'=>$_SESSION['id'],
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
                'ekpo'=>$_SESSION['id'],
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
                'ckpo'=>$_SESSION['id'],
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
                'ekpo'=>$_SESSION['id'],
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
                'ckpo'=>$_SESSION['id'],
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
                'ekpo'=>$_SESSION['id'],
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
                'ckpo'=>$_SESSION['id'],
                'is_active'=>1
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
                'ekpo'=>$_SESSION['id'],
                'is_active'=>1
            );

            $response =   $this->db->insert('tbl_user',$data);
            $insert_id = $this->db->insert_id();

            return $insert_id;
        }
        //return $response;
    }
    function add_fee(){
        $stdid=$this->input->post('stdid');
        $year=$this->input->post('year');
        $month=$this->input->post('month');
        $fee=$this->input->post('fee');
        //  echo $name;
        $date =date('Y-m-d H:i:s');
        $id =0;
        //  echo $id;
        $response = false;
        $query = $this->db->query("SELECT id from tblfee WHERE stdid = $stdid and year =$year and month = '$month' ");
        // echo $this->db->last_query();
        //  exit();  
        $count =  $query->num_rows();
        if($count>0){
            $response = $query->result_array();
            $id = $response[0]['id'];    
        }
        if($id>0){
            $data = array(
                'stdid'=>$stdid,
                'year'=>$year,
                'month'=>$month,
                'amount'=>$fee,
                'cdate'=>$date,
                'ckpo'=>$_SESSION['id'],
                //  'is_active'=>1
            );
            $this->db->where('id',$id);
            $response =   $this->db->update('tblfee',$data);
        } else{

            $data = array(
                'stdid'=>$stdid,
                'year'=>$year,
                'month'=>$month,
                'amount'=>$fee,
                'edate'=>$date,
                'ekpo'=>$_SESSION['id'],
                //  'is_active'=>1
            );
            $response =   $this->db->insert('tblfee',$data);
            //print_r($response);
            // $this->db->last_query();  
        }




        return $response;
    }
    function add_category(){
        $name=$this->input->post('name');
        $description=$this->input->post('description');
        $remarks=$this->input->post('remarks');
        //  echo $name;
        $date =date('Y-m-d H:i:s');
        $id =$this->input->post('id');
        //  echo $id;
        $response = false;

        if($id>0){
            $data = array(
                'name'=>$name,
                'description'=>$description,
                'remarks'=>$remarks,
                'cdate'=>$date,
                'ckpo'=>$_SESSION['id'],
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
                'ekpo'=>$_SESSION['id'],
                'is_active'=>1
            );
            $response =   $this->db->insert('tbl_category',$data);
            //print_r($response);
            // $this->db->last_query();  
        }




        return $response;
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