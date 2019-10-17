<?php
	class Offers_model extends CI_Model {

		function insert_offers($data,$table){
		$this->db->insert($table,$data);
		return;
		}
		//-- select  data to show leaderboard on dashboard!
     function all_offers_list($table){
        $this->db->select();
        $this->db->from($table);
        // $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }
	//-- delete function
    function delete($id,$table){
        $this->db->where('s_no',$id);
        $this->db->delete($table);
        return;
    }

}