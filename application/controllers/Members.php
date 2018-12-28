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