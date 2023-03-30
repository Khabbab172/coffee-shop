@extends('admin.layouts')
@section('content')
    <div>
        <h1>Manage Customers</h1>
        <button id="addCust" class="btn btn-primary">Add Customer</button>
        <div class="table-responsive cusDataTable">
              
            <table class="table center-aligned-table mt-10 no-footer" id="dataGrid">
            <thead>
              <th>id</th>
              <th>name</th>
              <th>email</th>
              <th>phone</th>
              <th> edit / delete </th> 
            </thead>
            <tbody> </tbody> 
              </table>
        </div>

    </div>

    {{-- Add Model --}}
    <div class="modal hide" id="addModal" style="display: none">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add new customer</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                <div class="mt-20">
                    <form id="custAddForm" method="POST" >
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Name <span class="mendatory">*</span></label>
                            <input type="text" id="name" name="name" class="form-control required" placeholder="name">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email <span class="mendatory">*</span></label>
                            <input type="text" id="email" name="email" class="form-control required" placeholder="email">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Phone number <span class="mendatory">*</span></label>
                            <input type="text" id="phone" name="phone" class="form-control required" placeholder="phone">
                        </div>
                        <button type="submit" class="btn btn-primary"> Add </button>
                    </form>
                </div>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button id="close" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>
    {{-- Edit Modal --}}
    <div class="modal hide" id="editModal" >
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit customer</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                <div class="mt-20">
                    <form id="custEditForm" method="POST" >
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Name <span class="mendatory">*</span></label>
                            <input type="text" id="name_edit" name="name" class="form-control required" placeholder="name">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email <span class="mendatory">*</span></label>
                            <input type="text" id="email_edit" name="email" class="form-control required" placeholder="email">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Phone number <span class="mendatory">*</span></label>
                            <input type="text" id="phone_edit" name="phone" class="form-control required" placeholder="phone">
                        </div>
                        <input id="id"  name="id" type="text" value="" style="display: none">
                        <button type="submit" class="btn btn-primary"> Edit </button>
                    </form>
                </div>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button id="close_edt" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>
    <script>
    $(document).ready(function(e){
        fill_customer_table() ;
        function fill_customer_table() {
        let target = "{{ url('/get_customers') }}";
        let table = $('#dataGrid').DataTable({
      "autoWidth": false,
      "paging": true,
      "destroy": true,
      "processing": true,
      "responsive": true,
      ajax: {
      "url": target,
      "type": "get"
      },
      order: [
          [0, "asc"]
      ],
      
      columns: [
          {
              "data": "id",
              "orderable": true,
              "searchable": true,
              "width": "10%"
              
          },
          {
              "data": "name",
              "orderable": true,
              "searchable": true,
              "width": "20%",
              "className": "name"
          },
          
          {
              "data": "email",
              "orderable": true,
              "searchable": true,
              "width": "10%",
              "className": "email"
          },
          {
              "data": "phone",
              "orderable": true,
              "searchable": true,
              "width": "10%",
              "className": "phone"
          },
          {
              "data": "id",
              "orderable": true,
              "searchable": true,
              "width": "10%"
          }
      ],                
          "columnDefs": [{
                    "render": function(data, type, row) {
                            var links = "";
                            links += "<a href='javascript:void(0)' data-id='" + row["id"] + "' class='btn btn-success action_link edit' title='View Email Details'>Edit</a>";
                            links += "   ";
                            links += "<a href='javascript:void(0)' data-id='" + row["id"] + "' class='btn btn-danger action_link delete' title='View Email Details'>Delete</a>"
                            
                            return links;
                        },
                        "targets":  4
                    },
                    {
                        "visible": false,
                        "targets": [0]
                    }
                ],
      "pageLength": 10
  });
}




        $("#custAddForm").validate({

        rules: {
            name: {
                required: true,
                lettersonly: true 
            },
            email:{
                required: true,
                email : true 
            } ,
            phone:{
                required: true,
                digits: true ,
                phoneUS: true
            } 
        }
    });
    $("#custEditForm").validate({

        rules: {
            name: {
                required: true,
                lettersonly: true 
            },
            email:{
                required: true,
                email : true 
            } ,
            phone:{
                required: true,
                digits: true ,
                phoneUS: true
            } 
        }
    });



    $(document).on('click', '.edit', function(e) {
                
                let id = $(this).data('id')  ; 
                let name = $(this).closest('tr').find('.name').text() ; 
                let email = $(this).closest('tr').find('.email').text() ; 
                let phone = $(this).closest('tr').find('.phone').text() ; 
                
                $('#id').val(id)
                $('#name_edit').val(name)
                $('#email_edit').val(email)
                $('#phone_edit').val(phone)
                

                
                $('#editModal').modal('show');
    });
    $(document).on('click', '.delete', function(e) {
                
                let id = $(this).data('id')  ; 
                let data =  {"id" : id }
                let formData = new FormData();
                Object.keys(data).forEach(key => formData.append(key, data[key]));
                
                $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/delete_customer",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                    if(data.code == 1){
                        Swal.fire({
                             position: 'center',
                             icon: 'success',
                             title: data.msg,
                             showConfirmButton: false,
                             timer: 1500
                        });
                        fill_customer_table() ;
                    }else{
                        Swal.fire({
                             position: 'center',
                             icon: 'error',
                             title: data.msg,
                             showConfirmButton: false,
                             timer: 1500
                        });
                    }

                    }
                });          
    });
       
   
    $('#custAddForm').submit(function(e) {
         
                e.preventDefault();
                let form = $('#custAddForm')[0] ;
                let formData = new FormData(form) ;
                
                if($("#custAddForm").valid()){
                    $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/add_customer",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                    if(data.code == 1){
                        $('#addModal').model('hide');
                        Swal.fire({
                             position: 'center',
                             icon: 'success',
                             title: data.msg,
                             showConfirmButton: false,
                             timer: 1500
                        });
                        fill_customer_table() ;
                        $('#name').val('');
                        $('#email').val('');
                        $('#phone').val(''); 

                    }else{
                        Swal.fire({
                             position: 'center',
                             icon: 'error',
                             title: data.msg,
                             showConfirmButton: false,
                             timer: 1500
                        });
                    }

                    }
                   });
                }

                
            });

    $('#custEditForm').submit(function(e) {
         
                e.preventDefault();
                let form = $('#custEditForm')[0] ;
                let formData = new FormData(form) ;
                
                if($("#custEditForm").valid()){
                    $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/edit_customer",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        
                    if(data.code == 1){
                        $('#editModal').modal('hide');
                        Swal.fire({
                             position: 'center',
                             icon: 'success',
                             title: data.msg,
                             showConfirmButton: false,
                             timer: 1500
                        });
                        fill_customer_table() ;
                        $('#name_edit').val('');
                        $('#email_edit').val('');
                        $('#phone_edit').val(''); 

                    }else{
                        Swal.fire({
                             position: 'center',
                             icon: 'success',
                             title: data.msg,
                             showConfirmButton: false,
                             timer: 1500
                        });
                    }

                    }
                   });
                }

                
            });


    

            $(document).on('click' , '#addCust' ,function(e){
                $('#addModal').modal('show');
            });


            $(document).on('click' , '#close' , function(e){
                $('#addModal').modal('hide');
                $('#name').val('');
                $('#email').val('');
                $('#phone').val('');   
                
            });
            $(document).on('click' , '#close_edt' , function(e){
                $('#editModal').modal('hide');
                $('#name_edit').val('');
                $('#email_edit').val('');
                $('#phone_edit').val('');   
                
            });
            
        });
    
    </script>
@endsection