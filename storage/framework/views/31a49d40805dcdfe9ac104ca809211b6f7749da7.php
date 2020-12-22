<?php $__env->startSection('content'); ?>
<section>
   <div class="container">
      <div class="row">
         <div class="col-xs-12 padding_0" style="padding-right:0px; padding-bottom:0px; ">
            <a href="<?php echo e(URL::to('product/name')); ?>" style="text-decoration: none;cursor: context-menu;color: #666; display: block;">
               <div id="search-inner" style="position: relative;"><i class="fa fa-search" aria-hidden="true" style="font-size: 20px;"></i>Search Products</div>
            </a>
         </div>
         <div class="col-sm-12 col-xs-12 padding_0">
            <button class="btn btn-default" onclick="window.history.back();" style="width:100%;text-align:center;color: #666;padding:10px;font-size: 20px;padding-top:17px;"><i class="fa fa-reply-all" style="font-size: 30px;" aria-hidden="true"></i></button>
         </div>
         <div class="col-sm-12 col-xs-12 padding_0" style="padding-top: 0px;background-color:#fff !important;">
            <ul style="width: 100%" id="etalage">
               <li style="width:100% !important">
                  <a itemprop="url" href="optionallink.html">
                  <?php if($products->product_image_new): ?>
                  <img style="width:100%" itemprop="image"  class="etalage_thumb_image" src="<?php echo e(URL::to((isset($products->product_image_new)) ? $products->product_image_new->image : 'no_image.jpg')); ?>" />
                  <img style="width:100%" itemprop="image"  class="etalage_source_image" src="<?php echo e(URL::to((isset($products->product_image_new)) ? $products->product_image_new->image : 'no_image.jpg')); ?>" />
                  <?php else: ?>
                  not found
                  <?php endif; ?>
                  </a>
               </li>
               <?php if($products->proimages_new && count($products->proimages_new) > 0): ?>
               <?php $__currentLoopData = $products->proimages_new; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                  <img itemprop="image"  class="etalage_thumb_image" src="<?php echo e(URL::to((isset($image)) ? $image->image : 'no_image.jpg')); ?>" />
                  <img itemprop="image"  class="etalage_source_image" src="<?php echo e(URL::to((isset($image)) ? $image->image : 'no_image.jpg')); ?>" />
               </li>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endif; ?>
            </ul>
         </div>
         <div class="col-sm-12 col-xs-12">
            <!-- <form action="<?php echo e(URL::to('make-favorite')); ?>" method="post"> -->
            <div style="padding-top: 20px;padding-bottom: 50px;">
               <span>
                  <?php
                     $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                     $buy_title = 'Buy '.$products->product_name->name.' '.$products->bdtdcProductToCategory->bdtdcCategory->name.' on bdtdc.com';
                  ?>
                  <ul class="share-link">
                     <li style="margin-top: -6px;"><em style="font-size: 18px; color: #666;">Share to</em></li>
                     <?php
                        $url='http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                     ?>
                     <?php if(Sentinel::check()): ?>
                     <form action="<?php echo e(URL::to('make-favorite')); ?>" method="post">
                        <?php echo csrf_field(); ?>

                        <?php if($products->customer_activity): ?>
                        <?php if(count($products->customer_activity)>0): ?>
                        <li>
                           <a class="fa fa-star btn favorite" title="Favourite" style="font-size: 22px;font-weight: normal;padding-top: 2%;padding-left: 16%;color:#0000FF;" data-key="<?php echo e($products->product_name->name ?? ''); ?>" data-id="<?php echo e($products->id); ?>"></a>
                        </li>
                        <?php else: ?>
                        <li><a class="fa fa-star-o btn favorite" title="Favourite" style="font-size: 22px;font-weight: normal;padding-top: 2%;padding-left: 16%;" data-key="<?php echo e($products->product_name->name ?? ''); ?>" data-id="<?php echo e($products->id); ?>"></a></li>
                        <?php endif; ?>
                        <?php else: ?>
                        <?php endif; ?>
                     </form>
                     <?php else: ?>
                     <li><a href="<?php echo e(URL::to('ServiceLogin?continue='.$url)); ?>"  class="fa fa-star-o btn favorite" itemprop="url" title="Favourite" style="font-size: 22px;font-weight: normal;padding-top: 2%;padding-left: 16%;"></a></li>
                     <?php endif; ?>
                     <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($actual_link); ?>" title="Facebook"><i class="fa fa-facebook" style="font-size: 22px;font-weight: normal;" aria-hidden="true"></i></a></li>
                     <li><a href="https://twitter.com/intent/tweet?source=<?php echo e($actual_link); ?>&text=<?php echo e($buy_title); ?>:<?php echo e($actual_link); ?>" target="_blank" title="Twitter"><i class="fa fa-twitter" style="font-size: 22px;font-weight: normal;" aria-hidden="true"></i></a></li>
                     <li><a href="https://plus.google.com/share?url=<?php echo e($actual_link); ?>" target="_blank" title="Google plus"><i class="fa fa-google-plus" style="font-size: 22px;font-weight: normal;" aria-hidden="true"></i></a></li>
                     <li><a href="http://pinterest.com/pin/create/button/?url=<?php echo e($actual_link); ?>&media=<?php echo e(URL::to($products->product_image_new->image,null)); ?>&description=<?php echo e($buy_title); ?>" target="_blank" title="Pin it"><i class="fa fa-pinterest" style="font-size: 22px;font-weight: normal;" aria-hidden="true"></i></a></li>
                  </ul>
               </span>
            </div>
            <!-- </form> -->
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container">
      <div class="row" style="background: #fff; margin-bottom: 28px;">
         <div class="col-xs-12" style="padding-left: 40px;">
            <p class="p-name-m" style="padding-right: 20px; padding-left: 0;">
               <a itemprop="url" href="<?php echo e(URL::to('category/product',$products->bdtdcProductToCategory->bdtdcCategory->id)); ?>" style="color: #000">
               <span itemprop="name"><?php echo e($products->product_name->name ?? ''); ?></span>
               </a>
            </p>
            <?php if($products->product_prices): ?>
            <p class="p-name-m"  style="padding: 0;">
               <span style="color: #333; font-size: 13px; font-weight: bold; text-align: left;">Price :</span>
               <?php if(trim($products->product_prices->product_FOB) != '' && trim($products->product_prices->product_FOB) != '0' && $products->product_prices->product_FOB != null ): ?>
               <span style="margin-bottom:0px;padding-left:0px;" itemprop="priceCurrency" content="USD">
               <font class="pro_details_pad"><span style="margin-bottom:0px;"> US $</span><?php if($products->product_prices != null): ?> <?php if($products->product_prices->product_FOB != null): ?> <?php echo e($products->product_prices->product_FOB); ?> <?php endif; ?> <?php else: ?> <?php endif; ?> / <?php echo e($products->ProductUnit->name ?? ''); ?>

               </font>
               </span>
               <?php endif; ?>
            </p>
            <p class="p-name-m" style="padding: 0;"><span style="color: #333; font-size: 13px;font-weight: bold; text-align: left;">Min-Order :</span>
               <?php if(trim($products->product_prices->product_MOQ) != '' && trim($products->product_prices->product_MOQ) != '0'&& $products->product_prices->product_MOQ != null): ?>
               <font itemprop="orderQuantity" style="padding-left:26px" class="pro_details_pad" color="#000">
               <?php echo e($products->product_prices->product_MOQ ?? ''); ?> <?php echo e($products->ProductUnit->name ?? ''); ?>

               </font>
               <?php endif; ?>
            </p>
            <?php endif; ?>
         </div>
         <div class="col-xs-12">
            <div style="width: 45%;border: 1px solid #255E98; padding: 10px;text-align: center;font-size: 14px;font-weight: 600;color: #255E98;display: block;float: left;overflow: hidden;">
               <a itemprop="url"  class="chat_single" data-target-id="
                  <?php if($products->supplier_product): ?>
                  <?php echo e($products->supplier_product->supplier_id.mt_rand(100000000, 999999999)); ?>

                  <?php else: ?>
                  0
                  <?php endif; ?>
                  " href="">Chat Now</a>
            </div>
            <div    data-product_id="<?php echo e($products->id ?? ''); ?>" data-supplier_id="<?php echo e($products->supplier_product->supplier_id ?? ''); ?>" class="col-xs-6 contact_supplier" style="width: 45%;border: 1px solid #255E98; padding: 10px;text-align: center;font-size: 14px;font-weight: 600;color: #255E98;display: block;float: left;overflow: hidden; margin-bottom: 12px; float: right;">
               Contact Supplier
            </div>
         </div>
         <div class="col-xs-12" style="">
            <a href="<?php echo e(URL::to('product-item-detail/'.preg_replace('/[^A-Za-z0-9\.-]/', '-',$products->bdtdcProductToCategory->bdtdcCategory->name).'/'.$products->id)); ?>">
               <div class="view-all" id="itm-detl" style="box-shadow:none; border-bottom: 1px solid #ddd; border-top:1px solid #ddd; text-align: left; padding-left: 25px;">Item Details</div>
            </a>
         </div>
         <div class="col-xs-12" >
            <div class="pr-dt" style="padding-left: 0px; border-bottom: 0 none; margin-top: 0;">
               <div class="left-dv" style="width: 40%;">
                  <ul class="pp-dt-lst">
                     <li>FOB Price : </li>
                     <?php if($products->logistic_info): ?>
                     <li>Port:</li>
                     <?php endif; ?>
                     <?php if($products->logistic_info): ?>
                     <li>Supply Ability:</li>
                     <?php endif; ?>
                     <?php if($products->payment_method): ?>
                     <li>Payment Terms:</li>
                     <?php endif; ?>
                  </ul>
               </div>
               <div class="left-dv" style="padding-left: 0; width: 60%;">
                  <ul class="pp-dt-lst">
                     <?php if($products->product_prices): ?>
                     <li> 
                        <?php if(trim($products->product_prices->product_FOB) != '' && trim($products->product_prices->product_FOB) != '0' && $products->product_prices->product_FOB != null ): ?>
                        <span style="margin-bottom:0px;padding-left:0px;" itemprop="priceCurrency" content="USD">
                        <font><span style="margin-bottom:0px;"> US $</span><?php if($products->product_prices != null): ?> <?php if($products->product_prices->product_FOB != null): ?> <?php echo e($products->product_prices->product_FOB); ?> <?php endif; ?> <?php else: ?> <?php endif; ?> / <?php echo e($products->ProductUnit->name ?? ''); ?>

                        </font>
                        </span>
                        <?php endif; ?>
                     </li>
                     <?php endif; ?>
                     <?php if($products->logistic_info): ?>
                     <li>
                        <?php if(trim($products->logistic_info->port) != '' && trim($products->logistic_info->port) != '0' && $products->logistic_info->port != null): ?>
                        <font style=""  color="#000">
                        <?php echo e($products->logistic_info->port); ?>

                        </font>
                        <?php endif; ?>
                     </li>
                     <?php endif; ?>
                     <?php if($products->logistic_info): ?>
                     <li>
                        <?php if(trim($products->logistic_info->supply_ability) != '' && trim($products->logistic_info->supply_ability) != '0' && $products->logistic_info->supply_ability != null): ?>
                        <font itemprop="orderQuantity"  color="#000"><?php echo e($products->logistic_info->supply_ability ?? ''); ?>  <?php echo e($products->ProductUnit->name ?? ''); ?> per Month
                        </font>    
                        <?php endif; ?>
                     </li>
                     <?php endif; ?>
                     <?php if(trim($products->payment_method) != '' && trim($products->payment_method) != '0' && $products->payment_method != null): ?>
                     <li>
                        <font   color="#000">
                        <?php echo e($products->payment_method ?? ''); ?>

                        </font>
                     </li>
                     <?php endif; ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container" >
      <div class="row" style="background: #fff;border-top: 1px solid #ddd; ">
         <div class="col-xs-12">
            <div class="view-all" style="text-align: left; padding-left: 25px;color: #FF7519;"><a href="<?php echo e(URL::to('get-quotations_product')); ?>"> GET QUOTATIONS NOW </a></div>
         </div>
         <div class="col-xs-12" style="">
            <?php if($products->supplier_product->sup_companies->name_string->name != null): ?>
            <a itemprop="url" target="_blank" href="<?php echo e(URL::to(preg_replace('/[^A-Za-z0-9\-]/', '-',$products->supplier_product->sup_companies->name_string->name).'/'.'company-overview/'.$products->supplier_product->sup_companies->id)); ?>">
               <div class="view-all" style="border-bottom: 1px solid #ddd; border-top:1px solid #ddd; text-align: left; padding-left: 25px;">
                  Company Profile    
               </div>
            </a>
            <?php endif; ?>
         </div>
         <div class="col-xs-12">
            <div class="pr-dt" style="padding-left: 25px; border:0 none; ">
               <div id="left_sh" itemprop="manufacturer" style="border: none" itemscope itemtype="http://schema.org/Organization">
                  <div>
                     <p class="heading_sup">
                        <?php if($products->supplier_product->sup_companies->name_string->name != null): ?>
                        <a itemprop="url" target="_blank" href="<?php echo e(URL::to('Home/'.preg_replace('/[^A-Za-z0-9\-]/', '-',$products->supplier_product->sup_companies->name_string->name).'/'.$products->supplier_product->sup_companies->id)); ?>">
                        <span itemprop="owns"> Verified Supplier- 
                        <?php echo e($products->supplier_product->sup_companies->name_string->name); ?>   
                        </span>
                        </a>  
                        <?php endif; ?> 
                     </p>
                     <p itemprop="foundingLocation" class="summary"><?php if($products->bdtdcProductToCategory->cat_country->name != null): ?> <?php echo e($products->bdtdcProductToCategory->cat_country->name); ?> <?php else: ?> no data <?php endif; ?> |<a  itemprop="url" target="_blank" href="<?php echo e(URL::to('contact/'.preg_replace('/[^A-Za-z0-9\-]/', '-',$products->supplier_product->sup_companies->name_string->name),(isset($products->supplier_product->sup_companies->id)) ? $products->supplier_product->sup_companies->id : '1')); ?>">Contact details</a></p>
                     <p itemprop="description" class="summary">
                        Experiance :<br>
                        <?php if($products->supplier_product->sup_companies->year_of_reg): ?>
                        Established <?php echo e($products->supplier_product->sup_companies->year_of_reg); ?> 
                        <br><?php $rand=rand(5,30) ?> <?php echo e($rand); ?> years OEM
                        <?php else: ?>
                        <span>a</span>
                        <?php endif; ?>
                     </p>
                     <p itemprop itemscope itemtype="http://schema.org/Rating" class="summary">
                        <span itemprop="ratingValue">Performance:<br>
                        <?php $rand=rand(70,92) ?> <?php echo e($rand); ?>% Response Rate </span>
                     </p>
                  </div>
                  <div>
                     <?php if($products->bdtdcProductToCategory->supplier_info): ?>
                     <div class="supplier-badge-gold" style="right: 0; width: 40px;">
                        <span class="gs-badge-year" style="margin-top: 21px;">
                        </span> 
                     </div>
                     <?php endif; ?>
                  </div>
                  <div>
                     <h5 class="heading">
                        <a itemprop="url" href="<?php echo e(URL::to('BuyerChannel/pages/trade_assurance',5)); ?>" target="_blank">
                        </a>
                     </h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xs-12" style="">
            <div class="view-all">
               <a itemprop="url" target="_blank" href="<?php echo e(URL::to('Home/'.preg_replace('/[^A-Za-z0-9\-]/', '-',$products->supplier_product->sup_companies->name_string->name).'/'.$products->supplier_product->sup_companies->id)); ?>" style="color: #FF7519;">
               Visit Minisite
               </a>
            </div>
         </div>
         <div class="col-xs-12" style="">
            <div class="view-all" style="box-shadow:none; border-bottom: 1px solid #ddd; border-top:1px solid #ddd; text-align: left; padding-left: 25px;"><a href="<?php echo e(URL::to('BuyerChannel/pages/trade_assurance',5)); ?>" style="color:#666;"> Buyer Protection</a> </div>
         </div>
         <div class="col-xs-12" style="padding: 40px 0; padding-left: 40px;margin-bottom: 20px;">
            <div style="position: relative;">
               <div>
                  <dt class="bdt-p">Buyer Protection is a FREE payment protection service</dt>
                  <p class="bdt-p" style="color: #666;">Place order online and pay to the designated bank account to get full protection.</p>
               </div>
               <div class="list" style="margin-left: -7px;">
                  <div style="display: block;clear: both;padding: 10px 0; margin: 0;">
                     <img itemprop="image" style="height:20px;" src="<?php echo asset('assets/images/100-576x400.png'); ?>">Product quality protection
                  </div>
                  <div style="display: block;clear: both;padding: 10px 0; margin: 0;">
                     <img itemprop="image" style="height:20px;" src="<?php echo asset('assets/images/100-576x400.png'); ?>">On-time shipment protection
                  </div>
                  <div style="display: block;clear: both;padding: 10px 0; margin: 0;">
                     <img itemprop="image" style="height:20px;" src="<?php echo asset('assets/images/100-576x400.png'); ?>">Payment protection  
                  </div>
               </div>
               <div data-product_id="5117" data-supplier_id="1143" class="btn btn-primary btn-join contact_supplier" style="padding:0 6px; position: absolute;left: 0;">Contact Supplier</div>
            </div>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container">
      <div class="row" style="background: #fff;border-top: 1px solid #ddd; margin-bottom: 28px;">
         <div class="col-xs-12">
            <div class="view-all" style="box-shadow:none;   text-align: left; padding-left: 25px;">Recommended For You </div>
         </div>
         <div class="col-xs-12 padding_0" style="border: 0 none;box-shadow: none;margin-top: 20px;border-top:1px solid #ddd; border-left: 1px solid #ddd;">
            <?php if($products->bdtdcProductToCategory): ?>
            <?php if($products->bdtdcProductToCategory->other_wholesalers_products): ?>
            <?php if(count($products->bdtdcProductToCategory->other_wholesalers_products) > 0): ?>
            <?php $item_active = 1; ?>
            <?php $__currentLoopData = $products->bdtdcProductToCategory->other_wholesalers_products->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mixed-product-list mixed-cell col-xs-6" style="height: 280px;  float: left; border-right: 1px solid #ddd;border-bottom: 1px solid #ddd; padding: 0; width: 50%;">
               <a href="<?php echo e(URL::to('product-details/'.preg_replace('/[^A-Za-z0-9\.-]/', '-',$single_sp->category_product_name->name).'='.mt_rand(100000000, 999999999).$single_sp->product_id)); ?>">
                  <div class="flex-vertical">
                     <div class="teletext">
                        <?php if($single_sp->pro_images_new): ?>
                        <img class="main-image" style="max-width: 136px; max-height: 136px; margin-top: 15px;" title="<?php echo e($single_sp->category_product_name?$single_sp->category_product_name->name:''); ?>"  src="<?php echo asset($single_sp->pro_images_new->image); ?>" alt="<?php echo e(substr($single_sp->category_product_name?$single_sp->category_product_name->name:'', 0, 50)); ?>"/>
                        <?php else: ?>
                        <img class='main-image'  title="<?php echo e($single_sp->category_product_name->name); ?>" src="<?php echo e(asset('/uploads/no_image.jpg')); ?>" alt="<?php echo e(substr($single_sp->category_product_name?$single_sp->category_product_name->name:'', 0, 50)); ?>"/>
                        <?php endif; ?>
                     </div>
                     <div class="additional" style="padding-left: 20px; padding-bottom: 8px;">
                        <div class="title-dt" style="height: 38px;">     
                           <?php echo e(substr($single_sp->category_product_name?$single_sp->category_product_name->name:'', 0, 40)); ?>

                        </div>
                        <div class="price-dt">
                           <?php if($single_sp->cat_pro_price): ?>
                           <?php if(trim($single_sp->cat_pro_price->product_FOB) != '' && trim($single_sp->cat_pro_price->product_FOB) != '0' && $single_sp->cat_pro_price->product_FOB != null && trim($single_sp->cat_pro_price->product_FOB) != '-' && trim($single_sp->cat_pro_price->product_FOB) != 'NA' && trim($single_sp->cat_pro_price->product_FOB) != 'N/A'): ?>
                           <p class="text-center" style="font-size:14px;padding:10px;padding-top:0;">FOB <?php echo e(trim($single_sp->cat_pro_price->currency)!=''?$single_sp->cat_pro_price->currency:'USD'); ?> <?php echo e($single_sp->cat_pro_price->product_FOB); ?> / <?php echo e($single_sp->bdtdcProduct?($single_sp->bdtdcProduct->ProductUnit?$single_sp->bdtdcProduct->ProductUnit->name:'pieces'):'pieces'); ?></p>
                           <?php endif; ?>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $item_active++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <p style="padding-top: 1%;padding-left: 3%;">There is no recommended product for you</p>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
         </div>
      </div>
   </div>
