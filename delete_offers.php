<style>
.mycontainer .column {
    position: relative;
    width:100%;
    float: left;
    transition: 0.5s;
}
.mycontainer .column .mybox {
    position: relative;
    width: 100%; 
    margin: 0 auto;
    padding: 20px;
    mybox-sizing: border-mybox;
    text-align: center;
    background: linear-gradient(0deg, #fff, #fff);
    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    border-bottom-left-radius: 150px;
    border-bottom-right-radius: 150px;
    border: 3px solid #0bc1cf;
    mybox-shadow: 0 0 0 6px #fff,0 0 0 10px #0bc1cf;
    overflow-y: hidden;
    transition: 0.5s;
}
.container .column .mybox:hover {
    transform: scale(1.1);
}
.container .column .mybox:before {
    content:"";
    position: absolute;
    top: 0;
    left: -50%;
    width: 100%;
    height: 100%;
	pointer-events:none;
}
.container .column .mybox .title .fa {
    margin-top: 20px;
    font-size: 60px;
    color: #000;
}
.container .column .mybox .title h2 {
    color: #000;
    margin-top: 20px 0 0;
    padding: 0;
}
.container .column .mybox .price h4 {
    font-size: 60px;
    color: #000;
    margin: 10px 0;
    padding: 0;
}
.container .column .mybox .option ul {
    margin: 20px 0;
    padding: 0;
}
.container .column .mybox .option ul li {
    list-style: none;
    color: #000;
    padding: 10px 0;
 
}
.container .column .mybox .btn {
    display: inline-block;
    background: #069099;
    color: #000000;
    font-weight: bold;
    padding: 10px 30px;
    margin-top: 20px;
    text-decoration: none;
    border-radius: 10px;
}



</style>


<!------ Include the above in your HEAD tag ---------->


<section>
    <?php if(empty($offers_data)){echo "<script>alert('No Offers Available Yet!');</script>";}?>
<div class="col-md-12" >
<?php foreach($offers_data as $data):?>
	      <div class="col-md-4">
		<div class="mycontainer"  style="
    border-radius: 30px;
    border: 3px solid #0bc1cf;
    box-shadow: 0 0 0 6px #fff, 0 0 0 10px #0bc1cf;
    text-align: center;
    padding: 20px;margin-bottom: 40px; width:93%;">
            <div class="column1">
                <div class="mybox">
                    <div class="title">
                        <i class="fa fa-paper-plane"></i>
                        <h2><?php echo $data['offers_title'];?></h2>
                    </div>
                    <div class="price">
                        <h4><sup>$</sup>50</h4>
                    </div>
                    <div class="option"  style="margin-left:-32px;">
                        <ul>
                            <?php echo $data['offers_details'];?>
                        </ul>
                    </div>
					<form action="<?php echo base_url('admin/offers/delete_ofr/')?>" onClick="return checkDelete();" method="get">
						<input type="hidden" name="del_id" value="<?php echo $data['s_no'];?>">
						<input type="submit" style="background-color:#0bc1cf;" class="btn btn-success" value="Delete">
					</form>

                </div>
            </div>
        </div>
 
		<div style="color:" class="clearfix"></div></div>
	<?php endforeach ?>

</div>
</section>
