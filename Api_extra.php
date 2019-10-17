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
                        							<th> File</th>
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
        	
        	//fatch all lead Api
        public function all_lead_test()
        {
           $this->load->library('Datatables');
    	   $this->datatables->select('first_name,last_name,lead.lead_id,lead_source,lead_status,name,lead.mobile,lead_status,class,assigned_to,remark')->from('lead');
    	   $this->datatables->join('lead_details','lead_details.lead_id = lead.lead_id','LEFT');
    	   $this->datatables->join('user','user.id = lead.assigned_to', 'left');
    	   $this->datatables->add_column('action', '<a href="./update_lead/$1"><button type="button" data-toggle="tooltip" data-original-title="Edit" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a> <a href="./delete/$1" onClick="return checkDelete();" ><button type="button" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button></a>', 'lead_id');
    	   $this->datatables->add_column('assigned_name','<p>first_name last_name</p>','first_name last_name');
    	   echo $this->datatables->generate(); 
        }
            	
        
}