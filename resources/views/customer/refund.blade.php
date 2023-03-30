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
    <form  id="order" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-2">
                <h1>Refund</h1>
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
                <th>Quantity</th>
                <th> Total </th> 
                <th> Apply for refund </th> 
            </thead>
            <tbody> </tbody> 
        </table>
</div>
</form>

</div>


<script>

$(document).ready(function(e){
    fill_cart_table() ;
    fill_wallet() ;
    function fill_cart_table() {
    let target = "{{ url('/get_cart_data') }}";
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
          "data": "quantity",
          "orderable": true,
          "searchable": true,
          "width": "15%" ,
          "className": "quantity"
      },
      {
          "data": "total_amt",
          "orderable": true,
          "searchable": true,
          "width": "10%",
          "className": "total_amt"
      },
      {   "data": "id",
          "orderable": true,
          "searchable": true,
          "width": "10%"
      },
      
  ],                
      "columnDefs": [
                {
                "render": function(data, type, row) {
                    if( row["is_refund"]  == 1 ){
                        let inpt = "" ;
                        inpt += "<button href='javascript:void(0)'  data-id='" + row["id"] + "' class='btn  btn-info action_link refund' title='View Email Details' disabled>In process...</button>";
                        return inpt;
                    }else if(row["is_refund"]  == 0){
                        let inpt = "" ;
                        inpt += "<a href='javascript:void(0)'  data-id='" + row["id"] + "' class='btn  btn-info action_link refund' title='View Email Details' >Refund</a>";
                        return inpt;
                    }
                    
                    },
                    "targets":  5 
                },
                {
                    "visible": false,
                    "targets": [0]
                }
            ],
  "pageLength": 5
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


$(document).on('click' , '.refund' , function(e){
    let id = $(this).data('id')  ;
    let data =  {"id" : id   } ;
    let formData = new FormData();
    Object.keys(data).forEach(key => formData.append(key, data[key]));

    $.ajax({
                type: "POST",
                url: "{{url('/')}}/apply_for_refund",
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
                    fill_cart_table() ;
                    fill_wallet() ;

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