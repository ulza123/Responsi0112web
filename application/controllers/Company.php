<?php

class Company extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->model('Company_model');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
    	$data['judul'] = 'Halaman Company';
        $data['company'] = $this->Company_model->getAllCompany();
        // if($this->input->post('keyword')){
        //     $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
        // }
        $this->load->view('templates/header',$data);
        $this->load->view('company/index',$data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $this->Company_model->hapusDataCompany($id);
        $this->session->set_flashdata('flash','Dihapus');
        redirect('company');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data company';
        $this->form_validation->set_rules('companyname','company Name','required');
        if($this->form_validation->run() == FALSE ) {

        $this->load->view('templates/header',$data);
        $this->load->view('Company/tambah');
        $this->load->view('templates/footer');

         } else {
           $this->Company_model->tambahDataCompany();
           $this->session->set_flashdata('flash', 'Ditambahkan');
           redirect('company');
            
        }
    }



    public function edit($id)
    {
        
        $data['judul'] = 'Edit Data Company';
        $data['company'] = $this->Company_model->getCompanyById($id);
        $this->form_validation->set_rules('companyname','Company Name','required');

        if($this->form_validation->run() == FALSE ) {

        $this->load->view('templates/header',$data);
        $this->load->view('company/edit',$data);
        $this->load->view('templates/footer');

         } else {
           $this->Company_model->ubahDataCompany($id);
           $this->session->set_flashdata('flash', 'Diubah');
           redirect('company');
            
        }
    }
}