@extends('admin.layouts')
@section('content')
    <div>
        <h1>Manage Products</h1>
        <button id="addProduct" class="btn btn-primary">Add Product</button>
        <div class="table-responsive ProductDataTable">
              
            <table class="table center-aligned-table mt-10 no-footer" id="dataGrid">
            <thead>
              <th>id</th>
              <th>Product name</th>
              <th>Product price </th>
              <th>Product pic</th>
              <th> Edit / Delete </th> 
            </thead>
            <tbody> </tbody> 
              </table>
        </div>

    </div>

    <script>
    $(document).ready(function(e){
        fill_product_table() ;
        function fill_product_table() {
        let target = "{{ url('/get_products') }}";
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
              "data": "product_name",
              "orderable": true,
              "searchable": true,
              "width": "20%",
              "className": "name"
          },
          
          {
              "data": "product_price",
              "orderable": true,
              "searchable": true,
              "width": "10%",
              "className": "price"
          },
          {
              "data": "product_pic",
              "orderable": true,
              "searchable": true,
              "width": "10%",
              "className": "pic"
          },
          {
              "data": "id",
              "orderable": true,
              "searchable": true,
              "width": "10%"
          }
      ],                
          "columnDefs": [
            {
                    "render": function(data, type, row) {
                            var links = "";
                            links += "<a href='javascript:void(0)' data-id='" + row["id"] + "' class='btn btn-success action_link edit' title='View Email Details'>Edit</a>";
                            links += "   ";
                            links += "<a href='javascript:void(0)' data-id='" + row["id"] + "' class='btn btn-danger action_link delete' title='View Email Details'>Delete</a>"
                            
                            return links;
                        },
                        "targets": 4  
                    },{
                    "render": function(data, type, row) {
                        var imgpath = "{{url('/')}}/uploads/products/" + row["product_pic"];
                        img = "<img width="+50+" height="+50+" src='" + imgpath + "' alt=''>";
                        return img ;
                        },
                        "targets":  3 
                    },
                    {
                        "visible": false,
                        "targets": [0]
                    }
                ],
      "pageLength": 10
  });
}




    $("#productAddForm").validate({

        rules: {
            name: {
                required: true,
            },
            price:{
                required: true,
                digits : true 
            } ,
            pic:{
                required: true,
                extension: "jpg|jpeg|png|ico|bmp"
            } 
        }
    });
    $("#productEditForm").validate({

        rules: {
            name: {
                required: true,
            },
            price:{
                required: true,
                digits : true 
            } ,
            pic:{
                required: true,
                extension: "jpg|jpeg|png|ico|bmp"
            } 
        }
    });



    $(document).on('click', '.edit', function(e) {
                
                let id = $(this).data('id')  ; 
                let name = $(this).closest('tr').find('.name').text() ; 
                let price = $(this).closest('tr').find('.price').text() ; 
                let pic = $(this).closest('tr').find('.pic').text() ; 
                
                $('#id').val(id)
                $('#name_edit').val(name)
                $('#price_edit').val(price)
                $('#pro_pic').val(pic)
                

                
                $('#editModal').modal('show');
    });
    $(document).on('click', '.delete', function(e) {
                
                let id = $(this).data('id')  ; 
                let data =  {"id" : id }
                let formData = new FormData();
                Object.keys(data).forEach(key => formData.append(key, data[key]));
                
                $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/delete_products",
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
                        fill_product_table() ;
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
       
   
    $('#productAddForm').submit(function(e) {
         
                e.preventDefault();
                let form = $('#productAddForm')[0] ;
                let formData = new FormData(form) ;
                
                if($("#productAddForm").valid()){
                    $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/add_products",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                    if(data.code == 1){
                        $('#addModal').modal('hide');
                        Swal.fire({
                             position: 'center',
                             icon: 'success',
                             title: data.msg,
                             showConfirmButton: false,
                             timer: 1500
                        });
                        fill_product_table() ;
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

    $('#productEditForm').submit(function(e) {
         
                e.preventDefault();
                let form = $('#productEditForm')[0] ;
                let formData = new FormData(form) ;
                
                if($("#productEditForm").valid()){
                    $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/edit_products",
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
                        fill_product_table() ;
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


    

            $(document).on('click' , '#addProduct' ,function(e){
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