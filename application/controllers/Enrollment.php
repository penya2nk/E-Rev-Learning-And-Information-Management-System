<?php

date_default_timezone_set("Asia/Manila");
defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Crud_model');
	}

	public function index() {
		$info = $this->session->userdata('userInfo');

		if ($info['identifier'] != "administrator") {
			redirect('Home', 'refresh');
		} elseif (!$info['logged_in']) {
			redirect('Welcome', 'refresh');
		}
		$data = array(
			"title" => "Enrollment - Learning Management System | FEU - Institute of Techonology"
		);
		$this->load->view('includes/header', $data);
		$this->load->view('enrollment/enrollment');
		$this->load->view('includes/footer');
	}

	public function updateEnrollment()
	{
		$id = $this->input->post("e_id");
		$active_e = $this->Crud_model->fetch("enrollment",array("enrollment_is_active"=>1));
		if ($active_e) {
			$active_e = $active_e[0];
			if ($this->Crud_model->update("enrollment",array("enrollment_is_active"=>0),array("enrollment_id"=>$active_e->enrollment_id))) {
				if ($this->Crud_model->update("enrollment",array("enrollment_is_active"=>1),array("enrollment_id"=>$id))) {
					echo json_encode(true);
				}else{
					echo json_encode("failed updating new enrollment");
				}
			}else{
				echo json_encode("failed updating old enrollment");
			}
		}else{
			if ($this->Crud_model->update("enrollment",array("enrollment_is_active"=>1),array("enrollment_id"=>$id))) {
				echo json_encode(true);
			}else{
				echo json_encode("failed adding new enrollment");
			}
		}
	}

}
