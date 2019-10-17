<?php
class Emp_model extends CI_Model {

//fatch user basic details ...

		 function get_user_details($id){
		$this->db->select('user.*');
		$this->db->select('country.*');
        $this->db->from('user');
		$this->db->where('user.id',$id);
		$this->db->join('country','country.id = user.country','LEFT');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
		}
//fatch all user history  of employee // what he do for lead // status or remarks updates only

		function get_user_history($id){
		$this->db->select('*');
        $this->db->from('history');
		$this->db->where('h_emp_id',$id);
		$this->db->order_by('s_no','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
		}

//fatch all extra Details of employee // details // we have not now :

		function get_user_big_info($id){
		$this->db->select('*');
        $this->db->from('lead_details');
		$this->db->where('lead_id',$id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
		}
//fatch all log of employee //activity overall work

		function get_user_log($id){
		$this->db->select('*');
        $this->db->from('emp_log_file');
		$this->db->where('emp_id',$id);
		$this->db->order_by('S_no','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
		}

//events or schedule task created by Employee 

		function get_user_event($id){
		$this->db->select('*');
        $this->db->from('scheduled');
		$this->db->where('emp_id',$id);
		$this->db->join('lead','lead.lead_id = scheduled.lead-id','left');
		$this->db->order_by('sno','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
		}





}