<?php
if($this->session->userdata('username') && $this->session->userdata('password'))
        {
            redirect('home');
        }
	$this->load->view('header');
		?>

<body class="bg-dark" onload="cekdata()">
 <script type="text/javascript">
			
				function cekdata(){
			//deklarasi variable
				var validNama = false;
				var validEmail = false;
				var validUser = false;
				var validPass = false;
				var validPass2 = false;
				var emailtrue=/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
	
				$("#formdaftar").submit(function(e){
						e.preventDefault();
						
							if(validNama == true && validEmail == true && validUser == true && validPass == true && validPass2 == true){
								$.ajax({
									type :"POST",
									url : "<?php echo base_url('daftar/add');?>",
									data : $(this).serialize(),
									success:function(){
										
										window.location.href="<?php echo base_url('daftar/next');?>";
										
									},
									error:function(xhr,teksStatus,err)
									{
										$(".text").html(err);
									},
									beforeSend : function(){
										$("#daftar").addClass("disabled");
										$(".text").html("memproses..");
									}
								});
							
							}
						
						else{
							if ($("#nama").val() ==''){
							$("#notif").removeClass('hidden');
							$(".notif").html("Nama Tidak Boleh kosong");
							}
						else if ($("#email").val() ==''){
							$("#notif").removeClass('hidden');
							$(".notif").html("Email Tidak Boleh kosong");
							}
						
						else if ($("#username").val() ==''){
							$("#notif").removeClass('hidden');
							$(".notif").html("Username Tidak Boleh kosong");
							}
						else if ($("#password").val() ==''){
							$(".notif").html("Password Tidak Boleh kosong");
							}
						else if ($("#password2").val() ==''){
							$("#notif").removeClass('hidden');
							$(".notif").html("Ketik Ulang Password");
							}
						}
	
				});
				
	
					//cek inputan nama
				$(".nama").on('blur',function(){
					
					if($(".nama").val() =='')
						{
							
						$("#notif").removeClass('hidden');
						$(".notif").html("Nama Tidak Boleh Kosong");
						}
					else if($(".nama").val().length < 3)
						{
							
							$("#notif").removeClass('hidden');
							$(".notif").html("Nama Minimal 3 karakter");
						}
					else{
						$("#notif").addClass('hidden');
						validNama = true;
					}
					
				});
				
					//cek inputan email
				$(".email").on('blur',function(){
					var email =$(".email").val();
					if($(".email").val() =='')
						{
						$("#notif").removeClass('hidden');
						$(".notif").html("Email Tidak Boleh Kosong");
							
						}
					else if(!email.match(emailtrue))
						{
							$("#notif").removeClass('hidden');
							$(".notif").html("Email Tidak Valid");
						}
					else{
						var mail =$(".email").val();
						var alamat ="<?php echo base_url('daftar/cekdata');?>";
						$(".check").removeClass('hidden');
						$.post(alamat,{email:mail}, function(data){
						
							var emailOK =data;
							if(emailOK ==1)
							{
								$(".notif").html("sudah ada");
								$("#notif").removeClass('hidden');
								$(".check").addClass('hidden');
							}
							else
							{
								$("#notif").addClass('hidden');
						
								$(".check").addClass('hidden');
								validEmail = true;
								
								
							}
					});
					}
					
				});
				
				
				//cek inputan username
				$(".username").on('blur',function(){
					
					if($(".username").val() =='')
						{
							$("#notif").removeClass('hidden');
							$(".notif").html("Username Tidak Boleh Kosong");
							
						}
					else if($(".username").val().length < 5)
						{
							$("#notif").removeClass('hidden');
							$(".notif").html("Username minimal 5 karakter");
						}
					else{
						var user =$(".username").val();
						$(".check2").removeClass('hidden');
						var alamat ="<?php echo base_url('daftar/cekdatausername');?>";
						
						$.post(alamat,{username:user}, function(data){
						
							var userOK =data;
							if(userOK ==1)
							{
								$(".notif").html("sudah ada");
								$("#notif").removeClass('hidden');
								$(".check2").addClass('hidden');
								
							}
							else
							{
								$("#notif").addClass('hidden');
								$(".check2").addClass('hidden');
								validUser = true;
								
								
							}
					});
					}
					
				});
				
				//cek inputan password
				$(".password").on('blur',function(){
					
					if($(".password").val() =='')
						{
							
							$("#notif").removeClass('hidden');
							$(".notif").html("Password Tidak Boleh Kosong");
						}
					else if($(".password").val().length < 8)
						{
							
							$("#notif").removeClass('hidden');
							$(".notif").html("Password minimal 8 karakter");
						}
					else{
						$("#notif").addClass('hidden');
						validPass = true;
					}
					
				});
			//cek inputan password2
				$(".password2").on('blur',function(){
					
					if($(".password2").val() =='')
						{
							
							$("#notif").removeClass('hidden');
							$(".notif").html("Password Tidak Boleh Kosong");
						}
					else if($(".password2").val().length < 8)
						{
							
							$("#notif").removeClass('hidden');
							$(".notif").html("Password minimal 8 karakter");
						}
					else if($(".password2").val() != $("#password").val())
						{
							
							$("#notif").removeClass('hidden');
							$(".notif").html("Password tidak sama");
						}
					else{
						$("#notif").addClass('hidden');
						validPass2 = true;
					}
					
				});
				
	//end function cek data
		}

		</script>
    <div class="container ">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
					<?php
		
						$atr=array(
						'class' => 'formdaftar',
						'id' => 'formdaftar',
						);
						echo form_open('daftar/add',$atr);?>
                <div class="login-panel panel panel-default">
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Daftar Member</span>
						</div>
						<div class="form-group hidden" id="notif">
							 <div class="alert alert-danger alert-dismissable">
								<i class="fa fa-bell"></i> <span class="notif"></span>
                            </div>
						</div>
					</div>
				   <div class="panel-body">
                       
                            <fieldset>
                                <div class="form-group">
                                     <input type="text" autofocus placeholder="Nama Anda" name="nama" id="nama" class="nama required form-control" autofocus>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="text" placeholder="Email" name="email" id="email" class="email required form-control">
									<span class="check fa-spin hidden form-control-feedback glyphicon glyphicon-hourglass "></span>
							   </div>
								<div class="form-group has-feedback">
                                    <input type="text" placeholder="Username" name="username" id="username" class="username required form-control">
									<span class="check2 fa-spin hidden form-control-feedback glyphicon glyphicon-hourglass "></span>
								</div>
								<div class="form-group">
                                     <input type="password" placeholder="Password" id="password" name="password" class="password form-control">
                                </div>
								<div class="form-group">
                                     <input type="password" placeholder="Ketik Ulang" id="password2" name="password2" class="password2 form-control no-border">
									<input type="hidden" name="avatar" value=0 />
								</div>
                               
                            </fieldset>
                       
                    </div>
                    <div class="panel-footer">
                     <div class="row">
						
						<div class="col-lg-6">
							<a href="<?php echo base_url('');?>" class=" btn btn-block btn-default" >Masuk</a>
						</div>
						<div class="col-lg-6">
							
							<button type="submit" id="daftar" onsubmit="daftar()" class="btn btn-block btn-info" ><span class="text">Daftar</span></button>
						</div>
					 </div>
                    </div>
                </div>
                 </form>
            </div>
        </div>
    </div>
   
</body>

</html>
