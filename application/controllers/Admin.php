<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session'); 
		$this->load->model('Crud_model');
	}

	public function dateDiffHours($value1 , $value2)
	{
		return round($value2 / (60 * 60 )) - round($value1 / (60 * 60 ));
	}
	public function dateDiffMinutes($value1 , $value2)
	{
		return round($value2 / (60 )) - round($value1 / (60));
	}

	

	public function index()
	{


		
		// Fetch Schedule
		$report_cosml = $this->Crud_model->fetch("schedule");

		// Count Schedule
		$count_res = $this->Crud_model->countResult("schedule");

		$this->verify_login();

		foreach ($report_cosml as $key => $value) {
			// Fetch Offering Data
			$report_cosml_offering = $this->Crud_model->fetch("offering",array("offering_id"=>$value->offering_id));

			foreach ($report_cosml_offering as $key => $offer) {

			// Insert offering data to object
				$value->course_code = $offer->offering_course_code;
				$value->course_title = $offer->offering_course_title;
				$value->course_section = $offer->offering_section;
				$value->lecturer_id = $offer->offering_lecturer_id;
				$value->enrollment_id = $offer->enrollment_id;
			}

			// Fetch Lecturer's data
			$value_lecturer = $this->Crud_model->fetch("lecturer",array("lecturer_id"=>$value->lecturer_id));
			foreach ($value_lecturer as $key => $lecturer) {
				$value->lecturer_name = $lecturer->lecturer_firstname." ".$lecturer->lecturer_lastname;
				$value->lecturer_firstname = $lecturer->lecturer_firstname;
				$value->lecturer_middlename = $lecturer->lecturer_midname;
				$value->lecturer_lastname = $lecturer->lecturer_lastname;
				$value->lecturer_expertise = $lecturer->lecturer_expertise;
				$value->lecturer_status = $lecturer->lecturer_status;
			}

			// Fetch Enrollment Data
			$value_enrollment = $this->Crud_model->fetch("enrollment",array("enrollment_id"=>$value->enrollment_id));
			foreach ($value_enrollment as $key => $enroll) {
				$value->term = $enroll->enrollment_term;
				$value->sy = $enroll->enrollment_sy;
			}
		}

		$data = array(
			"title" => "Administrator - Learning Management System | FEU - Institute of Techonology",
			"div_cosml_data" => $report_cosml
		);
		$this->load->view('includes/header',$data);
		$this->load->view('admin');
		$this->load->view('includes/footer');
	}


	public function Announcements()
	{
		$this->verify_login();
		$announcement = $this->Crud_model->fetch("announcement");
		$data = array(
			"title" => "Announcements - Learning Management System | FEU - Institute of Techonology",
			"announcement"=>$announcement
		);
		$this->load->view('includes/header',$data);
		$this->load->view('announcement');
		$this->load->view('includes/footer');
	}

	public function addAnnouncement()
	{
		$column = "";
		$info = $this->session->userdata('userInfo');
		switch ($info["identifier"]) {
			case 'administrator':
			$column="admin_id";
			break;
			case 'student':
			$column="student_id";
			break;
			case 'lecturer':
			$column="lecturer_id";
			break;
			case 'professor':
			$column="professor_id";
			break;
			
			default:
				# code...
			break;
		}


		$title = $this->input->post("title");
		$content = $this->input->post("content");
		$audience = $this->input->post("ann_audience");
		$data = array(
			"announcement_title"=>$title,
			"announcement_content"=>$content,
			"announcement_created_at"=>time(),
			"announcement_edited_at"=>time(),
			"announcement_is_active"=>time(),
			"announcement_audience"=>$audience,
			"announcement_announcer_id"=>$info["user"]->$column

		);
		if ($this->Crud_model->insert("announcement",$data)) {
			redirect('Admin/announcements','refresh');
		}

	}


	public function verify_login() 	
	{
		$info = $this->session->userdata('userInfo');
		if (!$info['logged_in'] && $info['identifier']=="administrator"){
			redirect('Welcome','refresh');
		}elseif ( $info['identifier']=="lecturer" || $info['identifier']=="student"|| $info['identifier']=="professor") {
			redirect('Home','refresh');
		}elseif(!$info['logged_in']){
			redirect('Welcome','refresh');
		}
	}

	public function viewAttendance()
	{
		$sum = 0;
		$minutes = 0;
		$lec_id = $this->uri->segment(3);
		$lec_data = $this->Crud_model->fetch("lecturer",array("lecturer_id"=>$lec_id));
		$lec_att_foreach = $this->Crud_model->fetch("lecturer_attendance",array("lecturer_lecturer_id"=>$lec_id));
		$lec_data = $lec_data[0];
		$lec_attendance = $this->Crud_model->fetch("lecturer_attendance",array("offering_id"=>$lec_data->lecturer_offering_id));

		foreach ($lec_att_foreach as $key => $value) {

			$sum +=  $this->dateDiffHours($value->lecturer_attendance_in,$value->lecturer_attendance_out);
			$minutes += $this->dateDiffMinutes($value->lecturer_attendance_in,$value->lecturer_attendance_out);
		}

		$minutes = (($sum * 60) - $minutes)*-1;

		$data = array(
			"title" => "Administrator - Learning Management System | FEU - Institute of Techonology",
			"lecturer"=>$lec_data,
			"attendance"=>$lec_attendance,
			"hours_rendered"=>$sum,
			"minutes_rendered"=>$minutes
		);
		$this->load->view('includes/header',$data);
		$this->load->view('admin-attendance');
		$this->load->view('includes/footer');
	}

	public function viewClassList()
	{
		$offering = $this->Crud_model->fetch("offering",array("offering_lecturer_id"=>$this->uri->segment(3)));

		$data = array(
			"title" => "Class List - Learning Management System | FEU - Institute of Techonology",
			"offering"=>$offering,
			
		);
		$this->load->view('includes/header',$data);
		$this->load->view('admin-classlist');
		$this->load->view('includes/footer');
	}



}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */