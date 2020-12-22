 <?php $__env->startSection('page_css'); ?>
    <link property='stylesheet' href="<?php echo asset('css/dashboard.css'); ?>" rel="stylesheet">
    
    <link property='stylesheet' href="<?php echo asset('assets/fontend/bdtdccss/why-bdtdc.css'); ?>" rel="stylesheet">
    <link property='stylesheet' href="<?php echo asset('assets/fontend/css/jquery-te-1.4.0.css'); ?>" rel="stylesheet">

  <?php $__env->stopSection(); ?>
<?php $__env->startSection('own_styles'); ?>
<style>
	.hide_details{
		display:none;
	}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
 <?php if(Sentinel::check()): ?>
            <?php
              $role = App\Model\Role_user::where('user_id',Sentinel::getUser()->id)->first();
              $dashboard_route = ($role->role_id ==3) ? "company/dashboard" : 'buyer/dashbord';
            ?>
        <?php endif; ?>

<div class="row" style="padding-top: 1%;padding-bottom: 0.5%">
        <div class="col-lg-12 col-md-12 padding_0">
            <ul  style="margin-left: -2%;float: left;"><li style="float: left">
            <a itemprop="url" href="<?php echo e(URL::to($dashboard_route,null)); ?>" style="color: #000">
            My Dashboard
            </a> <i class="fa fa-angle-right"></i> </li>
             <li style="float: left">
            <a itemprop="url" href="<?php echo e(URL::to('Mybuying-Request')); ?>" style="color: #000">
               <strong> My Buying Request</strong>
            </a> <i class="fa fa-angle-right"></i></li>
            <li style="float: left">
            <a itemprop="url" href="#" style="color: #000">
               <strong> Quotations</strong>
            </a> <i class="fa fa-angle-right"></i></li>
            </ul>
            <ul style="float:right;margin-left: -2%" itemscope itemtype="http://schema.org/BreadcrumbList">
        <button class="goBack" onclick="goBack()" style="padding: 0;"><span>Go Back</span></button>
      </ul>
        </div>
</div>

<div class="row" style="margin-bottom:2%;">
<div class="col-xs-12 col-sm-2 col-lg-2 padding_0" style="">						
		<?php echo $__env->make('fontend.layouts.dashboard-aside', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							
	</div>
	<div class="col-md-10" style="padding-right: 0px">

	<?php
		$inquiry_title = 'Not available';
		$image_url = 'uploads/no_image.jpg';
	?>
		<?php if($supplier_inquiry->inq_products_description): ?>
			<?php
				$inquiry_title = $supplier_inquiry->inq_products_description->name;
			?>
		<?php endif; ?>
		<?php if($supplier_inquiry->inq_products_images): ?>
			<?php
				$image_url = $supplier_inquiry->inq_products_images->image;
			?>
		<?php elseif($supplier_inquiry->inq_docs_one): ?>
			<?php
				$image_url = 'buying-request-docs/'.$supplier_inquiry->inq_docs_one->docs;
			?>
		<?php endif; ?>
		<?php if($supplier_inquiry->inquery_title != ''): ?>
			<?php
				$inquiry_title = $supplier_inquiry->inquery_title;
			?>
		<?php endif; ?>
	
	<div class="item_sha" style="margin-bottom:2%;">
		<div class="row" style="margin: 0;    padding: 1%;">
				<div class="col-sm-2">
					<p style="font-size: 14px;color: #919191;margin-bottom: 0">Enquiry for:</p>
				</div>
				<div class="col-sm-12">
					<?php if($supplier_inquiry): ?>
					<h1 class="qf-opt" title="<?php echo e($supplier_inquiry->inquery_title); ?>" style="font-size: 20px; font-weight: 300; text-transform: ; color: #545c58;margin: 0 0px 10px;">
						<a href="<?php echo e(URL::to('product-sourcing/view',$supplier_inquiry->id)); ?>"><?php echo e($supplier_inquiry->inquery_title, 0, 100); ?></a> <span class="qf-show"><i class="fa fa-angle-down"></i><span>View More</span></span>
					</h1>
					<?php else: ?>
					<p title="product name not available" style="font-size: 18px; font-weight: 300; text-transform: ; color: #545c58;">Inquiry title not available</p>
					<?php endif; ?>

					<div class="inq_details hide_details" class="col-sm-12" style="margin-bottom:2%;padding: 0;">
						<div class="col-sm-3" style="margin-left: -1%;">
							<img style="height:229px;width:237px;" src="<?php echo asset($image_url); ?>" alt="" />
						</div>
						<div class="col-sm-9">

							<p style="color: #999;">Quantity Required: <?php echo e($supplier_inquiry->quantity); ?> <?php if($supplier_inquiry->inq_unit_id){echo $supplier_inquiry->inq_unit_id->name; } ?></p>
							<?php if($supplier_inquiry->product_country): ?>
							<p style="color: #999;">Required Supplier Location: <?php if($supplier_inquiry->product_country){echo $supplier_inquiry->product_country->name;} ?></p>
							<?php endif; ?>
							<?php if($supplier_inquiry->pre_unit_price != 0): ?>
							<p style="color: #999;">Preferred Unit Price: <?php if(trim($supplier_inquiry->currency == '')){echo "USD";}else{ echo $supplier_inquiry->currency;} ?> <?php echo e($supplier_inquiry->pre_unit_price); ?> / <?php if($supplier_inquiry->inq_unit_id){echo $supplier_inquiry->inq_unit_id->name; } ?></p>
							<?php endif; ?>
							<p style="color: #999;">Expire After: <?php echo e(date('Y-m-d h:i:s a', strtotime($supplier_inquiry->created_at . ' +15 day'))); ?></p>
							<!-- <p style="color: #999;">Shipping Terms:</p> -->
							<p style="color: #999;">Destination Port: <?php echo e($supplier_inquiry->destination_port); ?></p>
							<?php if(trim($supplier_inquiry->payment_terms != '')): ?>
							<p style="color: #999;">Payment Terms: <?php echo e($supplier_inquiry->payment_terms); ?></p>
							<?php endif; ?>

							<p style="font-size: 13px;color: #999;">Status : <b><?php
								if($supplier_inquiry->status == 0){
									echo "Pending";
								}else if($supplier_inquiry->status == 1){
									echo "Approved";
								}else if($supplier_inquiry->status == 2){
									echo "Rejected";
								}else if($supplier_inquiry->status == 3){
									echo "Completed";
								}else if($supplier_inquiry->status == 4){
									echo "Closed";
								}
							?></b></p>
						</div>
					</div>
				</div>
				

				
				
		</div>
	</div>
	<div class="item_sha">
		<div class="row">
		<?php if($bdtdc_inquery_messages): ?>
			<?php if(count($bdtdc_inquery_messages) > 0): ?>
			<div class="col-sm-3" style="padding-right: 0;">
			  <ul class="inq_message_list" style="padding:5px;margin-left:10px;display: block;overflow: hidden;">
			  <?php $fontend_show = 1; ?>
			  <?php $__currentLoopData = $bdtdc_inquery_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inqMess): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    <li class="quotation_line" show_quotation="show_me<?php echo $fontend_show; ?>" style="border-bottom: 1px solid #dadada;display: block;overflow: hidden;">
				    <div class="" title="<?php echo $inqMess->bdtdcInqueryMessageUser['first_name']; ?> <?php echo $inqMess->bdtdcInqueryMessageUser['last_name']; ?>" style="cursor: pointer">
				    	
				    	<div class="col-sm-4 padding_0" style="    margin: 1px 0;">
				    		<?php if($inqMess->bdtdcInqueryMessageUser): ?>
				    			<?php 
				    			$user_image = 'uploads/'.$inqMess->bdtdcInqueryMessageUser->profile_picture;
				    			?>
				    			<?php if(file_exists($user_image)): ?>
					    			<img style="width:100%;" src="<?php echo e(asset($user_image)); ?>">
					    		<?php else: ?>
					    		<img style="width:100%;" src="<?php echo e(asset('uploads/no_image.jpg')); ?>">
					    		<?php endif; ?>
					    		<?php endif; ?>
				    	</div>
				    	<div class="col-sm-8 show_target" style="">
				    		<div class="frontend_show" style="display:<?php if($fontend_show == 1){echo 'none';}else{echo '';} ?>">
				    			<p style="margin: 0 0 0.1em;margin-top: 5px;font-size: 12px;"><b><?php echo $inqMess->bdtdcInqueryMessageUser['first_name']; ?></b></p>
					    		<p style="margin: 0 0 0.1em;font-size: 12px;">Order on buyerseller</p>
					    		<p style="margin: 0 0 0.1em;font-size: 12px;">Unit Price: <?php echo $inqMess->unit_price; ?> / <?php if(trim($inqMess->bdtdcInqueryMessageProduct->product_prices['currency'] == '')){echo "USD";}else{ echo $inqMess->bdtdcInqueryMessageProduct->product_prices['currency'];} ?></p>
					    		<p style="margin: 0 0 0.1em;font-size: 12px;">quantity: <?php echo $inqMess->quantity; ?> <?php echo $inqMess->bdtdcInqueryMessageProduct->ProductUnit['name']; ?></p>
				    		</div>
				    		<div class="backend_show" style="position: relative; display:<?php if($fontend_show == 1){echo '';}else{echo 'none';} ?>;">
				    			<p style="margin: 0 0 0.1em;margin-top: 5px;font-size: 12px;"><b><?php echo $inqMess->bdtdcInqueryMessageUser['first_name']; ?></b></p>
					    		<!-- <p style="margin: 0 0 0.1em;font-size: 12px;">
					    		<a href="#" data-product_id="{-!! $inqMess->product_id !!-}" data-supplier_id="{-!! $inqMess->product_owner_id !!-}" class="btn btn-primary contact_supplier" style="font-size:12px;padding:6px;"><i class="fa fa-envelope-o"></i>Contact Supplier</a>
					    		</p> -->
					    		<p style="margin: 0 0 0.1em;font-size: 12px;">Or Contact by <a class="tooltip_action">Email/Phone</a></p>
					    		<div class="toolTip" style="background-color: rgb(255, 255, 255); border: 1px solid rgb(115, 167, 240); padding: 5px; top: -4px; left: -50%; position: absolute; border-radius: 4px !important; box-shadow: black 0px 0px 8px -1px; z-index: 2147483647; display: none;">
									<p style="overflow:auto;margin-bottom: 0"><span>email:</span><?php echo $inqMess->bdtdcInqueryMessageUser['email']; ?></p>
									<!-- <p><span>tel:</span>81291308</p>
									<p><span>fax:</span>81011472</p>
									<p><span>mobile:</span>86-15521229350</p> -->
									<!-- <div class="tailShadow" style="background-color: transparent;width: 4px;height: 4px;position: absolute;top: -6px;left: 35px;z-index: -10;box-shadow: 0px 0px 8px 1px black;-moz-box-shadow: 0px 0px 8px 1px black;-webkit-box-shadow: 0px 0px 8px 1px black;"></div> -->
									<div class="tail1" style="width: 0px; height: 0px; border: 10px solid; border-color: transparent transparent #73a7f0 transparent; position: absolute; bottom: -20px; left: 45%; transform: rotate(180deg);"></div>
									<div class="tail2" style="width: 0px; height: 0px; border: 10px solid; border-color: transparent transparent #ffffff transparent; position: absolute; left: 45%; bottom: -18px; transform: rotate(180deg);"></div>
								</div>

				    		</div>
				    	</div>
				    </div>
			    </li>
			    <?php $fontend_show++; ?>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  </ul>
			</div>
			<div class="col-sm-9" style="padding-right: 30px;padding-left: 0">
				<?php if(session()->has('success')): ?>
					<div class="col-sm-12 alert alert-success" style="margin:0;">
	                    <?php echo e(session()->get('success')); ?>

	                </div>
				<?php endif; ?>
				<?php if(session()->has('error')): ?>
					<div class="col-sm-12 alert alert-danger" style="margin:0;">
	                    <?php echo e(session()->get('error')); ?>

	                </div>
				<?php endif; ?>
				<?php if(count($errors) > 0): ?>
	                <div class="col-sm-12 alert alert-danger" style="margin:0;">
	                    <ul>
	                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            <li><?php echo e($error); ?></li>
	                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                    </ul>
	                </div>
	            <?php endif; ?>

				<?php $show_mess_count = 1; ?>
				<?php $__currentLoopData = $bdtdc_inquery_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inqMessSingle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-sm-12 padding_0 hide_all show_me<?php echo $show_mess_count; ?>" style="margin-bottom:2%;border: 1px solid #E6E6E6;<?php if($show_mess_count == 1){echo '';}else{echo 'display:none';} ?>">
				<div class="col-sm-12" style="background-color:#FEFBEE;border: 1px solid #FFE2B0;">
					<div class="col-sm-6" style="">
						<?php if($inqMess->product_owner_id==Sentinel::getUser()->id): ?>
						<?php else: ?>
							<p style="margin-top: 10px">
							<a href="<?php echo e(URL::to('mysource/online-order/inq',mt_rand(100000000, 999999999).$inqMessSingle->id.mt_rand(100000000, 999999999))); ?>" type="button" class="btn btn-primary">start order</a>
							<a href="<?php echo e(URL::to('view/request-sample',$inqMessSingle->id)); ?>" style="padding-left: 10px;color: #06C;">Request a sample</a>
							</p>
						<?php endif; ?>
					</div>
					<div class="col-sm-6" style="border-left: 1px dashed #FFE2B0;">
					</div>
				</div>
				
				<div class="col-sm-12" style="border: 1px solid #ffe2b0;">
					<div class="col-sm-12" style="">
							<h3 style="color:#333;">The supplier's response to your requirements:</h3>
							<p style="font-size: 13px;color:#333;">"<?php echo e($inqMessSingle->messages); ?>" </p>
					</div>
					<div class="col-sm-12">
						<p id="m_q"><?php echo e($inqMessSingle->bdtdcInqueryMessageProduct->product_name->name); ?></p>
						<p style="font-size: 12px;color: #666;border-bottom: 1px dashed #E7E7E7;padding-bottom:10px;">Model Number: <?php echo e($inqMessSingle->bdtdcInqueryMessageProduct->model); ?></p>
					
						<div class="col-sm-12" style="margin-top:2%;margin-left: -3.5%;margin-bottom:2%;">
							<div class="col-sm-3" style="border-right: 1px dashed #E7E7E7;">
								<p>Shipping terms : </p>
							</div>
							<div class="col-sm-3" style="border-right: 1px dashed #E7E7E7;">
								<?php
								$port = '';
								if(isset($inqMessSingle->bdtdcInqueryMessageLogisticInfo['port'])){
									$port = $inqMessSingle->bdtdcInqueryMessageLogisticInfo['port'];
								}
								?>
								<p>Port : <?php echo e($port); ?></p>
							</div>
							<div class="col-sm-3" style="border-right: 1px dashed #E7E7E7;">
								<p>Payment Terms: <?php echo e($inqMessSingle->bdtdcInqueryMessageProduct->payment_method); ?></p>
							</div>
							
						</div>
						<p style="">Quotation Valid Till: <?php echo e(date('Y-m-d', strtotime($inqMessSingle->updated_at . ' +15 day'))); ?></p>
						<div class="col-sm-12" style="border-top: 1px dashed #E7E7E7;margin-top:1%;">
							<div class="col-sm-6">
								quantity
								<p id="m_q1"><?php echo e($inqMessSingle->quantity); ?> 
								<?php if($inqMessSingle->bdtdcInqueryMessageProduct->ProductUnit): ?>
								<?php echo e($inqMessSingle->bdtdcInqueryMessageProduct->ProductUnit['name']); ?>

								<?php endif; ?>
								 </p>
							</div>
							<div class="col-sm-6">
								 	Unit Price:
								 	<p id="m_q1">FOB <?php if(trim($inqMessSingle->bdtdcInqueryMessageProduct->product_prices['currency'] == '')){echo "USD";}else{ echo $inqMessSingle->bdtdcInqueryMessageProduct->product_prices['currency'];} ?> <?php echo e($inqMessSingle->unit_price); ?>/ <?php echo e($inqMessSingle->bdtdcInqueryMessageProduct->ProductUnit['name']); ?></p>
							</div>

						</div>
						<div class="col-sm-12" style="margin-top:2%;padding-bottom:20px;">
							<div class="col-sm-4">
								<a href="<?php echo e(URL::to('product-details/'.preg_replace('/[^A-Za-z0-9\.-]/', '-',$inqMessSingle->bdtdcInqueryMessageProductDescription->name).'='.mt_rand(100000000, 999999999).$inqMessSingle->bdtdcInqueryMessageProductDescription->product_id)); ?>">
								<img class="thumbnail" style="height:232px;width:206px;" src="
								<?php if($inqMessSingle->bdtdcInqueryMessageProductImageNew): ?>
								<?php echo e(URL::to($inqMessSingle->bdtdcInqueryMessageProductImageNew->image)); ?>

								<?php elseif($inqMessSingle->bdtdcInqueryMessageDocsOne): ?>
								<?php echo e(URL::to('quotation',$inqMessSingle->bdtdcInqueryMessageDocsOne->docs)); ?>

								<?php else: ?>
								<?php echo e(URL::to('uploads/no_image.jpg')); ?>

								<?php endif; ?>
								" alt="" /></a>
							</div>
							<div class="col-sm-8">
								<p><?php echo e($inqMessSingle->messages); ?></p>
								<?php $docs_found = 1; ?>
								<?php if($inqMessSingle->bdtdcInqueryMessageDocs): ?>
								<?php if(count($inqMessSingle->bdtdcInqueryMessageDocs)>0): ?>
								<?php $__currentLoopData = $inqMessSingle->bdtdcInqueryMessageDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inq_docs_single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($inq_docs_single->docs != ''): ?>
									<?php if(file_exists('quotation/'.$inq_docs_single->docs)): ?>
									<?php if($docs_found == 1): ?>
									<h4 style="margin-top: 20px;">Attached files</h4>
									<?php endif; ?>
									<a target="_blank" href="../../quotation/<?php echo e($inq_docs_single->docs); ?>"><img style="height:100px;width:100px;" src="../../quotation/<?php echo e($inq_docs_single->docs); ?>" alt="inquiry docs" /></a>
									<?php $docs_found++; ?>
									<?php endif; ?>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>



				<?php if($inqMessSingle->all_quote_messages): ?>
				<?php if(count($inqMessSingle->all_quote_messages)>0): ?>
					<?php $__currentLoopData = $inqMessSingle->all_quote_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inqMess_single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($inqMess_single->sender == Sentinel::getUser()->id): ?>
						<div class="col-sm-12" style="margin-top: 30px">
							<div class="col-sm-8">
								<p><span style="font-size: 14px;font-weight: bold;"><?php echo e($inqMess_single->bdtdcInqueryMessageSender?$inqMess_single->bdtdcInqueryMessageSender->first_name:'name not available'); ?> <?php echo e($inqMess_single->bdtdcInqueryMessageSender?$inqMess_single->bdtdcInqueryMessageSender->last_name:''); ?></span> <?php echo e($inqMess_single->created_at); ?></p>
								<div style="border: 1px solid #5683A0;border-radius: 5px !important;background-color: #f0f8ff;padding:10px;">
									<p><?php echo $inqMess_single->messages; ?></p>
									
									<?php $docs_found = 1; ?>
									<?php if($inqMess_single->bdtdcInqueryMessageDocs): ?>
									<?php if(count($inqMess_single->bdtdcInqueryMessageDocs)>0): ?>
									
									<?php $__currentLoopData = $inqMess_single->bdtdcInqueryMessageDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inq_docs_single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($inq_docs_single->docs != ''): ?>
										<?php if(file_exists('quotation/'.$inq_docs_single->docs)): ?>
										<?php if($docs_found == 1): ?>
										<h5 style="margin-top: 20px;">Attached files</h5>
										<?php endif; ?>
										<a target="_blank" href="../../quotation/<?php echo e($inq_docs_single->docs); ?>"><img style="height:100px;width:100px;" src="../../quotation/<?php echo e($inq_docs_single->docs); ?>" alt="inquiry docs" /></a>
										<?php $docs_found++; ?>
										<?php endif; ?>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
					<?php else: ?>
						<div class="col-sm-12" style="margin-top: 30px">
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<p class="text-right"><span style="font-size: 14px;font-weight: bold;"><?php echo e($inqMess_single->bdtdcInqueryMessageSender?$inqMess_single->bdtdcInqueryMessageSender->first_name:'not available'); ?> <?php echo e($inqMess_single->bdtdcInqueryMessageSender?$inqMess_single->bdtdcInqueryMessageSender->last_name:''); ?></span> <?php echo e($inqMess_single->created_at); ?></p>
								<div style="border: 1px solid #5683A0;border-radius: 5px !important;background-color: #f0f8ff;padding:10px;">
									<p><?php echo $inqMess_single->messages; ?></p>
									<?php $docs_found = 1; ?>
									<?php if($inqMess_single->bdtdcInqueryMessageDocs): ?>
									<?php if(count($inqMess_single->bdtdcInqueryMessageDocs)>0): ?>
									<?php $__currentLoopData = $inqMess_single->bdtdcInqueryMessageDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inq_docs_single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($inq_docs_single->docs != ''): ?>
										<?php if(file_exists('quotation/'.$inq_docs_single->docs)): ?>
										<?php if($docs_found == 1): ?>
										<h5 style="margin-top: 20px;">Attached files</h5>
										<?php endif; ?>
										<a target="_blank" href="../../quotation/<?php echo e($inq_docs_single->docs); ?>"><img style="height:100px;width:100px;" src="../../quotation/<?php echo e($inq_docs_single->docs); ?>" alt="inquiry docs" /></a>
										<?php $docs_found++; ?>
										<?php endif; ?>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				<?php endif; ?>


				<div class="col-sm-12">
					<?php echo Form::open(array('url'=>'quotations_form/submit-message/'.$inqMessSingle->id,'method'=>'POST', 'files'=>true,'class'=>'myform')); ?>

					<h1 style="font-size: 20px;font-weight: 400;color: #545c58;">Type your message here</h1>
					<input type="hidden" name="product_owner_id" value="<?php echo e($inqMessSingle->product_owner_id); ?>">
					<div class="form-group">
					    <textarea class="form-control editors" id="message" name="message"><?php echo e(old('message')); ?></textarea>
					    <?php if($errors->has('message')): ?>
					    <p class="alert alert-danger"><?php echo e($errors->first('message')); ?></p>
					    <?php endif; ?>
					</div>
					<div class="form-group">
					    <?php echo Form::label('file'); ?>

                    	<?php echo Form::file('file', ['class' => 'field']); ?>

                    	<?php if($errors->has('file')): ?>
                    	<p class="alert alert-danger"><?php echo e($errors->first('file')); ?></p>
                    	<?php endif; ?>
					</div>
					<button type="submit" class="btn btn-primary">Send</button>

					<?php echo Form::close(); ?>

					<br>
				</div>
				</div>
				<?php $show_mess_count++; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				

			</div>
		
			<?php else: ?>
			<div style="margin:0 auto;"><h1 style="text-align:center;color:forestgreen;">Requested quotation not available!!!</h1><p style="text-align:center;"><a style="text-decoration:none;" href="<?php echo e(URL::to('Mybuying-Request')); ?>"> << back to buying request</a></p><br></div>
			<?php endif; ?>
		<?php else: ?>
			<div style="margin:0 auto;"><h1 style="text-align:center;color:forestgreen;">Requested quotation not available!!!</h1><p style="text-align:center;"><a style="text-decoration:none;" href="<?php echo e(URL::to('Mybuying-Request')); ?>"> << back to buying request</a></p><br></div>
		<?php endif; ?>
		</div>
	</div>


</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
 
<script src="<?php echo e(URL::asset('assets/fontend/js/jquery-te-1.4.0.min.js')); ?>" charset="utf-8"></script>
<?php echo $__env->make('fontend.layouts.dashboard_aside_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
	
	$(document).ready(function(){

		setTimeout(function(){ $('.alert').hide(500) }, 5000);

		$('[show_quotation="<?php echo e($selected); ?>"]').css('background-color', 'aliceblue');

		$('.frontend_show').css('display','block');
		$('.backend_show').css('display','none');
		$('.hide_all').css('display','none');
		$('.quotation_line').css('background-color', 'white');
		$('[show_quotation="<?php echo e($selected); ?>"]').css('background-color', 'aliceblue');
		$('[show_quotation="<?php echo e($selected); ?>"]').children().children('.show_target').children('.frontend_show').css('display','none');
		$('[show_quotation="<?php echo e($selected); ?>"]').children().children('.show_target').children('.backend_show').css('display','block');
		var catch_class = $('[show_quotation="<?php echo e($selected); ?>"]').attr('show_quotation');
		$('.'+catch_class).css('display','block');

		$(document).on({click:function(){
			var target = $(this).attr('show_quotation');
			var url = window.location.origin+'/mysource_quotations/inq/'+'<?php echo e($supplier_inquiry->id); ?>'+'?s='+target;
			window.location = url;
		}},'.quotation_line');


		$(document).on({mouseover:function(){
			$(this).parent().parent().children('.toolTip').css('display','block');
		}},'.tooltip_action');
		$(document).on({mouseout:function(){
			$(this).parent().parent().children('.toolTip').css('display','none');
		}},'.tooltip_action');
		// $(document).on({mouseover:function(){
		// 	$(this).show();
		// }},'.toolTip');
		// $(document).on({mouseout:function(){
		// 	$(this).hide();
		// }},'.toolTip');

		$(document).on({

    		click: function(e) {
    			e.preventDefault();
    			var base_url = window.location.origin;
    			var supplier_id = $(this).data('supplier_id');
    			var product_id = $(this).data('product_id');
    			var url = base_url + "/byer/contact_supplier/" + supplier_id + "/" + product_id;
                window.location.href = url;
    		}

    	}, '.contact_supplier');

	    /*CKEDITOR.replace('message',
	    {
	        extraPlugins: 'uploadimage,image2',
			height: 300,

			// Upload images to a CKFinder connector (note that the response type is set to JSON).
			uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

			// Configure your file manager integration. This example uses CKFinder 3 for PHP.
			filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
			filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

			// The following options are not necessary and are used here for presentation purposes only.
			// They configure the Styles drop-down list and widgets to use classes.

			stylesSet: [
				{ name: 'Narrow image', type: 'widget', widget: 'image', attributes: { 'class': 'image-narrow' } },
				{ name: 'Wide image', type: 'widget', widget: 'image', attributes: { 'class': 'image-wide' } }
			],

			// Load the default contents.css file plus customizations for this sample.
			contentsCss: [ CKEDITOR.basePath + 'contents.css', 'assets/css/widgetstyles.css' ],

			// Configure the Enhanced Image plugin to use classes instead of styles and to disable the
			// resizer (because image size is controlled by widget styles or the image takes maximum
			// 100% of the editor width).
			image2_alignClasses: [ 'image-align-left', 'image-align-center', 'image-align-right' ],
			image2_disableResizer: true



	    });

	    $('.editors').each(function(){
	    	alert($(this).attr('id'));
		    CKEDITOR.replace( $(this).attr('id') );
		});*/

		$('.editors').jqte();
	    // settings of status
	    var jqteStatus = true;
	    $(".status").click(function(){
		    jqteStatus = jqteStatus ? false : true;
		    $('.jqte-test').jqte({"status" : jqteStatus})
	    });

	    var i = false;

	    $('.qf-show').click(function(){
	    	$(this).parent().toggleClass('qf-opt');
	    	$('.inq_details').toggleClass('hide_details');
	    	if(i){
	    		$(this).find('.fa').removeClass('fa-angle-up');	
	    		$(this).find('.fa').addClass('fa-angle-down');	
	    		$(this).find('span').text('view more');	
	    		i=false;

	    	}else{
	    		$(this).find('.fa').removeClass('fa-angle-down');	
	    		$(this).find('.fa').addClass('fa-angle-up');	
	    		$(this).find('span').text('view less');	
	    		i=true;
	    	}
	    	
	    });

	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('fontend.master-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>