@extends('layout.app')

@section('content')

<div id="maindiv" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">

      <button id="addnewbtn" class="btn btn-sm mr-3 btn-danger">Add New</button>

    <table id="serviceDatatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Image</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Description</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>

      <tbody id="servicetable">
      
        
      </tbody>
    </table>
    
    </div>
    </div>
    </div>




    <div id="loaderdiv" class="container">
          <div class="row">
            <div class="col-md-12 p-5 text-center">

                <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
            
            </div>
          </div>
    </div>

    <div id="wrongdiv" class="container d-none">
          <div class="row">
            <div class="col-md-12 p-5 text-center">

                <h3>Something went worng</h3>
            
            </div>
          </div>
    </div>



<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
    Launch demo modal
  </button> --}}
  




  
  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Services</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
         <h6>Do you want to delete?</h6>
         <h6 id="serviceDeletebtn"></h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button data-id='' id='serconfmdeltebtn' type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>






  <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Services</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form>

            <div id="detailsf" class="d-none">
                <h5 id="serviceeditid" class="mt-4 text-center"> </h5>
                <!-- Name input -->
                <div class="form-outline mb-4">
                  <input type="text" id="srid1" class="form-control" placeholder="Service name ">
                </div>
                <div class="form-outline mb-4">
                  <input type="text" id="srid2" class="form-control" placeholder="Service Description">
                </div>
                <div class="form-outline mb-4">
                  <input type="text" id="srid3" class="form-control" placeholder="Image Link">
                </div>

            </div>



            <div id="loaderdivd" class="container">
              <div class="row">
                <div class="col-md-12 p-5 text-center">
                    <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
                </div>
              </div>
        </div>
    
        <div id="wrongdivd" class="container d-none">
              <div class="row">
                <div class="col-md-12 p-5 text-center">
                    <h3>Something went worng</h3>
                </div>
              </div>
        </div>
        </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
          <button data-id='' id='serconfmEditbtn' type="button" class="btn btn-sm btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div>







  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form>
          <div id="serviceaddfrm" >

            <h6></h6>
              <!-- Name input -->
              <div class="form-outline mb-4">
                <input type="text" id="sraddid1" class="form-control" placeholder="Service name ">
              </div>
              <div class="form-outline mb-4">
                <input type="text" id="sraddid2" class="form-control" placeholder="Service Description">
              </div>
              <div class="form-outline mb-4">
                <input type="text" id="sraddid3" class="form-control" placeholder="Image Link">
              </div>

          </div>

      <div id="wrongdivd" class="container d-none">
            <div class="row">
              <div class="col-md-12 p-5 text-center">
  
                  <h3>Something went worng</h3>
              
              </div>
            </div>
      </div>
      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
        <button data-id='' id='serconfmaddbtn' type="button" class="btn btn-sm btn-danger">Add new</button>
      </div>
    </div>
  </div>
</div>

        




@endsection

@section('script')
<script type="text/javascript" >
getServicesData();



function getServicesData(){


axios.get('/getServicesData')
.then(function (response){

  if(response.status==200)
  {
    $('#maindiv').removeClass('d-none');
    $('#loaderdiv').addClass('d-none');

    $('#serviceDatatable').DataTable().destroy();
    $('#servicetable').empty();

    var jsonData=response.data;
    $.each(jsonData,function(i,item){
    $('<tr>').html(
    "<td><img class='table-img' src='"+jsonData[i].service_img+"'></td>"+
    "<td>"+jsonData[i].service_name+ "</td>"+
    "<td>"+jsonData[i].service_des+"</td>"+
    "<td> <a class='serviceeditbtn' data-id='"+jsonData[i].id+"' ><i class='fas fa-edit'></i></a>Edit</td>"+
    "<td><a class='serviceDeletebtn'  data-id='"+jsonData[i].id+"' ><i class='fas fa-trash-alt'></i></a></td>"
     ).appendTo('#servicetable');
    });

    //services delete
$('.serviceDeletebtn').click(function(){
  var id=$(this).data('id');
  $('#serconfmdeltebtn').attr('data-id',id);
  $('#deleteModal').modal('show');

})

    //service edit icon
    $('.serviceeditbtn').click(function(){
       var id=$(this).data('id');
      $('#serviceeditid').html(id);
       serviceDetails(id);
      $('#EditModal').modal('show')
    })


$('#serviceDatatable').DataTable({"order":false});
$('.dataTables_length').addClass('bs-select');



  }else{

    $('#loaderdiv').addClass('d-none');
    $('#wrongdiv').removeClass('d-none');

  }


}).catch(function (error) {

  $('#loaderdiv').addClass('d-none');
  $('#wrongdiv').removeClass('d-none');

});

}






