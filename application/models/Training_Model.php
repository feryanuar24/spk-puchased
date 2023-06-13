<?php 

/**
 * 
 */
class Training_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('tbl_training')->result();
	}

	public function tambah_data( )
	{
		// $jumlah_penghasilan = $this->input->post('jml_penghasilan', true);

		// if ($jumlah_penghasilan > 2500000) {
		// 	$kat = "tinggi";
		// }else if($jumlah_penghasilan >= 1500000 && $jumlah_penghasilan <= 2500000){
		// 	$kat = "sedang";
		// }else if($jumlah_penghasilan < 1500000){
		// 	$kat = "rendah";
		// }

		$data = array(
			// 'id_training' => $this->input->post('id_training', true),
			'nama' => $this->input->post('nama', true),
			'kepala_rt' => $this->input->post('kepala_rt', true),
			'jml_penghasilan' => $this->input->post('jml_penghasilan', true),
			'status_kelayakan' => $this->input->post('status_kelayakan', true)
		);

		$this->db->insert('tbl_training', $data);
	}

	public function ubah_data( )
	{
		$data = array(
			'nama' => $this->input->post('nama', true),
			'kepala_rt' => $this->input->post('kepala_rt', true),
			'jml_penghasilan' => $this->input->post('jml_penghasilan', true),
			'status_kelayakan' => $this->input->post('status_kelayakan', true)
		);
		$this->db->where('id_training', $this->input->post('id_training', true));
		$this->db->update('tbl_training', $data);
	}

	public function hapus_data($id)
	{
		$this->db->delete('tbl_training', ['id_training' => $id]);
	}

	public function detail_data($id)
	{
		return $this->db->get_where('tbl_training', ['id_training' => $id]) ->row_array(); 
	}

	public function count_layak()
	{
		$this->db->where('status_kelayakan', 'Layak');
		$this->db->from('tbl_training');
		return $this->db->count_all_results();
	}

	public function count_tidaklayak()
	{
		$this->db->where('status_kelayakan', 'Tidak Layak');
		$this->db->from('tbl_training');
		return $this->db->count_all_results();
	}

	public function kepala_rt($status)
	{
		// $status = "Laki-laki";
		$this->db->where('kepala_rt', $status);
		$this->db->where('status_kelayakan', "Layak");
		$this->db->from('tbl_training');
		$layak = $this->db->count_all_results()/$this->count_layak();	
		$this->db->where('kepala_rt', $status);
		$this->db->where('status_kelayakan', "Tidak Layak");
		$this->db->from('tbl_training');
		$tidak = $this->db->count_all_results()/$this->count_tidaklayak();
		return array('layak' => $layak, 'tidaklayak' => $tidak);	
	}

	public function jml_penghasilan($status)
	{	
		$kat ="";
		if ($status > 2500000) {
			$kat = "tinggi";
		}else if($status >= 1500000 && $status <= 2500000){
			$kat = "sedang";
		}else if($status < 1500000){
			$kat = "rendah";
		}
		$q_layak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT jml_penghasilan,  status_kelayakan,
			CASE
			WHEN jml_penghasilan > 2500000 THEN 'tinggi'
			WHEN jml_penghasilan >= 1500000 AND jml_penghasilan <= 2500000 THEN 'sedang'
			WHEN jml_penghasilan < 1500000 THEN 'rendah'
			ELSE ''
			END AS c_jml_penghasilan
			FROM tbl_training 
			) as conversi_jml_penghasilan  WHERE c_jml_penghasilan ='$kat' AND status_kelayakan = 'layak'
			")->row();
		$layak = $q_layak->jml/$this->count_layak();
		$q_tidak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT jml_penghasilan,  status_kelayakan,
			CASE
			WHEN jml_penghasilan > 2500000 THEN 'tinggi'
			WHEN jml_penghasilan >= 1500000 AND jml_penghasilan <= 2500000 THEN 'sedang'
			WHEN jml_penghasilan < 1500000 THEN 'rendah'
			ELSE ''
			END AS c_jml_penghasilan
			FROM tbl_training 
			) as conversi_jml_penghasilan  WHERE c_jml_penghasilan ='$kat' AND status_kelayakan = 'tidak layak'
			")->row();
		$tidak = $q_tidak->jml/$this->count_tidaklayak();

		return array('layak' => $layak, 'tidaklayak' => $tidak);	
	}





}
