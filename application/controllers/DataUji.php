<?php

/**
 * 
 */
class DataUji extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Uji_Model');
		$this->load->model('Training_Model');
		$this->load->library('form_validation');
	}

	function index()
	{

		$data['training'] = $this->Training_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('uji/index', $data);
		$this->load->view('templates/footer');
	}

	public function hapus($id)
	{
		$this->Uji_Model->hapus_data($id);
		$this->session->set_flashdata('flash_uji', 'Dihapus');
		redirect('DataUji');
	}

	public function ubah($id)
	{
		$this->form_validation->set_rules("Gender", "Gender", "required");
		$this->form_validation->set_rules("Age", "Age", "required");
		$this->form_validation->set_rules("AnnualSalary", "AnnualSalary", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Uji_Model->detail_data($id);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('uji/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Uji_Model->ubah_data();
			$this->session->set_flashdata('flash_uji', 'DiUbah');
			redirect('DataUji');
		}
	}

	function hitung()
	{
		$output = "";
		$this->form_validation->set_rules("Gender", "Gender", "required");
		$this->form_validation->set_rules("Age", "Age", "required");
		$this->form_validation->set_rules("AnnualSalary", "AnnualSalary", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Uji_Model->detail_data();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('uji/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$gender = array();
			$age = array();
			$annualsalary = array();
			$jumlah_yes = $this->Training_Model->count_yes();
			$jumlah_no = $this->Training_Model->count_no();
			$total_training = $jumlah_yes + $jumlah_no;
			$gender = $this->Training_Model->gender($this->input->post('Gender'));
			$age = $this->Training_Model->age($this->input->post('Age'));
			$annualsalary = $this->Training_Model->annualsalary($this->input->post('AnnualSalary'));

			//Label
			$output .= "<span style='font-weight:bold;font-size:20px;'>Label</span>";
			$output .= "
			<table id='example1' border='1'>
			<thead>
			<tr>
			<th>Jumlah Data</th>
			<th>Kelas PC1(Yes)</th>
			<th>Kelas PC0(No)</th>
			</tr>
			<tr>
			<td>" . $total_training . "</td>
			<td>" . $jumlah_yes . "</td>
			<td>" . $jumlah_no . "</td>
			</tr>
			</thead>
			</table>
			<br>";

			//Probabilitas Prior
			$PC1 = round($jumlah_yes / ($jumlah_no + $jumlah_yes), 2);
			$PC0 = round($jumlah_no / ($jumlah_no + $jumlah_yes), 2);
			$kelas_yes = round($gender[1], 2) * round($age[1], 2) * round($annualsalary[1], 2) * $PC1;
			$kelas_no = round($gender[0], 2) * round($age[0], 2) * round($annualsalary[0], 2) * $PC0;
			$output .= "<span style='font-weight:bold;font-size:20px;'>Probabilitas Prior</span>";
			$output .= "
			<table id='example1' border='1'>
			<thead>
			<tr>
			<th>Kelas PC1(Yes)</th>
			<th>Kelas PC0(No)</th>
			</tr>
			<tr>
			<td>" . $PC1 . "</td>
			<td>" . $PC0 . "</td>
			</tr>
			</thead>
			</table>
			<br>
			";

			//Probabilitas Data Uji
			$output .= "<span style='font-weight:bold;font-size:20px;'>Probabilitas Data Uji</span>";
			$output .= "
			<table id='example1' border='1'>
			<thead>
			<tr>
			<th> </th>
			<th>Gender</th>
			<th>Age</th>
			<th>AnnualSalary</th>
			<th>Hasil Proba bilitas</th>
			</tr>
			<tr>
			<td>PC1 (Yes)</th>
			<td>" . round($gender[1], 2) . "</td>
			<td>" . round($age[1], 2) . "</td>
			<td>" . round($annualsalary[1], 2) . "</td>
			<td>" . $kelas_yes . "</td>
			</tr>
			<tr>
			<td>PC0 (No)</th>
			<td>" . round($gender[0], 2) . "</td>
			<td>" . round($age[0], 2) . "</td>
			<td>" . round($annualsalary[0], 2) . "</td>
			<td>" . $kelas_no . "</td>
			</tr>
			</thead>
			</table>";

			//Kesimpulan
			$kesimpulan = "";
			if ($kelas_yes >= $kelas_no) {
				$kesimpulan = "Akan Membeli";
			} else {
				$kesimpulan = "Tidak Akan Membeli";
			}
			$output .= "<br>Berdasarkan Data Uji tersebut, dapat diambil kesimpulan bahwa orang tersebut <b><u>" . $kesimpulan . "</u></b> mobil yang ditawarkan.";

			//Simpan Data Uji
			$this->session->set_flashdata('flash_uji', 'dihitung');
			$this->session->set_flashdata('flash_hitung', $output);

			//Tampil Data Uji
			echo $output;
		}
	}
}
