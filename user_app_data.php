
    <!-- Start Page Content -->
            <script>
				$(document).ready(function(){
					
						$('input').attr('readonly', false);
				});
			</script>
		<style>
					.wid{width:auto;}
					
					.my_container{
						width: 940px;
						max-width: 100%;
						border-radius: 11px;
						padding: 8px;
						border:2px solid ;
						margin-bottom:10px;
					}
		</style>
	
    <div class="row">
        <div class="col-lg-12">
           <div class="panel panel-info">
                    <div class="panel-heading"> Select User </div>
                <div class="panel-body table-responsive">
        				 <?php $msg = $this->session->flashdata('msg'); ?>
                    <?php if (isset($msg)): ?>
                        <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                    <?php endif ?>
                    <?php $error_msg = $this->session->flashdata('error_msg'); ?>
                    <?php if (isset($error_msg)): ?>
                        <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                    <?php endif ?>
                </div>
                            <div class="form-group">							
								<label class="col-md-12" for="example-text">  </label>
							    <div class="col-sm-12">
							        <input type="radio" id="what" name="obj" value="record"> Recording
							        <input type="radio" id="what" name="obj" checked  value="location"> Location
							    </div>
							</div>
                            
		                	<div class="form-group">
								<div class="col-sm-12">
                                    <select class="form-control custom-select" id="emp_id"  required>	
										<option value="">Select</option>
											<?php foreach($emp_name as $emp): ?>
												<option value="<?php echo $emp['id'];?>">
													<?php echo $emp['first_name'].' '. $emp['last_name']; ?>
												</option>
											<?php endforeach ?>
									</select>
								</div>
							</div>
				            
            				<!--  Details	 -->	
            				<div class="details"> 	
            					<div class="panel-heading" id="he"> Information </div>
            					<div class="white-box">
            					    
            					</div>
            				</div> 
            					
		
				<h6>.</h6>	
            </div>
        </div>
    </div>
<script type="text/javascript">
	$(".details").hide();
		$(document).ready(function(){
			
			$("input[type=radio]").change(function(){
				$("#emp_id").val("");
				$(".details").hide();
			});
            var link ="<?php echo base_url('api/api/fetch'); ?>";
              $('#emp_id').change(function(e){
                e.preventDefault();
            	 var x = document.getElementById("emp_id").value;
            	 var what_1 = $('input[name=obj]:checked').val();
            	 if(x==""){alert("Select Employee First"); $(".details").css('display','none');}else{
					 $("#he").html(what_1+" Information");
					 $(".details").css("background","");
                        $.ajax({
                          type: 'POST',
                          url: link,
                          data: {emp_id : x, type:what_1},
                          success: function(data){
                    			$(".details").show();
                    			$(".white-box").html(data);
                            }
                        }); 
            	 }
              });
		});
	</script>

    <!-- End Page Content -->