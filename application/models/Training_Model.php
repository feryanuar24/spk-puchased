<?php

/**
 * 
 */
class Training_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('mytable')->result();
	}

	public function tambah_data()
	{
		$data = array(
			'Gender' => $this->input->post('Gender', true),
			'Age' => $this->input->post('Age', true),
			'AnnualSalary' => $this->input->post('AnnualSalary', true),
			'Purchased' => $this->input->post('Purchased', true)
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

	public function count_yes()
	{
		$this->db->where('Purchased', 1);
		$this->db->from('mytable');
		return $this->db->count_all_results();
	}

	public function count_no()
	{
		$this->db->where('Purchased', 0);
		$this->db->from('mytable');
		return $this->db->count_all_results();
	}

	public function Gender($status)
	{
		$this->db->where('Gender', $status);
		$this->db->where('Purchased', 1);
		$this->db->from('mytable');
		$yes = $this->db->count_all_results() / $this->count_yes();
		$this->db->where('Gender', $status);
		$this->db->where('Purchased', 0);
		$this->db->from('mytable');
		$no = $this->db->count_all_results() / $this->count_no();
		return array(1 => $yes, 0 => $no);
	}

	public function Age($status)
	{
		$this->db->where('Age', $status);
		$this->db->where('Purchased', 1);
		$this->db->from('mytable');
		$yes = $this->db->count_all_results() / $this->count_yes();
		$this->db->where('Age', $status);
		$this->db->where('Purchased', 0);
		$this->db->from('mytable');
		$no = $this->db->count_all_results() / $this->count_no();
		return array(1 => $yes, 0 => $no);
	}

	public function AnnualSalary($status)
	{
		$kat = "";
		if ($status > 125625) {
			$kat = "tinggi";
		} else if ($status >= 83750 && $status <= 125625) {
			$kat = "sedang";
		} else if ($status < 83750) {
			$kat = "rendah";
		}
		$q_yes = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT AnnualSalary,  Purchased,
			CASE
			WHEN AnnualSalary > 125625 THEN 'tinggi'
			WHEN AnnualSalary >= 83750 AND AnnualSalary <= 125625 THEN 'sedang'
			WHEN AnnualSalary < 83750 THEN 'rendah'
			ELSE ''
			END AS c_AnnualSalary
			FROM mytable 
			) as conversi_AnnualSalary  WHERE c_AnnualSalary ='$kat' AND Purchased = 1
			")->row();
		$yes = $q_yes->jml / $this->count_yes();
		$q_no = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT AnnualSalary,  Purchased,
			CASE
			WHEN AnnualSalary > 125625 THEN 'tinggi'
			WHEN AnnualSalary >= 83750 AND AnnualSalary <= 125625 THEN 'sedang'
			WHEN AnnualSalary < 83750 THEN 'rendah'
			ELSE ''
			END AS c_AnnualSalary
			FROM mytable 
			) as conversi_AnnualSalary  WHERE c_AnnualSalary ='$kat' AND Purchased = 0
			")->row();
		$no = $q_no->jml / $this->count_no();
		return array(1 => $yes, 0 => $no);
	}
}
