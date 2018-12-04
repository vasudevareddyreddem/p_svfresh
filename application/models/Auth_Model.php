<?php
/**
 *
 */
class Auth_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }
  public $table = 'users_tab';

  public function insert($post_data)
  {
    return $this->db->insert($this->table,$post_data);
  }

  public function check_exists($post_phone)
  {
    $this->db->where($post_phone);
    return $this->db->get($this->table)->row();
  }

  public function login($post_data)
  {
    return $this->db->get_where($this->table,$post_data)->row();
  }

}

 ?>
