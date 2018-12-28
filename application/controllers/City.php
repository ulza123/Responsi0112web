<?php

class City extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->model('City_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
    	$data['judul'] = 'Halaman City';
        $data['city'] = $this->City_model->getAllCity();
        // if($this->input->post('keyword')){
        //     $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
        // }
        $this->load->view('templates/header',$data);
        $this->load->view('city/index');
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $this->City_model->hapusDataCity($id);
        $this->session->set_flashdata('flash','Dihapus');
        redirect('city');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data City';
        $this->form_validation->set_rules('cityname','City Name','required');
        $this->form_validation->set_rules('country','Country','required');
        if($this->form_validation->run() == FALSE ) {

        $this->load->view('templates/header',$data);
        $this->load->view('city/tambah');
        $this->load->view('templates/footer');

         } else {
           $this->City_model->tambahDataCity();
           $this->session->set_flashdata('flash', 'Ditambahkan');
           redirect('city');
            
        }
    }
    public function edit($id)
    {
        
        $data['judul'] = 'Edit Data City';
        $data['city'] = $this->City_model->getCityById($id);
        $this->form_validation->set_rules('cityname','City Name','required');
        $this->form_validation->set_rules('country','Country','required');
        if($this->form_validation->run() == FALSE ) {

        $this->load->view('templates/header',$data);
        $this->load->view('city/edit',$data);
        $this->load->view('templates/footer');

         } else {
           $this->City_model->ubahDataCity($id);
           $this->session->set_flashdata('flash', 'Diubah');
           redirect('city');
            
        }
    }

}