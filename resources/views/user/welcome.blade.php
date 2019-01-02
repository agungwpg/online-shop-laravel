@extends('user.component.master-user')
@section('slider')
@if(\Session::has('success-register'))
  <script>
    alert('Register Success! Now you can order our product by online');
  </script>
@endif
@if(\Session::has('success-confirm'))
  <script>
    alert('Confirmation success, further information about package information will be informed trough SMS !');
  </script>
@endif

<div id="carouselBlk">
  <?php
    $i = 0;
  ?>
  <div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
      @foreach(\App\Slides::all() as $data)
      @if($i == 0)
        <div class="item active">
      @else
        <div class="item">
      @endif
        <div class="container">
          <a href=""><img style="width:100%; height: 500px" src="{{ asset($data->picture) }}" alt="special offers"/></a>
          <!-- <div class="carousel-caption">
            <h4>Second Thumbnail label</h4>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          </div> -->
        </div>
      </div>
      <?php $i++;?>
      @endforeach
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
  </div>
</div>



@stop
@section('content')
<div class="span9">
  <h4>Latest Products </h4>
  <ul class="thumbnails">
    @foreach(\App\Products::all() as $data)
    <li class="span3">
      <div class="thumbnail">
        <div style="width:100px;height:100px;margin-left: auto; margin-right: auto;">
          <a href="{{ route('detail-product',$data->id) }}"><img src="{{ asset($data->picture) }}" style="width:100px;height:100px" alt=""/></a>
        </div>
        <div class="caption">
          <h5>{{ $data->name }}</h5>
          <p>{{ \App\Category::where('id',$data->id_category)->pluck('name')->first() }}</p>
          <!-- <p>
            Lorem Ipsum is simply dummy text.
          </p> -->

          <h4 style="text-align:center"><a class="btn" href="{{ route('detail-product',$data->id) }}"> <i class="icon-zoom-in"></i></a> <a class="btn btn-primary" href="#">Rp {{ number_format($data->netprice) }}</a></h4>
        </div>
      </div>
    </li>
    @endforeach
  </ul>

</div>
@stop
@section('custom-script')
<script>
  var flag = 0;
</script>
@stop
