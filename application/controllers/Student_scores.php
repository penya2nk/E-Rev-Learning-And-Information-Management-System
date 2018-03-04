
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Student_scores extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Crud_model');
    }

    public function index() {
        $info = $this->session->userdata('userInfo');

        $ident = $info['identifier'];
        $ident.="_department";
        $program = 0;

        switch ($info['user']->$ident) {
            case 'CE':
                $program = 1;
                break;
            case 'ECE':
                $program = 2;
                break;
            case 'EE':
                $program = 3;
                break;
            case 'ME':
                $program = 4;
                break;

            default:
                break;
        }


        if ($info['logged_in'] && $info['identifier'] != "administrator") {
            $data = array(
                "title" => "Home - Learning Management System | FEU - Institute of Techonology",
                "info" => $info,
                "program" => $program,
                "s_h" => "",
                "s_a" => "",
                "s_f" => "",
                "s_c" => "",
                "s_t" => "",
                "s_s" => "",
                "s_co" => "",
                "s_ss" => "selected-nav",
            );
            $this->load->view('includes/header', $data);
            $this->load->view('student_scores');
            $this->load->view('includes/footer');
        } elseif ($info['identifier'] == "administrator") {
            redirect('Admin');
        } else {
            redirect('Welcome', 'refresh');
        }
    }

    public function importData() {
        $info = $this->session->userdata('userInfo');
        $ident = $info['identifier'];
        $ident.="_department";
        $program = 0;
        $course_id = $this->uri->segment(3);
        switch ($info['user']->$ident) {
            case 'CE':
                $program = 1;
                break;
            case 'ECE':
                $program = 2;
                break;
            case 'EE':
                $program = 3;
                break;
            case 'ME':
                $program = 4;
                break;

            default:
                break;
        }


        if ($info['logged_in'] && $info['identifier'] != "administrator") {
            $data = array(
                "title" => "Home - Learning Management System | FEU - Institute of Techonology",
                "info" => $info,
                "program" => $program,
                "course_id" => $course_id,
                "s_h" => "",
                "s_a" => "",
                "s_f" => "",
                "s_c" => "",
                "s_t" => "",
                "s_s" => "",
                "s_co" => "",
                "s_ss" => "selected-nav",
            );
            $this->load->view('includes/header', $data);
            $this->load->view('student_scores_import');
            $this->load->view('includes/footer');
        } elseif ($info['identifier'] == "administrator") {
            redirect('Admin');
        } else {
            redirect('Welcome', 'refresh');
        }
    }

    public function insertScore() {
        $total_s = $this->input->post("total_s");
        $total_s_alt = str_replace(" ", "", strip_tags($total_s));

        $passing_s = $this->input->post("passing_s");
        $passing_s_alt = str_replace(" ", "", strip_tags($passing_s));

        $select = $this->input->post("select");
        $select_alt = str_replace(" ", "", strip_tags($select));


        if (empty($total_s_alt) || empty($passing_s_alt) || empty($select_alt)) {
            echo json_encode("Values cannot be NULL");
        } elseif ($total_s <= $passing_s) {
            echo json_encode("Total Score must not be greater than passing score");
        } elseif (is_numeric($total_s) == false || is_numeric($passing_s) == false) {
            echo json_encode("Total Score and Passing Score Must be numeric only");
        } elseif ($total_s < 1 || $passing_s < 1) {
            echo json_encode("No negative and 0 value");
        } else {
            if ($this->Crud_model->insert("data_scores", array("data_scores_type" => $select, "data_scores_score" => $total_s, "data_scores_passing" => $select))) {
                echo json_encode(true);
            } else {
                echo json_encode("Problem in inserting Data Scores");
            }
        }
    }

    public function read_excel() {
        echo $this->uri->segment(3);

        require "./application/vendor/autoload.php";

        $config['upload_path'] = "./assets/uploads/";
        $config['allowed_types'] = 'xls|csv|xlsx';
        $config['max_size'] = '10000';
        $config["file_name"] = "student_scores_" . time();

        $this->load->library('upload', $config);
        $data = array(
            'title' => "Imported"
        );
        $this->load->view('includes/header', $data);
        if ($this->upload->do_upload($this->input->post("excel"))) {       //success upload
            $upload_data = $this->upload->data();
            echo"<pre>";
            print_r($upload_data);
            echo"<br>";
            echo"<br>";

            /** Load $inputFileName to a Spreadsheet Object  * */
            $spreadsheet = IOFactory::load($upload_data["full_path"]);
            $worksheet = $spreadsheet->getActiveSheet();
            echo $highestRow = $worksheet->getHighestRow(); // e.g. 10
            echo $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
//            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            print_r($sheetData);
        } else {            //uploading failed
            //code here
            echo "<br>";
            print_r($this->upload->display_errors());
        }
        $this->load->view('includes/footer', $data);
    }

}

/* End of file Student_scores.php */
/* Location: ./application/controllers/Student_scores.php */
