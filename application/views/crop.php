
<script type="text/javascript">

                
                     $('#cropimage').Jcrop({
					  aspectRatio: 1,
					  minSize: [ 0, 0 ],
					  maxSize: [ 0, 0 ],
					  onSelect: updateCoords

                  });

                  function updateCoords(c)
                  {
                    $('#x').val(c.x);
                    $('#y').val(c.y);
                    $('#w').val(c.w);
                    $('#h').val(c.h);
                  };

                  function checkCoords()
                  {
                    if (parseInt($('#w').val())) return true;
                    alert('Crop terlebih dahulu gambar anda!');
                    return false;
                  };

                </script>

			<div class="col-lg-12">
				<div class="thumbnail">
				<img src="<?php echo base_url().$path.'/'.$avatar;?>"  id="cropimage"/>
				</div>
			</div>
<form action="<?php echo base_url('daftar/crop');?>" accept-charset="utf-8" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="hidden" value="<?php echo $path;?>" name="path" />
			<input type="hidden" value="<?php echo $avatar;?>" name="avatar" />
			<input type="hidden" value="<?php echo $this->session->userdata('ses_username');?>" name="username" />
			<input type="hidden" value="<?php echo $this->session->userdata('ses_email');?>" name="email" />
			<div class="footer pull-right">
				 <button type="submit" class="btn btn-sm btn-success" ><i class="fa-crop fa"></i> Crop dan Pasang</button>
			</div>
		</form>