<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muc extends CI_Controller
{
    public $data;

    function __construct()
    {
        parent::__construct();
        //$this->load->model('Campaign_model');
        $this->load->model('Muc_model');
        $this->load->library('Csvimport');
        $this->load->library('form_validation');


        $this->load->model('User_model');
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }
        if (!$this->User_model->isadmin($this->session->userdata('user_id'))) {
            redirect('user/login');
        }

    }


    function index()
    {
        $data['muc_unsubscribers'] = $this->Muc_model->count_muc_unsubscribers();
        $data['muc_active'] = $this->Muc_model->count_muc_active();
        $this->load->view('admin/muc');

    }

//PRAV!!! Da duplikate v bazo, vendar vse duplikate!tudi če so isti že v bazi
    public function check_duplicates() {


        $this->load->model('Upload_model');
        $this->Upload_model->copy_duplicates();
        $this->Upload_model->truncate_duplicates();
        $query = "INSERT IGNORE INTO muc_duplicates (email_dup)  (SELECT email_ac from muc_active ac INNER JOIN muc_unsubscribers un ON ac.email_ac = un.email_un) ";


            $this->db->query($query);                   

            $this->session->set_flashdata('success', 'Duplicates Checked Succesfully');
            $this->Upload_model->trunc_ac();
            redirect(base_url() . 'index.php/admin/muc');
     //  $this->load->view('admin/muc');
    }

//print duplicated emails in CSV DELA!!!!!!

    function exportCSV()
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=' . $name);

        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = " , ";
        $newline = "\r\n";
		$enclosure = "";
        $filename = "duplicated_emails_export.csv";
        $datestart = $_POST['datepickerstart'];
        $datest = date("Y-m-d",strtotime($datestart));

        $query = "SELECT * FROM muc_duplicates WHERE cas >= '$datest'";
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline, $enclosure);

        force_download($filename, $data);


    }


    public function csvactive()
    {
        $this->load->view('admin/muc');
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=' . $name);
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        $this->load->model('upload_services');
        $this->load->helper('file');
        $this->load->library('csvimport');
        $this->load->library('upload');
        $data = array(
            'email_ac' => $email_ac
        );
        $this->db->set('cas', FALSE);
        $this->db->insert('muc_active', $data);
        $result = $this->db->query($query);
        force_upload($data);

        // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    }


    public function csvun()
    {
        $this->load->view('admin/muc');
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=' . $name);
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        $this->load->spark('csvimport');
        $this->load->model('upload_services');
        $this->load->model('Muc_model');
        $this->load->helper('file');
        $this->load->library('csvimport');
        $this->load->library('upload');
        $newline = "\r\n";
        $data['muc_unsubscribers'] = $this->Muc_model->csvun2();
        $this->db->set('cas', FALSE);

        $result = $this->db->query($query);
        force_upload($data);

    }


    function importcsvun()
    {
        $data['muc_unsubscribed'] = $this->Muc_model->get_un();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv|gif|jpg|png';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->load->library('Csvimport');
        $this->load->helper('file');

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/muc', $data);

        } else {
            $data = array('upload_data' => $this->upload->data());
            $file_data = $this->upload->data();
            $file_path = './uploads/' . $file_data['file_name'];

            if ($this->csvimport->parse_file($file_path)) {
                $csv_array = $this->csvimport->parse_file($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'email_un' => $row['email_un'],

                    );
                    $this->Muc_model->insert_csv_un($insert_data);
                }
            } else
                $data['error'] = "Error occured";
        }
        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
        redirect(base_url() . 'index.php/admin/muc');
    }


    function importcsvac()
    {
        $data['muc_active'] = $this->Muc_model->get_ac();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv|gif|jpg|png';
        $config['max_size'] = 1000;
        $this->load->library('upload', $config);
        $this->load->library('Csvimport');
        $this->load->helper('file');

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/muc', $data);

        } else {
            $data = array('upload_data' => $this->upload->data());
            $file_data = $this->upload->data();
            $file_path = './uploads/' . $file_data['file_name'];

            if ($this->csvimport->parse_file($file_path)) {
                $csv_array = $this->csvimport->parse_file($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'email_ac' => $row['email_ac'],

                    );
                    $this->Muc_model->insert_csv_ac($insert_data);
                }
            } else
                $data['error'] = "Error occured";
        }
        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
        redirect(base_url() . 'index.php/admin/muc');
    }

    public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('upload_success', $data);
        }
    }

///////////////////New functions to import CSV files///////////////////////////////////

    public function import_un(){
        set_time_limit(1000);
        $count=0;
        $fp = fopen($_FILES['unactives']['tmp_name'],'r') or die("can't open file");
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $insert_csv = array();
                $insert_csv['email_un'] = $csv_line[0];

            }
            $i++;
            $data = array(
                'email_un' => $insert_csv['email_un']);
            //$this->db->insert('muc_unsubscribers', $data);
            $this->Muc_model->insert_csv_un($data);

        }
        fclose($fp) or die("can't close file");
        
        //$this->Muc_model->insert_csv_un($data);
        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
        redirect(base_url() . 'index.php/admin/muc');
    }

    public function import_ac(){
        set_time_limit(1000);
        $count=0;
        $fp = fopen($_FILES['actives']['tmp_name'],'r') or die("can't open file");
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $insert_csv = array();
                $insert_csv['email_ac'] = $csv_line[0];

            }
            $i++;
            $data = array(
                'email_ac' => $insert_csv['email_ac']);
            //$this->db->insert('muc_active', $data);
            $this->Muc_model->insert_csv_ac($data);
        }
        fclose($fp) or die("can't close file");
        
        //$this->Muc_model->insert_csv_un($data);
        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
        redirect(base_url() . 'index.php/admin/muc');
    }
}


