@extends('customer.layouts')
@section('content')
    

    
    <section class="w-100 px-4 py-5" style="background-color: #f4f5f7; border-radius: .3rem .3rem 0 0;">
      <style>
        .gradient-custom {
          /* fallback for old browsers */
          background: #f6d365;

          /* Chrome 10-25, Safari 5.1-6 */
          background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

          /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
          background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
      </style>
      <div class="row d-flex justify-content-center">
        <div class="col col-lg-7 mb-4 mb-lg-0">
          <div class="card" style="border-radius: .5rem;">
            <div class="row g-0">
              <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <img id="profile_pic" src="" alt="avatar" class="img-fluid my-5" style="width: 80px;">
                <h5 id="name"></h5>
                <i class="far fa-edit mb-5"></i>
                <button id="edit" class="mt-20 btn btn-sm btn-primary">Edit profile</button>
              </div>
              <div class="col-md-8">
                <div class="card-body p-4">
                  <h6>Information</h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Email</h6>
                      <p id="email" class="text-muted"></p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Phone</h6>
                      <p id="phone" class="text-muted"></p>
                    </div>
                  </div>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Cart</h6>
                      <p id="cart" class="text-muted"></p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Wallet</h6>
                      <p id="wallet" class="text-muted"></p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-start">
                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
        {{-- Edit Modal --}}
        <div class="modal hide" id="editModal" >
            <div class="modal-dialog">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Edit Profile</h4>
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
                            <div class="form-group mb-2">
                                <label for="email">Profil pic <span class="mendatory">*</span></label>
                                <input type="file" id="pic" name="pic" class="form-control required" placeholder="phone">
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
    $(document).ready(function(){
        get_customer_data() ;
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
                },
                pic:{
                required: true,
                extension: "jpg|jpeg|png|ico|bmp"
            }  
            }
    });

    $(document).on('click' , '#edit' ,function(e){
        $('#name_edit').val($('#name').text())   ;
        $('#email_edit').val($('#email').text());
        $('#phone_edit').val($('#phone').text());
        $('#editModal').modal('show');
    });
    $(document).on('click' , '#close_edt' , function(e){
                $('#editModal').modal('hide');
                $('#name_edit').val('');
                $('#email_edit').val('');
                $('#phone_edit').val('');   
                
    });
    $('#custEditForm').submit(function(e) {
         
         e.preventDefault();
         let form = $('#custEditForm')[0] ;
         let formData = new FormData(form) ;
         
         if($("#custEditForm").valid()){
             $.ajax({
             type: "POST",
             url: "{{url('/')}}/edit_profile",
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
                 get_customer_data() ;
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

function  get_customer_data(){  
        $.ajax({

        type: "GET",
        url: "{{url('/')}}/get_customer_data",
        processData: false,
        contentType: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            if(data.data.profile_pic == null){
                $('#profile_pic').attr('src', "{{ asset('images/site_pics/user.png') }}");
            }else{
                var imgpath = "{{url('/')}}/uploads/profile_pic/" + data.data.profile_pic ;
                $('#profile_pic').attr('src', imgpath);
            }
            $('#name').text(data.data.name);
            $('#email').text(data.data.email);
            $('#phone').text(data.data.phone);
            $('#id').val(data.data.id);
            $('#wallet').text(data.data.wallet);



}
});



$.ajax({

type: "GET",
url: "{{url('/')}}/cart",
processData: false,
contentType: false,
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
success: function (data) {
    $('#cart').text(data.data);
}
});

}
    
        
        

    
        
});
   </script>
    
    

    
@endsection