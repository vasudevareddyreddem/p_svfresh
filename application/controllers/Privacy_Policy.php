<?php
/**
 *
 */
class Privacy_policy extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
	$data['pageTitle'] = 'privacy policy';
    $this->load->view('home/privacy_policy',$data);
  }
}

?>
