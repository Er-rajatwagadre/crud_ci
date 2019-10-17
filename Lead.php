<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lead extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
       $this->load->model('lead_model');
       $this->load->model('leaderboard_model');
       $this->load->model('Log_history_model');
    }


    public function index()
     {
		$data = array();
        $data['page_title'] = 'Add Lead';
        $data['emp_name'] = $this->lead_model->get_all_emp('user');
		$data['designation'] = $this->common_model->select('user_designation');
        $data['main_content'] = $this->load->view('admin/lead/add_lead', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
    //-- add new lead by admin
    public function add_lead()
    {   
        if ($_POST){
            $data = array(
                'name' => $_POST['name'],
                'class' => $_POST['class'],
                'gender' => $_POST['gender'],
                'parent_name' => $_POST['parent_name'],
                'lead_status' => $_POST['lead_status'],
                'mobile' => $_POST['mobile'],
                'remark' => $_POST['remark'],
                'assigned_to' => $_POST['assigned_to'],
				'lead_source_type' => $_POST['lead_source_type'],
				'lead_source' => $_POST['lead_source'],
                'lead_created' => $_POST['lead_created'],
                'lead_added_by_emp_id' => $_POST['lead_added_by_emp_id']
            );
		
			$data = $this->security->xss_clean($data);
				
				//-- check duplicate mobile number!
            $mob = $this->common_model->check_mob($_POST['mobile']);
			
			if (empty($mob)) {
                 $result = $this->common_model->insert($data, 'lead');
				 $extra_data =array(
						'lead_id' => $result ,
						'package' => $_POST['package'],
						'packge_id' => $_POST['packge_id'],
						'lead_role' => $_POST['lead_role'],
						'lead_priority' => $_POST['lead_priority'],
						'other_number' => $_POST['other_number'],
						'paying_capebility' => $_POST['paying_capebility'],
						'gender' => $_POST['gender'],
						'school_name' => $_POST['school_name'],
						'year' => $_POST['year'],
						'demo_status' => $_POST['demo_status'],
						'lead_details_date' => $_POST['lead_details_date']
				 );
				 
				$result_2 = $this->common_model->insert($extra_data,'lead_details');
				//  inset code for create log and history of employee or lead..
					$log_data= array(
						'emp_id' =>$_POST['emp_id'],
						'what_do' => "Fresh Lead added By ".$_POST['lead_added_by_emp_id'],
						'lead_id' => $result,
						'log_date_time' => $_POST['log_date_time']
					);
					$this->Log_history_model->insert($log_data,'emp_log_file');
                $this->session->set_flashdata('msg','Lead added successfully, Lead Id  '.$result);
                if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'super admin') { 
                      redirect(base_url('admin/lead/all_lead_list'));
                 }else{ 
                    redirect(base_url('admin/lead/my_lead_list'));
                 } 
            } else {
                $this->session->set_flashdata('error_msg', 'Mobile number already exist, try another number');
                redirect(base_url('admin/lead'));
            }
            }
        }
		//-- update new lead
		
    public function update_lead($id)
    {   
        if ($_POST){
            
             $data = array(
                'name' => $_POST['name'],
                'class' => $_POST['class'],
				'parent_name' => $_POST['parent_name'],
                'gender' => $_POST['gender'],
                'mobile' => $_POST['mobile'],
                'remark' => $_POST['remark'],
                'lead_status' => $_POST['lead_status'],
                'lead_source_type' => $_POST['lead_source_type'],
				'lead_source' => $_POST['lead_source'],
                'updated_lead' => $_POST['updated_lead']
            );
			$extra_data =array(
						'package' => $_POST['package'],
						'packge_id' => $_POST['packge_id'],
						'lead_role' => $_POST['lead_role'],
						'lead_priority' => $_POST['lead_priority'],
						'other_number' => $_POST['other_number'],
						'paying_capebility' => $_POST['paying_capebility'],
						'gender' => $_POST['gender'],
						'school_name' => $_POST['school_name'],
						'year' => $_POST['year'],
						'demo_status' => $_POST['demo_status'],
						'lead_details_date' => $_POST['lead_details_date']						
				);
				 
			// $lead_id = $_POST['lead_id'];
			
				$data = $this->security->xss_clean($data);
				
                $this->lead_model->update_lead($id,$data); // basic data updated
                $this->lead_model->update_lead_extra($id,$extra_data); //extra data updated 
				
				//  inset code for create log and history of employee or lead..
					$log_data= array(
						'emp_id' =>$_POST['emp_id'],
						'what_do' => "Lead Id ".$id." Updated By ".$_POST['updated_emp_name'],
						'lead_id' => $id,
						'log_date_time' => $_POST['log_date_time']
					);
					$this->Log_history_model->insert($log_data,'emp_log_file');
				// end log code! 	
				$this->session->set_flashdata('msg','Lead updated successfully  !! ');
				    $r = $this->session->userdata('role');
				if ($r == 'admin' || $r == 'super admin') { 
                      redirect(base_url('admin/lead/all_lead_list'));
                 }else{ 
                    redirect(base_url('admin/lead/my_lead_list'));
                 }
            }
			$data['emp_name'] = $this->lead_model->get_all_emp('user');
			$data['lead'] = $this->lead_model->get_single_lead_info($id);
			$data['lead_details'] = $this->lead_model->get_single_lead_extra_info($id);
			if (empty($data['lead_details'])){
				$extra_data =array(
						'lead_id' => $id 						
				 ); 
				$result_2 = $this->common_model->insert($extra_data,'lead_details');
				$data['lead_details'] = $this->lead_model->get_single_lead_extra_info($id);
			};
			$data['page_title'] = 'Edit Lead';
			$data['main_content'] = $this->load->view('admin/lead/edit_lead', $data, TRUE);
			$this->load->view('admin/index', $data);

        }
/*        
//fatch all lead version 1.
    public function all_lead_list()
    {
	 	$my_id = $_SESSION['id'];
	 	$data['page_title'] = 'All Lead List';
        $data['leads'] = $this->lead_model->get_all_lead();
        $data['myleads'] = $this->lead_model->get_my_lead($my_id);
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/lead/lead_list', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

//fatch all lead version 2.
    public function all_lead_list_v2()
    {
	 	$my_id = $_SESSION['id'];
	 	$data['page_title'] = 'All Lead List';
        $data['leads'] = $this->lead_model->get_all_lead();
        $data['myleads'] = $this->lead_model->get_my_lead($my_id);
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/lead/lead_list_v2', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
*/	
    public function scholar_lead()
    {
	 	$my_id = $_SESSION['id'];
	 	$data['page_title'] = 'All Lead List';
        $data['main_content'] = $this->load->view('admin/lead/scholar_lead', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    
	//fatch all lead version 1 New. admin or super admin
    public function all_lead_list()
    {
	 	$my_id = $_SESSION['id'];
	 	$data['page_title'] = 'All Lead List';
        $data['main_content'] = $this->load->view('admin/lead/lead_list', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    
//fatch all lead version 2. for admin or super admin
    public function all_lead_list_v2()
    {
	 	$my_id = $_SESSION['id'];
	 	$data['page_title'] = 'All Lead List';
        $data['main_content'] = $this->load->view('admin/lead/lead_list_v2', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    
	//fatch all lead version 1  for user
    public function my_lead_list()
    {
	 	$data['page_title'] = 'All Lead List';
        $data['main_content'] = $this->load->view('admin/lead/lead_list_u', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //fatch all lead version 2. for user
    public function my_lead_list_v2()
    {
	 	$my_id = $_SESSION['id'];
	 	$data['page_title'] = 'All Lead List';
        $data['main_content'] = $this->load->view('admin/lead/lead_list_v2_u', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

	//-- LEAD TRANSFER PAGE CODE//  page open, coding available here!
		public function lead_transfer()
		{
		$data['page_title'] = ' Transfer Lead ';
		// $data['leads'] = $this->lead_model->get_all_lead();
		$data['emp_name'] = $this->lead_model->get_all_emp('user');
		$data['count'] = $this->common_model->get_user_total();
		$data['main_content'] = $this->load->view('admin/lead/transfer_lead', $data, TRUE);
		$this->load->view('admin/index', $data);
		}
		 
		  //--SELECTED LEAD TRANSFER CODE
		public function selected_lead_transfer()
		{
				$lead_id =$_REQUEST['rj'];
				$asigned =$_REQUEST['assigned_to'];
				$data = array(
                'assigned_to' => $asigned);

				$change=explode(",",$lead_id);
				foreach ($change as $value => $id) {
				$this->lead_model->update_lead($id,$data);
					//  inset code for create log and history of employee or lead..
					$log_data= array(
						'emp_id' =>$_REQUEST['emp_id'],
						'what_do' => "Lead Id ".$id." Assigned To Employee Id - ".$_REQUEST['assigned_to']." By ".$_REQUEST['Assigned_emp_name'],
						'lead_id' => $id,
						'log_date_time' => $_REQUEST['log_date_time']
					);
					$this->Log_history_model->insert($log_data,'emp_log_file');
				// end log code! 
				}
				$this->session->set_flashdata('msg',' Selected lead transferred successfully ' );
	  redirect(base_url('admin/lead/lead_transfer'));
		}
		 

	 	 
    //-- delete lead
    public function delete($id)
    {
        $this->lead_model->delete($id,'lead'); 
		//  inset code for create log and history of employee or lead..
				date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
				$time = date('g:i:s A M d, Y'); 
				$emp_name =  $this->session->userdata('name').' [ '.$this->session->userdata('id').' ]' ;
				$emp_id =  $this->session->userdata('id');
				
					$log_data= array(
						'emp_id' =>$emp_id,
						'what_do' => "Lead Id ".$id." Is Deleted By ".$emp_name,
						'lead_id' => $id,
						'log_date_time' => $time
					);
					$this->Log_history_model->insert($log_data,'emp_log_file');
				// end log code! 
        $this->session->set_flashdata('msg', 'Lead deleted successfully');
        $r = $this->session->userdata('role');
				if ($r == 'admin' || $r == 'super admin') { 
                      redirect(base_url('admin/lead/all_lead_list'));
                 }else{ 
                    redirect(base_url('admin/lead/my_lead_list'));
                 }
    }
	
		//-- update Assigned person in lead
		
    public function update_assigned()
    {   
        if ($_POST){
            $data = array(
                'assigned_to' => $_POST['assigned_to']
            );
			$id = $_POST['lead_id_as'];
			
				$data = $this->security->xss_clean($data);
				
                $this->lead_model->update_lead($id,$data);
				 // inset code for create log and history of employee or lead..
					$log_data= array(
						'emp_id' =>$_REQUEST['emp_id'],
						'what_do' => "Lead Id ".$id." Assigned To Employee Id - ".$_REQUEST['assigned_to']." By ".$_REQUEST['Assigned_emp_name'],
						'lead_id' => $id,
						'log_date_time' => $_REQUEST['log_date_time']
					);
					$this->Log_history_model->insert($log_data,'emp_log_file');
				// end log code! 
				
				$this->session->set_flashdata('msg',' Lead  transferred successfully ' );
               redirect(base_url('admin/lead/lead_transfer'));
            }
			redirect(base_url('admin/lead/lead_transfer'));

        }
	// Open Events Table.
	public function open_events()
		{
			$emp_id = $this->session->userdata('id');
			$data = array();
			$data['page_title'] = 'My Scheduled Task';
			$data['scheduled_date'] = $this->lead_model->get_all_task('scheduled',$emp_id); //fatch all date for schedule for employee
			$data['scheduled_date_admin'] = $this->lead_model->get_all_task_admin('scheduled'); //fatch all date for schedule by admin all dates
			$data['main_content'] = $this->load->view('admin/pages/events', $data, TRUE);
			$this->load->view('admin/index', $data);
			}
			
			// Open Lead Details  for lead v2
	public function lead_details($id)
		{
			$data = array();
			$data['page_title'] = 'Lead Details';
			$data['details'] = $this->lead_model->get_lead_details($id); //fatch all  details of lead!..
			$data['history'] = $this->lead_model->get_lead_history($id); //fatch all  History of lead!..
			$data['big_details'] = $this->lead_model->get_lead_big_info($id); //fatch all  brief of lead!..
			$data['event'] = $this->lead_model->get_lead_event($id); //fatch all  event(scheduler) of lead!..
			 // print_r($data);
			$data['main_content'] = $this->load->view('admin/pages/lead_deatails', $data, TRUE);
			$this->load->view('admin/index', $data);
			}
			
// time scheduling for Lead by User :: feature references
	public function insert_scheduled()
		{
			$data1 = array(
			'time' => $_POST['time'],
			'msg' => $_POST['remark'],
			'lead-id' => $_POST['lead_id_as'],
			'emp_id' => $_POST['emp_id'],
			'day_slot' => $_POST['day_slot']
			);

			$this->lead_model->insert_scheduled($data1, 'scheduled');
			
			 // inset code for create log & history of employee or lead..
					date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
					$time = date('g:i:s A M d, Y'); 
					$log_data= array(
						'emp_id' =>$_REQUEST['emp_id'],
						'what_do' => "Lead Id ".$_POST['lead_id_as']." Is Scheduled on ".$_POST['time']." By ".$_REQUEST['emp_name'],
						'lead_id' => $_POST['lead_id_as'],
						'log_date_time' => $time
					);
					$this->Log_history_model->insert($log_data,'emp_log_file');
				// end log code! 
				
			
			$this->session->set_flashdata('msg','Lead Id '.$_POST['lead_id_as'].' is scheduled on '.$_POST['time']);
			 	$r = $this->session->userdata('role');
				if ($r == 'admin' || $r == 'super admin') { 
                      redirect(base_url('admin/lead/all_lead_list'));
                 }else{ 
                    redirect(base_url('admin/lead/my_lead_list'));
                 }
			}


	//-- update status lead by user // status and remark only!
		
    public function lead_custom_update()
    {   
        if ($_POST){
            $data = array(
                'remark' => $_POST['remark'],
                'lead_status' => $_POST['lead_status'],
                'updated_lead' => $_POST['updated_lead'],
                'num_verification' => $_POST['num_verification']
            );
			 $id = $_POST['lead_id_as'];
			
				$data = $this->security->xss_clean($data);
				
                $this->lead_model->update_lead($id,$data);
				// inset code for create log  of employee or lead..
					date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
					$time = date('g:i:s A M d, Y'); 
					$log_data= array(
						'emp_id' =>$_REQUEST['emp_id'],
						'what_do' => "Status Or Remarks Updated By ".$_REQUEST['emp_name'].", Lead Id -".$_POST['lead_id_as'].", on Time ".$time,
						'lead_id' => $_POST['lead_id_as'],
						'log_date_time' => $time
					);
					$this->Log_history_model->insert($log_data,'emp_log_file');
				// end log code!
				// inset code for create  history of employee or lead..
					date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
					$time = date('g:i:s A M d, Y'); 
					$history_data= array(
						'h_lead_status' =>$_POST['lead_status'],
						'h_emp_id' =>$_REQUEST['emp_id'],
						'lead_id' => $_POST['lead_id_as'],
						'h_date' => $time,
						'h_call_by' => $_REQUEST['emp_name'],
						'h_remarks' =>$_POST['remark'],
						'h_call_talk' => $_REQUEST['call_talk'],
						'h_call_details' => $_REQUEST['num_verification']	
					);
					$this->Log_history_model->insert_history($history_data,'history');
				// end log code! 
				
				
				$this->session->set_flashdata('msg',' Status updated successfully  !' );
				$r = $this->session->userdata('role');
				if ($r == 'admin' || $r == 'super admin') { 
                      redirect(base_url('admin/lead/all_lead_list'));
                 }else{ 
                    redirect(base_url('admin/lead/my_lead_list'));
                 }
            }
            $r = $this->session->userdata('role');
				if ($r == 'admin' || $r == 'super admin') { 
                      redirect(base_url('admin/lead/all_lead_list'));
                 }else{ 
                    redirect(base_url('admin/lead/my_lead_list'));
                 }
        }
		
// New lead working.............................................
		
		 //--SELECTED LEAD TRANSFER CODE //my app user data 
		public function selected_new_lead_insert()
		{
				date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
				$time = date('g:i:s A M d, Y');
				$id =$_REQUEST['id'];
				$emp_id =$_REQUEST['emp_id'];
				$asigned =$_REQUEST['assigned_to'];
				$insert_data =$_REQUEST['insert_data'];
				$my=1;
				// print_r($insert_data);
				// print_r($id);
				// $a = $insert_data[0]['name'];
				// $a = $insert_data[1]['name'];
				$size = sizeof($insert_data);
				
				
				for($i=0; $i<$size; $i++){
					$name = $insert_data[$i]['name'];
					$mobile = $insert_data[$i]['mobile'];
					$school = $insert_data[$i]['school'];
					$device = $insert_data[$i]['device'];
					$created_on = $insert_data[$i]['created_on'];
				
				$mob = $this->common_model->check_mob($mobile);
			
			if(empty($mob)){
				$data = array(
                'name' => $name,
                'mobile' => $mobile,
                'assigned_to' => $asigned,
                'lead_created' => $time,
                'lead_added_by_emp_id' => $emp_id
				);
				$result = $this->common_model->insert($data, 'lead');
				$extra_data =array(
						'lead_id' => $result ,
						'school_name' => $school,
						'lead_source_type' => $device,
						'lead_source' => "Self",
						'lead_details_date' => $time
				);
				$result_2 = $this->common_model->insert($extra_data,'lead_details');
				
				$log_data= array(
						'emp_id' => $emp_id,
						'what_do' => "Lead Id ".$result." Assigned To Employee Id - ".$asigned." By ".$emp_id,
						'lead_id' => $result,
						'log_date_time' => $time
					);
				$this->Log_history_model->insert($log_data,'emp_log_file');
				
				$this->session->set_flashdata('msg',' Selected lead transferred successfully ');
				$my=2;
			}else{
				$f="false";
				$my=3;
			}
		}
		if($my=="2")
		{
			$f="true";
		}
		echo $f;
	}
}