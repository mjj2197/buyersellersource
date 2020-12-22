<?php $__env->startSection('page_css'); ?>
<link property='stylesheet' href="<?php echo asset('css/dashboard.css'); ?>" rel="stylesheet">
<link property='stylesheet' href="<?php echo asset('assets/fontend/bdtdccss/why-bdtdc.css'); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('own_styles'); ?>
<style type="text/css">
   .buying-line2 {
      padding-left: 0;
      padding-top: 10%;
      padding-bottom: 5%;
   }

   .add-c {
      border: 0 none;
      width: 110px;
      position: relative;
   }

   .add-p .fa {
      padding: 0;
   }

   .add-p {
      width: 110px;
      display: block;
      padding-left: 0;
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 10px !important;
   }

   span.add-details-list {
      display: none;
      position: absolute;
      top: 10px;
      border-radius: 10px !important;
      width: 100%;
      left: 0px;
      z-index: 999;
      border: 1px solid #ddd;
      background: #fff;
      transition: all .3s ease;
   }

   span.add-details-list ul li a {
      display: block;
      padding: 3px 0;
      padding-left: 15px;

   }

   .add-c:hover span.add-details-list {
      display: block !important;
      top: 0 !important;
      transition: all .3s ease;
   }

   span.add-details-list ul li a:hover {
      background: #ddd;
   }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="ajax_status" style="position: fixed;left: 40%;top: 40%;" class="text-center">
   <img src="<?php echo e(URL::asset('uploads/ajax_loading.gif')); ?>" class="img-responsive" alt="">
