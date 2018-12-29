@extends('user.component.master-user')
@section('content')
<div class="span9">
  <h4>Search Result </h4>
  <ul class="thumbnails">
    @if($category == 0)
      @foreach(\App\Products::where('name','like','%'.$name.'%')->orderBy('created_at','desc')->get() as $data)
      <li class="span3">
        <div class="thumbnail">
          <div style="width:100px;height:100px;margin-left: auto; margin-right: auto;">
            <a href="{{ route('detail-product',$data->id) }}"><img src="{{ asset($data->picture) }}" alt=""/></a>
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
    @else
      @foreach(\App\Products::where('name','like','%'.$name.'%')->where('id_category',$category)->orderBy('created_at','desc')->get() as $data)
      <li class="span3">
        <div class="thumbnail">
          <a href="product_details.html"><img src="{{ asset($data->picture) }}" alt=""/></a>
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
    @endif

  </ul>

</div>
@stop
@section('custom-script')
<script>
  var flag = 1;
</script>
@stop
