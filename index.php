<?php include 'layout/css.php'; ?>
    <div id="wrapper"> 
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="icon-grid"></i></a>
                <div class="top-left-part"><a class="logo" href="<?php echo base_url('admin/dashboard/') ?>"><b>CRM</b><span class="hidden-xs">Praadis </span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs"><i class="icon-grid"></i></a></li>
				 </ul>
				<ul class="nav navbar-top-links navbar-right pull-right" >
                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
					
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
           <ul class="dropdown-menu animated bounceInDown">
               <!-- calculator-->
            <style>
                .calculator_button{
                    border : 1px solid #303641;
                    width: 50px;
                    background-color: #5A606C;
                    color: #F5FAFC;
                    cursor:auto;
                }
                .calculator_button:hover{
                    border : 1px solid #303641;
                    background-color: #5A606C;
                    color: #F5FAFC;
                }
                .calculator_button:focus{
                    border : 1px solid #303641;
                    background-color: #5A606C;
                    color: #F5FAFC;
                }
				@media(max-width:460px)
				{
					.abc_cal
					{
						margin-right: 139px;
						left: auto;
						right: 0;
					}
				}
            </style>
		<div class="abc_cal">
            <form name="form1" onsubmit="return false" >
            <table style="">
                <tr>
                    <td colspan="4"><input type="text" id="display" style="width:100%; border:0px; background-color:#303641;text-align: right;  font-size: 24px;  font-weight: 100;  color: #fff;" readonly placeholder="" /></td>
                </tr>
                <tr>
                    <td colspan="4"><button type="button" class="btn btn-default calculator_button" style="width:100%;"  onclick="reset()">Clear</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(7)">7</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(8)" >8</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(9)" >9</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;+&quot;)">+</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(4)">4</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(5)" >5</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(6)" >6</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;-&quot;)" >-</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(1)">1</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(2)" >2</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(3)" >3</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;*&quot;)" >&times;</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(0)">0</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(&quot;.&quot;)" >.</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="equals()" >=</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;/&quot;)" >&divide;</button></td>
                </tr>
            </table>
            </form>
          </div>        
    </ul>
        </li>
				  <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url();?>optimum/images/<?php echo $this->session->userdata('role'); ?>.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $this->session->userdata('name'); ?></b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a ><i class="fa fa-user"></i>  <?php echo $this->session->userdata('name'); ?></a></li>
                            <li><a href="<?php echo base_url('auth/logout') ?>" ><i class="fa fa-power-off"></i>  Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    	<!--<li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>-->
                    <!-- /.dropdown -->
                </ul> 
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
		<script>
				$(document).ready(function(){
					
						$('input').attr('readonly', false);
				});
			</script>
	
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                 
                    <li class="user-pro">
                        <a  class="waves-effect"><img src="<?php echo base_url();?>optimum/images/<?php echo $this->session->userdata('role'); ?>.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"><?php echo $this->session->userdata('name'); ?><!--<span class="fa arrow"></span>--></span>
                        </a>
                        <!--<ul class="nav nav-second-level">
                            <li ><a href="<?php echo base_url('auth/logout') ?>" ><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>-->
                    </li>
                    <li> <a href="<?php echo base_url('admin/dashboard') ?>" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>
                    
			<?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'super admin' ): ?>
					<?php if ($this->session->userdata('role') == 'super admin'){ ?><li> <a class="waves-effect"><i class="fa fa-user"></i> <span class="hide-menu">Admin Module</span></a> </li> <?php }?>
					<li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-user p-r-10"></i> <span class="hide-menu"> Employees <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">3</span></span></a>
                        <ul class="nav nav-second-level">
                             <li> <a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-plus p-r-10"></i><span class="hide-menu">New Employees</span></a></li>
							 <!--<li> <a href="<?php echo base_url('admin/user/designation') ?>"><i class="fa fa-cog p-r-10"></i><span class="hide-menu">Add Designation</span></a></li> -->
							 
						<li><a href="<?php echo base_url('admin/user/all_user_list') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">All Employees</span></a></li>
						<li><a href="<?php echo base_url('admin/user/users_v2') ?>"><i class="fa fa-info-circle p-r-10"></i><span class="hide-menu"> Employees Details</span></a></li>
                        <li><a href="<?php echo base_url('admin/user/treeview') ?>"><i class="fa fa-group p-r-10"></i><span class="hide-menu"> Employee Hierarchy</span></a></li>
                      </ul>
                    </li>
                    <?php if ($this->session->userdata('role') == 'super admin' ){ ?>
                    <li> <a href="<?php echo base_url('admin/App_data') ?>" class="waves-effect"><i class="fa fa-mobile"> </i> <span class="hide-menu">User App Data</span></a> </li>
                    <li> <a href="<?php echo base_url('admin/user/user_activation') ?>" class="waves-effect"><i class="fa fa-toggle-on"> </i> <span class="hide-menu">User App Activation</span></a> </li>
					<?php } ?>
					
					<li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-envelope p-r-10"></i> <span class="hide-menu"> Leads <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">4</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/lead') ?>">Add New Leads</a></li> 
                            <li> <a href="<?php echo base_url('admin/lead/all_lead_list') ?>">All Leads</a></li>
							<li> <a href="<?php echo base_url('admin/lead/all_lead_list_v2') ?>">Leads Id Details</a></li>
                            <li> <a href="<?php echo base_url('admin/lead/lead_transfer') ?>">Lead Transfer</a></li>
                        </ul>
                    </li>
					<li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-gift p-r-10"></i><span class="hide-menu"> Offers Zone <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">3</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/offers') ?>">Add New Offers</a></li>
                            <li> <a href="<?php echo base_url('admin/offers/all_offers') ?>">All Offers</a></li>
                            <li> <a href="<?php echo base_url('admin/offers/delete_ofr') ?>" title="This features disable Now">Offers Delete</a></li>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money p-r-10"></i><span class="hide-menu"> Incentives Card<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">2</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/incentive/') ?>">Add Incentive</a></li>
                            <li> <a href="<?php echo base_url('admin/incentive/all_incentives') ?>">Incentives card</a></li>
                        </ul>
                    </li>
			 <?php endif; ?>		
			<?php if ($this->session->userdata('role') == 'user' || $this->session->userdata('role') == 'super admin' ): ?>
			        <?php if ($this->session->userdata('role') == 'super admin'){ ?><li> <a class="waves-effect"><i class="fa fa-user"></i> <span class="hide-menu">Employee Module</span></a> </li><?php }?>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-envelope p-r-10"></i> <span class="hide-menu"> Leads <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">3</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/lead') ?>">Add New Leads</a></li> 
                            <li> <a href="<?php echo base_url('admin/lead/my_lead_list') ?>">All Leads</a></li>
							<li> <a href="<?php echo base_url('admin/lead/my_lead_list_v2') ?>">Leads Id Details</a></li>
                        </ul>
                    </li>
					<li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-gift p-r-10"></i> <span class="hide-menu"> Offers Zone <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">1</span></span></a>
						 <ul class="nav nav-second-level">
							<li> <a href="<?php echo base_url('admin/offers/all_offers') ?>">All Offers</a></li>
						</ul>
					</li>
					<li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money p-r-10"></i> <span class="hide-menu"> Incentive Card <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">1</span></span></a>
						 <ul class="nav nav-second-level">
							<li> <a href="<?php echo base_url('admin/incentive/all_incentives') ?>">Incentive Card</a></li>
						</ul>
					</li>
			 <?php endif; ?>
			 <?php if ($this->session->userdata('role') == 'super admin'){ ?><li> <a class="waves-effect"><i class="fa fa-group"></i> <span class="hide-menu">Common Module</span></a> </li><?php }?>
			 <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-chart p-r-10"></i> <span class="hide-menu"> Order <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/report/payment_report') ?>">All Order List</a></li>
                            <li> <a href="<?php echo base_url('admin/report/income_report') ?>">Income Order</a></li>
                            <li> <a href="<?php echo base_url('admin/report/sales_report') ?>">Sales Order</a></li>
                        </ul>
               </li> -->
			 
			  <li> <a href="<?php echo base_url('admin/leaderboard') ?>" class="waves-effect"><i class="fa fa-trophy p-r-10"></i> <span class="hide-menu">Leader Board</span></a> </li>
				
			  <li> <a href="<?php echo base_url('admin/lead/open_events') ?>" class="waves-effect"><i class="fa fa-calendar p-r-10"></i> <span class="hide-menu">Scheduled Task</span></a> </li>
			  <?php if ($this->session->userdata('role') == 'super admin'){ ?>
			            
			            <li> <a href="<?php echo base_url('admin/payment/travel') ?>" class="waves-effect"><i class="fa fa-bus p-r-10"></i> <span class="hide-menu"></span></a> </li>
			            
			  <!-- <li> <a href="<?php echo base_url('admin/Online_data/online_lead') ?>" class="waves-effect"><i class="fa fa-users p-r-10"></i> <span class="hide-menu">Registered Users</span></a> </li> -->
						<?php } ?>
				<!--	<li> <a href="#" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">UI Elements<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">25</span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo base_url('admin/ui/card') ?>">Cards</a></li>
                            <li><a href="<?php echo base_url('admin/ui/panel_well') ?>">Panels and Wells</a></li>
                            <li><a href="<?php echo base_url('admin/ui/panel_block') ?>">Panels With BlockUI</a></li>
                            <li><a href="<?php echo base_url('admin/ui/drag_panel') ?>">Draggable Panel</a></li>
                            <li><a href="<?php echo base_url('admin/ui/dragPortlet') ?>">Draggable Portlet</a></li>
                            <li><a href="<?php echo base_url('admin/ui/buttons') ?>">Buttons</a></li>
                            <li><a href="<?php echo base_url('admin/ui/bootsrap_switch') ?>">Bootstrap Switch</a></li>
                            <li><a href="<?php echo base_url('admin/ui/date_pagination') ?>">Date Paginator</a></li>
                            <li><a href="<?php echo base_url('admin/ui/sweet_alert') ?>">Sweat alert</a></li>
                            <li><a href="<?php echo base_url('admin/ui/typography') ?>">Typography</a></li>
                            <li><a href="<?php echo base_url('admin/ui/grid') ?>">Grid</a></li>
                            <li><a href="<?php echo base_url('admin/ui/tabs') ?>">Tabs</a></li>
                            <li><a href="<?php echo base_url('admin/ui/stylish') ?>">Stylish Tabs</a></li>
                            <li><a href="<?php echo base_url('admin/ui/modals') ?>">Modals</a></li>
                            <li><a href="<?php echo base_url('admin/ui/progressbar') ?>">Progress Bars</a></li>
                            <li><a href="<?php echo base_url('admin/ui/notification') ?>">Notifications</a></li>
                            <li><a href="<?php echo base_url('admin/ui/carousel') ?>">Carousel</a></li>
                            <li><a href="<?php echo base_url('admin/ui/list_media') ?>">List & Media object</a></li>
                            <li><a href="<?php echo base_url('admin/ui/user_card') ?>">User Cards</a></li>
                            <li><a href="<?php echo base_url('admin/ui/timeline') ?>">Timeline</a></li>
                            <li><a href="<?php echo base_url('admin/ui/horizontal_timeline') ?>">Horizontal Timeline</a></li>
                            <li><a href="<?php echo base_url('admin/ui/nestable') ?>">Nesteble</a></li>
                            <li><a href="<?php echo base_url('admin/ui/range_slider') ?>">Range Slider</a></li>
                            <li><a href="<?php echo base_url('admin/ui/ribbon') ?>">Ribbons</a></li>
                            <li><a href="<?php echo base_url('admin/ui/steps') ?>">Steps</a></li>
                        </ul>
                    </li>-->
                   
                   <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-chart p-r-10"></i> <span class="hide-menu"> Reports <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/report/payment_report') ?>">Payment Report</a></li>
                            <li> <a href="<?php echo base_url('admin/report/income_report') ?>">Income Report</a></li>
                            <li> <a href="<?php echo base_url('admin/report/sales_report') ?>">Sales Report</a></li>
                        </ul>
                    </li>-->
                   <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-inr p-r-10"></i> <span class="hide-menu"> Payments<span class="label label-rouded label-danger pull-right">2</span> <span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level">
							<li> <a href="<?php echo base_url('admin/payment/all_payments') ?>">All Payments</a></li>
							<li> <a href="<?php echo base_url('admin/payment/create_payment') ?>">Create Payment</a></li>
						</ul>
					</li>
					
					 <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-inr p-r-10"></i> <span class="hide-menu"> Travel Expenses<span class="label label-rouded label-danger pull-right">2</span> <span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level">
							<li> <a href="<?php echo base_url('admin/payment/travel_list') ?>">All Travel Expenses</a></li>
							<li> <a href="<?php echo base_url('admin/payment/travel') ?>">Create Travel Expenses</a></li>
						</ul>
					</li>
					<!-- <li> <a href="forms.html" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Forms<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo base_url('admin/form/form_basic') ?>">Basic Forms</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_layout') ?>">Form Layout</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_addon') ?>">Form Addons</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_material') ?>">Form Material</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_float') ?>">Form Float Input</a></li>
                            <li><a href="<?php echo base_url('admin/form/file_upload') ?>">File Upload</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_mask') ?>">Form Mask</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_validation') ?>">Form Validation</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_dropzone') ?>">File Dropzone</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_picker') ?>">Form-pickers</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_icheck') ?>">Icheck Form Controls</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_wizard') ?>">Form-wizards</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_typehead') ?>">Typehead</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_editable') ?>">X-editable</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_summernote') ?>">Summernote</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_wysihtml5') ?>">Bootstrap wysihtml5</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_tinymyce') ?>">Tinymce wysihtml5</a></li>
                        </ul>
                    </li>-->
                    
				<!--	<li> <a href="<?php echo base_url('admin/lead/all_lead_list_test') ?>" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Test</span></a> </li> -->
				<!--	<li> <a href="<?php echo base_url('admin/dashboard/backup') ?>" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Backup Database</span></a> </li> -->
					
                   <!-- <li> <a href="<?php echo base_url('admin/widget/widget') ?>" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Widgets</span></a> </li>
                    <li> <a href="#" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Icons<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/icon/font_awesome') ?>">Font awesome</a> </li>
                            <li> <a href="<?php echo base_url('admin/icon/themifyIcon') ?>">Themify Icons</a> </li>
                            <li> <a href="<?php echo base_url('admin/icon/simpleLineIcon') ?>">Simple line Icons</a> </li>
                            <li><a href="<?php echo base_url('admin/icon/lineIcon') ?>">Linea Icons</a></li>
                            <li><a href="<?php echo base_url('admin/icon/weatherIcon') ?>">Weather Icons</a></li>
                        </ul>
                    </li>-->
                    
                   <!-- <li> <a href="#" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Sample Pages<span class="fa arrow"></span><span class="label label-rouded label-purple pull-right">29</span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo base_url('admin/page/starter') ?>">Starter Page</a></li>
                            <li><a href="<?php echo base_url('admin/page/blank') ?>">Blank Page</a></li>
                            <li><a href="javascript:void(0)" class="waves-effect">Email Templates
            <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="<?php echo base_url('admin/page/email_basic') ?>">Basic</a></li>r
                                    <li><a href="<?php echo base_url('admin/page/email_alert') ?>">Alert</a></li>
                                    <li><a href="<?php echo base_url('admin/page/email_billing') ?>">Billing</a></li>
                                    <li><a href="<?php echo base_url('admin/page/reset_password') ?>">Reset Password</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url('admin/page/lightBox') ?>">Lightbox Popup</a></li>
                            <li><a href="<?php echo base_url('admin/page/treeview') ?>">Treeview</a></li>
                            <li><a href="<?php echo base_url('admin/page/search_result') ?>">Search Result</a></li>
                            <li><a href="<?php echo base_url('admin/page/utility_class') ?>">Utility Classes</a></li>
                            <li><a href="<?php echo base_url('admin/page/custom_scroll') ?>">Custom Scrolls</a></li>
                            <li><a href="<?php echo base_url('admin/page/login_page') ?>">Login Page</a></li>
                            <li><a href="<?php echo base_url('admin/page/second_login') ?>">Login v2</a></li>
                            <li><a href="<?php echo base_url('admin/page/animation') ?>">Animations</a></li>
                            <li><a href="<?php echo base_url('admin/page/profile') ?>">Profile</a></li>
                            <li><a href="<?php echo base_url('admin/page/invoice') ?>">Invoice</a></li>
                            <li><a href="<?php echo base_url('admin/page/faq') ?>">FAQ</a></li>
                            <li><a href="<?php echo base_url('admin/page/gallery') ?>">Gallery</a></li>
                            <li><a href="<?php echo base_url('admin/page/pricing') ?>">Pricing</a></li>
                            <li><a href="<?php echo base_url('admin/page/register') ?>">Register</a></li>
                            <li><a href="<?php echo base_url('admin/page/second_register') ?>">Register v2</a></li>
                            <li><a href="<?php echo base_url('admin/page/step_registration') ?>">3 Step Registration</a></li>
                            <li><a href="<?php echo base_url('admin/page/recover_password') ?>">Recover Password</a></li>
                        </ul>
                    </li>-->
                   
                 <!--   <li> <a href="tables.html" class="waves-effect"><i data-icon="O" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Tables<span class="fa arrow"></span><span class="label label-rouded label-info pull-right">7</span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo base_url('admin/table/basic_table') ?>">Basic Tables</a></li>
                            <li><a href="<?php echo base_url('admin/table/table_layout') ?>">Table Layouts</a></li>
                            <li><a href="<?php echo base_url('admin/table/data_table') ?>">Data Table</a></li>
                            <li><a href="<?php echo base_url('admin/table/bootsrap_table') ?>">Bootstrap Tables</a></li>
                            <li><a href="<?php echo base_url('admin/table/responsive_table') ?>">Responsive Tables</a></li>
                            <li><a href="<?php echo base_url('admin/table/editable_table') ?>">Editable Tables</a></li>
                            <li><a href="<?php echo base_url('admin/table/footable') ?>">FooTables</a></li>
                        </ul>
                    </li>-->
                    
					<li ><a href="<?php echo base_url('auth/logout') ?> " class="waves-effect" ><i class="icon-logout fa-fw"></i> <span class="hide-menu">Logout</span></a></li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        
       
	   
	    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                
			<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $page_title; ?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <!--<a href="" target="_blank" class="btn pull-right m-l-20 btn-info btn-rounded btn-sm">Buy Now</a>-->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>admin/dashboard/">Home</a></li>
                            <li class="active"> <?php echo $page_title; ?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 	
                <?php bridge();  ?>
				<!--  row    ->
               <?php  echo $main_content; ?>
                <!-- /.row -->
			
            </div>
            <!-- /.container-fluid -->
           <?php include 'layout/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
   <?php include 'layout/js.php'; ?>
 
 
