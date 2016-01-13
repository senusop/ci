<?php 
	if(!$User && !$Email)
	{
		redirect('daftar');
	}
	$this->load->view("header");
?>

<body class="bg-dark" onload="upload()">
<script type="text/javascript">
	function loadpage()
	{
		$.ajax({
		//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
		url	     : '<?php echo base_url('daftar/avatar');?>',
		type     : 'POST',
		dataType : 'html',
		data     : 'avatar',
		success  : function(data){
			$('#loadAvatar').html(data);
			$('.loading').hide();
		},
		beforeSend : function(){
			$('.loading').html("<i class='i  i-spinner  fa-spin'> </i>");
		}
			
	});
	}
	function upload()
	{
		
	var file = false;
				$("#formUpload").submit(function(e){
					
						e.preventDefault();
						
							if(file == true){
								$.ajax({
									type : "POST",
									dataType:"html",
									url : "<?php echo base_url('daftar/update');?>",
									data : new FormData(this),
									contentType : false,
									cache : false,
									processData : false,
									success:function(data){
											
											$(".textupload").html("success..");
											$(".starCrop").html(data);
											$(".crop").hide();
											$(".disabled").removeClass('disabled');
											$(".textupload").html('upload');
											$(".wrap-cropbox").hide();
											$(".formUpload")[0].reset();
											file=false;
											$("#info2").html('').show();
									
								
									},
									
									beforeSend : function(){
										$(".button").addClass("disabled");
										
										$(".textupload").html("loading..").show();
									}
								});
							
							}
							else{
								$("#info2").html('<i class="i i-cross2"></i> mohon pilih dulu foto');
							}
	
					});
					$(".file").on('change',function(){
						
							if($(".file").val() !='')
							{
								$("#info2").hide();
								file = true;
								
								$(".wrap-cropbox").addClass("thumbnail2 blur");
								
							}else{
								file = false;
							}
							
					});
					
					
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
							<span class="panel-title">Sunting Avatar</span>
						</div>
						<div class="form-group hidden" id="notif">
							 <div class="alert alert-danger alert-dismissable">
								<i class="fa fa-bell"></i> <span class="notif"></span>
                            </div>
						</div>
					</div>
					<?php 
							if($Avatar =='0')
							{
								$avatar =base_url('images/user.png');
							}
							else{
							
							$avatar = base_url($directory.'/'.$Avatar);
							}
					?>
				   <div class="panel-body">
                       
                            <fieldset>
								<center>
									<div class="thumb-lg">
										<img width="150px" src="<?php echo $avatar;?>" class="img-circle  b-a b-3x ">
									</div>
									<div class="h4 m-t m-b-xs"><?php echo $Nama;?></div>
									<small class="text-muted m-b"><?php echo $Email;?></small>
								</center>
                            </fieldset>
                       
                    </div>
                    <div class="panel-footer">
                     <div class="row">
						 <div class="col-lg-6">
							<a href="#gambar" onclick="loadpage()" data-toggle="modal" class="btn btn-block btn-md btn-default"><i class="i i-images"></i> Gambar</a>
                        </div>
						<div class="col-lg-6">
							<a href="<?php echo base_url('auth/finish');?>" class="btn btn-block btn-md btn-info"> Selesai</a>
                        </div>
					 </div>
                    </div>
                </div>
                 </form>
            </div>
        </div>
    </div>
 
  <div class="modal fade" id="gambar">
    <div class="modal-dialog">
      <div class="modal-content2">
        <div class="modal-body2 wrapper-lg">
            <div class="panel-group m-b " id="accordion2">
                  
					
					<div class="panel bg-white2 panel-default">
                      <div class="panel-heading ">
                        
						 <a  data-dismiss="modal" class="anchor accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
							<span class="a"><i class="i i-cross2"></i> Kembali</span>
                        </a>	
                      </div>
                     
                    </div>
					<div class="panel bg-white2 panel-default">
                      <div class="panel-heading">
                        <a  class="anchor accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
							<span class="a"><i class="i i-images"></i> Gambar Dari System</span>
                        </a>
                      </div>
                      <div id="collapseOne" class="panel-collapse in">
						<div class="panel-body text-sm">
							<div id="loadAvatar">
							<span class="loading"></span>
							
							</div>
							
						</div>
                      </div>
                    </div>
                    <div class="panel panel-default">
					 <div class="panel-heading">
                        <a  class="anchor accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                          <span class="a"> <i class="i i-laptop "></i> Gambar Dari Komputer</span>
                        </a>
                      </div>
                     <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
							<?php 
								$atr =array(
									'id' => 'formUpload',
									'class' => 'formUpload',
								);
								echo form_open_multipart("daftar/upload",$atr);?>
								<div class="header head">
                          		<div class="btn btn-sm btn-default btn-file">
								 <i class="fa fa-folder-open"></i> Browser
								 
									<input type="file" name="userfile" class="file"  onchange="$('.crop')[0].src = window.URL.createObjectURL(this.files[0])" />
									<input type="hidden" value="<?php echo $Email;?>" name="email" />
									<input type="hidden" value="<?php echo $User;?>" name="username" />
									
								</div>
								<button class="button btn btn-info btn-sm" type="submit"> <i class="i i-upload2 "></i>
									<span class="textupload">Upload Gambar</span>
								</button> 
								<span id="info2"></span>
								</div>
								<div class="wrap-cropbox">
									<img class="crop" width="50"/>
									
								</div>
								
							<?php echo form_close();?>
							
							<div class="starCrop"></div>
							
                        </div>
                      </div>
					 
                      
                    </div>
                   
             </div>   
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  