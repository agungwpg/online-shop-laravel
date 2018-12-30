<table class="table table-bordered table-striped tables2">
  <thead>
    <tr>
      <th>Product</th>
      <th>Qty</th>
      <th>Price/Item</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
  @foreach(\App\OrderDetail::where('id_order',$id)->get() as $data)
      <tr>
        <td>{{ \App\Products::where('id',$data->id_products)->pluck('name')->first() }}</td>
        <td>{{ $data->qty }}</td>
        <td>{{ $data->net_price }}</td>
        <td>{{ $data->net_price*$data->qty }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
