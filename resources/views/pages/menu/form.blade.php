@if($model==null)
<form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="" class="control-label">Nama Menu</label>
      <input type="text" class="form-control" name="nama_menu" id="nama_menu">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Harga</label>
      <input type="number" class="form-control" name="harga" id="harga">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Stok</label>
      <input type="text" class="form-control" name="jumlah" id="jumlah">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Photo</label>
      <input type="file" class="form-control" name="photo" id="photo">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Keterangan</label>
      <input type="text" class="form-control" name="keterangan" id="keterangan">
    </div>
    <button class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" id='modal-btn-save'>Tambah</button>
@else
<form action="{{ route('menu.update',$model->id_menu) }}" method="POST" enctype="multipart/form-data">
@csrf
    <input name="_method" type="hidden" value="PUT">
    <div class="form-group">
      <label for="" class="control-label">Nama Menu</label>
      <input type="text" class="form-control" name="nama_menu" value="{{$model->nama_menu}}" id="nama_menu">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Harga</label>
      <input type="number" class="form-control" name="harga" value="{{$model->harga}}" id="harga">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Stok</label>
      <input type="text" class="form-control" name="jumlah" value="{{$model->jumlah}}" id="jumlah">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Photo</label>
        <img width='300px' src="{{asset('/images/menu/'.$model->photo)}}">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Photo</label>
      <input type="file" class="form-control" name="photo" value="{{asset('images/menu/'.$model->photo)}}" id="photo">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Keterangan</label>
      <input type="text" class="form-control" name="keterangan" value="{{$model->keterangan}}" id="keterangan">
    </div>
    <button class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" id='modal-btn-save'>Update</button>
@endif