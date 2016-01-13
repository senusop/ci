<?php if(!defined('BASEPATH')) exit('akses langsung tidak diijinkan');

class Daftar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->helper('array');
		$this->load->model('model/mdaftar');
		$this->load->model('model/primary_model');
		$this->load->library(array('session','form_validation'));
	}
	
	public function index()
	{
		$data['judul'] = "mendaftar";

			//content
			$this->load->view('daftar_member',$data);
		
	}
	
	public function next()
	{
		$data_session=array(
			'username' => $this->session->userdata('ses_username'),
			'email' => $this->session->userdata('ses_email'),
		);
			
			
		$result = $this->primary_model->getDataBy('tb_user',$data_session);
		foreach($result as $row)
		{
			$data = array(
			'judul' => " avatar",
			'Nama' => $row->nama,
			'User' => $this->session->userdata('ses_username'),
			'Password' => $row->password,
			'Email' => $this->session->userdata('ses_email'),
			'Level' => $row->level,
			'directory' => $row->path,
			'Avatar' => $row->avatar,
			
			);
			
		}
			
			$this->load->view('upload_avatar',$data);
	
	}
	public function cekdata()
	{
		$data=array(
			'email' => $this->input->post('email'),
			
		);
		
		$result=$this->mdaftar->cekData($data);
		
		if($result)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
		
	}
	public function cekdatausername()
	{
		$data=array(
			'username' => $this->input->post('username'),
			
		);
		
		$result=$this->mdaftar->cekData($data);
		
		if($result)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
		
	}
	
	public function add()
	{
		
		
			$data = array(
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'level' => 'member',
				'dateRegister' => date('Y-m-d'),
				'path' => 'users/'.$this->input->post('username').'/img/thumb',
				'avatar' => $this->input->post('avatar'),
				'on' => '0'
				
			);
			$sesion = array(
				'ses_email' => $this->input->post('email'),
				'ses_username' => $this->input->post('username'),
			);
			$this->session->set_userdata($sesion);
			$uname = $this->input->post('username');
			
			$path ='./users/'.$uname;
				if(!is_dir($path))
				{
					mkdir($path, 0755, TRUE);
				}
			$this->primary_model->insertData('tb_user',$data);
		
	}
	public function update()
	{
		$nmfile = time();
		$uname =$this->input->post('username');
		$path ='./users/'.$uname.'/img/';
		$path_tumb=$path.'temp';
		$config['upload_path'] = $path;
		
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['max_size'] = 1024;
		
		$config['file_name'] = $nmfile;
		
		$this->load->library('upload',$config);
		if(!is_dir($path_tumb))
			{
				mkdir($path_tumb, 0755, TRUE);
			}
		
		if($this->upload->do_upload())
		{
			
				
			$datas = $this->upload->data();
			
			$file = $datas['file_name'];
			
			$email = $this->input->post('email');
			$conf['image_library'] = 'gd2';
			$conf['source_image'] = $path.$file;
			$conf['new_image'] = $path."temp/".$file;
			$conf['create_thumb'] = false;
			$conf['maintain_ratio'] = TRUE;
			$conf['width'] = 500;
			$conf['height'] = 500;
			$conf['quality'] = "100%";
		
			$this->load->library('image_lib', $conf); //initialize resize gambar

			$this->image_lib->resize(); //resize gambar
			$remove_img = $path.$file;
		    unlink($remove_img);
			$data= array(
			'avatar' => $file,
			'path' => $path_tumb,
			);			
			$this->load->view('crop',$data);
		}else{
			echo $this->upload->display_errors();
		}
	}
	public function update_avatar()
	{
		$avatar = $this->input->post('filter');
		$email =$this->input->post('email');
		
		$data_avatar=array(
			'avatar_id' => $avatar,
		);
		$data_email = array(
			'email' => $email,
		);
		
		$avatar_id = $this->primary_model->getDataBy('avatar',$data_avatar);
		$mail = $this->primary_model->getDataBy('tb_user',$data_email);
		
		foreach($avatar_id as $row_avatar)
		{
			$data=array(
				'avatar' => $row_avatar->avatar,
				'path' => $row_avatar->path,
			);
			
		}
		foreach($mail as $row_mail)
		{
			$fix_mail = $row_mail->email;
		}
		$this->primary_model->updateData('email',$fix_mail,'tb_user',$data);
		echo 1;
	}

	public function avatar()
	{
		
		$data=array(
			'dataAvatar' => $this->primary_model->getAll('avatar','avatar_id'),

		);
		
		$this->load->view('vavatar',$data);
	
	}
	function crop()
{
   
		
        $X = $this->input->post('x');
        $Y = $this->input->post('y');
        $W = $this->input->post('w');
        $H = $this->input->post('h');
        $path = $this->input->post('path');
		$avatar = $this->input->post('avatar');
		$uname = $this->input->post('username');
		$email = $this->input->post('email');
		$new_path = './users/'.$uname.'/img/avatar';
		if(!is_dir($new_path))
			{
				mkdir($new_path, 0755, TRUE);
			}
		$source = $path.'/'.$avatar;
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $new_path.'/'.$avatar;
        $config['quality'] = "100%";
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $W;
        $config['height'] = $H;
        $config['x_axis'] = $X;
        $config['y_axis'] = $Y;
 
        
        $this->load->library('image_lib', $config);
 
        if (!$this->image_lib->crop())
        {
            echo $this->image_lib->display_errors();
        }
        else
        {
			unlink($source);
			$data= array(
				'avatar' => $avatar,
				'path' => $new_path,
			);
			$this->primary_model->updateData('email',$email,'tb_user',$data);
            redirect("daftar/next");
        }
    
}

	
}

/* end of file csignin.php */
/* location application/controllers/admin/csignin.php */