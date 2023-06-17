<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ServerApi extends CI_Controller
{
	// create
	public function addStaff()
	{
		// declare var
		$name = $this->input->post('name');
		$hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');

		// input var 
		$data['staff_name'] = $name;
		$data['staff_hp'] = $hp;
		$data['staff_alamat'] = $alamat;
		$q = $this->db->insert('tb_staff', $data);

		// kondisi sukses / gagal
		if($q)
		{
			$response['pesan']='insert berhasil';
			$response['status']=200;
		} else {
			$response['pesan']='insert gagal';
			$response['status']=404;
		}
		echo json_encode($response);
	}

	// read
	public function getDataStaff()
	{
		// declare var
		$q = $this->db->get('tb_staff');

		// kondisi gagal / berhasil fetch tb
		if($q->num_rows() > 0)
		{
			$response['pesan']='data ada';
			$response['status']=200;

			// 1 row
			$response['staff']=$q->row();
			$response['staff']=$q->result();
		} else {
			$response['pesan']='data tidak ditemukan';
			$response['status']=404;
		}
		echo json_encode($response);
	}

	// update
	public function updateStaff()
	{
		// declare var
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$this->db->where('staff_id', $id);
		
		// input var
		$data['staff_name'] = $name;
		$data['staff_hp']=$hp;
		$data['staff_alamat']=$alamat;
		$q = $this->db->update('tb_staff', $data);

		// kondisi gagal / berhasil
		if($q)
		{
			$response['pesan']='update berhasil';
			$response['status']=200;
		} else {
			$response['pesan']='update gagal';
			$response['status']=404;
		}
		echo json_encode($response);
	}

	// delete
	public function deleteStaff()
	{
		$id = $this->input->post('id');
		$this->db->where('staff_id', $id);
		$status = $this->db->delete('tb_staff');

		// kondisi gagal / berhasil
		if($status == true)
		{
			$response['pesan']='data berhasil dihapus';
			$response['status']=200;
		} else {
			$response['pesan']='hapus data gagal';
			$response['status']=404;
		}

		echo json_encode($response);
	}
}