</section>

<?php $__env->stopSection(); ?>       
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
   jQuery(document).ready(function($) {
      $('#etalage').etalage({
         thumb_image_width: 300,
         thumb_image_height: 300,
         show_hint: true,
         click_callback: function(image_anchor, instance_id) {
            // alert('Callback example:\nYou clicked on an image with the anchor: "' + image_anchor + '"\n(in Etalage instance: "' + instance_id + '")');
         }
      });
      // This is for the dropdown list example:
      $('.dropdownlist').change(function() {
         etalage_show($(this).find('option:selected').attr('class'));
      });
   });

   function show_cate_product(id, block) {
      document.getElementById(id).style.display = block;
   }

   function hide_cate_product(id, none) {
      document.getElementById(id).style.display = none;
   }

   $(function() {
      $(".rslides").responsiveSlides();
   });

   $(".rslides").responsiveSlides({
      auto: true, // Boolean: Animate automatically, true or false
      speed: 500, // Integer: Speed of the transition, in milliseconds
      timeout: 4000, // Integer: Time between slide transitions, in milliseconds
      pager: false, // Boolean: Show pager, true or false
      nav: false, // Boolean: Show navigation, true or false
      random: false, // Boolean: Randomize the order of the slides, true or false
      pause: false, // Boolean: Pause on hover, true or false
      pauseControls: true, // Boolean: Pause when hovering controls, true or false
      //prevText: "Previous",   // String: Text for the "previous" button
      //nextText: "Next",       // String: Text for the "next" button
      maxwidth: "", // Integer: Max-width of the slideshow, in pixels
      navContainer: "", // Selector: Where controls should be appended to, default is after the 'ul'
      manualControls: "", // Selector: Declare custom pager navigation
      namespace: "rslides", // String: Change the default namespace used
      before: function() {}, // Function: Before callback
      after: function() {} // Function: After callback
   });

   //**Mobile search option***//
   $(document).ready(function() {
      $(document).on({
         click: function(e) {
            e.preventDefault();
            var options = $('select[name="search"].all_search').val();
            var key = $('input[name="key"].key').val();
            window.location.href = window.location.origin + '/search-product/search==' + options + '+..+key==' + key + '+..+country==0+..+buyer_protection==false+..+gold_supplier==false+..+assessed_supplier==false+..+filter_by_main_market==0+..+filter_by_total_revanue==0+..+filter_by_employe==0';
         }
      }, 'input[value="Search"].search');
   });
   (function() {
      $('.product_slide_area1 .item:eq(0)').addClass('active');
      if ($('.parent .chield').length > 1) {

      }
      setInterval(function() {
         $(".parent .chield:first").slideUp(200, function() {
            $(this).appendTo($(".parent")).slideDown();
         });
      }, 2000);
   })()

   $('.play_video').click(function() {
      $('.video_content').html("<video style='width: 100%; min-height: 240px;'' autoplay='true'><source src='<?php echo asset('resources/assets/images/Ekattor-TV-broadcasts-Bdtdccom-the-first-B2B-platform-in-Bangladesh - 10Youtube.com.webm'); ?>' type='video/ogg'></video>");
   });

   $('.close_video').click(function() {
      $('.video_content').html("");
   });

   $(document).on({
      click: function(e) {
         e.preventDefault();
         $('.modal-content').html('<span class="btn btn-block btn-lg"><i class="fa fa-spinner fa-pulse loading_icon text-primary"></i></span>');
         var base_url = window.location.origin; //$('[name="base_url"]').val();
         var supplier_id = $(this).data('supplier_id');
         var product_id = $(this).data('product_id');
         var url = base_url + "/byer/contact_supplier/" + supplier_id + "/" + product_id;
         window.location.href = url;
      }
   }, '.contact_supplier');

   // Chat Now
   $(document).on({
      click: function(e) {
         e.preventDefault();
         var target_id = $.trim($(this).attr('data-target-id'));
         if (parseInt(target_id) == 0) {
            alert('Unkonwn error occured.');
         } else {
            window.open("<?php echo URL::to('default/chat/" + target_id + "'); ?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=300,height=500");
         }
      }
   }, '.chat_single');

   /*favorite*/
   $(document).on({
      click: function(e) {
         e.preventDefault();
         var base_url = '<?php echo e(URL::to("/")); ?>';
         var key = $(this).attr('data-key');
         var data = $(this).attr('data-id');
         $.post(base_url + '/make-favorite', {
            '_token': '<?php echo e(csrf_token()); ?>',
            'key': key,
            'data': data
         }, function(result) {
            if (parseInt(result) == 1) {
               var redirected_url = window.location.href;
               window.location.href = redirected_url;
            }
         });
      }
   }, '.favorite');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('mobile-view.layout.master_m', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>