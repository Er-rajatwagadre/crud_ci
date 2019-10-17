<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// *************************************************************************
// *                                                                       *
// * Optimum LinkupComputers                              *
// * Copyright (c) Optimum LinkupComputers. All Rights Reserved                     *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@optimumlinkupsoftware.com                                 *
// * Website: https://optimumlinkup.com.ng								   *
// * 		  https://optimumlinkupsoftware.com							   *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// *                                                                       *
// *************************************************************************

//LOCATION : application - controller - Auth.php

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
     
        $this->load->model('login_model');
        $this->load->model('Log_history_model');
    }


    public function index(){
        $data = array();
        $data['page'] = 'Auth';
        $this->load->view('admin/login', $data);
    }



 /****************Function login**********************************
     * @type            : Function
     * @function name   : log
     * @description     : Authenticatte when uset try lo login. 
     *                    if autheticated redirected to logged in user dashboard.
     *                    Also set some session date for logged in user.   
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
    public function log(){

        if($_POST){ 
            $query = $this->login_model->validate_user();
            
            //-- if valid
            if($query){
                $data = array();
                foreach($query as $row){
                    $data = array(
                        'id' => $row->id,
                        'name' => $row->first_name." ".$row->last_name,
                        'email' =>$row->email,
                        'role' =>$row->role,
                        'is_login' => TRUE
                    );
					 $emp_id= $row->id;
					 $emp_name= $row->first_name;
                    $this->session->set_userdata($data);
                    $url = base_url('admin/dashboard');
                }
				$ip=$_SERVER['REMOTE_ADDR'];
				$login_location  =$_REQUEST['ip_location'];
				
				// inset code for create log  of employee or lead..
				date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
					$time = date('g:i:s A M d, Y'); 
					$log_data= array(
						'emp_id' =>$emp_id,
						'what_do' => $emp_name." is login On ".$time.", IP :".$ip." location : ".$login_location,
						'log_date_time' => $time
					);
					$this->Log_history_model->insert($log_data,'emp_log_file');	
				// end log code!
				   
				redirect(base_url() . 'admin/dashboard', 'refresh');
            }else{
                $this->session->set_flashdata('msg', 'You Entered Wrong Email & Password ! ');
               redirect(base_url(). 'auth', 'refresh');
            }
            
        }else{
            $this->load->view('auth', $data);
        }
    }

 /*     * ***************Function logout**********************************
     * @type            : Function
     * @function name   : logout
     * @description     : Log Out the logged in user and redirected to Login page  
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
    
    function logout(){
		 if(!empty($this->session->userdata('id'))){
				$emp_id=$this->session->userdata('id');
				$emp_name=$this->session->userdata('name');
				$ip=$_SERVER['REMOTE_ADDR'];
			
				
				
				
					date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
						$time = date('g:i:s A M d, Y'); 
						$log_data= array(
									'emp_id' =>$emp_id,
									'what_do' => $emp_name." is log Out On ".$time.", IP :".$ip,
									'log_date_time' => $time
								);
					$this->Log_history_model->insert($log_data,'emp_log_file');
					
				$this->session->sess_destroy();
		 }
        $data = array();
        $data['page'] = 'logout';
        $this->load->view('admin/login', $data);
    }

}