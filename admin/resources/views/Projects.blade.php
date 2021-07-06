@extends('layout.app')

@section('content')

<div id="mainDivProject" class="container d-non">
    <div class="row">
        <div class="col-md-12 p-5">
             <button id="addProjectbtn" class="btn btn-sm mr-3 btn-danger">Add New</button>
                <table id="Projectdatatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Description</th>

                    <th class="th-sm">Edit</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="project_table">
                
                </tbody>
                </table>
        </div>
    </div>
</div>


    <div id="loaderDivProject" class="container">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
          
          </div>
        </div>
  </div>

  <div id="wrongDivProject" class="container d-none">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <h3>Something went worng</h3>
          </div>
        </div>
  </div>






{{-- 
add project modal --}}



<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  <div class="modal-header">
      <h5 class="modal-title">Add New Course</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body  text-center">
     <div class="container">
         <div class="row">
             <div class="col-md">
               <input id="ProjectNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
                 <input id="ProjectDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
                 <input id="ProjectLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
                 <input id="ProjectImgId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
             </div>
         </div>
     </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
      <button  id="ProjectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>







{{-- delete modal --}}

<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Project</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
            <h6>Do you want to delete?</h6>
            <h2 id="projectDeletebtnid"> </h2>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
              <button data-id='' id='projectConfrmDeletebtn' type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
          </div>
        </div>
</div>



{{-- 
update project modal --}}



<div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <div class="modal-body  text-center">
      <h5 id="updateProjectid"></h5>
      <div id="projectEditFrom"  class="container d-none">

       
         <div class="row">
             <div class="col-md">
               <input id="ProjectNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
                 <input id="ProjectDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
                 <input id="ProjectLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
                 <input id="ProjectImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
             </div>
         </div>
      </div>
    </div>


    <div id="loaderDivproUpdate" class="container">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
          </div>
        </div>
    </div>

    <div id="wrongDivproUpdate" class="container d-none">
          <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something went worng</h3>
            </div>
          </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
      <button  id="ProjectUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>


@endsection

@section('script')
<script>
getprojectsdata();


function getprojectsdata(){
  axios.get('/getprojectsdata')
  .then(function(response){

    if(response.status==200){

    $('#mainDivProject').removeClass('d-none');     
    $('#loaderDivProject').addClass('d-none');
    $('#Projectdatatable').DataTable().destroy();
    $('#project_table').empty();

      var jsonData=response.data;
      $.each(jsonData,function(i){
        $('<tr>').html(
          "<td class='td-sm'>"+jsonData[i].project_name+"</td>"+
          "<td class='td-sm'>"+jsonData[i].project_des+"</td>" +
          "<td> <a class='projecteditbtn' data-id='"+jsonData[i].id+"' ><i class='fas fa-edit'></i></a>Edit</td>"+
         "<td><a class='projectDeletebtn'  data-id='"+jsonData[i].id+"' ><i class='fas fa-trash-alt'></i></a></td>"
        ).appendTo('#project_table');
      })

      $('.projectDeletebtn').click(function(){
        var id = $(this).data('id');
        $('#deleteProjectModal').modal('show');
        $('#projectDeletebtnid').html(id);
      })

      $('.projecteditbtn').click(function(){
        var id = $(this).data('id');
        projectUpdatedetails(id);
        $('#updateProjectid').html(id);
        $('#updateProjectModal').modal('show');
        
       
      })

      $('#Projectdatatable').DataTable({"order":false});
      $('.dataTables_length').addClass('bs-select');

    }else{
      $('#loaderDivProject').addClass('d-none');
      $('#wrongDivProject').removeClass('d-none');  
    }

  }).catch(function(error){

    $('#loaderDivProject').addClass('d-none');
    $('#wrongDivProject').removeClass('d-none');  

  })
}

//delete project


$('#projectConfrmDeletebtn').click(function(){
  var id=$('#projectDeletebtnid').html();
  deleteProject(id);
  })
  

