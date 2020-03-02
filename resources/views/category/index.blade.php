@extends('layouts.admin')
@push('customcss')
<script type="text/javascript" src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>
@endpush
  @section('title','Nama Event')
  @section('page-title','Nama Event')
  @section('navbar')
  <nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto" action="{{url('search')}}">
      <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
      </ul>
      <div class="search-element">
        <input class="form-control" type="search" name="q" placeholder="Cari Bidang Usaha" aria-label="Search" data-width="250">
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        
      </div>
    </form>
    
    <ul class="navbar-nav navbar-right">
      
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="{{asset('stisla/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->name}}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
          onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
           <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
         </form>
        </div>
      </li>
    </ul>
  </nav>
  

  <div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
           <div class="modal-body">
            <span id="form_result"></span>
            <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
             @csrf
             <div class="form-group">
               <label>Nama Event </label>
               <div>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" />
               </div>
              </div>
              <div class="form-group">
                <label>Slug </label>
                <div>
                 <input type="text" name="slug" id="slug" class="form-control" />
                </div>
               </div>
               <div class="form-group">
                <label>Gambar </label>
                <div>
                  <input type="file" name="gambarkategori" id="gambarkategori" />
                  <span id="store_image"></span>
                </div>
               </div>
              <br />
              <div class="form-group" align="center">
               <input type="hidden" name="action" id="action" />
               <input type="hidden" name="hidden_id" id="hidden_id" />
               <input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Add" />
              </div>
            </form>
           </div>
        </div>
       </div>
   </div>
   
   <div id="confirmModal" class="modal fade" role="dialog">
       <div class="modal-dialog">
           <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
               <div class="modal-body">
                   <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
               </div>
               <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
               </div>
           </div>
       </div>
   </div>
  @endsection
  @section('head')
  <div class="section-header">
    <h1>@yield('page-title')</h1>
  </div>
  @endsection
  @section('content')
  <div class="card">
    <div class="card-header">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Category</button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped" id="user_table">
          <thead>
            <tr>
              <th>Aksi</th>
              <th>Nama</th>
              <th>Slug</th>
              <th>Foto</th>
              
            </tr>
          </thead>
          
        </table>
      </div>
    </div>
  </div>

                
                 

                 <script>
                 $(document).ready(function(){
                 
                  $('#user_table').DataTable({
                   processing: true,
                   serverSide: true,
                   ajax:{
                    url: "{{ route('category.index') }}",
                   },
                   columns:[
                    {
                     data: 'action',
                     name: 'action',
                     orderable: false
                    },
                    {
                     data: 'nama_kategori',
                     name: 'nama_kategori'
                    },
                    {
                     data: 'slug',
                     name: 'slug'
                    },
                    {
                     data: 'gambarkategori',
                     name: 'gambarkategori',
                     render: function(data, type, full, meta){
                      return "<a target='_blank' href={{ URL::to('/') }}/uploads/category/" + data + "><img src={{ URL::to('/') }}/uploads/category/" + data + " width='70' class='img-thumbnail' /></a>";
                     },
                     orderable: false
                    }
                    
                   ]
                  });
                 
                  $('#create_record').click(function(){
                   $('.modal-title').text("Add New Record");
                      $('#action_button').val("Add");
                      $('#action').val("Add");
                      $('#formModal').modal('show');
                  });
                 
                  $('#sample_form').on('submit', function(event){
                   event.preventDefault();
                   if($('#action').val() == 'Add')
                   {
                    $.ajax({
                     url:"{{ route('category.store') }}",
                     method:"POST",
                     data: new FormData(this),
                     contentType: false,
                     cache:false,
                     processData: false,
                     dataType:"json",
                     success:function(data)
                     {
                      var html = '';
                      if(data.errors)
                      {
                       html = '<div class="alert alert-danger">';
                       for(var count = 0; count < data.errors.length; count++)
                       {
                        html += '<p>' + data.errors[count] + '</p>';
                       }
                       html += '</div>';
                      }
                      if(data.success)
                      {
                       html = '<div class="alert alert-success">' + data.success + '</div>';
                       $('#sample_form')[0].reset();
                       $('#user_table').DataTable().ajax.reload();
                      }
                      $('#form_result').html(html);
                     }
                    })
                   }
                 
                   if($('#action').val() == "Edit")
                   {
                    $.ajax({
                     url:"{{ route('category.update') }}",
                     method:"POST",
                     data:new FormData(this),
                     contentType: false,
                     cache: false,
                     processData: false,
                     dataType:"json",
                     success:function(data)
                     {
                      var html = '';
                      if(data.errors)
                      {
                       html = '<div class="alert alert-danger">';
                       for(var count = 0; count < data.errors.length; count++)
                       {
                        html += '<p>' + data.errors[count] + '</p>';
                       }
                       html += '</div>';
                      }
                      if(data.success)
                      {
                       html = '<div class="alert alert-success">' + data.success + '</div>';
                       $('#sample_form')[0].reset();
                       $('#store_image').html('');
                       $('#user_table').DataTable().ajax.reload();
                      }
                      $('#form_result').html(html);
                     }
                    });
                   }
                  });
                 
                  $(document).on('click', '.edit', function(){
                   var id = $(this).attr('id');
                   $('#form_result').html('');
                   $.ajax({
                    url:"/category/"+id+"/edit",
                    dataType:"json",
                    success:function(html){
                     $('#nama_kategori').val(html.data.nama_kategori);
                     $('#slug').val(html.data.slug);
                     $('#store_image').html("<img src={{ URL::to('/') }}/uploads/category/" + html.data.gambarkategori + " width='70' class='img-thumbnail' />");
                     $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.gambarkategori+"' />");
                     $('#hidden_id').val(html.data.id);
                     $('.modal-title').text("Edit New Record");
                     $('#action_button').val("Edit");
                     $('#action').val("Edit");
                     $('#formModal').modal('show');
                    }
                   })
                  });
                 
                  var user_id;
                 
                  $(document).on('click', '.delete', function(){
                   user_id = $(this).attr('id');
                   $('#confirmModal').modal('show');
                  });
                 
                  $('#ok_button').click(function(){
                   $.ajax({
                    url:"category/destroy/"+user_id,
                    beforeSend:function(){
                     $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                     setTimeout(function(){
                      $('#confirmModal').modal('hide');
                      $('#user_table').DataTable().ajax.reload();
                     }, 2000);
                    }
                   })
                  });
                 
                 });
                 </script>
   
  @endsection