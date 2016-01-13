<?php
if($this->session->userdata('username') && $this->session->userdata('password'))
        {
            redirect('home');
        }
	$this->load->view('header');
		?>

<body class="bg-dark">
 
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form role="form" action="<?php echo base_url('auth/action');?>" method="POST">
                   
                <div class="login-panel panel">
				<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Login Area</span>
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
                                <label for="email" class="label2 control-label"><i class='fa fa-user'></i> Username or email</label>
                                    <input class="form-control input-lg" placeholder="" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="label2 control-label"><i class='fa fa-key'></i> Password</label>
                                    <input class="form-control input-lg" placeholder="" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                   <?php 
                                            $message = $this->session->flashdata('message');
                                            if($message)
                                            {
                                                echo "<div class=\"alert alert-danger alert-dismissable\">
                                                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                                        <p><i class=\"fa fa-warning\"></i> $message</p>
                                                    </div>";

                                            }?>
                                </div>

                            </fieldset>
                       
                    </div>
                    <div class="panel-footer">
                     <div class="row">
						<div class="col-lg-6">
							<a href="<?php echo base_url('daftar');?>" class="btn btn-block btn-default" >Mendaftar</a>
						</div>
						<div class="col-lg-6">
							
							<input type="submit" value="Masuk" class="btn btn-block btn-info" />
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
