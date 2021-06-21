<head>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Restoran Mewah</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">    
	<!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- Start header -->
<header class="top-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-top : -200px">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="images/logo.png" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-rs-food">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu.html">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-a">
                            <a class="dropdown-item" href="reservation.html">Reservation</a>
                            <a class="dropdown-item" href="stuff.html">Stuff</a>
                            <a class="dropdown-item" href="gallery.html">Gallery</a>
                        </div>
                    </li> --}}
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Blog</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-a">
                            <a class="dropdown-item" href="blog.html">blog</a>
                            <a class="dropdown-item" href="blog-details.html">blog Single</a>
                        </div>
                    </li> --}}
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    @if($check)
                    <li class="nav-item"><a class="nav-link" href="logout">Logout</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="login">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
@include('layouts._modal')
<div style="margin-top: 200px">
    @yield('content')
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- End header -->
<script>
// --------------------- Tampil Modal -----------------------
$('body').on('click','.modal-show',function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr("href"),
        method = url.indexOf('edit'),
        title = me.attr("title");
    $('#modal-title').text(title);
    $('#modal-btn-save').show().text(me.hasClass('edit')?'Update Product':'Add Product');
    $.ajax({
        url:url,
        dataType:"html",
        success: function(response){
            $('#modal-body').html(response);
            // if(method != -1){
            //     var src = $('#photo').val();
            //     $('#uploaded_image').html('<img src="/images/'+src+'" id="image" name="image" width="300" height/>');
            // }
        },
        error: function(jqXHR,textStatus,errorThrown){
            if(errorThrown == 'Unauthorized'){
                swal({
                    icon:'error',
                    title:'Oops...',
                    text:'You must logged in to do this !'
                })
                $('#modal').modal('hide');
            }
            else{
                swal({
                    icon:'error',
                    title:'Oops...',
                    text:'Something went wrong!'
                })
                $('#modal').modal('hide');
            }
        }
    });
    $('#modal').modal('show');
});
// ----------------- Add Jumlah ------------------------
$('body').on('click','#item',function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr("href"),
        title = me.attr("title");
    $('#modal-title').text(title);
    $('#modal-btn-save').show().text('Add to Cart');
    $.ajax({
        url:url,
        dataType:"html",
        success: function(response){
            $('#modal-body').html(response);
        },
        error: function(jqXHR,textStatus,errorThrown){
            if(errorThrown == 'Unauthorized'){
                swal({
                    icon:'error',
                    title:'Oops...',
                    text:'You must logged in to do this !'
                })
                $('#modal').modal('hide');
            }
            else{
                swal({
                    icon:'error',
                    title:'Oops...',
                    text:'Something went wrong!'
                })
                $('#modal').modal('hide');
            }
        }
    });
    $('#modal').modal('show');
});
// ---------------------------- Delete Data ---------------
$('body').on('click','.btn-delete',function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: 'Are you sure want to delete '+title+' ?',
        text: 'You won\'t be able to revert this !',
        icon: 'warning',
        buttons : [true,'Yes , delete it !'],
        dangerMode :true,
    }).then((value)=>{
        if(value){
            $.ajax({
                url:url,
                type:'POST',
                data:{
                    '_method':'DELETE',
                    '_token' : csrf_token
                },
                success:function(response){
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        icon:'success',
                        title:'Success !',
                        text: 'Data has been deleted !'
                    })
                },
                error:function(xhr){
                    swal({
                        icon:'error',
                        title:'Oops...',
                        text:'Something went wrong!'
                    })
                }
            })
        }
    })
})
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
@stack('scripts');