<?php

class Company_model extends CI_model {

	public function getAllCompany()
    {
        return $query = $this->db->get('company')->result_array();
       // return $this->db->get('members')->result_array();
        
    }

    public function hapusDataCompany($id)
    {
        $this->db->delete('company', ['idcompany' => $id]);
    }

    public function tambahDataCompany()
    {
    	$data = [
            "name" => $this->input->post('companyname',true)
        ];
        
        $this->db->insert('company', $data);
    }

    public function getCompanyById($id)
    {
    //    return $this->db->get_where('siswa',['id_siswa' => $id])->row_array();
       

        $this->db->where('idcompany',$id);
        return $query = $this->db->where('idcompany',$id)->get('company')->row_array();
    }

    public function ubahDataCompany($id)
    {
    	$data = [
            "name" => $this->input->post('companyname',true)
        ];
        $this->db->where('idcompany',$this->input->post('idcompany'));
        $this->db->update('company', $data);
    }
}