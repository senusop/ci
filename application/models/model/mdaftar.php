<?php if(!defined('BASEPATH')) exit('tidak boleh akses langsung');

class Mdaftar extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function cekData($data)
	{
		$hasil = $this->db->get_where('tb_user',$data);
		if($hasil->num_rows() == 1)
		{
			return $hasil->result();
			
		}else
		{
			echo 0;
		}
	}
	
}