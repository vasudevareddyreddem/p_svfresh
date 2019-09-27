<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");

	}
	public function check_password($id,$pwd){
			$pwd=md5($pwd);
			$this->db->select('admin_id');
			$this->db->from('admin_tab');
			$this->db->where('admin_id',$id);
			$this->db->where('password',$pwd);
			 $res=$this->db->get()->result();
			 if(count($res)>0){
				 return 1;
				
			 }
			else {return 0;}
			 
			
		}
		public function set_new_password($id,$newpwd,$pwd){
			$hashpwd=md5($newpwd);
			$this->db->set('password',$hashpwd);
			$this->db->set('org_password',$newpwd);
			$this->db->where('admin_id',$id);
			$this->db->update('admin_tab');
			 return ($this->db->affected_rows() > 0) ? 1 : 0; 
		}
		public function count_cat(){
			$this->db->select('*')->from('category_tab')->where('status',1)
			->or_where('status',2);
			$res=$this->db->get()->result();
			return count($res);
		}
		public function count_users(){
			$this->db->select('*')->from('users_tab');
			$res=$this->db->get()->result();
			return count($res);
		}
		public function count_orders(){
			$this->db->select('*')->from('order_tab');
			$res=$this->db->get()->result();
			return count($res);
		}
		public function count_products(){
			$this->db->select('*')->from('product_tab')->where('status',1)
			->or_where('status',2);
			$res=$this->db->get()->result();
			return count($res);
		}
		public function update_app_content_data($id,$data){
			$this->db->where('c_id',$id);
			return $this->db->update('app_scroll_content',$data);
		}
		
		public  function get_app_content_data(){
				$this->db->select('*')->from('app_scroll_content');
				return $this->db->get()->row_array();
		}
		public function get_all_users_data(){
				$this->db->select('id,verified,otp_created_on,updated_by_admin')->from('users_tab');
				//$this->db->where('updated_by_admin !=',1);
				$this->db->where('verified',0);
				return $this->db->get()->result_array();
		}
		public function user_delete($id){
			$this->db->where('id',$id);
			return $this->db->delete('users_tab');
		}
	
	}