<?php
class Members extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->model('Members_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        
        $data['judul'] = 'Halaman Members';
        $data['members'] = $this->Members_model->getAllMembers();
        // if($this->input->post('keyword')){
        //     $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
        // }
        // Upload CSV
            $file = $_FILES;
        if(!empty($file)){
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'csv';
            $config['max_size']             = 100;
            $this->load->library('upload', $config);
            if ( !$this->upload->do_upload('csv')){
                $data['error'] = $this->upload->display_errors();   
            }else{
                $newfile = $this->upload->data();
           
                $handle = fopen($config['upload_path'].$newfile['file_name'], "r");
                $i = 1; $data['ok'] = ""; $data['error'] = "";
                while (($dt = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    // proses simpan ke db
                    $in['fullname'] = $dt[0];
                    $in['email'] = $dt[1];
                    $in['address'] = $dt[2];
                    $in['idcompany'] = $dt[3];
                    $in['idcity'] = $dt[4];    
                    $add = $this->Members_model->add($in);
                    if($add['sts']){
                        $data['ok'] .= "Baris ke ".$i.": ".$add['msg']."<br />";
                        
                    }else{
                        $data['error'] .= "Baris ke ".$i.": ".$add['msg']."<br />";
                        
                    }
                    $i++;   
                }
                fclose($handle);
            }
        }



        $this->load->view('templates/header',$data);
        $this->load->view('members/index');
        $this->load->view('templates/footer');
    }
    public function detail($id)
    {
    	$data['judul'] = 'Detail Members';
        $data['members'] = $this->Members_model->getMembersById($id);
        $this->load->view('templates/header',$data);
        $this->load->view('members/detail_members',$data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $this->Members_model->hapusDataMembers($id);
         $this->session->set_flashdata('flash','Dihapus');
        redirect('members');
    }

    public function tambah()
    {
    	$data['judul'] = 'Tambah Data Members';
    	$data['company'] = $this->Members_model->getAllCompany();
    	$data['city'] = $this->Members_model->getAllCity();

    	$this->form_validation->set_rules('fullname','Nama','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        if($this->form_validation->run() == FALSE ) {

    	$this->load->view('templates/header',$data);
        $this->load->view('members/tambah');
        $this->load->view('templates/footer');

         } else {
           $this->Members_model->tambahDataMembers();
           $this->session->set_flashdata('flash', 'Ditambahkan');
           redirect('members');
            
        }
    }

    public function edit($id)
    {
    	
    	$data['judul'] = 'Edit Data Members';
    	$data['company'] = $this->Members_model->getAllCompany();
    	$data['city'] = $this->Members_model->getAllCity();
    	$data['members'] = $this->Members_model->getMembersById($id);
    	$this->form_validation->set_rules('fullname','Nama','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        if($this->form_validation->run() == FALSE ) {

    	$this->load->view('templates/header',$data);
        $this->load->view('members/edit');
        $this->load->view('templates/footer');

         } else {
           $this->Members_model->editDataMembers($id);
           $this->session->set_flashdata('flash', 'Diubah');
           redirect('members');
            
        }
    }
}