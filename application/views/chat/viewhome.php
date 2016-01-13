<?php
if(!$this->session->userdata('username') && !$this->session->userdata('password'))
        {
            redirect('/');
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<style>
		#pesan{display:none;}
		#kirim{display:none;}
	</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $judul;?></title>
	<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo base_url();?>assets/img/icon.ico" />
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap-theme.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/css/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   <script type="text/javascript">
	
	<?php for($i=0; $i<4; $i++){
		?>
	function auth<?php echo $i;?>()
	{
		var x = $('#captcha').val();
		var data =$('#btn<?php echo $i;?>').val();
		if(x == data)
		{
			alert('icon sama');
			$("#pesan").show();
			$("#kirim").show();
			$(".fieldset").hide();
			
		}else
		{
			alert('icon salah bro..');
			$("#pesan").hide();
			$("#kirim").hide();
		}
		
	}
	<?php
	}
	?>
   </script>

</head>

<body class="bg-dark">
 
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
               <!-- /.panel -->
                    <div class="chat-panel panel panel-info top20">
                        <div class="panel-heading">
                            <i class="fa fa-qrcode fa-fw"></i>
                            Enkripsi Data  
                            <span id="loading"></span>
                            <span id="loading2"></span>
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i> <?php echo $this->session->userdata('username');?>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?php echo base_url('deskripsi');?>">
                                            <i class="fa fa-code fa-fw"></i> Deskrispi
                                        </a>
                                    </li> 
									<li>
                                        <a href="<?php echo base_url('auth/logout');?>">
                                            <i class="fa fa-close fa-fw"></i> Keluar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat" id="list">
                                
                               
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
						<fieldset class="fieldset">
							<legend><i class="fa fa-warning"></i> Pilih icon yang sama untuk mengirim data</legend>
                            	<?php
									$arr = array(
									"fa-anchor","fa-bell","fa-microphone","fa-mortar-board"
										);
									$col = array("btn-success","btn-warning","btn-primary","btn-danger");
										$c = count($arr);
										$b = rand(0,($c-1));
										
									
										
								?>
							<div class="form-group">
								<span class="pull-left">
								 <button id="captcha" value="<?php echo $arr[$b];?>" type="button" class="btn btn-circle btn-default"><i class="fa <?php echo $arr[$b];?> "></i></button>
								</span>
								<span class="left20">
									<?php for($i=0;$i<$c;$i++)
									{
										?>
										<button id="btn<?php echo $i;?>" value="<?php echo $arr[$i];?>" onclick="auth<?php echo $i;?>()" type="button" class="btn <?php echo $col[$i];?> btn-circle"><i class="fa <?php echo $arr[$i];?> "></i> </button>
									<?php
									}
									?>
								</span>
							</div>
						</fieldset>	
							
							
							<div class="input-group">
                                <input name="message" id="pesan" type="text" class="form-control input-sm" placeholder="Ketikan pesan kamu disini.." />
                                <input type="hidden" value="<?php echo $this->session->userdata('username');?>" id="user" />
                                <input type="hidden" value="<?php echo $this->session->userdata('userID');?>" id="id" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-sm" id="kirim">
                                        Enkripsi 
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
						
                    </div>
                    <!-- /.panel .chat-panel -->
					
            </div>
        </div>
		
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/js/jquery2.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/js/metisMenu.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/sb-admin-2.js"></script>

</body>
<script>    
        $(document).ready(function(){
        
        function tampildata(){
           $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/ambil_pesan');?>",  
             beforeSend: function() {
                // setting a timeout
                $('#loading2').html('<i class="fa fa-spin fa-circle-o-notch"></i> menuat pesan...');
            },     
            success: function(data){                 
                     $('#list').html(data);
                     $("#loading2").hide();
            }  
           });
        }
	
         $('#kirim').click(function(){
           var pesan = $('#pesan').val(); 
           var user = $('#user').val(); 
		   var id =$("#id").val();
           $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kirim_chat');?>",    
            data: 'pesan=' + pesan + '&user=' + user + '&iduser=' + id,    
             beforeSend: function() {
                // setting a timeout
                $('#loading').append('<i class="fa fa-spin fa-circle-o-notch"></i> mengirim...');
            },   
            success: function(data){                 
              $('#list').html(data);
              $('#loading').hide();
            }  
           });
          });
          
          
          setInterval(function(){
            tampildata();});
        });
    </script>
</html>
