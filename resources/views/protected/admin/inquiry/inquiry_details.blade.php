<?php
use App\Model\BdtdcProductDescription;
use App\Model\BdtdcInqueryMessage;
use App\Model\bdtdcInqueryDocs;
$user_id = Sentinel::getUser()->id; ?>
@if($inquiry)
@if($inquiry->is_RFQ == 1)
<div>
    <h5 class="text-center">Inquiry/Product Title:</h5>
    <p class="text-center"><a title="{{$inquiry->inquery_title}}" target="_blank" href="{{URL::to('product-sourcing/view',$inquiry->id)}}">{{$inquiry->inquery_title}}.</a></p>
</div>
@else
<div class="row">
    <div class="col-md-6" style="border-right: 1px solid #eee;">
          <h5 class="text-center">Inquiry/Product Title:</h5>
          <?php
          $product_name_title = 'No title found';
            if($inquiry->is_join_quotation == 1){
                $product_name_title = 'join';
            }else{
                if($inquiry->inq_products_description){
                    $product_name_title = $inquiry->inq_products_description->name;
                }else if($inquiry->inquery_title){
                    $product_name_title = $inquiry->inquery_title;
                }
            }
          ?>
          @if($product_name_title == 'join')
            <p class="text-left"><a title="{{$inquiry->inquery_title}}" target="_blank" href="{{URL::to('product-sourcing/view',$inquiry->id)}}">{{$inquiry->inquery_title}}.</a></p>
          @else
            <p class="text-left"><a title="{{$product_name_title}}" target="_blank" href="{{URL::to('product-sourcing/view',$inquiry->id)}}">{{$product_name_title}}.</a></p>
          @endif
    </div>
    <div class="col-md-6">
          <h5 class="text-center">Inquiry/Product Source:</h5>
        @if($inquiry->is_RFQ == 1)
          <p class="text-right"><a title="{{$product_name_title}}" target="_blank" href="{{URL::to('product-sourcing/view',$inquiry->id)}}">{{$product_name_title}}.</a></p>
        @else
          <?php
            $p_id_array = explode(',', trim($inquiry->product_id));
            foreach ($p_id_array as $key => $value) {
              $product_details = BdtdcProductDescription::where('product_id',$value)->first();
              if($product_details){
              ?>
              <p class="text-right"><a title="{{$product_details->name}}" itemprop="url" target="_blank" href="{{ URL::to('product-details/'.preg_replace('/[^A-Za-z0-9\.-]/', '-', $product_details->name).'='.mt_rand(100000000, 999999999).$product_details->product_id) }}">{{$product_details->name}}</a></p>
              <?php
              }
            }
          ?>
        @endif
    </div>
</div>
@endif
<hr />
<div class="row">
    <div class="col-md-6 text-left">
        <h5>Inquiry Sender Info:</h5>
        @if($inquiry->inq_sender_user)
            @if($inquiry->sender_company)
            <p><a target="_blank" href="{{URL::to('contact/'.preg_replace('/[^A-Za-z0-9\.-]/', '-', $inquiry->sender_company->name_string->name),$inquiry->sender_company->id)}}">{{ $inquiry->inq_sender_user->first_name }} {{ $inquiry->inq_sender_user->last_name }}</a></p>
            <p><a target="_blank" href="{{URL::to('Home/'.preg_replace('/[^A-Za-z0-9\.-]/', '-', $inquiry->sender_company->name_string->name),$inquiry->sender_company->id)}}">{{ $inquiry->sender_company->name_string->name }}</a></p>
            <p>{{ $inquiry->inq_sender_user->email }}</p>
            @else
              Sender Company Not available
            @endif
        @else
            Not Available
        @endif
        @if($inquiry->sender_company)
          @if($inquiry->sender_company->location_of_reg_string)
          <p>{{$inquiry->sender_company->location_of_reg_string->name}}</p>
          @endif
        @endif
        @if($inquiry->sender_customers_info)
          <p>{{$inquiry->sender_customers_info->telephone}}</p>
        @endif
        @if($inquiry->sender_company)
          @if(trim($inquiry->sender_company->owner_contact) != '')
          <p>{{$inquiry->sender_company->owner_contact}} (Owner)</p>
          @endif
        @endif
    </div>
    <div class="col-md-6 text-right" style="border-right: 1px solid #eee;">
        <h5>Inquiry Product Owner Info:</h5>
        @if($inquiry->product_owner_user)
            @if($inquiry->product_owner_company)
            <p><a target="_blank" href="{{URL::to('contact/'.preg_replace('/[^A-Za-z0-9\.-]/', '-', $inquiry->product_owner_company->name_string->name),$inquiry->product_owner_company->id)}}">{{ $inquiry->product_owner_user->first_name }} {{ $inquiry->product_owner_user->last_name }}</a></p>
            <p><a target="_blank" href="{{URL::to('Home/'.preg_replace('/[^A-Za-z0-9\.-]/', '-', $inquiry->product_owner_company->name_string->name),$inquiry->product_owner_company->id)}}">{{ $inquiry->product_owner_company->name_string->name }}</a></p>
            <p>{{ $inquiry->product_owner_user->email }}</p>
            @else
              Owner Company Not available
            @endif
        @else
            Not Available
        @endif
        @if($inquiry->product_owner_company)
          @if($inquiry->product_owner_company->location_of_reg_string)
          <p>{{$inquiry->product_owner_company->location_of_reg_string->name}}</p>
          @endif
        @endif
        @if($inquiry->product_owner_customers_info)
          <p>{{$inquiry->product_owner_customers_info->telephone}}</p>
        @endif
        @if($inquiry->product_owner_company)
          @if(trim($inquiry->product_owner_company->owner_contact) != '')
          <p>{{$inquiry->product_owner_company->owner_contact}} (Owner)</p>
          @endif
        @endif
    </div>
