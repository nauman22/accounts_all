<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct(){

        parent::__construct();
        $this->load->library('session');
        // Load model
        $this->load->model('Welcome_model');  
    }
    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    *         http://example.com/index.php/welcome
    *    - or -
    *         http://example.com/index.php/welcome/index
    *    - or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see https://codeigniter.com/userguide3/general/urls.html
    */
    public function index()
    {
        $this->load->view('common/header_home.php');
        $this->load->view('common/menu_home.php');
        $this->load->view('pages/homepage.php');
        $this->load->view('common/footer_home.php');
        /* $is_login= $this->check_session();
        if($is_login){
        redirect($this->login());  
        return;
        // exit();
        } 
        */
        // print_r($_SESSION);
        //echo $_SESSION['id'];
        // return;
        /*$userid = $_SESSION['id'];
        $data['menu_id'] =1; //$this->Welcome_model->get_menu("dashboard");

        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        //print_r($data['user_rights']);
        //exit();
        $data['dashboard'] = $this->Welcome_model->get_dashboard_data("admin");
        $this->load->view('common/header.php',$data);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);
        if(@$data['single_menu'][0]['show_menu'] != 1 )
        {
        if( $_SESSION['type'] == 1){
        $this->load->view('pages/dashboard_inst.php'); 
        $this->load->view('common/footer.php');   
        }else{
        $this->load->view('errors/html/401.php');       
        }

        } 
        else{
        $this->load->view('pages/dashboard.php',$data);
        $this->load->view('common/footer.php'); 
        $data['barchart'] =$this->bar_chart_dashboard();
        for($i=0; $i<count($data['barchart']); $i++){
        $data['type'][] =  $data['barchart'][$i]['type_name'];
        $data['amount'][] =  $data['barchart'][$i]['amount'];
        $random = mt_rand(0, 16777215);
        $color = "#" . dechex($random);
        $data['color'][] = $color; 
        }
        $data['piechart'] =$this->pie_chart_dashboard(); 
        for($i=0; $i<count($data['piechart']); $i++){
        $data['pie_category_name'][] =  $data['piechart'][$i]['name'];
        $data['pie_amount'][] =  $data['piechart'][$i]['amount'];
        $random = mt_rand(0, 16777215);
        $color = "#" . dechex($random);
        $data['pie_color'][] = $color; 
        } */
        //print_r($data['barchart']);
        //exit();


        // $this->load->view('common/chart_bar.php',$data);
        //}

        // $this->load->view('errors/html/401.php');
        //$this->load->view('pages/dashboard.php');
        // $this->load->view('common/footer.php');
        //$this->load->view('pages/login.php');
    }
    public function saveMsg(){
        $data = array("msg"=>$this->Welcome_model->saveMsg());

        redirect('Welcome/index');  
    }
    public function about()
    {
        $this->load->view('common/header_home.php');
        $this->load->view('common/menu_home.php');
        $this->load->view('pages/about.php');
        $this->load->view('common/footer_home.php');


    }

    public function profile_user()
    {


        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/profile_user.php');  
        $this->load->view('common/footer_user.php');  
    }

    public function withdrawal()
    {

        $data =array("data"=>$this->Welcome_model->getUserWithdraw()) ;
        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/withdrawal.php',$data);  
        $this->load->view('common/footer_user.php');  
    }
    public function add_reward_level()
    {

        $data =array("data"=>$this->Welcome_model->addUserReward()) ;
        redirect('Welcome/plan_reward');
    }
    public function plan_reward()
    {

        $data =array("data"=>$this->Welcome_model->getUserReward()) ;
        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/plan_level.php',$data);  
        $this->load->view('common/footer_user.php');  
    }
    public function withdrawMode()
    {

        $id = $_SESSION['phone'];
        $data = array('email'=>$_SESSION['email'], 'phone'=>$_SESSION['phone']);
        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/withdrawMode.php',$data);  
        $this->load->view('common/footer_user.php');  
    }

    public function tree()
    {

        $userid = $_SESSION['id'];
        $alluser['data'] = $this->Welcome_model->getUserReward_level($userid);
        $lvl = 2;
        $alluser['level2'] = "";
        $alluser['level3'] = "";
        for($i=0; $i<count($alluser['data']); $i++){
            // echo $alluser['data'][$i]['userid'];
            // exit();
            if($alluser['data'][$i]['userid']>0){
                // echo $this->Welcome_model->getUserReward_level($alluser['data'][$i]['userid']);
                // exit();
                // if($this->Welcome_model->getUserReward_level($alluser['data'][$i]['userid']) == "A"){
                $alluser['level2'][$i] = $this->Welcome_model->getUserReward_level($alluser['data'][$i]['userid']);
                // }

                //echo  $alluser['level2'];
                //print_r( $alluser['level2']);
                //print_r($alluser['level2'][$i]);     
            }
        }
        //print_r($alluser['level2']);
        // exit();
        for($i=0; $i<count( $alluser['level2']); $i++){
            if($alluser['level2'][$i]['userid']>0){
                $alluser['level3'][$i] =$this->Welcome_model->getUserReward_level( $alluser['level2'][$i]['userid']);     
            }
        }
        // print_r($alluser);
        //  exit();

        $data = array("data"=>$alluser,'reward'=>$this->Welcome_model->getUserReward());
        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/tree.php',$data);  
        $this->load->view('common/footer_user.php');  
    }
    public function buyPlan()
    {
        $data =array("data"=>$this->Welcome_model->getUserDepositData()
            ,"plan"=>$this->Welcome_model->getUserPlan()
        ) ;

        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/buyPlan.php',$data);  
        $this->load->view('common/footer_user.php');  
    }
    public function rewardList()
    {


        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/rewardList.php');  
        $this->load->view('common/footer_user.php');  
    }
    public function plan()
    {


        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/plan.php');  
        $this->load->view('common/footer_user.php');  
    }
    public function donation()
    {


        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/donation.php');  
        $this->load->view('common/footer_user.php');  
    }
    public function support()
    {


        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/support.php');  
        $this->load->view('common/footer_user.php');  
    }
    public function kyc()
    {
        $data =array("data"=>$this->Welcome_model->getUserkyc()) ;


        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/kyc.php',$data);  
        $this->load->view('common/footer_user.php');  
    }
    public function adminPlan()
    {
        $data =array("data"=>$this->Welcome_model->getUserPlan()) ;


        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/plan_crud.php',$data);  
        $this->load->view('common/footer_user.php');  
    }
    public function add_plan()
    {
        $data =array("data"=>$this->Welcome_model->add_plan()) ;
        redirect('Welcome/adminPlan');       
    }
    public function adminDashboard()
    {
        $action = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $type = $this->uri->segment(5);

        if($id>0){
            if($type==5){
                $data =array("data"=>$this->Welcome_model->admin_status_update($action,$id,$type)) ;
                redirect('Welcome/plan_reward');      
            }
            if($type==4){
                $data =array("data"=>$this->Welcome_model->admin_status_update($action,$id,$type)) ;
                redirect('Welcome/adminPlan');      
            }

            $data =array("data"=>$this->Welcome_model->admin_status_update($action,$id,$type)) ;
            redirect('Welcome/adminDashboard');  

        }
        $data =array(
            "data"=>$this->Welcome_model->getUserDepositData_admin(),
            "kyc"=>$this->Welcome_model->getUserDepositData_admin_kyc(),
            "withdraw"=>$this->Welcome_model->getUserDepositData_admin_widthdraw(),

        ) ;
        $data['query'] =array("data"=>$this->Welcome_model->getUserDepositData_admin_amount()) ;


        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/adminDashboard.php',$data);  
        $this->load->view('common/footer_user.php');  
    }
    public function policy()
    {
        $this->load->view('common/header_home.php');
        $this->load->view('common/menu_home.php');
        $this->load->view('pages/policy.php');
        $this->load->view('common/footer_home.php');


    }
    public function contact()
    {
        $this->load->view('common/header_home.php');
        $this->load->view('common/menu_home.php');
        $this->load->view('pages/contact.php');
        $this->load->view('common/footer_home.php');


    }
    public function user_profile_update(){
        $data = $this->Welcome_model->user_profile_update();

        redirect('Welcome/profile_user');  
    }
    public function user_kin_update(){

        $data = $this->Welcome_model->user_kin_update();
        redirect('Welcome/profile_user');  
    }
    public function user_pwd_update(){
        $data = $this->Welcome_model->user_pwd_update();
        redirect('Welcome/profile_user');  
    }

    public function user_deposit()
    {     $insreted_id = $this->Welcome_model->user_deposit();
        //  echo  $insreted_id ;
        // exit();
        $id = $insreted_id;
        $path = user_deposit_img; // upload directory

        $files = $_FILES['file_upload'];
        // print_r($files);
        $title = $id;
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);

        }
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|jpeg',
            'overwrite'     => TRUE,                       
        );

        $resp = $this->load->library('upload', $config);
        //  print_r($resp);
        // exit();
        $images = array();
        $increment = 1;
        foreach ( $_FILES['file_upload'] as $key => $image) {
            // echo 1;
            // exit();
            /*  $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];  */
            // echo $files['type'][$key];

            $fileName = $title.".jpg";
            //echo $fileName;
            // exit();
            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file_upload')) {
                $error = array('error' => $this->upload->display_errors());
                echo $error;
                print_r($error);
                exit();
                $this->session->set_flashdata('error',$error['error']);
                redirect('Welcome/buyPlan');
            }
            if ($this->upload->do_upload('file_upload')) {
                $this->upload->data();
            } else {
                return false;
            }
            break;
            // $increment++;
        }
        //    $response = $this->upload_files($path,$title,$files);

        //   echo $response ;

        redirect('Welcome/buyPlan');
    }
    public function user_kyc()
    {     $insreted_id = $this->Welcome_model->user_kyc();
        $id = $insreted_id;
        $path = user_kyc; // upload directory

        $files = $_FILES['file_upload'];
        // print_r($files);
        $title = $id;
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);

        }
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png|jpeg',
            'overwrite'     => TRUE,                       
        );

        $resp = $this->load->library('upload', $config);
        //print_r($resp);
        $images = array();
        $increment = 1;
        foreach ( $_FILES['file_upload'] as $key => $image) {
            //echo 1;
            /*  $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];  */
            // echo $files['type'][$key];

            $fileName = $title.".jpg";
            //  echo $fileName;
            // exit();
            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_upload')) {
                $this->upload->data();
            } else {
                return false;
            }
            break;
            // $increment++;
        }
        //    $response = $this->upload_files($path,$title,$files);

        //   echo $response ;

        redirect('Welcome/kyc');
    }
    public function user_img_update()
    {
        $id = $_SESSION['id'];
        $path = user_img; // upload directory

        $files = $_FILES['file_upload'];
        // print_r($files);
        $title = $id;
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);

        }
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => TRUE,                       
        );

        $resp = $this->load->library('upload', $config);
        //print_r($resp);
        $images = array();
        $increment = 1;
        foreach ( $_FILES['file_upload'] as $key => $image) {
            //echo 1;
            /*  $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];  */
            // echo $files['type'][$key];

            $fileName = $title.".jpg";
            //  echo $fileName;
            // exit();
            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_upload')) {
                $this->upload->data();
            } else {
                return false;
            }
            break;
            // $increment++;
        }
        //    $response = $this->upload_files($path,$title,$files);

        //   echo $response ;

        redirect('Welcome/profile_user');
    }



    public function register()
    {
        $is_login= $this->check_session();
        /* if($is_login){
        redirect(login);  
        return;
        // exit();
        }*/ 

        // $this->load->view('errors/html/401.php');
        //$this->load->view('pages/dashboard.php');
        // $this->load->view('common/footer.php');

        $this->load->view('common/header_home.php');
        $this->load->view('common/menu_home.php');
        $this->load->view('pages/register.php');
        $this->load->view('common/footer_home.php');
    }
    public function chkPwd(){
        if($_POST['pwd'] == $_SESSION['password']){
            echo json_encode(array("resp"=>"match")) ;
            exit();
        } else{
            echo json_encode(array("resp"=>"password not matched")) ;
            exit();
        }
    } 
    public function withdrawl_update(){
        $data = $this->Welcome_model->withdrawl_update();
        if($data>0){
            echo json_encode(array("resp"=>"match")) ;
            exit();
        } else{
            echo json_encode(array("resp"=>"Data not Saved!")) ;
            exit();
        }
    }   
    public function login_check()
    {
        /* $is_login= $this->check_session();
        if($is_login){
        redirect($this->home_user());  
        // return;
        // exit();
        }    */
        $data = $this->Welcome_model->check_login();

        // $this->load->view('errors/html/401.php');
        //$this->load->view('pages/dashboard.php');
        // $this->load->view('common/footer.php');
        $data_['msg'] ="";
        // print_r($_POST);
        //$data = $this->Welcome_model->login();
        $data_['data']=$data;
        /*  print_r($data);
        echo $data[0]['is_active']; 
        exit();  */
        if($data){
            if($data[0]['is_active'] != 1 ){
                $data_['msg'] ="Your account is in-active, please contact to Admin.";
            } else{
                $_SESSION['id'] = $data[0]['id'];
                $_SESSION['first_name'] = $data[0]['first_name'];
                $_SESSION['last_name'] = $data[0]['last_name'];
                $_SESSION['address'] = $data[0]['address'];
                $_SESSION['phone'] = $data[0]['Phone'];
                $_SESSION['email'] = $data[0]['email'];
                $_SESSION['password'] = $data[0]['password'];
                $_SESSION['is_active'] = $data[0]['is_active'];
                $_SESSION['pic'] = $data[0]['pic'];
                $_SESSION['type'] = $data[0]['type'];
                $_SESSION['kin'] = $data[0]['kin'];
                $_SESSION['city'] = $data[0]['city'];
                $_SESSION['parrentId'] = $data[0]['parrentId'];
                $_SESSION['plan'] = $data[0]['plan'];
                $_SESSION['country'] = $data[0]['country'];
                $_SESSION['username'] = $data[0]['username'];
                $_SESSION['parrentid'] = $data[0]['parrentid'];
                $_SESSION['status'] = $data[0]['status'];
                //  redirect(index);    
            }

            //$this->session->set_userdata($_SESSION); 
        } else{
            $data_['msg'] ="Incorrect user credentials!";
        }  
        if($data != false){
            redirect('Welcome/home_user');
            /*$this->load->view('common/header_user.php');
            $this->load->view('common/menu_user.php');
            $this->load->view('common/topbar_user.php');
            $this->load->view('pages/dashboard_tlf.php');  
            $this->load->view('common/footer_user.php'); */  
        } else
        {
            $data = array('message'=>"incorrect email/ phone or password! " , cred=>$_POST);
            $this->load->view('common/header_home.php');
            $this->load->view('common/menu_home.php');
            $this->load->view('pages/login.php',$data);  
            $this->load->view('common/footer_home.php');      
        }

    }
    public function sendMsgWhatsApp(){
        $phoneNo; $msg;
        $phoneNo = "923456218851"."@c.us";
        $msg = 'Hello World';
        //The idInstance and apiTokenInstance values are available in your account, double brackets must be removed
        $url = 'https://api.callmebot.com/whatsapp.php?phone=923456218851&text=This+is+a+test&apikey=7219206';

        //chatId is the number to send the message to (@c.us for private chats, @g.us for group chats)
        $data = array(
            'chatId' => $phoneNo,
            'message' => $msg
        );

        $options = array(
            'http' => array(
                'header' => "Content-Type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);

        $response = file_get_contents($url, false, $context);

        echo $response;

    }
    public function home_user(){
        $getdata = $this->Welcome_model->getUserDashboardData();
        //echo $getdata[0]['plan_activeDate'];


        //print_r($_SESSION);
        // EXIT();

        // echo $today;
        for($i=0; $i<count($getdata); $i++){
            $amount = $getdata[$i]['amount'];
           // echo $amount;
           // exit();
            $perday = $amount / 30;
            //echo $getdata[$i]['plan_activeDate'];
            $plan_activeDate = $getdata[$i]['plan_activeDate'];// date(strtotime($getdata[$i]['plan_activeDate']),'Y-m-d H:i:s');   //from database
            $plan_activeDate = date(strtotime($plan_activeDate),'Y-m-d H:i:s');
            //exit();
            // $datediff = $today-date(strtotime($plan_activeDate),'Y-m-d H:i:s');
            // echo $datediff;
           
               
                //  echo "<pre>" .$datediff."</pre>";
             
                //  echo $total_days;
                // exit();
                //$plan_activeDate = new DateTime($plan_activeDate);
                $today = new DateTime($today);
                $date = strtotime ( $getdata[$i]['plan_activeDate'] ); 
                $start =  date ( 'Y-m-d' , $date );
                // $start = date($getdata[0]['plan_activeDate'],'Y-m-d');
                //exit();
                $end = date('Y-m-d',time());
                //echo $start;
                //exit();
                $today = $now;
                $start = new DateTime($start);
                $end = new DateTime($end);
                // otherwise the  end date is excluded (bug?)
                $end->modify('+1 day');

                $interval = $end->diff($start);

                // total days
                $days = $interval->days;

                // create an iterateable period of date (P1D equates to 1 day)
                $period = new DatePeriod($start, new DateInterval('P1D'), $end);

                // best stored as array, so you can add more than one
                $holidays = array('2012-09-07');

                foreach($period as $dt) {
                    $curr = $dt->format('D');

                    // substract if Saturday or Sunday
                    if ($curr == 'Sat' || $curr == 'Sun') {
                        $days--;
                    }

                    // (optional) for the updated question
                    elseif (in_array($dt->format('Y-m-d'), $holidays)) {
                        $days--;
                    }
                }


                //echo $days; // 4
               // exit();
                if($days<23){
                   // echo "<pre>".$amount."</pre>";
                    $roi = $perday*$days;
                    //echo "<pre>".$roi."</pre>";
                   // exit();
                }else{
                    $roi = $perday*22;
                   // echo "<pre>".$roi."</pre>";
                } 
            $u = $this->Welcome_model->updateROI($roi,$getdata[$i]['id']); 
        }
      
       // exit();
        $data =array(
            "data"=>$this->Welcome_model->getUserDashboardData(),


        ) ;
        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/dashboard_tlf.php',$data);  
        $this->load->view('common/footer_user.php'); 
    }
    public function checkEmailPwd(){
        $data = $this->Welcome_model->checkEmailPwd();
        if($data == false){
            $data['msg'] = "Incorrect Email / Phone No. ";
            $this->load->view('pages/forgetpwd.php',$data);   
        }  else{
            // require FCPATH . 'vendor/autoload.php';
            // require Kreait\Firebase\Factory;

            // $factory = (new Factory)->withServiceAccount('projecttmp-14e2d-firebase-adminsdk-bz552-20eaf27a05.json');
            $this->load->view('pages/verify.php',$data);    
        }

    }
    public function forgetpwd()
    {
        $is_login= $this->check_session();
        /* if($is_login){
        redirect(login);  
        return;
        // exit();
        }*/ 

        // $this->load->view('errors/html/401.php');
        //$this->load->view('pages/dashboard.php');
        // $this->load->view('common/footer.php');
        $this->load->view('common/header_home.php');
        $this->load->view('common/menu_home.php');
        $this->load->view('pages/forgetpwd.php');
        $this->load->view('common/footer_home.php');   
    }
    public function saveUser(){
        //DebugBreak();
        $data['user'] = $this->Welcome_model->saveuser();

        $data = array('message'=>"Successful Registered " , 'cred'=>$_POST);
        $this->load->view('common/header_user.php');
        $this->load->view('common/menu_user.php');
        $this->load->view('common/topbar_user.php');
        $this->load->view('pages/dashboard_tlf.php');  
        $this->load->view('common/footer_user.php');  

    }
    public function upload_excel(){
        $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        //$data['menu'] = $this->Welcome_model->get_menu("profile");
        $userid = $_SESSION['id'];
        $data['menu_id'] =10; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        $this->load->view('pages/upload_excel.php');
        $this->load->view('common/footer.php'); 
    }
    public function excel_read(){
        $msg = "";
        $response = false;
        // if ($this->input->post('submit')) {
        $path = 'assets/uploads/excel/';
        require_once APPPATH . "/third_party/PHPExcel-1.8.1/Classes/PHPExcel.php";
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);            
        if (!$this->upload->do_upload('uploadFile')) {
            $msg = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        if(empty($msg)){
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                // echo "<pre>".print_r($allDataInSheet)."</pre>";
                // exit();
                $flag = true;
                $i=0;
                foreach ($allDataInSheet as $value) {
                    if($flag){
                        $flag =false;
                        continue;
                    }
                    $inserdata[$i]['date'] = $value['B'];
                    $inserdata[$i]['description'] = $value['C'];
                    $inserdata[$i]['category'] = $value['D'];
                    $inserdata[$i]['payment_method'] = $value['E'];
                    $inserdata[$i]['amount'] = $value['F'];
                    $i++;
                }               
                $result = $this->Welcome_model->excel_importData($inserdata);   
                if($result){
                    $response = true;
                    $msg =  "Imported successfully";
                }else{
                    $msg =  "ERROR !";
                }             
            } catch (Exception $e) {
                $msg = ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' .$e->getMessage());
            }
        }else{
            $msg = $error['error'];
        }
        $data=array(
            'status'=>$response,
            'message'=>$msg,
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
        // }
        // $this->load->view('upload_excel');
    }


    public function bar_chart_dashboard(){

        $current_month = date('m', strtotime('+6 months'));;
        if($current_month <= 6){

            $months_name =["January", "February", "March", "April", "May", "June"];

        } else{
            $months_name =["July", "August", "September", "October", "November", "December"];
        }
        return  $this->Welcome_model->get_barchart_dashboard();

        // print_r($data['barchart']);
    }
    public function pie_chart_dashboard(){

        return  $this->Welcome_model->get_piechart_dashboard();


    }
    public function reports()
    {     
        $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $data['type'] = $this->Welcome_model->get_type($id=null);
        $data['account'] = $this->Welcome_model->get_account($id=null);
        $data['head'] = $this->Welcome_model->get_head($id=null);
        $data['category'] = $this->Welcome_model->get_category($id=null);
        $data['mode'] = $this->Welcome_model->get_mode($id=null);
        $data['user'] = $this->Welcome_model->get_user($id=null);
        $data['get_report_type'] = $this->Welcome_model->get_report_type($id=null);
        $data['company'] = $this->Welcome_model->get_company($id=null);
        $userid = $_SESSION['id'];
        $data['menu_id'] =16; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        //$data['menu'] = $this->Welcome_model->get_menu("reports");
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/reports.php');
            $this->load->view('common/footer.php');
        }

    }
    public function profile()
    {    $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        //$data['menu'] = $this->Welcome_model->get_menu("profile");
        $userid = $_SESSION['id'];
        $data['menu_id'] =10; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/profile.php');
            $this->load->view('common/footer.php');
        }

    }
    public function fee_crud(){
        $insertId = $this->Welcome_model->add_fee();
        $response = 0;
        if($insertId >0){
            $response = true;

        }
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();

    }
    public function insert_profile()
    {

        // $this->check_session();

        $insertId = $this->Welcome_model->add_profile();
        $response = 0;
        if($insertId >0){
            $response = true;

            if(isset($_FILES['staff_img'])){
                $path = employee_img.$insertId."/"; // upload directory
                $files = $_FILES['staff_img'];
                $title = $insertId;
                $this->upload_files($path,$title,$files);

            }
            if(isset($_FILES['staff_docs'])){
                $path = employee_doc.$insertId."/"; // upload directory
                $files = $_FILES['staff_docs'];
                $title = $insertId;
                $this->upload_files($path,$title,$files);
            }

        }
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }

    public function check_session()
    {
        if( !isset($_SESSION['id'])){
            return true;

        }
    }

    public function login()
    {     $data = "";
        //print_r($_POST);
        $data_['msg'] ="";  
        if($_POST){
            $data_['msg'] ="";
            // print_r($_POST);
            $data = $this->Welcome_model->login();
            $data_['data']=$data;
            //print_r($data);
            // echo $data[0]->is_active; 
            //exit();
            if($data){
                if($data[0]->is_active != 1 ){
                    $data_['msg'] ="Your account is in-active, please contact to Admin.";
                } else{
                    $_SESSION['id'] = $data[0]->id;
                    $_SESSION['name'] = $data[0]->name;
                    $_SESSION['cell_no'] = $data[0]->cell_no;
                    $_SESSION['address'] = $data[0]->address;
                    $_SESSION['email'] = $data[0]->email;
                    $_SESSION['desig'] = $data[0]->desig;
                    $_SESSION['is_active'] = $data[0]->is_active;
                    $_SESSION['pic'] = $data[0]->pic;
                    $_SESSION['type'] = $data[0]->type;
                    redirect(index);    
                }

                //$this->session->set_userdata($_SESSION); 
            } else{
                $data_['msg'] ="Incorrect user credentials!";
            }  
        }
        //$this->load->view('common/header.php');
        // $msg = array('data'=>$data[0]);

        $this->load->view('common/header_home.php');
        $this->load->view('common/menu_home.php');
        $this->load->view('pages/login.php',$data_);
        $this->load->view('common/footer_home.php');
        //$this->load->view('common/footer.php');
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        redirect("Welcome/login");
        //$this->load->view('common/header.php');
        //$this->load->view('pages/login.php');
        // $this->load->view('common/footer.php');
    }

    public function std()
    {   $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $data['type'] = $this->Welcome_model->get_type($id=null);
        $data['account'] = $this->Welcome_model->get_account($id=null);
        $data['head'] = $this->Welcome_model->get_head($id=null);
        $data['category'] = $this->Welcome_model->get_category($id=null);
        $data['mode'] = $this->Welcome_model->get_mode($id=null);
        $data['user'] = $this->Welcome_model->get_user($id=null);
        $data['company'] = $this->Welcome_model->get_company($id=null);

        //$data['cash_register'] = $this->Welcome_model->get_type($id=null);
        //print_r($data);
        // exit();
        //$data['menu'] = $this->Welcome_model->get_menu("cash register");
        $userid = $_SESSION['id'];
        $data['menu_id'] =20; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/std.php');
            $this->load->view('common/footer.php');
        }

    }
    public function fee()
    {   $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $data['type'] = $this->Welcome_model->get_type($id=null);
        $data['account'] = $this->Welcome_model->get_account($id=null);
        $data['head'] = $this->Welcome_model->get_head($id=null);
        $data['category'] = $this->Welcome_model->get_category($id=null);
        $data['mode'] = $this->Welcome_model->get_mode($id=null);
        $data['user'] = $this->Welcome_model->get_user($id=null);
        $data['company'] = $this->Welcome_model->get_company($id=null);

        //$data['cash_register'] = $this->Welcome_model->get_type($id=null);
        //print_r($data);
        // exit();
        //$data['menu'] = $this->Welcome_model->get_menu("cash register");
        $userid = $_SESSION['id'];
        $data['menu_id'] =21; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/std_fee.php');
            $this->load->view('common/footer.php');
        }

    }

    public function cash_register()
    {   $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $data['type'] = $this->Welcome_model->get_type($id=null);
        $data['account'] = $this->Welcome_model->get_account($id=null);
        $data['head'] = $this->Welcome_model->get_head($id=null);
        $data['category'] = $this->Welcome_model->get_category($id=null);
        $data['mode'] = $this->Welcome_model->get_mode($id=null);
        $data['user'] = $this->Welcome_model->get_user($id=null);
        $data['company'] = $this->Welcome_model->get_company($id=null);

        //$data['cash_register'] = $this->Welcome_model->get_type($id=null);
        //print_r($data);
        // exit();
        //$data['menu'] = $this->Welcome_model->get_menu("cash register");
        $userid = $_SESSION['id'];
        $data['menu_id'] =2; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/cash_register.php');
            $this->load->view('common/footer.php');
        }

    }
    public function assets()
    {   $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =15; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        //$data['menu'] = $this->Welcome_model->get_menu("assets");
        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/assets.php');
            $this->load->view('common/footer.php');
        }

    }
    public function bank()
    {   $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        //$data['menu'] = $this->Welcome_model->get_menu("bank account");
        $userid = $_SESSION['id'];
        $data['menu_id'] =14; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/bank.php');
            $this->load->view('common/footer.php');
        }

    }
    public function user_rights()
    {   $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =18; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['selected_icons'] = "";
        // $data['menu'] = $this->Welcome_model->get_menu("bank account");
        $data['user'] = $this->Welcome_model->get_user($userid);
        $data['menu_all'] = $this->Welcome_model->get_menu_all($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/user_rights.php');
            $this->load->view('common/footer.php');
        }

    }

    public function fee_report(){
        //echo "Hello";
        $class=$this->uri->segment(3);;
        $year=$this->uri->segment(4);;
        $month=$this->uri->segment(5);;
        $_POST['class'] =$class;
        $_POST['year'] =$year;
        $_POST['month'] =$month;
        $data =  $this->Welcome_model->get_std_class_list("");
        // print_r($data);
        // exit();
        $this->load->library('fpdf/FPDF');

        // $pdf = new FPDF();
        // $this->load->plugin('fpdf');
        //$pdf->AddPage();
        $pdf = new FPDF('P','mm','A4');

        $pdf->AddPage();
        /*output the result*/

        /*set font to arial, bold, 14pt*/
        $pdf->SetFont('Arial','B',20);

        /*Cell(width , height , text , border , end line , [align] )*/

        $pdf->Cell(50 ,10,'',0,0);
        $pdf->Cell(59 ,5,'Class Wise Fee Detail',0,0);
        $pdf->Cell(59 ,10,'',0,1);

        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(71 ,5,'Year : '.$year,0,0);
        $pdf->Cell(59 ,5,'',0,0);
        $pdf->Cell(59 ,5,'Month : '.$month,0,1);
        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'Class : '.$class,0,1);
        $pdf->SetFont('Arial','',10);

        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'Printing Date:',0,0);
        $pdf->Cell(34 ,5,date('d-m-Y h:m:s a'),0,1);
        /*
        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'',0,0);
        $pdf->Cell(34 ,5,'',0,1);

        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'',0,0);
        $pdf->Cell(34 ,5,'',0,1);


        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(59 ,5,'',0,0);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(189 ,10,'',0,1);   */



        $pdf->Cell(50 ,10,'',0,1);

        $pdf->SetFont('Arial','B',10);
        /*Heading Of the table*/
        $pdf->Cell(10 ,6,'Sr',1,0,'C');
        $pdf->Cell(60 ,6,'Candidate Name',1,0,'C');
        $pdf->Cell(60 ,6,'Father Name',1,0,'C');
        $pdf->Cell(20 ,6,'DOB',1,0,'C');
        //$pdf->Cell(20 ,6,'Entry Date',1,0,'C');
        $pdf->Cell(40 ,6,'Fee',1,1,'C');/*end of line*/
        /*Heading Of the table end*/
        $srno = 1;
        $subtotal = 0;
        $pdf->SetFont('Arial','',10);
        for ($i = 0; $i <count($data); $i++) {
            $pdf->Cell(10 ,6,$srno,1,0,'C');
            $pdf->Cell(60 ,6,$data[$i]['name'],1,0,'L');
            $pdf->Cell(60 ,6,$data[$i]['fname'],1,0,'L');
            $pdf->Cell(20 ,6,$data[$i]['dob'],1,0,'C');
            // $pdf->Cell(20 ,6,$data[$i]['class'],1,0,'R');
            $fee_detail = $this->Welcome_model->get_fee($data[$i]['id'],$year,$month);
            if($fee_detail){
                $pdf->MultiCell(40 ,6,$fee_detail[0]['amount']." (".date('d-m-Y',strtotime($fee_detail[0]['edate'])).")",1,'C',0);         
                $subtotal =  $subtotal+$fee_detail[0]['amount'];
            } else{
                $pdf->Cell(40 ,6,0,1,1,'C');                  
            }

            $srno++;
        }


        $pdf->Cell(130 ,6,'',0,0);
        $pdf->Cell(20 ,6,'Total',0,0);
        $pdf->Cell(40 ,6,$subtotal,1,1,'R');


        $pdf->Output();
    } 
    public function fee_report_not_paid(){
        //echo "Hello";
        $class=$this->uri->segment(3);;
        $year=$this->uri->segment(4);;
        $month=$this->uri->segment(5);;
        $_POST['class'] =$class;
        $_POST['year'] =$year;
        $_POST['month'] =$month;
        $data =  $this->Welcome_model->get_std_class_list("");
        // print_r($data);
        // exit();
        $this->load->library('fpdf/FPDF');

        // $pdf = new FPDF();
        // $this->load->plugin('fpdf');
        //$pdf->AddPage();
        $pdf = new FPDF('P','mm','A4');

        $pdf->AddPage();
        /*output the result*/

        /*set font to arial, bold, 14pt*/
        $pdf->SetFont('Arial','B',20);

        /*Cell(width , height , text , border , end line , [align] )*/

        $pdf->Cell(30 ,10,'',0,0);
        $pdf->Cell(59 ,5,'Class Wise Fee Not Submited Detail',0,0);
        $pdf->Cell(59 ,10,'',0,1);

        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(71 ,5,'Year : '.$year,0,0);
        $pdf->Cell(59 ,5,'',0,0);
        $pdf->Cell(59 ,5,'Month : '.$month,0,1);
        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'Class : '.$class,0,1);
        $pdf->SetFont('Arial','',10);

        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'Printing Date:',0,0);
        $pdf->Cell(34 ,5,date('d-m-Y h:m:s a'),0,1);
        /*
        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'',0,0);
        $pdf->Cell(34 ,5,'',0,1);

        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'',0,0);
        $pdf->Cell(34 ,5,'',0,1);


        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(59 ,5,'',0,0);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(189 ,10,'',0,1);   */



        $pdf->Cell(50 ,10,'',0,1);

        $pdf->SetFont('Arial','B',10);
        /*Heading Of the table*/
        $pdf->Cell(10 ,6,'Sr',1,0,'C');
        $pdf->Cell(60 ,6,'Candidate Name',1,0,'C');
        $pdf->Cell(60 ,6,'Father Name',1,0,'C');
        $pdf->Cell(20 ,6,'DOB',1,0,'C');
        //$pdf->Cell(20 ,6,'Entry Date',1,0,'C');
        $pdf->Cell(40 ,6,'Fee',1,1,'C');/*end of line*/
        /*Heading Of the table end*/
        $srno = 1;
        $subtotal = 0;
        $pdf->SetFont('Arial','',10);
        for ($i = 0; $i <count($data); $i++) {

            // $pdf->Cell(20 ,6,$data[$i]['class'],1,0,'R');
            $fee_detail = $this->Welcome_model->get_fee($data[$i]['id'],$year,$month);
            if($fee_detail){
                //$pdf->MultiCell(40 ,6,$fee_detail[0]['amount']." (".date('d-m-Y',strtotime($fee_detail[0]['edate'])).")",1,'C',0);         
                // $subtotal =  $subtotal+$fee_detail[0]['amount'];
            } else{
                $pdf->Cell(10 ,6,$srno,1,0,'C');
                $pdf->Cell(60 ,6,$data[$i]['name'],1,0,'L');
                $pdf->Cell(60 ,6,$data[$i]['fname'],1,0,'L');
                $pdf->Cell(20 ,6,$data[$i]['dob'],1,0,'C');
                $pdf->Cell(40 ,6,0,1,1,'C'); 
                $srno++;                 
            }


        }


        $pdf->Cell(130 ,6,'',0,0);
        $pdf->Cell(20 ,6,'Total',0,0);
        $pdf->Cell(40 ,6,$subtotal,1,1,'R');


        $pdf->Output();
    } 
    public function fee_report_overall(){
        //echo "Hello";
        $class=$this->uri->segment(3);;
        $year=$this->uri->segment(4);;
        $month=$this->uri->segment(5);;
        $_POST['class'] =$class;
        $_POST['year'] =$year;
        $_POST['month'] =$month;
        $all_classes = array(0=>"PG", 1=>"NURSERY",2=>"PREP",3=>"ONE",4=>"TWO",5=>"THREE",6=>"FOUR",7=>"FIVE",8=>"SIX",9=>"SEVEN",10=>"9TH JUNIOR",11=>"NINE",12=>"TEN");
        $data =  $this->Welcome_model->get_std_class_list("");
        // print_r($data);
        // exit();
        $this->load->library('fpdf/FPDF');

        // $pdf = new FPDF();
        // $this->load->plugin('fpdf');
        //$pdf->AddPage();
        $pdf = new FPDF('L','mm','A4');

        $pdf->AddPage();
        /*output the result*/

        /*set font to arial, bold, 14pt*/
        $pdf->SetFont('Arial','B',20);

        /*Cell(width , height , text , border , end line , [align] )*/

        $pdf->Cell(70 ,10,'',0,0);
        $pdf->Cell(40 ,5,'Class Wise Overall Fee Detail',0,0);
        $pdf->Cell(59 ,10,'',0,1);

        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(71 ,5,'Year : '.$year,0,0);
        $pdf->Cell(59 ,5,'',0,0);
        $pdf->Cell(59 ,5,'Month : '.$month,0,1);
        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'',0,1);
        $pdf->SetFont('Arial','',10);

        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'Printing Date:',0,0);
        $pdf->Cell(34 ,5,date('d-m-Y h:m:s a'),0,1);
        /*
        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'',0,0);
        $pdf->Cell(34 ,5,'',0,1);

        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(25 ,5,'',0,0);
        $pdf->Cell(34 ,5,'',0,1);


        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(130 ,5,'',0,0);
        $pdf->Cell(59 ,5,'',0,0);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(189 ,10,'',0,1);   */



        $pdf->Cell(50 ,10,'',0,1);

        $pdf->SetFont('Arial','B',10);
        /*Heading Of the table*/
        $pdf->Cell(10 ,6,'Sr',1,0,'C');
        $pdf->Cell(50 ,6,'Class',1,0,'C');
        $pdf->Cell(40 ,6,'Candidates',1,0,'C');
        $pdf->Cell(30 ,6,'Total Fee',1,0,'C');
        $pdf->Cell(40 ,6,'Submitted Fee Cand.',1,0,'C');
        $pdf->Cell(40 ,6,'Fee No Paid Cand.',1,0,'C');
        $pdf->Cell(30 ,6,'Fee submitted',1,0,'C');
        $pdf->Cell(40 ,6,'Fee Remaining',1,1,'C');
        //$pdf->Cell(20 ,6,'Entry Date',1,0,'C');
        /*end of line*/
        /*Heading Of the table end*/
        $srno = 1;
        $subtotal = 0;
        $sum_cand = 0;
        $sum_fee = 0;
        $sum_fee_cand = 0;
        $sum_fee_not_paid_cand = 0;
        $sum_fee_submit=0;
        $sum_fee_remaining = 0;
        $pdf->SetFont('Arial','',10);
        for ($i = 0; $i <13; $i++) {
            $_POST['class']= $all_classes[$i];
            $data =  $this->Welcome_model->get_std_class_list("");
            $total_class_cand = count($data);
            $total_class_fee = array_sum(array_column($data,'reqFee'));
            // $pdf->Cell(20 ,6,$data[$i]['class'],1,0,'R');
            $fee_detail = $this->Welcome_model->get_fee_classwise($all_classes[$i],$year,$month);
            $total_submitted_fee_cand = count($fee_detail);
            $total_cand_fee_paid = array_sum(array_column($fee_detail,'amount'));
            if($fee_detail){
                //$pdf->MultiCell(40 ,6,$fee_detail[0]['amount']." (".date('d-m-Y',strtotime($fee_detail[0]['edate'])).")",1,'C',0);         
                // $subtotal =  $subtotal+$fee_detail[0]['amount'];
            } else{
                // $pdf->Cell(6 ,6,'',0,1);
                //$pdf->Cell(40 ,6,0,1,1,'C');

            }
            $pdf->Cell(10 ,6,$srno,1,0,'C');
            $pdf->Cell(50 ,6,$all_classes[$i],1,0,'C');
            $pdf->Cell(40 ,6,$total_class_cand,1,0,'C');
            $pdf->Cell(30 ,6,$total_class_fee,1,0,'C');
            $pdf->Cell(40 ,6,$total_submitted_fee_cand,1,0,'C');
            $pdf->Cell(40 ,6,$total_class_cand-$total_submitted_fee_cand,1,0,'C');
            $pdf->Cell(30 ,6,$total_cand_fee_paid,1,0,'C');
            $pdf->Cell(40 ,6,$total_class_fee-$total_cand_fee_paid,1,1,'C'); 

            $srno++;    
            $sum_cand = $sum_cand+$total_class_cand;
            $sum_fee =$sum_fee+ $total_class_fee;
            $sum_fee_cand =$sum_fee_cand+ $total_submitted_fee_cand;
            $sum_fee_not_paid_cand = $sum_fee_not_paid_cand+($total_class_cand-$total_submitted_fee_cand);
            $sum_fee_submit=$sum_fee_submit+$total_cand_fee_paid;
            $sum_fee_remaining = $sum_fee_remaining+($total_class_fee-$total_cand_fee_paid)   ;
        }
        //$pdf->Cell(10 ,6,'Sr',1,0,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(60 ,6,'Grand Sum',1,0,'C');
        $pdf->Cell(40 ,6,$sum_cand,1,0,'C');
        $pdf->Cell(30 ,6,$sum_fee,1,0,'C');
        $pdf->Cell(40 ,6,$sum_fee_cand,1,0,'C');
        $pdf->Cell(40 ,6,$sum_fee_not_paid_cand,1,0,'C');
        $pdf->Cell(30 ,6,$sum_fee_submit,1,0,'C');
        $pdf->Cell(40 ,6,$sum_fee_remaining,1,1,'C');     

        //$pdf->Cell(130 ,6,'',0,0);
        //$pdf->Cell(20 ,6,'Total',0,0);
        //$pdf->Cell(40 ,6,$subtotal,1,1,'R');


        $pdf->Output();
    } 
    public function std_fee_list()
    {
        $class = $_POST['class'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $data =array(
            'class'=>$class,
            'month'=>$month,
            'year'=>$year
        );
        $data = $this->Welcome_model->get_std_class_list($data);
        if($data){
            for($i=0; $i<count($data); $i++){
                $path  = std_img.$data[$i]['id']."/";
                $img = "";
                $images = glob($path."*.{jpg,png,gif,JPG,JPEG,PNG,GIF}",GLOB_BRACE);
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";
                //$img .= '<div class="show_img_screen_view"><div>';
                $fee_detail = $this->Welcome_model->get_fee($data[$i]['id'],$year,$month);

                if($fee_detail){
                    $data[$i]['fee_detail'] = $fee_detail;
                    $data[$i]['fee'] =$fee_detail[0]['amount']   ;
                    $data[$i]['fee_edate'] =date("d-m-Y h:m:s a", strtotime($fee_detail[0]['edate']));   ;
                    if($fee_detail[0]['cdate'] ){
                        $data[$i]['fee_cdate'] =date("d-m-Y h:m:s a" , strtotime($fee_detail[0]['cdate']  )) ;  
                    }else{
                        $data[$i]['fee_cdate'] =""  ;
                    }

                } else{
                    $data[$i]['fee_detail'] = "";
                    $data[$i]['fee'] = "";
                    $data[$i]['fee_edate'] =""  ;
                    $data[$i]['fee_cdate'] =""   ;
                } 


                foreach ($images as $image) {
                    // $img .= '<img alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />';
                    /*$img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    '; */
                    $img = "../".$image;
                    break;
                }
                $data[$i]['img']=$img;
            }
            //$img .=' </div></div>';
            // $nestedData['images'] = $img;
        }
        echo json_encode($data);
        exit();
    }

    public function get_user_rights()
    {
        $data = $this->Welcome_model->get_menu_all_user();
        echo json_encode($data);
        exit();
    }
    public function type()
    {   $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =8; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        //$data['menu'] = $this->Welcome_model->get_menu("type");
        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/type.php');
            $this->load->view('common/footer.php');
        }

    }

    public function insert_user_rights()
    {
        // print_r($_POST);
        // exit();
        $response = $this->Welcome_model->add_user_rights();
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function insert_task()
    {
        // print_r($_POST);
        // exit();
        $response = $this->Welcome_model->add_task();
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function insert_type()
    {
        $response = $this->Welcome_model->add_type();
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function mode()
    {
        $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =6; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        // $data['menu'] = $this->Welcome_model->get_menu("mode");
        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/mode.php');
            $this->load->view('common/footer.php');
        }

    }
    public function insert_mode()
    {
        $response = $this->Welcome_model->add_mode();
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function category()
    {
        $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =3; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        //  $data['menu'] = $this->Welcome_model->get_menu("category");
        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/category.php');
            $this->load->view('common/footer.php');
        }

    }
    public function insert_cat()
    {
        $response = $this->Welcome_model->add_category();
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function head()
    {
        $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =4; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        //$data['menu'] = $this->Welcome_model->get_menu("head");
        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/head.php');
            $this->load->view('common/footer.php');
        }

    }
    public function company()
    {
        $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =12; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        //$data['menu'] = $this->Welcome_model->get_menu("company");
        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/company.php');
            $this->load->view('common/footer.php');
        }

    }
    public function insert_bank()
    {
        $response = $this->Welcome_model->add_bank();
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function insert_asset()
    {
        $insertId = $this->Welcome_model->add_asset();
        $response = 0;
        if($insertId >0){
            $response = true;

            if(isset($_FILES['asset_img'])){
                $path = asset_doc.$insertId."/"; // upload directory
                $files = $_FILES['asset_img'];
                $title = $insertId;
                $this->upload_files($path,$title,$files);

            }



        }
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function insert_company()
    {
        $response = $this->Welcome_model->add_company();
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function insert_head()
    {
        $response = $this->Welcome_model->add_head();
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function insert_form_std()
    {


        $insertId = $this->Welcome_model->add_std();
        // echo $insertId;
        $response = 0;
        if($insertId >0){
            $response = true;
            if(isset($_FILES['upload_doc_std_img']))
            {
                if(count($_FILES['upload_doc_std_img'])>0){
                    $path = std_img.$insertId."/"; // upload directory
                    $files = $_FILES['upload_doc_std_img'];
                    $title = $insertId;
                    $this->upload_files($path,$title,$files);
                }

            }
            if(isset($_FILES['upload_doc_std_doc']))
            {
                if(count($_FILES['upload_doc_std_doc'])>0){
                    $path = std_doc.$insertId."/"; // upload directory
                    $files = $_FILES['upload_doc_std_doc'];
                    $title = $insertId;
                    $this->upload_files($path,$title,$files);
                }

            }

        }          
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>$insertId,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function insert_cash_register()
    {


        $insertId = $this->Welcome_model->add_cash_register();
        // echo $insertId;
        $response = 0;
        if($insertId >0){
            $response = true;
            if(isset($_FILES['upload_doc_cash_register']))
            {
                if(count($_FILES['upload_doc_cash_register'])>0){
                    $path = cash_register_voucher.$insertId."/"; // upload directory
                    $files = $_FILES['upload_doc_cash_register'];
                    $title = $insertId;
                    $this->upload_files($path,$title,$files);
                }

            }

        }          
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>$insertId,
            'surname'=>44
            //'response'=>$response
        );
        //echo "true";
        echo json_encode($data);
        exit();
    }
    public function dashboard()
    {   $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =1; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);

        // $data['menu'] = $this->Welcome_model->get_menu("dashboard");
        $data['dashboard'] = $this->Welcome_model->get_dashboard_data("admin");
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/dashboard.php');
            $this->load->view('common/footer.php');
        }

    }
    public function task()
    {   $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
            // exit();
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =19; //$this->Welcome_model->get_menu("dashboard");
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['user'] = $this->Welcome_model->get_user($userid);
        // $data['menu'] = $this->Welcome_model->get_menu("dashboard");
        $data['task'] = $this->Welcome_model->get_task();
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/task.php');
            $this->load->view('common/footer.php');
        }

    }
    public function company_table()
    {
        $this->load->model('Company_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            1 =>'address',
            2=> 'description',
            3=> 'remarks',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Company_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Company_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Company_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Company_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {    $userid = $_SESSION['id'];
            $menu_id =12;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);
            // print_r($single_menu);
            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['address'] = $post->address;
                $nestedData['description'] = $post->description;
                $nestedData['remarks'] = $post->remarks;
                /*
                $btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '12'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button><button data-button_id='2' data-menu_id = '12' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */

                $btn = "<div class='d-grid gap-2'>";
                if($single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '12'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if($single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '12' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";


                $nestedData['buttons'] = $btn;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function report_table()
    {

        //print_r($_POST);
        //exit();
        $this->load->model('Report_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'date',
            1 =>'description',
            2=> 'category_id',
            3=> 'mode_id',

        );
        $p_array = array ();
        $p_array['company'] = $_POST['form'][0]['value'];
        $p_array['date_from']  = $_POST['form'][1]['value'];
        $p_array['date_to']  = $_POST['form'][2]['value'];
        $p_array['type'] = $_POST['form'][3]['value'];
        $p_array['account'] = $_POST['form'][4]['value'];
        $p_array['head'] = $_POST['form'][5]['value'];
        $p_array['category'] = $_POST['form'][6]['value'];
        $p_array['mode'] =$_POST['form'][7]['value'];
        $p_array['emp'] = $_POST['form'][8]['value'];

        //print_r($_POST);//$this->input->post('emp');
        // echo $_POST['emp'];
        //print_r($_POST);
        //echo $p_array['category'];
        // exit();
        $limit = $this->input->post('length');

        $start = $this->input->post('start');
        // $order = $columns[$this->input->post('order')[0]['column']];
        //$dir = $this->input->post('order')[0]['dir'];
        $order = 0;
        $dir   = 0;
        $totalData = $this->Report_table_model->allposts_count($p_array);

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Report_table_model->allposts($limit,$start,$order,$dir,$p_array);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Report_table_model->posts_search($limit,$start,$search,$order,$dir,$p_array);

            $totalFiltered = $this->Report_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {      $srno = 0;
            foreach ($posts as $post)
            {
                $srno++;
                // $nestedData['id'] = $post->id;
                $nestedData['id'] = $srno;
                $nestedData['date'] = $post->date;
                $nestedData['description'] = $post->description;
                $nestedData['amount'] = $post->amount;
                $nestedData['type_name'] = $post->type_name;
                $nestedData['bank_name'] = $post->bank_name;
                $nestedData['head_name'] = $post->head_name;
                $nestedData['category_name'] = $post->category_name;
                $nestedData['user_name'] = $post->user_name;
                $nestedData['mode_name'] = $post->mode_name;
                $nestedData['company_name'] = $post->company_name;
                $nestedData['remarks'] = $post->remarks;
                $path  = cash_register_voucher.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,gif,JPG,JPEG,PNG,GIF}",GLOB_BRACE);
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";
                //$img .= '<div class="show_img_screen_view"><div>';


                foreach ($images as $image) {
                    // $img .= '<img alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />';
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }
                //$img .=' </div></div>';
                $nestedData['images'] = $img;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function std_table()
    {
        //DebugBreak();
        // echo "Hello";

        $this->load->model('Std_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2 =>'fname',
            3=> 'dob',
            4=> 'bform',
            5=> 'fnic',
            6=> 'address',
            7=> 'class',
            8=> 'adm_date',
            9=> 'section',
            10=> 'status',
            11=> 'remarks',
            12=> 'cell'


        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Std_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Std_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Std_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Std_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {
            $userid = $_SESSION['id'];
            $menu_id =20;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);


            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['class'] = $post->class;
                $nestedData['name'] = $post->name;
                $nestedData['fname'] = $post->fname;
                $nestedData['reqFee'] = $post->reqFee;
                $nestedData['dob'] = $post->dob;
                $nestedData['bform'] = $post->bform;
                $nestedData['fnic'] = $post->fnic;
                $nestedData['address'] = $post->address;

                $nestedData['adm_date'] = $post->adm_date;
                $nestedData['cell'] = $post->cell;
                $nestedData['section'] = $post->section;
                $nestedData['remarks'] = $post->remarks;
                $nestedData['father_occouption'] = $post->father_occouption;




                $path  = std_img.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,gif,JPG,JPEG,PNG,GIF}",GLOB_BRACE);
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";
                //$img .= '<div class="show_img_screen_view"><div>';


                foreach ($images as $image) {
                    // $img .= '<img alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />';
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }
                //$img .=' </div></div>';
                $nestedData['pic'] = $img;
                if($post->status ==1 ){
                    $post->status = "Struck OFF";  
                } else if( $post->status== 2){
                    $post->status = "Quit";   
                }   else if($post->status==3){
                    $post->status = "Leave wiht all dues paid";  
                }
                $path  = std_doc.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,gif,JPG,JPEG,PNG,GIF}",GLOB_BRACE);
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";
                //$img .= '<div class="show_img_screen_view"><div>';


                foreach ($images as $image) {
                    // $img .= '<img alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />';
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }
                //$img .=' </div></div>';
                $nestedData['doc'] = $img;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                $nestedData['status'] = $post->status;
                $btn = "<div class='d-grid gap-2'>";
                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '20'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                /*  if(@$single_menu[0]['delete_record'] == 1 ){
                $btn .="<button data-button_id='2' data-menu_id = '2' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }   */
                $btn .="</div>";
                $nestedData['buttons'] = $btn;
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function cash_register_table()
    {
        $this->load->model('Cash_register_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'date',
            1 =>'description',
            2=> 'category_id',
            3=> 'mode_id',
            4=> 'amount'

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Cash_register_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Cash_register_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Cash_register_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Cash_register_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {
            $userid = $_SESSION['id'];
            $menu_id =2;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);


            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['date'] = $post->date;
                $nestedData['description'] = $post->description;
                $nestedData['amount'] = $post->amount;
                $nestedData['type_name'] = $post->type_name;
                $nestedData['bank_name'] = $post->bank_name;
                $nestedData['head_name'] = $post->head_name;
                $nestedData['category_name'] = $post->category_name;
                $nestedData['user_name'] = $post->user_name;
                $nestedData['mode_name'] = $post->mode_name;
                $nestedData['company_name'] = $post->company_name;
                $nestedData['remarks'] = $post->remarks;
                $path  = cash_register_voucher.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,gif,JPG,JPEG,PNG,GIF}",GLOB_BRACE);
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";
                //$img .= '<div class="show_img_screen_view"><div>';


                foreach ($images as $image) {
                    // $img .= '<img alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />';
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }
                //$img .=' </div></div>';
                $nestedData['images'] = $img;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));

                $btn = "<div class='d-grid gap-2'>";
                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '2'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if(@$single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '2' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";
                $nestedData['buttons'] = $btn;
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function asset_table()
    {
        $this->load->model('Asset_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            1 =>'address',
            2=> 'purchasing_date',
            3=> 'remarks',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Asset_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Asset_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Asset_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Asset_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {   $userid = $_SESSION['id'];
            $menu_id =15;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);

            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['address'] = $post->address;
                $nestedData['longitude'] = $post->longitude;
                $nestedData['purchasing_date'] = $post->purchasing_date;
                $nestedData['seller_name'] = $post->seller_name;
                $nestedData['seller_address'] = $post->seller_address;
                $nestedData['seller_cnic'] = $post->seller_cnic;
                $nestedData['seller_cell'] = $post->seller_cell;
                $nestedData['remarks'] = $post->remarks;

                $btn = "<div class='d-grid gap-2'>";
                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '15'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if(@$single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '15' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";

                /* $btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '15'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button><button data-button_id='2' data-menu_id = '15' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */  
                $nestedData['buttons'] = $btn;

                $path  = asset_doc.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,gif,JPG,JPEG,PNG,GIF}",GLOB_BRACE);
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";

                foreach ($images as $image) {
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }

                $nestedData['image'] = $img;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function bank_table()
    {
        $this->load->model('Bank_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            1 =>'address',
            2=> 'description',
            3=> 'remarks',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Bank_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Bank_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Bank_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Bank_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {    $userid = $_SESSION['id'];
            $menu_id =14;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);

            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['address'] = $post->address;
                $nestedData['iban'] = $post->iban;
                $nestedData['swift'] = $post->swift;
                $nestedData['account_no'] = $post->account_no;
                $nestedData['description'] = $post->description;
                $nestedData['remarks'] = $post->remarks;


                /*$btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '14'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button><button data-button_id='2' data-menu_id = '14' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";
                if($single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '14'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if($single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '14' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";

                $nestedData['buttons'] = $btn;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function head_table()
    {
        $this->load->model('Head_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2=> 'description',
            3=> 'remarks',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Head_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Head_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Head_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Head_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {     $userid = $_SESSION['id'];
            $menu_id =4;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);

            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['description'] = $post->description;
                $nestedData['remarks'] = $post->remarks;

                /*$btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '4'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button><button data-button_id='2' data-menu_id = '4' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";
                if($single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '4'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if($single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '4' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";

                $nestedData['buttons'] = $btn;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function category_table()
    {
        $this->load->model('Category_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2=> 'description',
            3=> 'remarks',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Category_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Category_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Category_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Category_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {   $userid = $_SESSION['id'];
            $menu_id =3;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);

            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['description'] = $post->description;
                $nestedData['remarks'] = $post->remarks;

                /*$btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '3'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button><button data-button_id='2' data-menu_id = '3' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */

                $btn = "<div class='d-grid gap-2'>";
                if($single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '3'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if($single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '3' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";


                $nestedData['buttons'] = $btn;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function checkPhone()
    {

        $data = $this->Welcome_model->checkEmailPwd();
        echo json_encode($data);
        exit();
    }
    public function crud()
    {

        $data = $this->Welcome_model->crud();
        echo json_encode($data);
        exit();
    }
    public function mode_table()
    {
        $this->load->model('Mode_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2=> 'description',
            3=> 'remarks',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Mode_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Mode_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Mode_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Mode_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {    $userid = $_SESSION['id'];
            $menu_id =6;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);

            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['description'] = $post->description;
                $nestedData['remarks'] = $post->remarks;

                /*$btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '6'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button><button data-button_id='2' data-menu_id = '6' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */

                $btn = "<div class='d-grid gap-2'>";
                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '6'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if(@$single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '6' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";

                $nestedData['buttons'] = $btn;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function type_table()
    {
        $this->load->model('Type_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2=> 'description',
            3=> 'remarks',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Type_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Type_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Type_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Type_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {   $userid = $_SESSION['id'];
            $menu_id =8;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);

            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['description'] = $post->description;
                $nestedData['remarks'] = $post->remarks;
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                /*$btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '8'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button><button data-button_id='2' data-menu_id = '8' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";
                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '8'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if(@$single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '8' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";

                $nestedData['buttons'] = $btn;


                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function profile_table()
    {
        $userid = $_SESSION['id'];
        $menuid = 10;
        // echo $userid;
        // echo $menuid ;
        //exit();
        $single_menu = $this->Welcome_model->get_single_menu($userid,$menuid);

        //echo $single_menu->show_menu ;
        // echo "hello";

        // print_r($single_menu);
        // exit();
        $this->load->model('Profile_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2=> 'cell_no',
            3=> 'address',
            4=> 'email',
            5=> 'desig',
            6=> 'salary',
            7=> 'remarks',
            8=> 'note',


        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Profile_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Profile_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Profile_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Profile_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {   


            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $path  = employee_img.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,gif,JPG,JPEG,PNG,GIF}",GLOB_BRACE);
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";

                foreach ($images as $image) {
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }

                $nestedData['image'] = $img;
                $nestedData['name'] = $post->name;
                $nestedData['cell'] = $post->cell_no;
                $nestedData['address'] = $post->address;
                $nestedData['email'] = $post->email;
                $nestedData['designation'] = $post->desig;
                $nestedData['salary'] = $post->salary;
                $nestedData['remarks'] = $post->remarks;
                $nestedData['note'] = $post->note;
                $nestedData['cnic'] = $post->cnic;

                if($post->dob == "1970-01-01"){
                    $post->dob = "";
                }

                $nestedData['dob'] = $post->dob;
                $nestedData['father_name'] = $post->father_name;
                $nestedData['guardian_cell'] = $post->guardian_cell;
                $nestedData['home_cell'] = $post->home_cell;
                $nestedData['emergency_cell'] = $post->emergency_cell;
                $nestedData['bank_name'] = $post->bank_name;
                $nestedData['bank_account'] = $post->bank_account_no;
                $nestedData['iban'] = $post->iban;
                $nestedData['note'] = $post->note;
                $nestedData['description'] = $post->description;

                $path  = employee_doc.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,gif,JPG,JPEG,PNG,GIF}",GLOB_BRACE);
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";
                foreach ($images as $image) {
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }

                $nestedData['doc'] = $img;

                /* $btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '10'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button><button data-button_id='2' data-menu_id = '10' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";


                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '10'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if(@$single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '10' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";
                $nestedData['buttons'] = $btn;
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function task_table()
    {
        $userid = $_SESSION['id'];
        $menuid = 10;
        // echo $userid;
        // echo $menuid ;
        //exit();
        $single_menu = $this->Welcome_model->get_single_menu($userid,$menuid);

        //echo $single_menu->show_menu ;
        // echo "hello";

        // print_r($single_menu);
        // exit();
        $this->load->model('Profile_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2=> 'cell_no',
            3=> 'address',
            4=> 'email',
            5=> 'desig',
            6=> 'salary',
            7=> 'remarks',
            8=> 'note',


        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Profile_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Profile_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Profile_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Profile_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {   


            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $path  = employee_img.$post->id."/";
                $img = "";
                $images = glob($path."*.jpg");
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";

                foreach ($images as $image) {
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }

                $nestedData['image'] = $img;
                $nestedData['name'] = $post->name;
                $nestedData['cell'] = $post->cell_no;
                $nestedData['address'] = $post->address;
                $nestedData['email'] = $post->email;
                $nestedData['designation'] = $post->desig;
                $nestedData['salary'] = $post->salary;
                $nestedData['remarks'] = $post->remarks;
                $nestedData['note'] = $post->note;
                $nestedData['cnic'] = $post->cnic;

                if($post->dob == "1970-01-01"){
                    $post->dob = "";
                }

                $nestedData['dob'] = $post->dob;
                $nestedData['father_name'] = $post->father_name;
                $nestedData['guardian_cell'] = $post->guardian_cell;
                $nestedData['home_cell'] = $post->home_cell;
                $nestedData['emergency_cell'] = $post->emergency_cell;
                $nestedData['bank_name'] = $post->bank_name;
                $nestedData['bank_account'] = $post->bank_account_no;
                $nestedData['iban'] = $post->iban;
                $nestedData['note'] = $post->note;
                $nestedData['description'] = $post->description;

                $path  = employee_doc.$post->id."/";
                $img = "";
                $images = glob($path."*.jpg");
                $hard_path  = "C:\\xampp\\htdocs\\arsh\\";
                foreach ($images as $image) {
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }

                $nestedData['doc'] = $img;

                /* $btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '10'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button><button data-button_id='2' data-menu_id = '10' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";


                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '10'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Updte</button>";

                }
                if(@$single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '10' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";
                $nestedData['buttons'] = $btn;
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        echo json_encode($json_data); 
    }
    public function upload_files($path, $title, $files)
    {        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);

        }
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();
        $increment = 1;
        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'.$increment."_".$image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }

            $increment++;
        }

        return $images;
    }
}
