<?php

date_default_timezone_set("Asia/Manila");
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('cookie');
    }

    public function index() {
        if ($this->session->userdata('userInfo')['logged_in'] == 1 && $this->session->userdata('userInfo')['identifier'] == "professor") {
            $info = $this->session->userdata('userInfo');

            if (is_array($hold = $this->get_active_enrollment())) {        //checks if this is array, else it is error coz multiple active enrollment
                $enrollment_active = $hold[0]->enrollment_id;

                $col = 'cou.course_id, cou.course_course_title, cou.course_course_code';
                $where = array('cou.enrollment_id' => $enrollment_active, 'cou.course_department' => $info["user"]->professor_department);
                $result = $this->Crud_model->fetch_select("course as cou", $col, $where);
//                echo"<pre>";
//                print_r($result[0]);
                foreach ($result as $key => $res) {
                    $var = (string) $res->course_id;
                    $result[$key]->course_id_sha = $this->hash_id($var);
                }

                $data = array(
                    "title" => "Section Management",
                    'info' => $info,
                    "s_h" => "",
                    "s_a" => "",
                    "s_c" => "",
                    "s_f" => "",
                    "result" => $result
                );
                $this->load->view('includes/header', $data);
                $this->load->view('course/main');
                $this->load->view('includes/footer');
            } else {
                echo $hold;
            }
        } else {
            redirect("");
        }
    }

    public function view() {
        if ($this->session->userdata('userInfo')['logged_in'] == 1 && $this->session->userdata('userInfo')['identifier'] == "professor") {
            $info = $this->session->userdata('userInfo');

            if (is_array($hold = $this->get_active_enrollment())) {        //checks if this is array, else it is error coz multiple active enrollment
                $enrollment_active = $hold[0]->enrollment_id;

                $col = 'cou.course_id, cou.course_course_title, cou.course_course_code';
                $where = array('cou.enrollment_id' => $enrollment_active, 'cou.course_department' => $info["user"]->professor_department, "cou.professor_id" => $info["user"]->professor_id);
                $result = $this->Crud_model->fetch_select("course as cou", $col, $where);
                $segment = $this->uri->segment(3);  //get segment
                $isit = false;                      //holder if it is confirmed
                foreach ($result as $key => $res) {
                    $var = $res->course_id;
                    if ($segment == $this->hash_id($var)) {
                        $isit = true;
                        $hold_key = $key;
                        break;
                    }
                }
                if ($isit) {
                    $course = $result[$hold_key];
                    $col = 'off.offering_id, off.offering_name, sch.schedule_start_time, sch.schedule_end_time, sch.schedule_venue';
                    $where = array("off.course_id" => $result[$hold_key]->course_id);
                    $join = array(
                        array(
                            "schedule as sch", "sch.offering_id = off.offering_id"
                        )
                    );
                    $result = $this->Crud_model->fetch_join2("offering as off", $col, $join, NULL, $where);

                    foreach ($result as $key => $res) {
                        $result[$key]->format_time = date("g:iA", $res->schedule_start_time) . "-" . date("g:iA", $res->schedule_end_time);
                        $result[$key]->format_day = date("D", $res->schedule_start_time);
                    }
                    $data = array(
                        "title" => "Section Management",
                        'info' => $info,
                        "s_h" => "",
                        "s_a" => "",
                        "s_c" => "",
                        "s_f" => "",
                        "result" => $result,
                        "course_title" => $course->course_course_title,
                        "course_code" => $course->course_course_code
                    );
                    $this->load->view('includes/header', $data);
                    $this->load->view('course/view');
                    $this->load->view('includes/footer');
                } else {
                    redirect("Course");
                }
            } else {
                echo $hold;
            }
        } else {
            redirect();
        }
    }

    public function add() {
        if ($this->session->userdata('userInfo')['logged_in'] == 1 && $this->session->userdata('userInfo')['identifier'] == "professor") {
            $info = $this->session->userdata('userInfo');

            $this->form_validation->set_rules('course_code', "Course Code", "required|alpha_numeric|min_length[3]|max_length[20]");
            $this->form_validation->set_rules('course_title', "Course Title", "required|alpha_numeric|min_length[3]|max_length[100]");

            $data = array(
                "title" => "Course Management",
                'info' => $info,
                "s_h" => "",
                "s_a" => "",
                "s_c" => "",
                "s_f" => ""
            );
            $this->load->view('includes/header', $data);
            if ($this->form_validation->run() == FALSE) {       //wrong
                $this->load->view('course/add');
            } else {
                echo '<script>alert("Successful insertion");</script>';

                //GET ENROLLMENT OF THE USER
                $where = array(
                    "professor_id" => $info["user"]->professor_id,
                    "course_department" => $info["user"]->professor_department
                );
                $col = "enrollment_id";
                $result = $this->Crud_model->fetch_select("course", $col, $where);

                $hold = $this->input->post(array('course_code', 'course_title'));
//                print_r($hold);
                $data = array(
                    "course_course_code" => $hold["course_code"],
                    "course_course_title" => $hold["course_course_title"],
                    "course_department" => $info["user"]->professor_department,
                    "course_is_active" => 1
                );
                if ($result = $this->Crud_model->insert("course", $data)) {

                } else {
                    redirect("Course");
                }
            }
            $this->load->view('includes/footer');
        } else {
            redirect();
        }
    }

    private function get_active_enrollment() {
        $where = array("enrollment_is_active" => 1);
        if (count($result = $this->Crud_model->fetch_select("enrollment", NULL, $where)) != 1) {
            return "There are multiple active enrollment.";
        } else if ($result) {
            return $result;
        } else {
            return "There is no activated enrollment";
        }
    }

    private function hash_id($var) {
        return substr(sha1($var), 1, 10);
    }

}