</div>
<hr />
<div class="">
    <h5>Message:</h5>
    <div>{!! nl2br($inquiry->message) !!}</div>
</div>
<hr />
<div>
    <h5 class="text-center">Inquiry/Product Images:</h5>
    <div>
      @if($inquiry->is_join_quotation != 1)
        @if(count($inquiry->inq_products_images_all) > 0)
          @foreach($inquiry->inq_products_images_all as $image)
              <a title="{{$inquiry->inq_products_description->name}}" href="{{ URL::to($image->image) }}" target="_blank"><img src="{{ URL::to($image->image) }}" height="110" width="110" alt="{{$inquiry->inq_products_description->name}}" style="padding-bottom:3px;"></a> 
          @endforeach
        @endif
      @else
        <?php
          $p_id_array = explode(',', trim($inquiry->product_id));
          foreach ($p_id_array as $key => $value) {
            $product_details = BdtdcProductDescription::where('product_id',$value)->first();
            if($product_details){
            ?>
              @if(count($product_details->proimages_new) > 0)
                @foreach($product_details->proimages_new as $image)
                    @if($product_details->product_name_category)
                    <a title="{{$product_details->name}}" href="{{ URL::to($image->image) }}" target="_blank"><img src="{{ URL::to($image->image) }}" height="110" width="110" alt="{{$product_details->name}}" style="padding-bottom:3px;"></a> 
                    @endif
                @endforeach
              @endif
            <?php
            }
          }
        ?>
      @endif
      @if(count($inquiry->inq_docs) > 0)
          <h5>Attached Images</h5>
          @foreach($inquiry->inq_docs as $image)
              <a title="{{$inquiry->inquery_title}}" href="{{ URL::to('buying-request-docs',$image->docs) }}" target="_blank"><img src="{{ URL::to('buying-request-docs',$image->docs) }}" height="110" width="110" alt="{{$inquiry->inquery_title}}" style="padding-bottom:3px;"></a> 
          @endforeach
      @endif
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-6 text-left" style="border-right: 1px solid #eee;">
        <h5>Destination Port:</h5>
        <p>{{$inquiry->destination_port}}</p>
    </div>
    <div class="col-md-6 text-right">
        <h5>Payment Term:</h5>
        <p>{{$inquiry->payment_terms}}</p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-4 text-left" style="border-right: 1px solid #eee;">
        <h5>Quantity:</h5>
        <p>{{$inquiry->quantity}}</p>
    </div>
    <div class="col-md-4 text-center" style="border-right: 1px solid #eee;">
        <h5>Asking Unit Price:</h5>
        <p> @if(trim($inquiry->pre_unit_price) != '')
              @if(trim($inquiry->currency) != '')
                  {{$inquiry->currency}} 
              @else
                  USD
              @endif
              {{$inquiry->pre_unit_price}} / 
              @if($inquiry->BdtdcSupplierQueryProductUnit)
                  {{$inquiry->BdtdcSupplierQueryProductUnit->name}}
              @else
                  pieces
              @endif
          @endif
        </p>
    </div>
    <div class="col-md-4 text-right">
        <h5>Payment Type:</h5>
        <p>{{$inquiry->payment_type}}</p>
    </div>
</div>
@endif