function deleteProject(deleteid){

  $('#projectConfrmDeletebtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
  axios.post('/projectdelete',{
    id:deleteid}).then(function(response){

    $('#projectConfrmDeletebtn').html('Yes');
    if(response.status==200){
      if(response.data==1)
      {
        $('#deleteProjectModal').modal('hide');
        toastr.success('delete sucessful');
        getprojectsdata();
      }else{
        $('#deleteProjectModal').modal('hide');
        toastr.error('delete failed');
        getprojectsdata();
      }

    }else{
      $('#deleteProjectModal').modal('hide');
      toastr.error("Something went wrong");
    }
  }).catch(function(error){
    $('#deleteProjectModal').modal('hide');
    toastr.error("Something went wrong");

  })

}



//add project 

$('#addProjectbtn').click(function(){
  $('#addProjectModal').modal('show');
})

$('#ProjectAddConfirmBtn').click(function(){
  var  ProjectName=$('#ProjectNameId').val();
  var  ProjectDes=$('#ProjectDesId').val();
  var  ProjectLink=$('#ProjectLinkId').val();
  var  ProjectImg=$('#ProjectImgId').val();
  addProject(ProjectName,ProjectDes,ProjectLink,ProjectImg);
})

function addProject(ProjectName,ProjectDes,ProjectLink,ProjectImg){

  if(ProjectName.length==0){
    toastr.error('Project Name is empty!');
  }else if(ProjectDes.length==0){
    toastr.error('Project Des is empty!');
  }else if(ProjectImg.length==0){
    toastr.error('Project Img is empty!');
  }else if(ProjectLink.length==0){
    toastr.error('Project Link is empty!');
  }else{
    $('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/projectAdd',{
      project_name:ProjectName,
      project_des: ProjectDes,
      project_link: ProjectLink,
      project_img: ProjectImg
    })
    .then(function(response){
      $('#ProjectAddConfirmBtn').html("Save");
      if(response.status==200){
        if(response.data==1){
          $('#addProjectModal').modal('hide');
          toastr.success("add success");
          getprojectsData();
        }else{
          $('#addProjectModal').modal('hide');
          toastr.error("add failed");
          getprojectsData(); }

      }else{
        $('#addProjectModal').modal('hide');
        toastr.error("Something Went Wrong!");
      }

    }).catch(function(error){
      $('#addProjectModal').modal('hide');
      toastr.error("Something Went Wrong gg!");
    });

  }

}


// update project detials

function projectUpdatedetails(id){

  axios.post('/ProjectDetails',{
    id:id
  })
  .then(function(response){
    if(response.status==200){

      $('#projectEditFrom').removeClass('d-none');
      $('#loaderDivproUpdate').addClass('d-none');

      var jsonData=response.data;
          $('#ProjectNameUpdateId').val(jsonData[0].project_name);
          $('#ProjectDesUpdateId').val(jsonData[0].project_des);
          $('#ProjectLinkUpdateId').val(jsonData[0].project_link);
          $('#ProjectImgUpdateId').val(jsonData[0].project_img);

    }else{

      $('#loaderDivproUpdate').addClass('d-none');
      $('#wrongDivproUpdate').removeClass('d-none');
    }
  }).catch(function(error){

    $('#loaderDivproUpdate').addClass('d-none');
    $('#wrongDivproUpdate').removeClass('d-none');
   
  })

}

$('#ProjectUpdateConfirmBtn').click(function(){
  
  var id=$('#updateProjectid').html();
  var ProjectName=$('#ProjectNameUpdateId').val();
  var projectDes=$('#ProjectDesUpdateId').val();
  var projectLink=$('#ProjectLinkUpdateId').val();
  var projectImg=$('#ProjectImgUpdateId').val();
  updateProject(id,ProjectName,projectDes,projectLink,projectImg);
})

// update project

function updateProject(id,ProjectName,projectDes,projectLink,projectImg){

  if(ProjectName.length==0){
    toastr.error('Project Name is empty!');
  }else if(projectDes.length==0){
    toastr.error('Project Des is empty!');
  }else if(projectImg.length==0){
    toastr.error('Project Img is empty!');
  }else if(projectLink.length==0){
    toastr.error('Project Link is empty!');
  }else{
  axios.post('/ProjectUpdate',{
    id:id,
    project_name: ProjectName,
    project_des: projectDes,
    project_link: projectLink,
    project_img: projectImg
  }).then(function(response){
    if(response.status==200){

      $('#updateProjectModal').modal('hide');
      toastr.success("Update Success")
      getprojectsdata()


    }else{
      $('#updateProjectModal').modal('hide');
      toastr.error("Update failed")
    }


  }).catch(function(error){

    $('#updateProjectModal').modal('hide');
    toastr.error("Update failed")

  })

}
}

</script>
    
@endsection

