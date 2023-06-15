<?php

/**
 * 
 */
class DataTraining extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Training_Model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data['training'] = $this->Training_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('training/index', $data);
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{
		$this->form_validation->set_rules("Gender", "Gender", "required");
		$this->form_validation->set_rules("Age", "Age", "required");
		$this->form_validation->set_rules("AnnualSalary", "AnnualSalary", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Training_Model->tambah_data();
			$this->session->set_flashdata('flash_training', 'Disimpan');
			redirect('DataTraining');
		}
	}

	public function hapus($id)
	{
		$this->Training_Model->hapus_data($id);
		$this->session->set_flashdata('flash_training', 'Dihapus');
		redirect('DataTraining');
	}

	public function ubah($id)
	{
		$this->form_validation->set_rules("Gender", "Gender", "required");
		$this->form_validation->set_rules("Age", "Age", "required");
		$this->form_validation->set_rules("AnnualSalary", "AnnualSalary", "required");
		$this->form_validation->set_rules("Purchased", "Purchased", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Training_Model->detail_data($id);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('training/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Training_Model->ubah_data();
			$this->session->set_flashdata('flash_training', 'DiUbah');
			redirect('DataTraining');
		}
	}
}
