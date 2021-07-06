@extends('layout.app')
@section('content')


<div id="mainDivCourse" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">

        <button id="addCoursebtn" class="btn btn-sm mr-3 btn-danger">Add New</button>

    <table id="coursedatatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Name</th>
          <th class="th-sm">Course fee</th>
          <th class="th-sm">Class</th>
          <th class="th-sm">Enroll</th>
          <th class="th-sm">Details</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="course_table">
	

      </tbody>
    </table>
    </div>
    </div>
    </div>



    <div id="loaderDivCourse" class="container">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
          
          </div>
        </div>
  </div>

  <div id="wrongDivCourse" class="container d-none">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <h3>Something went worng</h3>
          </div>
        </div>
  </div>



{{-- 
add modal --}}



  <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>






{{-- delete modal --}}
<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete course</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
            <h6>Do you want to delete?</h6>
            <h2 id="courseDeletebtnid"></h2>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
              <button data-id='' id='courseConfrmDeletebtn' type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
          </div>
        </div>
</div>



{{-- Update modal --}}

<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Update Course</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body  text-center">
                                <div id="courseEditFrom" class="container d-none">
                                        <br><h5 id="updateCourseid"></h5>
                                      <div class="row">
                                          <div class="col-md-6">
                                            <input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                                              <input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
                                            <input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
                                            <input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
                                          </div>
                                          <div class="col-md-6">
                                            <input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
                                            <input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
                                            <input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
                                          </div>
                                      </div>
                                </div>

                              <div id="loaderDivUpdate" class="container">
                                  <div class="row">
                                    <div class="col-md-12 p-5 text-center">
                                        <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
                                    </div>
                                  </div>
                              </div>

                              <div id="wrongDivUpdate" class="container d-none">
                                    <div class="row">
                                      <div class="col-md-12 p-5 text-center">
                                          <h3>Something went worng</h3>
                                      </div>
                                    </div>
                              </div>


                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                  </div>
      </div>
    </div>
</div>
    
@endsection


@section('script')
<script>
getCoursesData();




function getCoursesData(){
  axios.get('/getCoursesData')
        .then(function(response){
          if(response.status==200){
            $('#mainDivCourse').removeClass('d-none');
            $('#loaderDivCourse').addClass('d-none');

            $('#coursedatatable').DataTable().destroy();
            
            $('#course_table').empty();

            
            var jsonData=response.data;
            $.each(jsonData, function(i){
              $('<tr>').html(
                "<td class='td-sm'>"+jsonData[i].course_name+"</td>"+
                "<td class='td-sm'>"+jsonData[i].course_fee+"</td>"+
                "<td class='td-sm'>"+jsonData[i].course_totalclass+"</td>"+
                "<td class='td-sm'>"+jsonData[i].course_totalenroll+"</td>"+
                "<td> <a class='courseViewDetailsbtn' data-id='"+jsonData[i].id+"' ><i class='fas fa-eye'></i></a>Details</td>"+
                "<td> <a class='courseeditbtn' data-id='"+jsonData[i].id+"' ><i class='fas fa-edit'></i></a>Edit</td>"+
               "<td><a class='courseDeletebtn'  data-id='"+jsonData[i].id+"' ><i class='fas fa-trash-alt'></i></a></td>"
              ).appendTo('#course_table');
            })

            $('.courseDeletebtn').click(function(){
              var id= $(this).data('id');
              $('#deleteCourseModal').modal('show');
              $('#courseDeletebtnid').html(id);
            });



            $('.courseeditbtn').click(function(){
              var id=$(this).data('id');
              courseUpdatedetails(id);
              $('#updateCourseid').html(id);
              $('#updateCourseModal').modal('show');
              
            })

            $('#coursedatatable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');

          }else{
            $('#wrongDivCourse').removeClass('d-none');
            $('#loaderDivCourse').addClass('d-none');

          }
        }).catch(function(error){
          $('#wrongDivCourse').removeClass('d-none');
          $('#loaderDivCourse').addClass('d-none');
        })
}


$('#addCoursebtn').click(function(){
  $('#addCourseModal').modal('show');

})


$('#CourseAddConfirmBtn').click(function(){
  var  CourseName=$('#CourseNameId').val();
  var  CourseDes=$('#CourseDesId').val();
  var  CourseFee=$('#CourseFeeId').val();
  var  CourseEnroll=$('#CourseEnrollId').val();
  var  CourseClass=$('#CourseClassId').val();
  var  CourseLink=$('#CourseLinkId').val();
  var  CourseImg=$('#CourseImgId').val();
  courseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
})



