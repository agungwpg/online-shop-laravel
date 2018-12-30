@extends('user.component.master-user')
@section('content')
<div class="span9">
  <ul class="breadcrumb">
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li><a href="products.html">Products</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
  </ul>
  <div class="row">
    <div id="gallery" class="span3">
        <img src="{{ asset($pr->picture) }}" style="width:100%" alt="{{ $pr->name }}"/>
      <div id="differentview" class="moreOptopm carousel slide">
        <!-- <div class="carousel-inner">
          <div class="item active">
            <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
            <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
            <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
          </div>
          <div class="item">
            <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
            <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
            <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
          </div>
        </div> -->
        <!--
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
      -->
    </div>

    <!-- <div class="btn-toolbar">
      <div class="btn-group">
        <span class="btn"><i class="icon-envelope"></i></span>
        <span class="btn" ><i class="icon-print"></i></span>
        <span class="btn" ><i class="icon-zoom-in"></i></span>
        <span class="btn" ><i class="icon-star"></i></span>
        <span class="btn" ><i class=" icon-thumbs-up"></i></span>
        <span class="btn" ><i class="icon-thumbs-down"></i></span>
      </div>
    </div> -->
  </div>
  <div class="span6">
    <h3>{{ $pr->name }}  </h3>
    <!-- <small>- (14MP, 18x Optical Zoom) 3-inch LCD</small> -->
    <hr class="soft"/>
    <form class="form-horizontal qtyFrm" action="{{ route('addcart',$pr->id) }}" method="post">
      {{ csrf_field() }}
      <div class="control-group">
        <label class="control-label"><span>Rp {{ number_format($pr->netprice) }} / item</span></label>
        <input type="hidden" name="price" value="{{ $pr->netprice }}">
        <div class="controls">
          <input type="number" name="qty" class="span1 txt-qty" placeholder="Qty."/>
          <button type="button" class="btn btn-large btn-primary pull-right btn-add-cart"> Add to cart <i class=" icon-shopping-cart"></i></button>
        </div>
      </div>
    </form>

    <hr class="soft"/>
    <h4>{{ $pr->stock}} items in stock</h4>
    <hr class="soft clr"/>
    <p>
      {{ $pr->description }}
    </p>
    <br class="clr"/>
    <a href="#" name="detail"></a>
    <hr class="soft"/>
  </div>

  <div class="span9">
    <ul id="productDetail" class="nav nav-tabs">
      <li class="active"><a href="#profile" data-toggle="tab">Related Products</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade active in" id="profile">
        <br class="clr"/>
        <hr class="soft"/>
        <div class="tab-content">
          <div class="tab-pane active" id="blockView">
            <ul class="thumbnails">
              @foreach(\App\Products::where('id_category',$pr->id_category)->where('id','<>',$pr->id)->inRandomOrder()->take(6)->get() as $data)
              <li class="span3">
                <div class="thumbnail">
                  <a href="product_details.html"><img src="{{ asset($data->picture) }}" style="width:100px;height:100px" alt=""/></a>
                  <div class="caption">
                    <h5>{{ $data->name }}</h5>
                    <!-- <p>
                      Lorem Ipsum is simply dummy text.
                    </p> -->

                    <h4 style="text-align:center"><a class="btn" href="{{ route('detail-product',$data->id) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rp {{ number_format($data->netprice) }}</a></h4>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
            <hr class="soft"/>
          </div>
        </div>
        <br class="clr">
      </div>
    </div>
  </div>

</div>
</div>
@stop

@section('custom-script')
<script>
$(".btn-add-cart").click(function(){

  if($(".txt-qty").val() == "")
  {
    alert("please fill product quantity")
  }
  else {
    var conf = confirm('are you sure want to add this item to yout cart ?');

    if(conf == true)
    {
      alert("item added to cart");
      $(".qtyFrm").submit();
    }
  }


});
</script>
@stop
