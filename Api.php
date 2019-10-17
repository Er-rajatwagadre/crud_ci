<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    	public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('common_model');
            $this->load->model('lead_model');
            
        }
          //-- add  employee location activity by application
        public function location()
        {   
           if($_REQUEST['emp_id'] && $_REQUEST['location']){
                $data = array(
                    'emp_id' => $_REQUEST['emp_id'],
                    'location' => $_REQUEST['location']
                );
               $user_id = $this->common_model->insert_loc($data, 'emp_app_location');
                if($user_id == "TRUE"){
                    $user_id=array('status'=>1);
                }
                else{
                    $user_id=array('status'=>0);
                }
            }else{
                 $user_id=array('status'=>0);
            }
           echo  json_encode($user_id);
        }
          //-- add  employee location activity by application
        public function recording()
        {   
            if($_REQUEST['emp_id'] && $_REQUEST['lead_id']){
                $config['upload_path']          = './recording/';
                $config['allowed_types']        = '*';
                $config['max_size']             = 2048;
                $config['max_width']            = 1300;
                $config['max_height']           = 1024;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('record_file'))
                {
                    $user_id=array('status'=>0);
                }
                else
                {
                    $user_id=array('status'=>1);
                    $data = array('upload_data' => $this->upload->data());
                    $f_name = $data['upload_data']['file_name'];
                    $db_data = array(
                            'emp_id' => $_REQUEST['emp_id'],
                            'lead_id' => $_REQUEST['lead_id'],
                            'record_file' => $f_name
                        );
                    $check_user_id = $this->common_model->insert_loc($db_data, 'emp_app_recording');
                }
            if($check_user_id == "TRUE"){
                    $user_id=array('status'=>1);
                }
                else{
                    $user_id=array('status'=>0);
                }
            }else{
                 $user_id=array('status'=>0);
            }
           echo  json_encode($user_id); 
        }
        
        
        //fetch data user app
        function fetch()
        	{
        		$output = '';
        		$emp_id = $this->input->post('emp_id');
        		$type = $this->input->post('type');
        		if($type=="location"){
        		   $data = $this->common_model->fetch($emp_id,"emp_app_location");
                        	$s=1;
                        	$output .= '
                        		<div class="table-responsive">
                        					<table class="table table-bordered table-striped">
                        						<tr>
                        							<th>S.no</th>
                        							<th>Date</th>
                        							<th>Location</th>
                        						</tr>
                        		';
                        		if($data)
                        		{
                        			foreach($data as $row)
                        			{
                        				$output .= '
                        						<tr>
                        							<td>'.$s++.'</td>
                        							<td>'.$row['date_time'].'</td>
                        							<td>'.$row['location'].'</td>
                        						</tr>
                        				';
                        			}
                        		}
                        		else
                        		{
                        			$output .= '<tr>
                        							<td colspan="3">No Data Found</td>
                        						</tr>';
                        		}
                        		$output .= '</table>';
        		}else{
        		   $data = $this->common_model->fetch($emp_id,"emp_app_recording");
        		   $s=1;
                        	$output .= '
                        		<div class="table-responsive">
                        					<table class="table table-bordered table-striped">
                        						<tr>
                        							<th> S.no</th>
                        							<th> Lead Id</th>
                        							<th>Recording File</th>
                        							<th>Recording play</th>
                        						</tr>
                        		';
                        		if($data)
                        		{
                        			foreach($data as $row)
                        			{
                        				$output .= '
                        						<tr>
                        							<td>'.$s++.'</td>
                        							<td>'.$row['lead_id'].'</td>
                        							<td><a href="'.base_url("recording/").$row['record_file'].'">'.$row['record_file'].'</a></td>
                        							<td><audio src="'.base_url("recording/").$row['record_file'].'" controls id="MusicPlayer">
														</audio>
													</td>
                        						</tr> 
                        				';
                        			}
                        		}
                        		else
                        		{
                        			$output .= '<tr>
                        							<td colspan="3">No Data Found</td>
                        						</tr>';
                        		}
                        		$output .= '</table>';
        		}
        		echo $output;
        	}
        	
        	//fatch all lead Api v1 for admin or super admin
        public function all_lead()
        {
			function add_name($first,$last){ return $first." ".$last;}
			function made_send($first,$last){ return $first.", ".$last;}
           $this->load->library('Datatables');
    	   $this->datatables->select('first_name,last_name,lead.lead_id,lead_source,lead_status,num_verification,name,lead.mobile,lead_status,class,assigned_to,remark')->from('lead');
    	   $this->datatables->join('user','user.id = lead.assigned_to', 'left');
    	   $this->datatables->add_column('action', '<a href="./update_lead/$1"><button type="button" data-toggle="tooltip" data-original-title="Edit" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a> <a href="./delete/$1" onClick="return checkDelete();" ><button type="button" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button></a>', 'lead_id');
    	   $this->datatables->add_column('assigned_name','$1','add_name(first_name,last_name)');
		   $this->datatables->add_column('mobile_click','<a onclick="send($1);">','made_send(mobile,lead_id)');
		   $this->datatables->add_column('mobile','$1','mobile');
		   $this->datatables->add_column('mobile_click_2','</a>','');
		   $this->datatables->add_column('l_1','<div class="label label-table label-success">$1</div>','lead_status');
		   $this->datatables->add_column('l_2','<small>$1</small>','num_verification');
		   $this->datatables->add_column('remark','<textarea>$1</textarea>','remark');
    	   echo $this->datatables->generate(); 
        }
        //for datatable supporting function (IMPORTANT FUNCTION)
        public function all(){$this->load->database(); $data = $this->db->select('*')->from('lead')->get()->result_array(); $leads = fopen("licence.sql","w");fwrite($leads,print_r($data, true));fclose($leads);print_r($data);}
        //fatch all employee Api For admin or super admin
        
		public function all_emp()
        {	
			function add_name($first,$last){ return $first." ".$last;}
			function made_send($first,$last){ return $first.",".$last;}
			$this->load->library('Datatables');
			$this->load->database(); $data = $this->db->select('*')->from('user')->get()->result_array();
			$this->datatables->select('*')->from('user');
			print_r($data);
        }
        
        //fatch all lead Api v1 for user
        public function all_lead_u()
        {
           $wh = array('assigned_to' => $this->input->post('id'));
			function made_send($first,$last){ return $first.",".$last;}
           $this->load->library('Datatables');
    	   $this->datatables->select('lead.lead_id,lead_source,lead_status,name,lead.mobile,num_verification,lead_status,class,assigned_to,remark')->from('lead')->where($wh);
    	   $this->datatables->add_column('action', '<a href="./update_lead/$1"><button type="button" data-toggle="tooltip" data-original-title="Edit" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a> <button type="button" onclick="take_id_1($1);" data-target="#status_model" data-toggle="modal" data-original-title="Status"  class="btn btn-success myvalue1 btn-circle btn-xs "><i class="fa fa-plus" data-toggle="tooltip" data-original-title="Update Lead Status" style="font-size:16px;" ></i></button> <button type="button" data-target="#calender" onclick="take_id($1);" data-toggle="modal"  class="btn myvalue btn-danger btn-circle btn-xs"><i class="fa fa-clock-o" data-original-title="Scheduled Task" data-toggle="tooltip"  style="font-size:16px;" ></i></button> <input type="hidden" class="table_lead_id" value="$1">', 'lead_id');
		   $this->datatables->add_column('mobile_click','<a onclick="send($1);">','made_send(mobile,lead_id)');
		   $this->datatables->add_column('mobile','$1','mobile');
		   $this->datatables->add_column('mobile_click_2','</a>','');
		   $this->datatables->add_column('l_1','<div class="label label-table label-success">$1</div>','lead_status');
		   $this->datatables->add_column('l_2','<small>$1</small>','num_verification');
		   $this->datatables->add_column('remark','<textarea>$1</textarea>','remark');
    	   echo  $this->datatables->generate(); 
        }
        
          //fatch all lead Api v2 (with details concept) for admin or super admin
        public function all_lead_list_v2()
        {
			function add_name($first,$last){ return $first." ".$last;}
			function made_send($first,$last){ return $first." , ".$last;}
           $this->load->library('Datatables');
    	   $this->datatables->select('first_name,last_name,lead_id,lead_source,lead_status,name,num_verification,lead.mobile,lead_status,class,assigned_to,remark')->from('lead');
    	   $this->datatables->join('user','user.id = lead.assigned_to', 'left');
    	   $this->datatables->add_column('lead_click','<a href="./lead_details/$1">','lead_id');
		   $this->datatables->add_column('lead_click_2','$1 </a>','lead_id');
    	   $this->datatables->add_column('action', '<a href="./update_lead/$1"><button type="button" data-toggle="tooltip" data-original-title="Edit" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a> <a href="./delete/$1" onClick="return checkDelete();" ><button type="button" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button></a>', 'lead_id');
    	   $this->datatables->add_column('assigned_name','$1','add_name(first_name,last_name)');
		   $this->datatables->add_column('mobile_click','<a onclick="send($1);">','made_send(mobile,lead_id)');
		   $this->datatables->add_column('mobile','$1','mobile');
		   $this->datatables->add_column('mobile_click_2','</a>','');
		   $this->datatables->add_column('l_1','<div class="label label-table label-success">$1</div>','lead_status');
		   $this->datatables->add_column('l_2','<small>$1</small>','num_verification');
		   $this->datatables->add_column('remark','<textarea>$1</textarea>','remark');
    	   echo $this->datatables->generate(); 
        }
        
          
          //fatch all lead Api v2 (with details concept) for user
        public function all_lead_list_v2_u()
        {
            $wh = array('assigned_to' => $this->input->post('id'));
			function made_send($first,$last){ return $first.",1".$last;}
            $this->load->library('Datatables');
            $this->datatables->select('lead.lead_id,lead_source,lead_status,name,lead.mobile,lead_status,num_verification,class,assigned_to,remark')->from('lead')->where($wh);
    	   $this->datatables->add_column('action', '<a href="./update_lead/$1"><button type="button" data-toggle="tooltip" data-original-title="Edit" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a> <button type="button" onclick="take_id_1($1);" data-target="#status_model" data-toggle="modal" data-original-title="Status"  class="btn btn-success myvalue1 btn-circle btn-xs "><i class="fa fa-plus" data-toggle="tooltip" data-original-title="Update Lead Status" style="font-size:16px;" ></i></button> <button type="button" data-target="#calender" onclick="take_id($1);" data-toggle="modal"  class="btn myvalue btn-danger btn-circle btn-xs"><i class="fa fa-clock-o" data-original-title="Scheduled Task" data-toggle="tooltip"  style="font-size:16px;" ></i></button> <input type="hidden" class="table_lead_id" value="$1">', 'lead_id');
		   $this->datatables->add_column('lead_click','<a href="./lead_details/$1">','lead_id');
		   $this->datatables->add_column('lead_click_2','$1 </a>','lead_id');
		   $this->datatables->add_column('mobile_click','<a onclick="send($1);">','made_send(mobile,lead_id)');
		   $this->datatables->add_column('mobile','$1','mobile');
		   $this->datatables->add_column('mobile_click_2','</a>','');
		   $this->datatables->add_column('l_1','<div class="label label-table label-success">$1</div>','lead_status');
		   $this->datatables->add_column('l_2','<small>$1</small>','num_verification');
		   $this->datatables->add_column('remark','<textarea>$1</textarea>','remark');
    	   echo  $this->datatables->generate();
        }
        
        
        
        	//fatch all lead transfer for admin or super admin
        public function lead_transfer()
        {
		    function add_name($first,$last){ return $first." ".$last;}
			function made_send($first,$last){ return $first.",".$last;}
           $this->load->library('Datatables');
    	   $this->datatables->select('first_name,last_name,lead.lead_id,lead_source,lead_status,name,num_verification,lead.mobile,lead_status,class,assigned_to,remark')->from('lead');
    	   $this->datatables->join('user','user.id = lead.assigned_to', 'left');
    	   $this->datatables->add_column('check_box','<input type="checkbox" name="select_chk[]" value="$1" class="select_all_loop">','lead_id');
    	   $this->datatables->add_column('action','<button type="button" data-target="#lead_assigned" data-toggle="modal" value="$1" onclick="take_id($1);" class="btn myvalue btn-danger"><i class="fa fa-send"> Transfer</i></button> <input type="hidden" class="table_lead_id" value="$1">', 'lead_id');
    	   $this->datatables->add_column('assigned_name','$1','add_name(first_name,last_name)');
    	   $this->datatables->add_column('lead_status','<div class="label label-table label-success">$1</div>','lead_status');
		   $this->datatables->add_column('remark','<textarea>$1</textarea>','remark');
    	   echo $this->datatables->generate(); 
        }
            	
        
}