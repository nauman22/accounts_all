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
    * 		http://example.com/index.php/welcome
    *	- or -
    * 		http://example.com/index.php/welcome/index
    *	- or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see https://codeigniter.com/userguide3/general/urls.html
    */
    public function index()
    {
        $is_login= $this->check_session();
        if($is_login){
            redirect(login);  
            return;
            // exit();
        } 

        // print_r($_SESSION);
        //echo $_SESSION['id'];
        // return;
        $userid = $_SESSION['id'];
        $data['menu_id'] =1; //$this->Welcome_model->get_menu("dashboard");

        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        //print_r($data['user_rights']);
        //exit();
        $data['dashboard'] = $this->Welcome_model->get_dashboard_data("admin");
        $this->load->view('common/header.php',$data);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);
        if(@$data['single_menu'][0]['show_menu'] != 1 )
        {
            $this->load->view('errors/html/401.php');   
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
            }
            //print_r($data['barchart']);
            //exit();

            $this->load->view('common/chart.php',$data);
            // $this->load->view('common/chart_bar.php',$data);
        }

        // $this->load->view('errors/html/401.php');
        //$this->load->view('pages/dashboard.php');
        // $this->load->view('common/footer.php');
        //$this->load->view('pages/login.php');
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

    public function get_serialnumber(){

        $data = $this->Welcome_model->get_serialnumber($_POST['collectiondate']);
        echo json_encode($data);
        exit();


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

    public function insert_employee()
    {
        $insertId = $this->Welcome_model->add_employee();
        $response = 0;
        if($insertId >0){
            $response = true;

            if(isset($_FILES['staff_mgt_docs'])){
                $path = staff_mgt_docs.$insertId."/"; // upload directory
                $files = $_FILES['staff_mgt_docs'];
                $title = $insertId;
                $this->upload_files($path,$title,$files);
            }

        }
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44

        );
        echo json_encode($data);
        exit();
    }

    public function insert_cheque()
    {

        // $this->check_session();

        $insertId = $this->Welcome_model->add_cheque();
        $response = 0;
        if($insertId >0){
            $response = true;

            if(isset($_FILES['upload_doc_cheque'])){
                $path = cheque_img.$insertId."/"; // upload directory
                $files = $_FILES['upload_doc_cheque'];
                $title = $insertId;
                $this->upload_files($path,$title,$files);
            }

        }
        $data=array(
            'status'=>$response,
            'message'=>"There is an error occoured. Please try again later!",
            'middlename'=>33,
            'surname'=>44

        );

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
        $this->load->view('pages/login.php',$data_);
        //$this->load->view('common/footer.php');
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        redirect(login);
        //$this->load->view('common/header.php');
        //$this->load->view('pages/login.php');
        // $this->load->view('common/footer.php');
    }
    public function branch()
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

        $userid = $_SESSION['id'];
        $data['menu_id'] =22; 
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/branch.php');
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

        //$data['branch'] = $this->Welcome_model->get_branch($id=null);

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
    public function get_user_rights()
    {
        $data = $this->Welcome_model->get_menu_all_user();
        echo json_encode($data);
        exit();
    } 
    public function get_Company_branches()
    {
        $data = $this->Welcome_model->get_Company_branches($_POST['id']);
        echo json_encode($data);
        exit();
    } 
    public function get_branches_employee()
    {
        $data = $this->Welcome_model->get_branches_employee($_POST['id']);
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


    public function get_all_branches()
    {
        $userData['data'] = $this->Welcome_model->get_branch($id=null);
        echo json_encode( $userData['data']);

    }
    public function cheque()
    {
        $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =5; 
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);

        $data['branch'] = $this->Welcome_model->get_branch($id=null);


        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/cheque.php');
            $this->load->view('common/footer.php');
        }
    }
    public function employee()
    {
        $is_login= $this->check_session();
        if($is_login){
            redirect(login);
            return;
        }
        $userid = $_SESSION['id'];
        $data['menu_id'] =7; 
        $data['user_rights'] = $this->Welcome_model->get_menu_user($userid);
        $data['single_menu'] = $this->Welcome_model->get_single_menu($userid,$data['menu_id']);
        $data['user'] = $this->Welcome_model->get_user($id=null);
        $this->load->view('common/header.php',$data);
        if(@$data['single_menu'][0]['show_menu'] != 1 ){
            $this->load->view('errors/html/401.php');   
        } else{
            $this->load->view('pages/employee.php');
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

    public function insert_branch()
    {
        $insertId = $this->Welcome_model->add_branch();

        /*echo $insertId;
        exit();*/

        $response = 0;
        if($insertId >0){
            $response = true;

            if(isset($_FILES['upload_branches'])){
                $path = branch_img.$insertId."/"; // upload directory
                $files = $_FILES['upload_branches'];
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
            'middlename'=>33,
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
            0  =>'id', 
            1  =>'name',
            2  =>'address',
            3  =>'lic_name',
            4  =>'lic_no',
            5  =>'company_start_date',
            6  =>'company_last_date',
            7  =>'est_start_date',
            8  =>'est_end_date',
            9  =>'office_ijari_start_date',
            10 =>'office_ijari_end_date',
            11 => 'description',
            12 => 'remarks',

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
                $nestedData['lic_name'] = $post->lic_name;
                $nestedData['lic_no'] = $post->lic_no;
                $nestedData['company_start_date'] = $post->company_start_date;
                $nestedData['company_last_date'] = $post->company_last_date;
                $nestedData['est_start_date'] = $post->est_start_date;
                $nestedData['est_end_date'] = $post->est_end_date;
                $nestedData['office_ijari_start_date'] = $post->office_ijari_start_date;
                $nestedData['office_ijari_end_date'] = $post->office_ijari_end_date;
                $nestedData['description'] = $post->description;
                $nestedData['remarks'] = $post->remarks;
                /*
                $btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '12'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Update</button><button data-button_id='2' data-menu_id = '12' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */

                $btn = "<div class='d-grid gap-2'>";
                if($single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '12'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

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

    public function get_branch_users()
    {
        $userData['user_id'] = $this->Welcome_model->get_user($id=null);
        echo json_encode($userData['user_id']);
    } 
    public function get_company_branch_wrkemp()
    {
        $userData['data'] = $this->Welcome_model->get_company_branch_wrkemp($_POST['wrkempid']);
        echo json_encode($userData['data']);
    }


    public function branch_table()
    {
        $this->load->model('branch_table_model');
        $columns = array( 
            0  =>'id', 
            1  =>'company_id',
            2  =>'branch_name',
            3  =>'user_id',
            4  =>'branch_price',
            5  =>'row_permit_start_date',
            6  =>'row_permit_end_date',
            7  =>'tax',
            8  =>'plot_utilization_start_date',
            9  =>'plot_utilization_end_date',
            10  =>'building_permit_start_date',
            11 =>'building_permit_end_date',
            12 => 'project_start_date',
            13 => 'project_end_date',
            14 => 'parking_ijari_start_date',
            15 => 'parking_ijari_start_date',
            16 => 'remarks',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->branch_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->branch_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->branch_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->branch_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {    
            $userid = $_SESSION['id'];
            $menu_id =22;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);
            /*print_r($posts);
            exit();*/
            $nestedData = array(); // Initialize the result array
            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $path  = branch_img.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,jpeg}",GLOB_BRACE);

                /*print_r($images);
                exit();*/


                foreach ($images as $image) {
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }


                $nestedData['image'] = $img;
                $nestedData['company_id'] = $this->Welcome_model->get_single_company($post->company_id);
                $nestedData['company_id'] = $nestedData['company_id'][0]['name'];
                $nestedData['branch_name'] = $post->branch_name;
                $userData =array();
                $userData['user_id'] = $this->Welcome_model->get_branch_users($post->user_id);
                $namesString = ''; 
                for ($i = 0; $i < count($userData['user_id']); $i++) {
                    $name = $userData['user_id'][$i]['name'];
                    $namesString .= $name . ', '; 
                }                                        
                $namesString = rtrim($namesString, ', ');
                $nestedData['user_id'] = $namesString;
                $nestedData['branch_price'] = $post->branch_price;
                $nestedData['row_permit_start_date'] = $post->row_permit_start_date;
                $nestedData['row_permit_end_date'] = $post->row_permit_end_date;
                $nestedData['tax'] = $post->tax;
                $nestedData['plot_utilization_start_date'] = $post->plot_utilization_start_date;
                $nestedData['plot_utilization_end_date'] = $post->plot_utilization_end_date;
                $nestedData['plot_utilization_price'] = $post->plot_utilization_price;
                $nestedData['building_permit_start_date'] = $post->building_permit_start_date;
                $nestedData['building_permit_end_date'] = $post->building_permit_end_date;
                $nestedData['building_permit_price'] = $post->building_permit_price;
                $nestedData['project_start_date'] = $post->project_start_date;
                $nestedData['project_end_date'] = $post->project_end_date;
                $nestedData['parking_ijari_start_date'] = $post->parking_ijari_start_date;
                $nestedData['parking_ijari_end_date'] = $post->parking_ijari_end_date;
                $nestedData['remarks'] = $post->remarks;




                $btn = "<div class='d-grid gap-2'>";
                if($single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '22'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

                }
                if($single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '22' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
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
                $images = glob($path."*.{jpg,png,jpeg}", GLOB_BRACE);

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
    public function cash_register_table()
    {
        $this->load->model('Cash_register_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'date',
            2 =>'description',
            3=> 'category_id',
            4=> 'mode_id',
            5=> 'amount'
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
                $nestedData['branch_name'] = $post->branch_name;
                $nestedData['remarks'] = $post->remarks;
                $path  = cash_register_voucher.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,jpeg}", GLOB_BRACE);

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
                /*print_r($nestedData['images']);
                exit();*/
                //$nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));

                $btn = "<div class='d-grid gap-2'>";
                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '2'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

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
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

                }
                if(@$single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '15' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                    <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button>";

                }
                $btn .="</div>";

                /* $btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '15'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Update</button><button data-button_id='2' data-menu_id = '15' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */  
                $nestedData['buttons'] = $btn;

                $path  = asset_doc.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,jpeg}", GLOB_BRACE);


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
                <span class='btn-label'><i class='fa fa-check'></i></span>Update</button><button data-button_id='2' data-menu_id = '14' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";
                if($single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '14'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

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
                <span class='btn-label'><i class='fa fa-check'></i></span>Update</button><button data-button_id='2' data-menu_id = '4' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";
                if($single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '4'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

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
                <span class='btn-label'><i class='fa fa-check'></i></span>Update</button><button data-button_id='2' data-menu_id = '3' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */

                $btn = "<div class='d-grid gap-2'>";
                if($single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '3'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

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
                <span class='btn-label'><i class='fa fa-check'></i></span>Update</button><button data-button_id='2' data-menu_id = '6' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */

                $btn = "<div class='d-grid gap-2'>";
                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '6'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

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
                <span class='btn-label'><i class='fa fa-check'></i></span>Update</button><button data-button_id='2' data-menu_id = '8' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";
                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '8'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

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
    public function cheque_table()
    {
        $this->load->model('Cheque_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'chqno',
            2=> 'type',
            3=> 'date',
            4=> 'amount',
            5=> 'status',
            6=> 'description',
            7=> 'branchname',
            8=> 'branchnumber',
            9=> 'iban',
            10=> 'remarks',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Cheque_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Cheque_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Cheque_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Cheque_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {   $userid = $_SESSION['id'];
            $menu_id =5;
            $single_menu = $this->Welcome_model->get_single_menu($userid,$menu_id);

            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                $nestedData['chqno'] = $post->chqno;
                $nestedData['type'] = $post->type;
                $nestedData['date'] = $post->date;
                $nestedData['amount'] = $post->amount;
                $nestedData['status'] = $post->status;
                $nestedData['description'] = $post->description;
                $nestedData['branchname'] = $post->branchname;
                $nestedData['branchnumber'] = $post->description;
                $nestedData['iban'] = $post->iban;
                $nestedData['remarks'] = $post->remarks;

                $btn = "<div class='d-grid gap-2'>";
                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '5'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

                }
                if(@$single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '5' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
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

                $path  = employee_img.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,jpeg}", GLOB_BRACE);

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

                /*print_r($img);
                exit();*/

                $nestedData['id'] = $post->id;
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


                $nestedData['visa_entry_date'] = $post->visa_entry_date;
                $nestedData['visa_expiry_date'] = $post->visa_expiry_date;
                $nestedData['labour_entry_date'] = $post->labour_entry_date;
                $nestedData['labour_expiry_date'] = $post->labour_expiry_date;
                $nestedData['pasport_issue_date'] = $post->pasport_issue_date;
                $nestedData['pasport_expiry_date'] = $post->pasport_expiry_date;
                $nestedData['id_card_issue_date'] = $post->id_card_issue_date;
                $nestedData['id_card_expiry_date'] = $post->id_card_expiry_date;

                /*echo $post->id;
                exit();      */


                $path  = employee_doc.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,jpeg}", GLOB_BRACE);

                foreach ($images as $image) {
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }

                $nestedData['doc'] = $img;

                /* $btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '10'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Update</button><button data-button_id='2' data-menu_id = '10' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";


                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '10'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

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
    public function employee_table()
    {
        $userid = $_SESSION['id'];
        $menuid = 7;
        $single_menu = $this->Welcome_model->get_single_menu($userid,$menuid);
        $this->load->model('Employee_table_model');
        $columns = array( 
            0 =>'id', 
            1 =>'user_id',
            2=> 'type',
            3=> 'date',
            4=> 'amount',
            5=> 'description',

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Employee_table_model->allposts_count();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Employee_table_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->Employee_table_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Employee_table_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {   


            foreach ($posts as $post)
            {
                $nestedData['images'] = $img;
                $nestedData['id'] = $post->id;
                //$nestedData['user_id'] = $post->user_id;

                $userData =array();
                $userData['user_id'] = $this->Welcome_model->get_branch_users($post->user_id);
                $namesString = ''; 
                for ($i = 0; $i < count($userData['user_id']); $i++) {
                    $name = $userData['user_id'][$i]['name'];
                    $namesString .= $name . ', '; 
                }                                        
                $namesString = rtrim($namesString, ', ');
                $nestedData['empname'] = $namesString;

                //$nestedData['type'] = $post->type;
                if($post->type == 1){
                    $nestedData['typename'] = "Salary"; 
                }else if($post->type == 2){
                    $nestedData['typename'] = "Loan"; 
                }else if($post->type == 3){
                    $nestedData['typename'] = "Return Loan"; 
                }
                $nestedData['date'] = $post->date;
                $nestedData['amount'] = $post->amount;
                $nestedData['description'] = $post->description;

                $path  = staff_mgt_docs.$post->id."/";
                $img = "";
                $images = glob($path."*.{jpg,png,jpeg}", GLOB_BRACE);
                foreach ($images as $image) {

                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }


                $btn = "<div class='d-grid gap-2'>";


                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '7'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

                }
                if(@$single_menu[0]['delete_record'] == 1 ){
                    $btn .="<button data-button_id='2' data-menu_id = '7' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
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
                $images = glob($path."*.{jpg,png,jpeg}", GLOB_BRACE);


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
                $images = glob($path."*.{jpg,png,jpeg}", GLOB_BRACE);

                foreach ($images as $image) {
                    $img .= ' <a class="nsbbox" title="'.basename($image).'" 
                    href="../'.$image.'">
                    <img title="'.basename($image).'" alt="Image 1" class="img-responsive img" src="../'.$image.'" style="width:50px" />
                    </a>
                    ';
                }

                $nestedData['doc'] = $img;

                /* $btn = "        <div class='d-grid gap-2'>  <button data-button_id='1' data-menu_id = '10'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                <span class='btn-label'><i class='fa fa-check'></i></span>Update</button><button data-button_id='2' data-menu_id = '10' data-row_id='".$post->id."' class='btn_del btn btn-labeled btn-danger '>
                <span class='btn-label'><i class='fa fa-remove'></i></span>Delete</button></div>";
                */
                $btn = "<div class='d-grid gap-2'>";


                if(@$single_menu[0]['edit_record'] == 1 ){
                    $btn .="<button data-button_id='1' data-menu_id = '10'  data-row_id='".$post->id."'  type='button' class='btn_edit btn btn-labeled btn-success '>
                    <span class='btn-label'><i class='fa fa-check'></i></span>Update</button>";

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
            'allowed_types' => 'jpg|jpeg|png',
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

}
