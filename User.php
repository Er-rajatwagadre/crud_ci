<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
       $this->load->model('Emp_model');
    }
    

    public function index()
    {
        $data = array();
        $data['page_title'] = 'Add Employee';
        $data['country'] = $this->common_model->select('country');
        $data['designation'] = $this->common_model->get_all_designation('user_designation');
        $data['main_content'] = $this->load->view('admin/user/add', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- add new employee by admin
    public function add()
    {   
        if ($_POST){
            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'mobile' => $_POST['mobile'],
                'country' => $_POST['country'],
                'role' => $_POST['role'],
            );

            $data = $this->security->xss_clean($data);
            
            //-- check duplicate email
            $email = $this->common_model->check_email($_POST['email']);

            if (empty($email)) {
                $user_id = $this->common_model->insert($data, 'user');
            
               
                $this->session->set_flashdata('msg', 'Employee added successfully');
                redirect(base_url('admin/user/all_user_list'));
            } else {
                $this->session->set_flashdata('error_msg', 'Email already exist, try another email');
                redirect(base_url('admin/user'));
            }
        }
    }

    public function all_user_list()
    {
	 	$data['page_title'] = 'All Registered Employee';
        $data['users'] = $this->common_model->get_all_user();
        $data['country'] = $this->common_model->select('country');
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/user/users', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- update employee info
    public function update($id)
    {
        if ($_POST) {
			
			$pass_enc=	md5($_POST['password']);
            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'mobile' => $_POST['mobile'],
                'password' => $pass_enc,
                'country' => $_POST['country'],
                'role' => $_POST['role']
            );
            $data = $this->security->xss_clean($data);

            $designations = $this->input->post('role_action');
            if (!empty($designations)) {
                $this->common_model->delete_user_role($id, 'user_role');
                foreach ($designations as $value) {
                   $role_data = array(
                        'user_id' => $id,
                        'action' => $value
                    ); 
                   $role_data = $this->security->xss_clean($role_data);
                   $this->common_model->insert($role_data, 'user_role');
                }
            }

            $this->common_model->edit_option($data, $id, 'user');
            $this->session->set_flashdata('msg', 'Information updated successfully');
            redirect(base_url('admin/user/all_user_list'));

        }
		
        $data['user'] = $this->common_model->get_single_user_info($id);
        // $data['user_role'] = $this->common_model->get_user_role($id);
        $data['designation'] = $this->common_model->select('user_designation');
        $data['country'] = $this->common_model->select('country');
        $data['main_content'] = $this->load->view('admin/user/edit_user', $data, TRUE);
		$data['page_title'] = 'Edit User';
        $this->load->view('admin/index', $data);
    }

    public function user_activation()
    {
	 	$data['page_title'] = 'All Registered Employee';
        $data['main_content'] = $this->load->view('admin/user/activation', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    

	public function treeview()
    {
	 	$data['page_title'] = 'All Registered Employee';
        $data['users'] = $this->common_model->get_all_user();
        $data['country'] = $this->common_model->select('country');
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/pages/treeview', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    
    //-- active user
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'Employee active successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- deactive user
    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'User deactivate successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- delete employee (user)
    public function delete($id)
    {
        $this->common_model->delete($id,'user'); 
        $this->session->set_flashdata('msg', 'User deleted successfully');
        redirect(base_url('admin/user/all_user_list'));
    }


    public function designation()
    {   
		$data['page_title'] = 'Add Employee  Designation';
        $data['designations'] = $this->common_model->get_all_designation('user_designation');
        $data['main_content'] = $this->load->view('admin/user/user_designation', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- add user designation
    public function add_designation()
    {   
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name'],
                'designation_id' => $_POST['designation_id']
            );
            $data = $this->security->xss_clean($data);
            
            //-- check duplicate designation id
            $designation = $this->common_model->check_exist_designation($_POST['designation_id']);
            if (empty($designation)) {
                $user_id = $this->common_model->insert($data, 'user_designation');
                $this->session->set_flashdata('msg', 'Designation added successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Designation id already exist, try another one');
            }
            redirect(base_url('admin/user/designation'));
        }
        
    }

    //--update user designation
    public function update_designation()
    {   
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name']
            );
            $data = $this->security->xss_clean($data);
            
            $this->session->set_flashdata('msg', 'designation updated Successfully');
            $user_id = $this->common_model->edit_option($data, $_POST['id'], 'user_designation');
            redirect(base_url('admin/user/designation'));
        }
        
    }

    public function delete_designation($id)
    {
        $this->common_model->delete($id,'user_designation'); 
        $this->session->set_flashdata('msg', 'Designation deleted successfully');
        redirect(base_url('admin/user/designation'));
    }
	public function user_details($id)
			{
						$data = array();
						$data['page_title'] = 'User Details';
						$data['details'] = $this->Emp_model->get_user_details($id);
						$data['country'] = $this->common_model->select('country');						//fatch country for user.//basic details
						$data['history'] = $this->Emp_model->get_user_history($id); //fatch all History of lead!.. // work about lead
						$data['emp_log'] = $this->Emp_model->get_user_log($id); //fatch all log data(activity) of lead!. // overall work login to log out.
						$data['big_details'] = $this->Emp_model->get_user_big_info($id); //fatch all brief of lead!.. // extra details of employee - in v3.3 future version.
						$data['event'] = $this->Emp_model->get_user_event($id); //fatch all event(scheduler) of lead!..
						  // print_r($data['details']);
						$data['main_content'] = $this->load->view('admin/pages/users_details', $data, TRUE);
						$this->load->view('admin/index', $data);
			}

	public function users_v2(){
						$data = array();
						$data['users'] = $this->common_model->get_all_user();
						$data['count'] = $this->common_model->get_user_total();
						$data['page_title'] = 'Employee List V2';	
						$data['main_content'] = $this->load->view('admin/user/user_v2', $data, TRUE);
						$this->load->view('admin/index', $data);

		}
		
		   


}