@if($product)
<form action="{{ URL::to('post_conversation',null) }}" method="post" class="form conversation_form">
{!! csrf_field() !!}
    <div class="col-sm-12 padding_0">
        <p style="font-size:15px;font-weight:bold;color:#666" class="pull-left">Product</p>
        <a href="#" class="btn btn-sm btn-warning pull-right">Modify & Submit</a>
        <div class="container_of_inquery_action_btn">
        @if($user_id == $product->sender)
            <a class="pull-right text-danger inquery_action" href="#" ca_inquery_id="{{ $product->id }}" style="margin-top:.5%;margin-right:2%" ca_action="single_trush"><i class="fa fa-trash"></i> Trush</a>
        @else
            <a class="pull-right text-danger inquery_action" href="#" ca_inquery_id="{{ $product->id }}" style="margin-top:.5%;margin-right:2%" ca_action="single_spam"><i class="fa fa-thumbs-down"></i> Spam</a>
            <a class="pull-right text-danger inquery_action" href="#" ca_inquery_id="{{ $product->id }}" style="margin-top:.5%;margin-right:2%" ca_action="single_flag"><i class="fa fa-flag-checkered"></i> Flag</a>
        @endif
        </div>

    </div>
    <table class="table" style="background:#F0F0F0">
        <thead style="border:1px solid #ddd!important">
            <tr class="text-muted" style="font-weight:bold">
                <td>Product Information</td>
                <td>Quantity</td>
                <td>Unit</td>
                <td>Unit Price (Asking)</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody style="border:1px solid #dce2e6!important">
            <tr style="font-size:13px">
                <input type="hidden" name="product_owner_id" value="{{ $product->product_owner_id }}">
                <input type="hidden" name="inquery_id" value="{{ $product->id }}">
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                <td><a href="{{ URL::to('product-details/'.preg_replace('/[^A-Za-z0-9\. -]/', ' ',$product->name).'='.mt_rand(100000000, 999999999).$product->product_id) }}" target="_blank" style="border:1px solid #ddd;padding:0%" class="col-xs-2 padding_0">
                @if($product->images)
                <img src="{{ URL::to($product->images) }}" alt="{{$product->name}}" class="img-responsive" style="height:52px;width:100%">
                @else
                <img src="{{ URL::asset('uploads/no-image.jpg') }}" alt="no image" class="img-responsive" style="height:52px;width:100%">
                @endif
                </a><a href="{{ URL::to('product-details/'.preg_replace('/[^A-Za-z0-9\. -]/', ' ',$product->name).'='.mt_rand(100000000, 999999999).$product->product_id) }}" target="_blank" class="col-xs-9 btn-link">{{ $product->name }}</a></td>
                <?php
                $previous_qp_data = BdtdcInqueryMessage::where('inquery_id',$product->id)
                                ->where('product_id',$product->product_id)
                                ->where('product_owner_id',$product->product_owner_id)
                                ->orderBy('id','desc')
                                ->first();
                $attached_docs = bdtdcInqueryDocs::where('inquery_id',$product->id)->get();
                // dd($attached_docs);
                ?>
                <td><input type="text" name="quantity" class="form-control quantity" value="<?php if($previous_qp_data){echo $previous_qp_data->quantity;}else{echo $product->quantity;} ?>"></td>
                <td>{{ $product->unit }}</td>
                <td><input type="text" name="unit_price" class="form-control unit_price" placeholder="Asking Unit Price" value="<?php if($previous_qp_data){echo $previous_qp_data->unit_price;}else{echo '';} ?>"></td>
                <td><input type="text" name="total" class="form-control total" readonly></td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                        $person_who_wrote  = ($user_id == $product->sender) ? "<span style='color:#666;font-weight:bold'>You</span>" : "<span style='color:red;font-weight:bold'>Supplier</span>";
                        if($user_id == $product->sender){
                            ?><span class="badge" style="background: #F1F1F1;color: #666;font-weight: bold">You wrote </span><?php
                        }else{ ?>
                                <span class="badge" style="background: #F1F1F1;color: darkred;font-weight: bold">{{$product->s_first_name}} {{$product->s_last_name}} wrote </span>
                            <?php
                        }
                    ?>
                    <span class="badge pull-right">at {{ $product->created_at }}</span><div class="prev_msg">{!! nl2br($product->message) !!}</div>
                    @if($attached_docs)
                    @if(count($attached_docs) > 0)
                    <div>
                        <p style="font-size:15px;font-weight:bold;color:#666">Attached Documents</p>
                        @foreach($attached_docs as $ad)
                        <a target="_blank" href="{{ URL::asset('buying-request-docs/'.$ad->docs.'') }}"><img width="150" height="150" src="{{ URL::asset('buying-request-docs/'.$ad->docs.'') }}" alt=""></a> 
                        @endforeach
                    </div>
                    @endif
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <?php $_id = 1 ?>
    @foreach($prev_quotation as $pq)
        <table class="table show_prev_quotation_tbl" class="collapsed" style="background:#F0F0F0;height:50px">
            <thead style="border:1px solid #ddd!important" data-toggle="collapse" data-messID="{{ $pq->id }}" data-target="#demo{{ $_id }}" class="quotation_tbl_header <?php if($pq->is_view == 0 && $pq->sender != Sentinel::getUser()->id){echo 'view_changer';} ?>">
                <tr>
                    <td>@if($pq->bdtdcInqueryMessageSender)
                          @if($pq->bdtdcInqueryMessageSender->Role_user)
                            @if($pq->bdtdcInqueryMessageSender->Role_user->role_id == 2)
                            <img src="{{URL::to('favicon-16x16.png')}}" alt="bdtdc logo">
                            @else
                            <i class="fa fa-user-plus pull-left" style="margin-top: 1%"></i>
                            @endif
                          @else
                          <i class="fa fa-user-plus pull-left" style="margin-top: 1%"></i>
                          @endif
                        @else
                        <i class="fa fa-user-plus pull-left" style="margin-top: 1%"></i>
                        @endif
                        <div class="toggle_quotation_text">
                            <?php
                                if($user_id == $pq->sender){
                                    ?><span class="badge" style="background: #F1F1F1;color: #666;font-weight: bold">You Wrote:</span> {{ substr($pq->messages,'0','15') }}... <?php
                                }else{
                                    ?><span class="badge" style="background: #F1F1F1;color: darkred;font-weight: bold">{{ $pq->bdtdcInqueryMessageSender->first_name }} {{ $pq->bdtdcInqueryMessageSender->last_name }} Wrote: </span>{{ substr($pq->messages,'0','15') }}...<?php
                                }
                            ?>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td><span class="toggle_quotation_text">at {{ $pq->created_at }}</span></td>
                    <td style="padding:0%"class="text-right"> <i class="fa fa-arrow-circle-down btn btn-xs" style="font-size: 19px;margin-top:1%;<?php if($pq->is_view == 0 && $pq->sender != Sentinel::getUser()->id){echo 'color: green;';} ?>"></i> </td>
                </tr>
            </thead>
            <tbody style="border:1px solid #dce2e6!important" id="demo{{$_id}}" class="collapse">
                <tr style="font-size:13px">
                    <td><a href="{{ URL::to('product-details/'.preg_replace('/[^A-Za-z0-9\. -]/', ' ',$product->name).'='.mt_rand(100000000, 999999999).$product->product_id) }}" target="_blank" style="border:1px solid #ddd;padding:0%" class="col-xs-2 padding_0">
                    @if($product->images)
                    <img src="{{ URL::to($product->images) }}" alt="{{$product->name}}" class="img-responsive" style="height:52px;width:100%">
                    @else
                    <img src="{{ URL::asset('uploads/no-image.jpg') }}" alt="no image" class="img-responsive" style="height:52px;width:100%">
                    @endif
                    <!-- <img src="{-{ URL::asset('uploads/'.$product->image.'') }-}" alt="" class="img-responsive" style="height:52px;width:100%"> -->
                    </a><a href="{{ URL::to('product-details/'.preg_replace('/[^A-Za-z0-9\. -]/', ' ',$product->name).'='.mt_rand(100000000, 999999999).$product->product_id) }}" target="_blank" class="col-xs-9 btn-link">{{ $product->name }}</a></td>
                    <td><input type="text" name="" value="{{ $pq->quantity }}" class="form-control"/></td>
                    <td>{{ $product->unit }}</td>
                    <td><input type="text" name="" class="form-control" placeholder="Asking Unit Price" value="{{ $pq->unit_price }}"></td>
                    <td><input type="text" name="" class="form-control" value="{{ $pq->total }}" readonly></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <?php
                            $person_who_wrote  = ($user_id == $product->sender) ? "<span style='color:#666;font-weight:bold'>You</span>" : "<span style='color:red;font-weight:bold'>Supplier</span>";
                            if($user_id == $pq->sender){
                                ?><span class="badge" style="background: #F1F1F1;color: #666;font-weight: bold">You wrote </span><?php
                            }else{
                                ?><span class="badge" style="background: #F1F1F1;color: darkred;font-weight: bold">Supplier wrote </span><?php
                            }
                        ?>
                        <span class="badge pull-right">at {{ $pq->created_at }}</span><div class="prev_msg">{!! nl2br($pq->messages) !!}</div>
                    </td>
                </tr>

            </tbody>
        </table>
        <?php $_id++ ?>
    @endforeach

    <div class="col-sm-12 padding_0">
        <textarea name="messages" id="" cols="30" rows="2" placeholder="New message" class="form-control"></textarea>
        <input type="submit" value="Send" class="btn btn-sm btn-primary submit_single_msg"/>
    </div>
</form>
@else
<h2 class="text-danger text-muted">Product not available</h2>
@endif