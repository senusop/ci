<?php if(!defined('BASEPATH')) exit('akses langsung tidak diijinkan');

class Primary_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
	public function getAll($table,$desc)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($desc,'desc');
		return $this->db->get()->result();
	}
	
	public function getData($table,$where,$data,$id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where,$data);
		$this->db->order_by($id,'desc');
		return $this->db->get()->result();

	}
	public function getDataBy($table,$data)
	{
		return $this->db->get_where($table,$data)->result();
	}
	
	public function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	public function updateData($id,$IDdata,$table,$data)
	{
		$this->db->where($id,$IDdata);
		$this->db->update($table,$data);
	}
	
	public function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	public function countdata($table)
	{
		return $this->db->get($table)->num_rows();
	}
}