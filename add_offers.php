
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> 
                     <i class="fa fa-plus"></i> &nbsp; Add Offers<a href="<?php echo base_url('admin/offers/all_offers') ?>" class="pull-right"><i class="fa fa-list"></i> Existing Offers</a>

                </div>
                <div class="panel-body table-responsive">
				
				 <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%;"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
			
			<script>
				$(document).ready(function(){
					
						$('input').attr('readonly', false);
				});
			</script>
	
                    <form method="post" action="<?php echo base_url('admin/offers/insert_offers') ?>" class="form-horizontal" >
                       <div class="form-group">
							<label class="col-md-12" for="example-text">Offer Title</label>
							<div class="col-sm-12">
                                            <input type="text" name="offers_title" class="form-control" required >
                                        </div>
                                   </div>
                              

                           <div class="form-group">
                 	<label class="col-md-12" for="example-text">Offer Details</label>
                    <div class="col-sm-12">
                                            <input type="text" name="offers_details" class="form-control" required data-validation-required-message="Last Name is required" >
                                        </div>
                                    </div>
                              <div class="form-group">
										<div class="col-sm-12">
                                            <input type="hidden" name="offers_created_date" class="form-control" value="<?php echo date('g:i:s A M d, Y'); ?>">
                                        </div>
                                    </div>

                           
                            <!-- CSRF token -->
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
							<div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info btn-rounded btn-sm"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Offers</button>
                            </div>
                        </div>
                           
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->