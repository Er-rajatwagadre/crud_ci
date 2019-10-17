<?php
class Lead_model extends CI_Model {

  

    //-- get all lead 
    function get_all_lead(){
        $this->db->select('lead.*,user.first_name, user.last_name, lead_details.lead_source');
        $this->db->from('lead');
        // $this->db->order_by('class','DESC');
        $this->db->join('user','user.id = lead.assigned_to', 'left');
        $this->db->join('lead_details','lead_details.lead_id = lead.lead_id', 'left');
		$this->db->order_by('updated_lead','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }
    //-- get My lead 
    function get_my_lead($my_name){
		
        $this->db->select('*, lead_details.lead_source');
        $this->db->where('assigned_to',$my_name);
		$this->db->order_by('updated_lead','ACS');
        $this->db->from('lead');
        $this->db->join('lead_details','lead_details.lead_id = lead.lead_id', 'left');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }
	
	
    //-- get all Employee
    function get_all_emp($table){
		
        $this->db->select('*');
        $this->db->where('role',"user");
        $this->db->from($table);
        // $this->db->order_by('designation_id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }
	
	 //-- update Lead // multiple id assigned to user // 
    function update_lead($id,$data){
        $this->db->where('lead_id',$id);
        $this->db->update('lead',$data);
        return;
    } 
	
	//-- update Lead extra information 
    function update_lead_extra($id,$data){
        $this->db->where('lead_id',$id);
        $this->db->update('lead_details',$data);
        return;
    } 
	
	//-- get single lead info (for update)
    function get_single_lead_info($id){
		
        $this->db->select('*');
        $this->db->from('lead');
        $this->db->where('lead_id',$id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }
	
	//-- get single lead extra info (for update)
    function get_single_lead_extra_info($id){
		// echo " hello".$id;
        $this->db->select('*');
        $this->db->from('lead_details');
        $this->db->where('lead_id',$id);
        $query = $this->db->get();
        $query = $query->row();  
		// print_r($query);
		// echo " hello";
        return $query;
    }
	 //-- delete lead function
    function delete($id,$table){
        $this->db->delete($table, array('lead_id' => $id));
        return;
    }
	// insert scheduled in db
	function insert_scheduled ($data1){
		$this->db->insert('scheduled',$data1);
		return;
		}
		
    //-- get all scheduling task for user 
    function get_all_task($table,$emp_id){
		
        $this->db->select('*');
		$this->db->where('emp_id',$emp_id);
        $this->db->from($table);
        // $this->db->order_by('designation_id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }
	
    //-- get all lead details for brief  (: Basic Info.)
    function get_lead_details($lead_id){
		
        $this->db->select('*');
        $this->db->from('lead');
       $this->db->where('lead_id',$lead_id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }
    //-- get all lead details for brief  (: brief Info.)
    function get_lead_big_info($lead_id){
		
        $this->db->select('*');
        $this->db->from('lead_details');
       $this->db->where('lead_id',$lead_id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }
    //-- get all lead details for brief  (: history)
    function get_lead_history($lead_id){
		
        $this->db->select('*');
        $this->db->from('history');
       $this->db->where('lead_id',$lead_id);
	   $this->db->order_by('h_date','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }	
	
	//-- get all lead details for brief  (: event)
    function get_lead_event($lead_id){
		
        $this->db->select('*');
        $this->db->from('scheduled');
       $this->db->where('lead-id',$lead_id);
	   $this->db->order_by('time','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }	
	
    //-- get all scheduling task for admin all task for all date
    function get_all_task_admin($table){
        $this->db->select('*');
        $this->db->from($table);
		$this->db->join('user','user.id = scheduled.emp_id');
        // $this->db->order_by('designation_id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

}