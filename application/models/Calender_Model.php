<?php
/**
 *
 */
class Calender_Model extends CI_Model
{

  public $table = 'calender_tab';

  function __construct()
  {

  }

  public function insert($post_data='')
  {
    return $this->db->insert($this->table,$post_data);
  }

}


?>
