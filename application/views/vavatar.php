
<script type="text/javascript">
	function avatar()
	{
		var check = false;
				$("#avatar_form").submit(function(e){
						e.preventDefault();
						
							if(check == true){
								$.ajax({
									type : "POST",
									url : "<?php echo base_url('daftar/update_avatar');?>",
									data : $(this).serialize(),
									success:function(msg){
										if(msg == 1)
										{
											$(".load").html("success..");
										setTimeout(function() {
										 location.reload()
										  },500);
										
										}
										else{
											$(".load").html("error..");
										}
									},
									
									beforeSend : function(){
										$("#tombol").addClass("disabled");
										$(".lanjut").hide();
										$(".load").html("loading..").show();
									}
								});
							
							}
							else{
								$(".info").html('<i class="i i-cross2"></i> mohon pilih dulu foto');
							}
	
					});
					$(".check").on('change',function(){
						
							
							$(".info").hide();
							check = true;
						
					});
	}
	
	
</script>
			
				<div class="col-lg-12">
				<div class="panel-heading b-b bg-white"><span class="info"></span></div>
				<?php
					$atr = array(
						'id' =>"avatar_form",
						'class' => "avatar_form",
					);
					echo form_open_multipart('daftar/update_avatar',$atr);
				?>
					  <div class="row row-sm">
					  <?php foreach($dataAvatar as $row)
						{
							$path = $row->path;
							$name = $row->avatar;
							$avatar_id = $row->avatar_id;
							?>
						<div class="col-lg-3 text-center">
						  <div class="thumbnail">
							<a href="#"><img src="<?php echo base_url($path).'/'.$name;?>" alt=""></a>
							<div class="caption">
							  <p class="text-ellipsis m-b-none">
							   <ul class="list-unstyled">
								<li class="radio i-checks">
								  <label>
									<input  onclick="avatar()" class="check" type="radio" value="<?php echo $avatar_id;?>" name="filter"><i></i> <?php echo $row->avatar_name;?>
									<input type="hidden" value="<?php echo $this->session->userdata('ses_email');?>" name="email" />
								  </label>
								</li>
								</ul>
							  </p>
							</div>
						  </div>
						</div>
					  
						<div class="clearfix visible-xs"></div>
						<?php } ?>
					  </div>
					  
                     
                      <button onclick="avatar()" id="tombol" type="submit" class="btn btn-info btn-sm"><span class="lanjut"> Pasang Avatar </span><span class="load"> </button>
                 
                  <?php echo form_close();?>
                </div>

				

