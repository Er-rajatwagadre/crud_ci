
<?php 
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
if(empty($_SESSION['is_login'])){
?>
<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="We develop creative software, eye catching software. We also train to become a creative thinker">
        <link rel="icon" href="<?php echo base_url(); ?>optimum/logo-circle.png" type="image/x-icon" />
        <title><?php echo $system_name; ?></title>
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>optimum/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
<!-- animation CSS -->
<link href="<?php echo base_url(); ?>optimum/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>optimum/css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="<?php echo base_url(); ?>optimum/css/colors/megna.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body onload="showPosition();">
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register"> 
  <div class="login-box login-sidebar">
    <div class="white-box" style="border:30px solid #0bc1cf; border-radius:60px;"> 
			<script>
				$(document).ready(function(){
					
						$('input').attr('readonly', false);
				});
			</script>
	
               <div align="center"> 
			   
				<img  width="100" height="100" src="<?php echo base_url(); ?>optimum/logo-circle.png">
                    <br><br>
					Welcome to<br> <strong style="color:#0BC1CF">PRAADIS SALES CRM</strong>. 
                <div align="center">
                       <?php if (isset($page) && $page == "logout"): ?>
                    <div class="alert alert-success hide_msg pull" style="width:100%"> <i class="fa fa-check-circle"></i> Logout Successfully &nbsp;
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
               	 	<?php endif ?>
					<?php $msg = $this->session->flashdata('msg'); ?>
				 <?php if (isset($msg)): ?>	
					<div class="alert alert-danger hide_msg pull" style="width:100%"> <i class="fa fa-check-circle"></i> <?php echo $msg;  ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
				<?php endif ?>	
                    </div>
		<br><br>
					<form class="form-horizontal form-material" id="login-form" action="<?php echo base_url('auth/log'); ?>" method="post"> 

					<div class="form-group">
                                   
                          <div class="col-xs-12">
                            <input class="form-control" type="email" name="user_name" value="" required="" placeholder="Email Address" style="width:100%">
                          </div>
                     </div>
					<div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" value="" required="" placeholder="Password" style="width:100%">
                        </div>
                    </div>
                   
					<input type="hidden" id="result" name="ip_location" >
	 <!-- CSRF token -->
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
		  
<button class="btn btn-info style1 btn-lg btn-block text-uppercase waves-effect waves-light"  type="submit" style="width:100%; color:white">
Login
</button>
<div align="center"><img id="install_progress" src="<?php echo base_url() ?>optimum/images/loading.gif" style="margin-left: 20px;  display: none"/></div>

                        </div>
						<br><br><br><br><br><br><br><br><br>
                    </div>
					
                 </form>
        			
            </div>
        </div>
		
		
		
		

    </section>
	

<!-- jQuery -->
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/tether.min.js"></script>
<script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>

<!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>optimum/js/custom.min.js"></script>
    <script src="<?php echo base_url() ?>optimum/js/custom.js"></script>
	

	
<!-- Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
 
 <!-- auto hide message div-->
    <script type="text/javascript">
        $( document ).ready(function(){
           $('.hide_msg').delay(2000).slideUp();
        });
    </script>
	
<!--slimscroll JavaScript -->
<script src="<?php echo base_url(); ?>optimum/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url(); ?>optimum/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>optimum/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<script>
    $('form').submit(function (e) 
	{
        $('#install_progress').show();
        $('#modal_1').show();
        $('.btn').val('Login...');
        $('form').submit();
        e.preventDefault();
    });
	
</script>

<script type="text/javascript">
    function showPosition(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                var positionInfo = position.coords.latitude + ", "+ position.coords.longitude;
                document.getElementById("result").value = positionInfo;
            });
        }    
		document.getElementById("result").value="User Denied Access!";
    }
</script>
<?php }else{ redirect(base_url() . 'admin/dashboard', 'refresh'); }?>
</body>

</html>
