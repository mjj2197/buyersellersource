<?php echo $__env->make('fontend.layouts.topbar-home', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="container">
<div class="row topbar_sha" style="box-shadow:none;padding-top:0;margin-bottom:10px">
<div class="col-sm-12 col-md-12 col-sx-12 padding_0">
<div class="col-sm-3" style="float:left;padding-left:0">
<?php echo $__env->make('fontend.layouts.all-category-list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="col-sm-9 padding_0" style="float:left">
<?php if(isset($cat_name_array)): ?>
<div class="col-md-12 col-sm-12 col-xs-12 padding_0" id="com_des" style="font-size:1em;line-height:30px">
<div style="position:relative;float:left;min-width:120px"><span style="font-size:1em;margin-right:3px">Related Searches: </span></div>
<ul class="list-inline" itemscope itemtype="http://schema.org/SiteNavigationElement" style="margin:0">
<?php $__currentLoopData = $cat_name_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li itemscope itemtype="http://data-vocabulary.org/Product" style="padding:0">
<a rel="category" itemprop="url" href="<?php echo e(URL::to(trim(strtolower(preg_replace('/[^A-Za-z0-9\.-]/','',preg_replace('/[^A-Za-z0-9\.,&-]/','-',trim($data))))).'/search?t=products',null)); ?>"><span itemprop="name"><strong><?php echo e($data); ?> > </strong></span></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<div><span class="pull-right more" style="cursor:pointer;line-height:30px">More &nbsp;<i class="fa fa-caret-right"></i></span></div>
</div>
<?php else: ?>
<?php endif; ?>
</div>
</div>
</div>
</div>
</section>
<div class="container">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">function show_home(){document.getElementById("bang-trade").setAttribute("style"," margin-top: -35px; ")}function hide_home(){document.getElementById("bang-trade").setAttribute("style","margin-top: 0; ")}</script>
<script type="text/javascript">/*<![CDATA[*/var linksLen=$("#com_des ul li");function lesstext(){var c=0;for(var b=0;b<linksLen.length;b++){var a=$(linksLen[b]).text();c+=a.length;if(c>115){$(linksLen[b]).css("display","none")}}}function moretext(){for(var a=0;a<linksLen.length;a++){$(linksLen[a]).css("display","inline-block")}}lesstext();var mktoggle=false;$("#com_des .more").click(function(){if(!mktoggle){moretext();mktoggle=true;$(this).html('<span class="pull-right more" style="cursor: pointer;">Less &nbsp;<i class="fa fa-caret-right"></i></span>')}else{lesstext();mktoggle=false;$(this).html('<span class="pull-right more" style="cursor: pointer;">More &nbsp;<i class="fa fa-caret-right"></i></span>')}});/*]]>*/</script>