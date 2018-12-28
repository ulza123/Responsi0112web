<?php

class Members_model extends CI_model {

	public function getAllMembers()
    {
    	$this->db->select('*');
        $this->db->from('members');
        $this->db->join('company', 'company.idcompany = members.idcompany');
        $this->db->join('city', 'city.idcity = members.idcity');
        return $query = $this->db->get()->result_array();
       // return $this->db->get('members')->result_array();
        
    }

    public function getMembersById($id)
    {
    //    return $this->db->get_where('siswa',['id_siswa' => $id])->row_array();
       
    	$this->db->select('*');
    	$this->db->where('id',$id);
        $this->db->from('members');
        $this->db->join('company', 'company.idcompany = members.idcompany');
        $this->db->join('city', 'city.idcity = members.idcity');
      	return $query = $this->db->get()->row_array();
    }



    public function hapusDataMembers($id)
    {
        // $this->db->where('id_siswa', $id);
        $this->db->delete('members', ['id' => $id]);
    }

    public function getAllCompany()
    {
        return $this->db->get('company')->result_array();
    }
    public function getAllCity()
    {
        return $this->db->get('city')->result_array();
    }
    
    public function tambahDataMembers()
    {  
    $file = $_FILES;
    $namaFile = $_FILES['foto']['name'];
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	$namaFileBaru = uniqid();
	// $namaFileBaru .= '.';
	// $namaFileBaru .= $ekstensiGambar;

    	if(!empty($file)){
    		$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['file_name']			= $namaFileBaru;
            $this->load->library('upload', $config);
            if ( !$this->upload->do_upload('foto')){
            	$data['error'] = $this->upload->display_errors();	
            }else{
            	$newfile = $this->upload->data();
            	$handle = fopen($config['upload_path'].$newfile['file_name'], "r");
            	fclose($handle);
            }
            $foto = $config['upload_path'].$config['file_name'].$config['allowed_types'];

          
		 $namaFile = $config['file_name'] . '.' . $ekstensiGambar;
        $data = [
            "fullname" => $this->input->post('fullname',true),
            "email" => $this->input->post('email',true),
            "address" => $this->input->post('address',true),
            "foto" => $namaFile,
            "idcompany" => $this->input->post('company',true),
            "idcity" => $this->input->post('city',true)
        ];
        
        $this->db->insert('members', $data);

    }

}

    public function editDataMembers($id)
    {  
    	//cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4) {
		$foto = $this->input->post('fotoLama');
	} else {
    
        $data = [
            "fullname" => $this->input->post('fullname',true),
            "email" => $this->input->post('email',true),
            "address" => $this->input->post('address',true),
            // "foto" => $foto,
            "idcompany" => $this->input->post('company',true),
            "idcity" => $this->input->post('city',true)
        ];
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('members', $data);

    }


}

    public function add($post)
    {
        $data = $this->db->insert('members', $post);
        if($data){
            $msg = "Input data member berhasil";
            return array('sts'=>true, 'msg'=>$msg);
        }else{
            $msg = $this->db->error();
            return array('sts'=>false, 'msg'=>$msg);
        }
    }

}

