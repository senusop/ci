<?php
class Model_chat extends CI_Model
{
	//method return all data chat
	public function showData()
	{
		return $this->db->get('chat');
	}

}