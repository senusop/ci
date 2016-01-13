<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','captcha'));
		$this->load->model('mlogin');
	}
	
	public function index()
	{
		
		
		$data['judul']="Login Page";
		//sesi captcha
		$text = ucfirst(random_element($this->config->item('captcha_word')));
		$number = random_element($this->config->item('captcha_num'));
		$word =$text.$number;
			$this->load->helper('captcha');
			$vals = array(
				'img_path'	 => './captcha/',
                'img_url'	 => base_url().'captcha/',
                'img_width'	 => '200',
				'font_path' => './system/fonts/texb.TTF',
                'img_height' => 40,
                'border' => 1, 
				'word' => $word,
                'expiration' => 7200,
			);
			
			//create captcha image
			$cap = create_captcha($vals);
			//store image html code in a variabel
			$data['captcha'] = $cap['image'];
			//store the captcha word in a session
			$this->session->set_userdata('mycaptcha', $cap['word']);
		//end captcha
		$this->load->view('login',$data);
		
	}
	
	public function finish()
	{
		
		$this->session->unset_userdata('ses_username');
        $this->session->unset_userdata('ses_email');
		
		redirect("/");
		
	}
	//METHOD ACTION
	public function action()
	{
		
		$data=array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
		);
		
		$result=$this->mlogin->cek_data($data);
		if($result){
			foreach($result as $row)
			{
			
				if($this->input->post('login-code') == $this->session->userdata('mycaptcha'))
				{
					$sesArray = array();
					$sessArray = array(
						'userID' => $row->id_user,
						'username' => $row->username,
						'password' => $row->password,
						'nama' => $row->nama,
						'email' => $row->email,
						'level' => $row->level,
						'path' => $row->path,
						'avatar' => $row->avatar,
						 
					);
					//create session
						$this->session->set_userdata($sessArray);
						
							redirect('home');
				}	
					elseif($this->input->post('login-code') != $this->session->userdata('mycaptcha'))
					{
						$this->session->set_flashdata('message',' Kode Salah');
						redirect('login');
					}

			}
		}else
		{
			$this->session->set_flashdata('message',' username dan password salah');
			redirect('/');
		}
		
	}
	
	//METHOD LOGOUT
		function logout()
		{
			
			$this->session->unset_userdata('userID');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('password');
			
		 
			redirect('auth');
		}

}

/* End of file login.php */
/* Location : ./application/modules/login/controllers/login.php */