@extends('layout.app')
@section('content')

<div id="mainDivContact" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">

                <table id="Contactdatatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Mobile</th>
                    <th class="th-sm">Email</th>
                    <th class="th-sm">Message</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="Contact_table">
                

                </tbody>
                </table>
        </div>
    </div>
</div>



    <div id="loaderDivContact" class="container">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
          
          </div>
        </div>
  </div>

  <div id="wrongDivContact" class="container d-none">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <h3>Something went worng</h3>
          </div>
        </div>
  </div>


{{-- delete modal --}}
<div class="modal fade" id="deleteContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
        <div class="modal-dialog"Contact"document">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Contact</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
            <h6>Do you want to delete?</h6>
            <h2 id="ContactDeletebtnid"></h2>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
              <button data-id='' id='ContactConfrmDeletebtn' type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
          </div>
        </div>
</div>
    
@endsection



@section('script')
<script>
    getContactData();

    function getContactData(){

axios.get('/getcontactdata')
.then(function(response){
  if(response.status==200){

    $('#mainDivContact').removeClass('d-none');
    $('#loaderDivContact').addClass('d-none');

    $('#Contactdatatable').DataTable().destroy();

    $('#Contact_table').empty();

    var jsonData=response.data;
    $.each(jsonData,function(i){
      $('<tr>').html(
        "<td class='td-sm'>"+jsonData[i].contact_name+"</td>"+
        "<td class='td-sm'>"+jsonData[i].contact_mobile+"</td>" +
        "<td class='td-sm'>"+jsonData[i].contact_email+"</td>"+
        "<td class='td-sm'>"+jsonData[i].contact_msg+"</td>" +
       "<td><a class='contactDeletebtn'  data-id='"+jsonData[i].id+"' ><i class='fas fa-trash-alt'></i></a></td>"
      ).appendTo('#Contact_table');
    })

    $('.contactDeletebtn').click(function(){
      var id=$(this).data('id');
      

      $('#deleteContactModal').modal('show');
      $('#ContactDeletebtnid').html(id);
    })

    $('#Contactdatatable').DataTable({"order":false});
    $('.dataTable_length').addClass('bs-select');
    

  }else{
    $('#wrongDivContact').removeClass('d-none');
    $('#loaderDivContact').addClass('d-none');
    
  }

}).catch(function(error){

  $('#wrongDivContact').removeClass('d-none');
  $('#loaderDivContact').addClass('d-none');


})

}

$('#ContactConfrmDeletebtn').click(function(){
var id=$('#ContactDeletebtnid').html();
ContactDelete(id)

})

function ContactDelete(id){

$('#ContactConfrmDeletebtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
axios.post('/contactdelete',{
  id:id
}).then(function(response){
  $('#ContactConfrmDeletebtn').html("Yes");
  if(response.status==200){
    if(response.data==1){
      $('#deleteContactModal').modal('hide');
      toastr.success("Delete success");
      getContactData();

    }else{

      $('#deleteContactModal').modal('hide');
      toastr.error("Delete failed");
      getContactData();
    }


  }else{
    $('#deleteContactModal').modal('hide');
    toastr.error("Something wrong");


  }
}).catch(function(error){

  $('#deleteContactModal').modal('hide');
  toastr.error("Something wrong");
})
}


</script>
    
@endsection