$('#serconfmdeltebtn').click(function(){
  var id=$(this).data('id');
  serviceDelete(id);


})

function serviceDelete(deleteid){

  axios.post('/ServicesDelete',{id:deleteid})
  .then(function(response){

    if(response.data==1)
    {
      $('#deleteModal').modal('hide');
      toastr.success("Delete success");
      getServicesData();

    }else{
    
      $('#deleteModal').modal('hide');
      toastr.error("Delete Faild");
      getServicesData();
    }

  


  }).catch(function (error) {


});


}


// each service update Details

function serviceDetails(detailid){

  axios.post('/ServicesDetails',{id:detailid})
  .then(function(response){

    if(response.status==200){

      

      $('#detailsf').removeClass('d-none');
      $('#loaderdivd').addClass('d-none');
      

      var jsonData=response.data;

      $('#srid1').val(jsonData[0].service_name);
      $('#srid2').val(jsonData[0].service_des);
      $('#srid3').val(jsonData[0].service_img);

    }else{
      $('#wrongdivd').removeClass('d-none');
      $('#loaderdivd').addClass('d-none');
      

    }


  }).catch(function (error) {

    $('#wrongdivd').removeClass('d-none');
    $('#loaderdivd').addClass('d-none');
});


}





    //services edit confirm
    $('#serconfmEditbtn').click(function(){
      var id=$('#serviceeditid').html();
      var name=$('#srid1').val();
      var des=$('#srid2').val();
      var img=$('#srid3').val();

      serviceUpdate(id,name,des,img);

    })

    
function serviceUpdate(serid,serName,serDes,serImg){

  if(serName.length==0){

    toastr.error("Name link emty");
    
  }else if(serDes.length==0){
    toastr.error("Des link emty");

  }
  else if(serImg.length==0){
    toastr.error("Image link emty");

  }else{

                  axios.post('/ServicesUpdate',{
                    id:serid,
                    name:serName,
                    des:serDes,
                    img:serImg
                  })
                  .then(function(response){

                    if(response.data==1)
                    {
                      $('#EditModal').modal('hide');
                      toastr.success("Update success");
                      getServicesData();
                
                    }else{
                    
                      $('#EditModal').modal('hide');
                      toastr.error("Update Faild");
                      getServicesData();
                    }
                
                
                  }).catch(function (error) {
                

                });

    }

 


}


// service add

$('#addnewbtn').click(function(){

$('#addModal').modal('show');

});





$('#serconfmaddbtn').click(function(){
  var name=$('#sraddid1').val();
  var des=$('#sraddid2').val();
  var img=$('#sraddid3').val();

  serviceAdd(name,des,img);

});


// service add method


function serviceAdd(serName,serDes,serImg){

  if(serName.length==0){

    toastr.error("Name link emty");
    
  }else if(serDes.length==0){
    toastr.error("Des link emty");

  }
  else if(serImg.length==0){
    toastr.error("Image link emty");

  }else{ 
    axios.post('/ServicesAdd',{ 
                    name:serName,
                    des:serDes,
                    img:serImg
                  })
                  .then(function(response){

                    if(response.data==1)
                    {
                      $('#addModal').modal('hide');
                      toastr.success("add success");
                      getServicesData();
                
                    }else{
                    
                      $('#addModal').modal('hide');
                      toastr.error("add Faild");
                      getServicesData();
                    }

                  }).catch(function (error) {
                

                });

    }

 


}

</script>
    
@endsection