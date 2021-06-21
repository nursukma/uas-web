<title>Menu</title>
{{-- @extends('layouts.app') --}}
  @extends('layouts.header')
  @section('content')
@if($user == 'Admin')
    <div class="site-section" style='margin-top:60px;' id="products-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-6 text-center">
            <h3 class="section-sub-title">List All Menu</h3>
            <h2 class="section-title mb-3">Menu</h2>
          </div>
        </div>
        <div class="panel-head" style='margin-bottom:10px;'>
          <a href='{{route("menu.create")}}' class="btn btn-info modal-show">Tambah Produk</a>
          {{-- <a href='{{route("pdf-product")}}' class="btn btn-default" title='Report'>Report</a> --}}
          
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-body">
        <table id='datatable' width='100%' class='table table-hover'>
          <thead>
            <th> No </th>
            <th> Nama </th>
            {{-- <th> Category </th> --}}
            <th> Harga</th>
            <th> Stok</th>
            <th> Keterangan</th>
            <th> Photo</th>
            <th> Action </th>
          </thead>
          <tbody>
          </tbody>
        </table>
        </div>
      </div>
    </div>
@endsection
@push('scripts')
  <script>
    $('#datatable').DataTable({
      responsive:true,
      processing:true,
      serverSide:true,
      ajax:'{{route("table-menu")}}',
      columns: [
        {data: 'DT_RowIndex',name: 'id_menu'},
        {data: 'nama_menu',name: 'nama_menu'},
        // {data: 'category',name: 'category'},
        {data: 'harga',name: 'harga'},
        {data: 'jumlah',name: 'jumlah'},
        {data: 'keterangan',name: 'keterangan'},
        {data: 'photo',name: 'photo'},
        {data: 'action',name: 'action'}
      ]
    })
  </script>
@endpush
@else
<script>
window.location.replace('/');
</script>
@endif