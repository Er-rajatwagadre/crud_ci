<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offers extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
       $this->load->model('Offers_model');
       $this->load->model('lead_model');
       $this->load->model('leaderboard_model');
    }
	
	public function index()
    {
        $data = array();
        $data['page_title'] = 'Add Offers';
        $data['country'] = $this->common_model->select('country');
		$data['designation'] = $this->common_model->get_all_designation('user_designation');
        $data['main_content'] = $this->load->view('admin/offers/add_offers', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

		public function insert_offers()
			{

			$data = array(
			'offers_title' => $_POST['offers_title'],
			'offers_details' => $_POST['offers_details'],
			'offers_created_date' => $_POST['offers_created_date']
			);		
			$this->Offers_model->insert_offers($data,'offers_zone');
			redirect(base_url('admin/offers/all_offers'));
		}
		
		public function all_offers()
		{
			$data = array();
			$data['page_title'] = 'All Offer Zone';
			$data['offers_data'] = $this->Offers_model->all_offers_list('offers_zone'); //fatch all leadboard by admin
			$data['main_content'] = $this->load->view('admin/offers/all_offers', $data, TRUE);
			$this->load->view('admin/index', $data);
		}
		public function delete_ofr()
		{
			if($_GET){	
			$sno=$_GET['del_id'];
			$data['offers_data'] = $this->Offers_model->delete($sno,'offers_zone'); //DELETE 
			}
			$data = array();
			$data['page_title'] = ' All Offer Delete Zone';
			$data['offers_data'] = $this->Offers_model->all_offers_list('offers_zone'); //fatch all leadboard by admin
			$data['main_content'] = $this->load->view('admin/offers/delete_offers', $data, TRUE);
			$this->load->view('admin/index', $data);
			
		}
}