</div>
<div class="container">
   <?php if(Sentinel::check()): ?>
   <?php
      $role = App\Model\Role_user::where('user_id',Sentinel::getUser()->id)->first();
      $dashboard_route = ($role->role_id ==3) ? "company/dashboard" : 'buyer/dashbord';
   ?>
   <?php endif; ?>

   <div class="row" style="padding-top: 1%;padding-bottom: 0.5%">
      <div class="col-lg-12 col-md-12 padding_0">
         <ul style="margin-left: -2%;float: left;">
            <li style="float: left">
               <a itemprop="url" href="<?php echo e(URL::to($dashboard_route,null)); ?>" style="color: #000">
                  My Dashboard
               </a> <i class="fa fa-angle-right"></i>
            </li>
            <li style="float: left">
               <a itemprop="url" href="" style="color: #000">
                  <strong> Quote Management</strong>
               </a> <i class="fa fa-angle-right"></i>
            </li>
         </ul>
         <ul style="float:right;margin-left: -2%" itemscope itemtype="http://schema.org/BreadcrumbList">
            <button class="goBack" onclick="goBack()" style="padding: 0;"><span>Go Back</span></button>
         </ul>
      </div>
   </div>

   <div class="row padding_0" style="background: #fff; padding-bottom: 5%;">
      <input type="hidden" id="selected_status" name="selected_status" value="<?php echo e($current_status); ?>">
      <input type="hidden" id="selected_view" name="selected_view" value="<?php echo e($unread); ?>">
      <input type="hidden" name="search_val" value="<?php echo e($search_str); ?>">
      <input type="hidden" name="date_val" value="<?php echo e($search_date); ?>">
      <div class="col-sm-12 col-lg-12 padding_0">
         <div class="col-xs-12 col-sm-2 col-lg-2 padding_0">
            <?php echo $__env->make('fontend.layouts.dashboard-aside', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         </div>
         <div class="col-sm-10">
            <div class="col-sm-12 padding_0">
               <div class="col-sm-6 padding_0">
                  <h2 class="" style="color: #000; padding-bottom: 2%; font-size: 2em;line-height: 1;margin-top: .75em;">Quotes Management</h2>
               </div>
               <div class="col-sm-6 padding_0 text-right">
                  <h2><a href="<?php echo e(URL::to('get_qutations')); ?>" target="_blank" style="font-size: 14px; font-weight: bold; color: #000; text-decoration: underline;">Post a buying request</a></h2>
               </div>

            </div>


            <div class="col-sm-12 padding_0" style="padding-top: 15px; padding-bottom: 15px;">
               <?php
						App\Model\BdtdcSupplierQuery::where('status',0)->update(['status'=>1]);
						/*
					    Status list
					    ------------
					        1 = Pending
					        2 = Approved
					        3 = Rejected
					        4 = Completed
					        5 = Closed
					    */
					   $all_status = 0;
						$unread_quote = 0;
						$pending = 0;
						$approved = 0;
						$rejected = 0;
						$completed = 0;
						$closed = 0;
					?>
					<?php if(count($bdtdc_inquery_messages) > 0): ?>
						<?php $all_status = count($bdtdc_inquery_messages); ?>
						<?php $__currentLoopData = $bdtdc_inquery_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inq_all): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($inq_all->all_quote_messages): ?>
								<?php if(count($inq_all->all_quote_messages) > 0): ?>
									<?php $__currentLoopData = $inq_all->all_quote_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inq_mess): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($inq_mess->sender != Sentinel::getUser()->id && $inq_mess->is_view == 0): ?>
											<?php $unread_quote++; ?>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
							<?php endif; ?>
							<?php if($inq_all->status == 0): ?>
								<?php App\Model\BdtdcSupplierQuery::where('id',$inq_all->id)->update(['status'=>1]); ?>
							<?php endif; ?>
							<?php if($inq_all->status == 1): ?>
								<?php $pending++; ?>
							<?php elseif($inq_all->status == 2): ?>
								<?php $approved++; ?>
							<?php elseif($inq_all->status == 3): ?>
								<?php $rejected++; ?>
							<?php elseif($inq_all->status == 4): ?>
								<?php $completed++; ?>
							<?php elseif($inq_all->status == 5): ?>
								<?php $closed++; ?>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
               <div class="col-sm-9 padding_0">

                  <input name="search_all_inq" class="search_all_inq" type="text" style="" placeholder="Search" value="<?php echo e($search_str); ?>"><span class="all_inq_search_btn" style=""><i class="fa fa-search" aria-hidden="true" style="color: #728398;padding: 3px;"></i></span>
                  <select id="rfq-manage-select" class="buyer-rq-select" style="">
                     <option value="0" selected="&quot;selected&quot;">All Status <?php echo e($all_status>0?'('.$all_status.')':''); ?></option>
                     <option value="1">Pending <?php echo e($pending>0?'('.$pending.')':''); ?></option>
                     <option value="2">Approved <?php echo e($approved>0?'('.$approved.')':''); ?></option>
                     <option value="3">Rejected <?php echo e($rejected>0?'('.$rejected.')':''); ?></option>
                     <option value="4">Completed <?php echo e($completed>0?'('.$completed.')':''); ?></option>
                     <option value="5">Closed <?php echo e($closed>0?'('.$closed.')':''); ?></option>
                  </select>

                  <div style="" class="dropdown">
                     <button class="btn btn-default btn-md dropdown-toggle" style="border-radius: 3px !important;height:30px;font-size: 13px;" type="button" id="menu3" data-toggle="dropdown">Date
                        <span class="caret"></span></button>
                     <ul style="min-width: 140px;" class="dropdown-menu" role="menu" aria-labelledby="menu3">
                        <li role="presentation"><a class="all_inq_date" data-date_target="0" style="padding:2px 14px;" role="menuitem" tabindex="-1" href="#">All</a></li>
                        <li role="presentation"><a class="all_inq_date" data-date_target="3" style="padding:2px 14px;" role="menuitem" tabindex="-1" href="#">3 days ago</a></li>
                        <li role="presentation"><a class="all_inq_date" data-date_target="7" style="padding:2px 14px;" role="menuitem" tabindex="-1" href="#">7 days ago</a></li>
                        <li role="presentation"><a class="all_inq_date" data-date_target="30" style="padding:2px 14px;" role="menuitem" tabindex="-1" href="#">30 days ago</a></li>
                     </ul>
                  </div>
                  <label class="" style="margin-left: 1%;padding-top: 2px;"><input type="checkbox" id="show-unread-btn" <?php if($unread == 'true'): ?> checked <?php else: ?> ''<?php endif; ?>> Unread quotes <?php echo e($unread_quote>0?'('.$unread_quote.')':''); ?></label>
               </div>
               <div class="col-sm-3 padding_0">
                  <?php if(isset($bdtdc_inquery_messages)): ?>
                  <div class="ui-pagination ui-pagination-pager util-clearfix rfq-manage-list-pagination">

                     <a title="previous" href="<?php echo e($bdtdc_inquery_messages->previousPageUrl()); ?>"><span class="ui-pagination-prev ui-pagination-disabled" style=" background-position: -44px 3px;cursor:pointer;">previous</span></a>


                     <a title="next" href="<?php echo e($bdtdc_inquery_messages->nextPageUrl()); ?>"><span class="ui-pagination-next ui-pagination-disabled" style=" background-position:-27px 3px;cursor:pointer;">next</span></a>

                     <label class="ui-label">
                        <?php if($bdtdc_inquery_messages->lastPage() > 0): ?>
                        <?php echo e($bdtdc_inquery_messages->currentPage()); ?>

                        <?php else: ?>
                        <?php echo e($bdtdc_inquery_messages->lastPage()); ?>

                        <?php endif; ?>
                        of <?php echo e($bdtdc_inquery_messages->lastPage()); ?> Page
                     </label>
                  </div>
                  <?php endif; ?>

               </div>
            </div>

            <?php if($bdtdc_inquery_messages): ?>
            <?php if(count($bdtdc_inquery_messages) > 0): ?>
            <?php $__currentLoopData = $bdtdc_inquery_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inqMess): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="col-sm-12 col-md-12 padding_0 head-query" style="margin-right: 0px; margin-left: 0px">

               <div class="col-sm-12 col-md-12 padding_0 head-query-top">
                  <div class="col-sm-4 padding_0">
                     <?php
								$unread_quote_single = 0;
							?>
								<?php if($inqMess->all_quote_messages): ?>
									<?php if(count($inqMess->all_quote_messages)>0): ?>
										<?php $__currentLoopData = $inqMess->all_quote_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sing_msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($sing_msg->sender != Sentinel::getUser()->id && $sing_msg->is_view == 0): ?>
												<?php echo e($unread_quote_single++); ?>

											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								<?php endif; ?>
                     <span style="display: block;float: left;padding: 5px 10px;">
                        <!-- <i style="cursor:pointer;" class="fa fa-flag inq_flag_hover " ca_inquery_id="{-{$inq_value->id}-}" ca_action="join_flag" ca_reverse_from="flag" aria-hidden="true"></i> -->
                        <i class="fa fa-envelope" title="<?php echo e($unread_quote_single); ?> unread message" aria-hidden="true" style="color: #4ad44a; font-size: 17px; top: 1px; position: relative;padding-right: 0px;"></i> <?php echo e($unread_quote_single>0?'('.$unread_quote_single.')':''); ?>

                        <input class="star" type="checkbox" title="bookmark page" style="margin-right: 5px">
                     </span>
                     <div title="Inquiry ID" style="display: block;float: left; padding: 9px 5px;"><?php echo e($inqMess->inquery_id); ?></div>
                     <div title="Date" style="display: block;float: left; padding: 9px 15px;"><?php echo e(date('Y-m-d', strtotime($inqMess->updated_at))); ?></div>
                  </div>
                  <div title="" class="col-sm-3" style="    padding: 9px 0px;">

                  </div>
                  <div title="Sender's Company" class="col-sm-3" style="padding: 9px 0px;">
                     <?php if($inqMess->bdtdcInqueryMessageUser): ?>
                     <?php if($inqMess->bdtdcInqueryMessageUser->companies): ?>
                     <?php if($inqMess->bdtdcInqueryMessageUser->companies->name_string): ?>
                     <a target="_blank" title="Sent To: <?php echo e($inqMess->bdtdcInqueryMessageUser->first_name); ?> <?php echo e($inqMess->bdtdcInqueryMessageUser->last_name); ?>" href="<?php echo e(URL::to('contact/'.$inqMess->bdtdcInqueryMessageUser->companies->name_string->name,$inqMess->bdtdcInqueryMessageUser->companies->id)); ?>">Sent To: <?php echo e($inqMess->bdtdcInqueryMessageUser->first_name); ?> <?php echo e($inqMess->bdtdcInqueryMessageUser->last_name); ?></a>
                     <?php else: ?>
                     <a target="_blank" title="Sent To: <?php echo e($inqMess->bdtdcInqueryMessageUser->first_name); ?> <?php echo e($inqMess->bdtdcInqueryMessageUser->last_name); ?>" href="<?php echo e(URL::to('contact/'.'Company-Description',$inqMess->bdtdcInqueryMessageUser->companies->id)); ?>">Sent To: <?php echo e($inqMess->bdtdcInqueryMessageUser->first_name); ?> <?php echo e($inqMess->bdtdcInqueryMessageUser->last_name); ?></a>
                     <?php endif; ?>
                     <?php endif; ?>
                     <?php else: ?>
                     Sent To: <?php echo e($inqMess->bdtdcInqueryMessageUser->first_name); ?> <?php echo e($inqMess->bdtdcInqueryMessageUser->last_name); ?>

                     <?php endif; ?>
                  </div>
                  <div class="col-sm-2 padding_0" style="padding: 9px 0px;">
                     <?php if($inqMess->bdtdcInqueryMessageUser): ?>
                     <?php if($inqMess->bdtdcInqueryMessageUser->companies): ?>
                     <?php if($inqMess->bdtdcInqueryMessageUser->companies->name_string): ?>
                     <a target="_blank" title="<?php echo e($inqMess->bdtdcInqueryMessageUser->companies->name_string->name); ?>" href="<?php echo e(URL::to('Home/'.$inqMess->bdtdcInqueryMessageUser->companies->name_string->name,$inqMess->bdtdcInqueryMessageUser->companies->id)); ?>"><?php echo e(substr($inqMess->bdtdcInqueryMessageUser->companies->name_string->name,0,30)); ?></a>
                     <?php else: ?>
                     <a target="_blank" title="Name not available" href="<?php echo e(URL::to('Home/Name not available',$inqMess->bdtdcInqueryMessageUser->companies->id)); ?>">Name not available</a>
                     <?php endif; ?>
                     <?php endif; ?>
                     <?php else: ?>
                     Company Not available
                     <?php endif; ?>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-12 padding_0">
                  <div class="col-sm-4">
                     <div style="padding: 25px 0px;">
                        <?php
									$inq_title = 'Not available';
								?>
								<?php if($inqMess->bdtdcInquery): ?>
									<?php if($inqMess->bdtdcInquery->inquery_title != ''): ?>
										<?php $inq_title = $inqMess->bdtdcInquery->inquery_title; ?>
									<?php else: ?>
										<?php if($inqMess->bdtdcInquery->inq_products_description): ?>
											<?php $inq_title = $inqMess->bdtdcInquery->inq_products_description->name; ?>
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>

                        <a href="<?php echo e(URL::to('product-sourcing/view',$inqMess->inquery_id)); ?>" class="rfq-detail-title" title="Quotation for : <?php echo e($inq_title); ?>"><?php echo e(substr($inq_title,0,50)); ?></a>
                     </div>

                  </div>
                  <div class="col-sm-3 padding_0" style="padding-top: 4.6%;">
                     <!-- <div class="rat">30</div>
                     <div class="rat">Sets</div>
                     <div class="rat">US $</div> -->
                  </div>

                  <div class="col-sm-3 padding_0" style="padding-top: 4.6%;">
                     <div class="aui2-grid-quo-status-col">
                        <span>
                        	<?php if($unread_quote_single>0): ?> ( <?php echo e($unread_quote_single); ?> New
                           <?php else: ?>
                           	<?php if($inqMess->status == 1): ?>
                              	Pending
                              <?php elseif($inqMess->status == 2): ?>
                              	Approved
                              <?php elseif($inqMess->status == 3): ?>
                              	Rejected
                              <?php elseif($inqMess->status == 4): ?>
                              	Completed
                              <?php elseif($inqMess->status == 5): ?>
                              	Closed
                              <?php endif; ?>
                           <?php endif; ?>
                        </span>
                     </div>
                  </div>
                  <div class="col-sm-2 padding_0" style="padding-top: 4.6%;">
                     <div>
                        <a href="<?php echo e(URL::to('quotation/quote',$inqMess->id)); ?>" class="btn-primary" style="padding: 6px 7px;color: #fff !important;"> View Details</a>
                     </div>
                  </div>
               </div>

            </div>


            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div class="col-sm-12 col-md-12 padding_0 head-query text-center" style="padding: 40px;margin-right: 0px; margin-left: 0px">

               No entry found!

            </div>
            <?php endif; ?>
            <?php else: ?>
            <div class="col-sm-12 col-md-12 padding_0 head-query text-center" style="padding: 40px;margin-right: 0px; margin-left: 0px">

               No entry found!

            </div>
            <?php endif; ?>

            <!-- product here display   -->
            <div class="col-sm-12">
               <?php if(isset($bdtdc_inquery_messages)): ?>
               <div class="ui-pagination ui-pagination-pager util-clearfix rfq-manage-list-pagination">

                  <a title="previous" href="<?php echo e($bdtdc_inquery_messages->previousPageUrl()); ?>"><span class="ui-pagination-prev ui-pagination-disabled" style=" background-position: -44px 3px;cursor:pointer;">previous</span></a>


                  <a title="next" href="<?php echo e($bdtdc_inquery_messages->nextPageUrl()); ?>"><span class="ui-pagination-next ui-pagination-disabled" style=" background-position:-27px 3px;cursor:pointer;">next</span></a>

                  <label class="ui-label">
                     <?php if($bdtdc_inquery_messages->lastPage() > 0): ?>
                     <?php echo e($bdtdc_inquery_messages->currentPage()); ?>

                     <?php else: ?>
                     <?php echo e($bdtdc_inquery_messages->lastPage()); ?>

                     <?php endif; ?>
                     of <?php echo e($bdtdc_inquery_messages->lastPage()); ?> Page
                  </label>
               </div>
               <?php endif; ?>

            </div>


         </div>



      </div>
   </div>
   <?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php echo $__env->make('fontend.layouts.dashboard_aside_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
		$(document).on({
			mouseover:function(){
				$(this).parent().children('span.add-details-list').css('display','block');
			}
		},'.add-p');
		$(document).on({
			mouseleave:function(){
				$('span.add-details-list').css('display','none');
			}
		},'.add-p');
		$(document).on({
			mouseover:function(){
				$(this).css('display','block');
			}
		},'.add-details-list');
		$(document).on({
			mouseleave:function(){
				$('span.add-details-list').css('display','none');
			}
		},'.add-details-list');

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


	$(document).ready(function(){

		$('#ajax_status').hide();

		function change_action(){
			var selected_status = $('#selected_status').val();
			var selected_view = $('#selected_view').val();
			var search_val = $('[name="search_val"]').val();
			var date_val = $('[name="date_val"]').val();
			var base_url = "<?php echo e(URL::to('quotation/management')); ?>";
			var redirect_url = base_url+'?status='+selected_status+'&unread='+selected_view+'&search='+search_val+'&d='+date_val;
			window.location.href = redirect_url;
		}

		function ajax_success_message(str){
			$('#ajax_status').html(str);
			$('#ajax_status').show();
		    /*$('#ajax_status').show().html(str).fadeOut(1500,function(){
		        $('#ajax_status').addClass('hide_this_loading');
		        $('#ajax_status').html('<img src="'+window.location.origin+'/uploads/ajax_loading.gif" class="img-responsive" alt="" >');
		    });*/
		}

		$('#show-unread-btn').click(function(){
        	if ($('#show-unread-btn').is(':checked')) {
				$('#selected_view').val('true');
			}else{
				$('#selected_view').val('false');
			}
			change_action();
        });

        $('#rfq-manage-select').change(function(){
        	var selected_status = $(this).val();
        	$('#selected_status').val(selected_status);
        	change_action();
        });

        $(document).on({click:function(e){
			e.preventDefault();
			var search_text =  $('[name="search_all_inq"]').val();
			$('[name="search_val"]').val(search_text);
			change_action();
		}},'.all_inq_search_btn');

		$(document).on({keypress:function(e){
			var key = e.which;
			 if(key == 13)  // the enter key code
			  {
			  	$('.all_inq_search_btn').click();
			    return false;  
			  }
		}}, '[name="search_all_inq"]');

		$(document).on({click:function(e){
			e.preventDefault();
			$('[name="date_val"]').val($(this).attr('data-date_target'));
			change_action();
		}},'.all_inq_date');

		$('#rfq-manage-select').val('<?php echo e($current_status); ?>');


	});

</script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('fontend.master-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>