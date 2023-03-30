@extends('customer.layouts')
@section('content')
<style>
    .dark{
        color: black ;
        font-weight: 700 ;
        font-size: 20px ;
    }
</style>
<div>
    <form action="/buy_coffee" id="order" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-2">
                <h1>Product</h1>
            </div>
            <div class="col-sm-4 mt-auto">
                <label class="border border-info" for="btn"><span class="dark">Wallet  :</span> 
                    <span id="wallet" ></span>
                </label>
            </div>
        </div>
    <div class="table-responsive ProductDataTable">
        <table class="table center-aligned-table mt-10 no-footer" id="dataGrid">
            <thead>
                <th>id</th>
                <th>Product name</th>
                <th>Product price </th>
                <th>Product pic</th>
                <th> Quantity </th> 
                <th> Add </th> 
                <th> Total </th> 
            </thead>
            <tbody> </tbody> 
        </table>
</div>
</form>

</div>

{{-- Add modal --}}
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
                <form id="productAddForm" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Product Name <span class="mendatory">*</span></label>
                        <input type="text" id="name" name="name" class="form-control required" placeholder="name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Product Price <span class="mendatory">*</span></label>
                        <input type="text" id="price" name="price" class="form-control required" placeholder="email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Product Pic <span class="mendatory">*</span></label>
                        <input type="file" id="pic" name="pic" class="form-control required" placeholder="phone">
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
                <form id="productEditForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Product Name <span class="mendatory">*</span></label>
                        <input type="text" id="name_edit" name="name" class="form-control required" placeholder="name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Product Price<span class="mendatory">*</span></label>
                        <input type="text" id="price_edit" name="price" class="form-control required" placeholder="email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Product Pic <span class="mendatory">*</span></label>
                        <input type="file" id="edtpic" name="pic" class="form-control required" placeholder="phone">
                    {{-- <input id="pro_pic" type="file" style="display: none"> --}}
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
    fill_product_table() ;
    fill_wallet() ;
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
          "width": "5%"
          
      },
      {
          "data": "product_name",
          "orderable": true,
          "searchable": true,
          "width": "15%",
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
          "width": "15%"
      },
      {
          "data": "id",
          "orderable": true,
          "searchable": true,
          "width": "10%"
      },
      {
          "orderable": true,
          "searchable": true,
          "width": "10%"
      }
  ],                
      "columnDefs": [
        {
                "render": function(data, type, row) {
                        let inpt = "" ;
                        inpt = "<input type='text' value='"+0+"'  name='name' class='form-control required inptquantity'>";
                        inpt += "<a href='javascript:void(0)' data-id='" + row["id"] + "' class='btn btn-success btn-sm action_link quantity' title='View Email Details'>increase quantity</a>";
                        
                        return inpt;
                    },
                    "targets": 4  
                },
                {
                "render": function(data, type, row) {
                    var imgpath = "{{url('/')}}/uploads/products/" + row["product_pic"];
                    img = "<img width="+50+" height="+50+" src='" + imgpath + "' alt=''>";
                    return img ;
                    },
                    "targets":  3 
                },
                {
                "render": function(data, type, row) {
                    let inpt = "" ;
                        inpt += "<a href='javascript:void(0)' data-id='" + row["id"] + "' class='btn  btn-warning action_link buy' title='View Email Details'>Buy</a>";
                        return inpt;
                    },
                    "targets":  5 
                },
                {
                "render": function(data, type, row) {
                    let inpt = "" ;
                        inpt += "<span class='total'  >0</span>";
                        return inpt;
                    },
                    "targets":  6 
                },
                {
                    "visible": false,
                    "targets": [0]
                }
            ],
  "pageLength": 10
});
}

function fill_wallet(){
    $.ajax({
                type: "GET",
                url: "{{url('/')}}/wallet",
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $('#wallet').text(data.wallet + " " +  '₹') ;
                }
        });
    
}



$(document).on('click' , '.quantity' , function(e){
    let id = $(this).data('id')  ;
    let quantity = $(this).closest('tr').find('.inptquantity').val(); 
    let price = $(this).closest('tr').find('.price').text(); 
    price = Number(price)  ;
    quantity = Number(quantity) + 1 ;
    let total = quantity * price ;
    $(this).closest('tr').find('.inptquantity').val(quantity)
    $(this).closest('tr').find('.total').text(total)
   
});


$(document).on('click' , '.buy' , function(e){
    let id = $(this).data('id')  ;
    let quantity = $(this).closest('tr').find('.inptquantity').val(); 
    let price  =  $(this).closest('tr').find('.price').text(); 
    let name  =  $(this).closest('tr').find('.name').text(); 
    let total =    $(this).closest('tr').find('.total').text() ;
 
    let data =  {"id" : id    ,  'name':name, "quantity" : quantity , 'price':price   , 'total':total }
    let formData = new FormData();
    Object.keys(data).forEach(key => formData.append(key, data[key]));

    $.ajax({
                type: "POST",
                url: "{{url('/')}}/buy_coffee",
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
                    fill_wallet() ;
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
    
                
   
});












            
         
});


</script>
@endsection