<?php
/**
 *
 */
class Privacy_Policy extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->view('home/privacy_policy');
  }
}

?>