//course add method
function courseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg){

  if(CourseName.length==0){
    toastr.error('Course Name is empty!');
  }else if(CourseDes.length==0){
    toastr.error('Course Des is empty!');

  }else if(CourseFee.length==0){
    toastr.error('Course Fee is empty!');
  }else if(CourseEnroll.length==0){
    toastr.error('Course Enroll is empty!');
  }else if(CourseClass.length==0){
    toastr.error('Course Class is empty!');
  }else if(CourseImg.length==0){
    toastr.error('Course Img is empty!');
  }else if(CourseLink.length==0){
    toastr.error('Course Link is empty!');
  }else{
    $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/CourseAdd',{
      course_name: CourseName,
      course_des: CourseDes,
      course_fee: CourseFee,
      course_totalenroll: CourseEnroll,
      course_totalclass: CourseClass,
      course_link: CourseLink,
      course_img: CourseImg
    })
    .then(function(response){
      $('#CourseAddConfirmBtn').html("Save");
      if(response.data==1){
          $('#addCourseModal').modal('hide');
          toastr.success("add success");
          getCoursesData();
        }else{
        $('#addCourseModal').modal('hide');
        toastr.error("Something Went Wrong!");
        getCoursesData();

      }
    }).catch(function(error){
      $('#addCourseModal').modal('hide');
      toastr.error("Something Went Wrong!");
    });

  }

}


//delete course

$('#courseConfrmDeletebtn').click(function(){
var id=$('#courseDeletebtnid').html();
 courseDelete(id);
})


function courseDelete(deleteid){

  $('#courseConfrmDeletebtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

  axios.post('/CourseDelete',{id: deleteid})
  .then(function(response){
    $('#courseConfrmDeletebtn').html("Yes");
    if(response.status==200){
      if(response.data==1){
        $('#deleteCourseModal').modal('hide');
        toastr.success("Delete success");
        getCoursesData();

      }else{
        $('#deleteCourseModal').modal('hide');
        toastr.error("Delete fail");
        getCoursesData();

      }

    }else{
      $('#deleteCourseModal').modal('hide');
      toastr.error("Something went wrong");


    }

  }).catch(function(error){
    $('#deleteCourseModal').modal('hide');
      toastr.error("Something went wrong");
  })
}






// update course

function courseUpdatedetails(detailsid){

  axios.post('/CourseDetails',{
    id:detailsid
  })
  .then(function(response){
    if(response.status==200){

      $('#courseEditFrom').removeClass('d-none');
      $('#loaderDivUpdate').addClass('d-none');

      var jsonData=response.data;

          $('#CourseNameUpdateId').val(jsonData[0].course_name);
          $('#CourseDesUpdateId').val(jsonData[0].course_des);
          $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
          $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
          $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
          $('#CourseLinkUpdateId').val(jsonData[0].course_link);
          $('#CourseImgUpdateId').val(jsonData[0].course_img);

    }else{

      $('#loaderDivUpdate').addClass('d-none');
      $('#wrongDivUpdate').removeClass('d-none');
    }
  }).catch(function(error){

    $('#loaderDivUpdate').addClass('d-none');
    $('#wrongDivUpdate').removeClass('d-none');
  })


}



// Course update


$('#CourseUpdateConfirmBtn').click(function(){
  var  CourseId=$('#updateCourseid').html();
  var  CourseName=$('#CourseNameUpdateId').val();
  var  CourseDes=$('#CourseDesUpdateId').val();
  var  CourseFee=$('#CourseFeeUpdateId').val();
  var  CourseEnroll=$('#CourseEnrollUpdateId').val();
  var  CourseClass=$('#CourseClassUpdateId').val();
  var  CourseLink=$('#CourseLinkUpdateId').val();
  var  CourseImg=$('#CourseImgUpdateId').val();

courseUpdate(CourseId,CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
})

function courseUpdate(CourseId,CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg){

  if(CourseName.length==0){
    toastr.error('Course Name is empty!');
  }else if(CourseDes.length==0){
    toastr.error('Course Des is empty!');

  }else if(CourseFee.length==0){
    toastr.error('Course Fee is empty!');
  }else if(CourseEnroll.length==0){
    toastr.error('Course Enroll is empty!');
  }else if(CourseClass.length==0){
    toastr.error('Course Class is empty!');
  }else if(CourseLink.length==0){
    toastr.error('Course Link is empty!');
  }else if(CourseImg.length==0){
    toastr.error('Course Image is empty!');
  }else{
    $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/CourseUpdate',{
      id: CourseId,
      course_name: CourseName,
      course_des: CourseDes,
      course_fee: CourseFee,
      course_totalenroll: CourseEnroll,
      course_totalclass: CourseClass,
      course_link: CourseLink,
      course_img: CourseImg
    })
    .then(function(response){
      $('#CourseUpdateConfirmBtn').html("Save");
      if(response.status==200){

        if(response.data==1){
          $('#updateCourseModal').modal('hide');
          toastr.success("Update success");
          getCoursesData();
        }else{

          $('#updateCourseModal').modal('hide');
          toastr.error("Update fail");
          getCoursesData();
        }

      }else{
        $('#updateCourseModal').modal('hide');
        toastr.error("Something went wrong");
      }


    }).catch(function(error){
      $('#updateCourseModal').modal('hide');
      toastr.error("Something went wrong");

    });
  }
}



</script>
    
@endsection