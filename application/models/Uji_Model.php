<?php

/**
 * 
 */
class Uji_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('mytable')->result();
	}

	public function tambah_data($kesimpulan)
	{
		$data = array(
			'Gender' => $this->input->post('Gender', true),
			'Age' => $this->input->post('Age', true),
			'AnnualSalary' => $this->input->post('AnnualSalary', true),
			'Purchased' => $kesimpulan
		);
		$this->db->insert('mytable', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'Gender' => $this->input->post('Gender', true),
			'Age' => $this->input->post('Age', true),
			'AnnualSalary' => $this->input->post('AnnualSalary', true),
			'Purchased' => $this->input->post('Purchased', true)
		);
		$this->db->where('User_ID', $this->input->post('User_ID', true));
		$this->db->update('mytable', $data);
	}

	public function hapus_data($id)
	{
		$this->db->delete('mytable', ['User_ID' => $id]);
	}

	public function detail_data($id)
	{
		return $this->db->get_where('mytable', ['User_ID' => $id])->row_array();
	}
}
