function getreviewdata(){
  axios.get('/getreviewsdata')
  .then(function(response){

    if(response.status==200){

    $('#mainDivReview').removeClass('d-none');     
    $('#loaderDivReview').addClass('d-none');
    $('#Reviewdatatable').DataTable().destroy();
    $('#review_table').empty();

      var jsonData=response.data;
      $.each(jsonData,function(i){
        $('<tr>').html(
          "<td class='td-sm'>"+jsonData[i].name+"</td>"+
          "<td class='td-sm'>"+jsonData[i].des+"</td>" +
          "<td> <a class='revieweditbtn' data-id='"+jsonData[i].id+"' ><i class='fas fa-edit'></i></a>Edit</td>"+
         "<td><a class='reviewDeletebtn'  data-id='"+jsonData[i].id+"' ><i class='fas fa-trash-alt'></i></a></td>"
        ).appendTo('#review_table');
      })

      $('.reviewDeletebtn').click(function(){
        var id = $(this).data('id');
        $('#deleteReviewModal').modal('show');
        $('#reviewDeletebtnid').html(id);
      })

      $('.revieweditbtn').click(function(){
        var id = $(this).data('id');
        reviewUpdatedetails(id);
        $('#reviewReviewid').html(id);
        $('#updateReviewModal').modal('show');
        
       
      })

      $('#Reviewdatatable').DataTable({"order":false});
      $('.dataTables_length').addClass('bs-select');

    }else{
      $('#loaderDivReview').addClass('d-none');
      $('#wrongDivReview').removeClass('d-none');  
    }

  }).catch(function(error){

    $('#loaderDivReview').addClass('d-none');
    $('#wrongDivReview').removeClass('d-none');  

  })
}

//delete Review


$('#reviewConfrmDeletebtn').click(function(){
  var id=$('#reviewDeletebtnid').html();
  deleteReview(id);
  })
  

function deleteReview(deleteid){

  $('#reviewConfrmDeletebtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
  axios.post('/reviewdelete',{
    id:deleteid}).then(function(response){

    $('#reviewConfrmDeletebtn').html('Yes');
    if(response.status==200){
      if(response.data==1)
      {
        $('#deleteReviewModal').modal('hide');
        toastr.success('delete sucessful');
        getreviewdata();
      }else{
        $('#deleteReviewModal').modal('hide');
        toastr.error('delete failed');
        getreviewdata();
      }

    }else{
      $('#deleteReviewModal').modal('hide');
      toastr.error("Something went wrong");
    }
  }).catch(function(error){
    $('#deleteReviewModal').modal('hide');
    toastr.error("Something went wrong");

  })

}



//add Review

$('#addReviewbtn').click(function(){
  $('#addReviewModal').modal('show');
})

$('#ReviewAddConfirmBtn').click(function(){
  var  ReviewName=$('#ReviewNameId').val();
  var  ReviewDes=$('#ReviewDesId').val();
  var  ReviewImg=$('#ReviewImgId').val();
  addReview(ReviewName,ReviewDes,ReviewImg);
})

function addReview(ReviewName,ReviewDes,ReviewImg){

  if(ReviewName.length==0){
    toastr.error('Name is empty!');
  }else if(ReviewDes.length==0){
    toastr.error('Des is empty!');
  }else if(ReviewImg.length==0){
    toastr.error('Img is empty!');
  }else{
    $('#ReviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/reviewAdd',{
      name:ReviewName,
      des: ReviewDes,
      img: ReviewImg
    })
    .then(function(response){
      $('#ReviewAddConfirmBtn').html("Save");
      if(response.status==200){
        if(response.data==1){
          $('#addReviewModal').modal('hide');
          toastr.success("add success");
          getreviewdata();
        }else{
          $('#addReviewModal').modal('hide');
          toastr.error("add failed");
          getreviewdata(); }

      }else{
        $('#addReviewModal').modal('hide');
        toastr.error("Something Went Wrong!");
      }

    }).catch(function(error){
      $('#addReviewModal').modal('hide');
      toastr.error("Something Went Wrong gg!");
    });

  }

}


// update Review detials

function reviewUpdatedetails(id){
  axios.post('/ReviewDetails',{
    id:id
  })
  .then(function(response){
    if(response.status==200){

      $('#reviewEditFrom').removeClass('d-none');
      $('#loaderDivReviewUpdate').addClass('d-none');

      var jsonData=response.data;
          $('#ReviewNameUpdateId').val(jsonData[0].name);
          $('#ReviewDesUpdateId').val(jsonData[0].des);
          $('#ReviewImgUpdateId').val(jsonData[0].img);

    }else{

      $('#loaderDivReviewUpdate').addClass('d-none');
      $('#wrongDivReviewUpdate').removeClass('d-none');
    }
  }).catch(function(error){

    $('#loaderDivReviewUpdate').addClass('d-none');
    $('#wrongDivReviewUpdate').removeClass('d-none');
   
  })

}

$('#ReviewUpdateConfirmBtn').click(function(){

  var id=$('#reviewReviewid').html();
  var ReviewName=$('#ReviewNameUpdateId').val();
  var ReviewDes=$('#ReviewDesUpdateId').val();
  var ReviewImg=$('#ReviewImgUpdateId').val();
  updateReview(id,ReviewName,ReviewDes,ReviewImg);
})

// update Review

function updateReview(id,ReviewName,ReviewDes,ReviewImg){

  if(ReviewName.length==0){
    toastr.error('Name is empty!');
  }else if(ReviewDes.length==0){
    toastr.error('Des is empty!');
  }else if(ReviewImg.length==0){
    toastr.error('Img is empty!');
  }else{
  axios.post('/ReviewUpdate',{
    id:id,
    name: ReviewName,
    des: ReviewDes,
    img: ReviewImg
  }).then(function(response){
    if(response.status==200){

      $('#updateReviewModal').modal('hide');
      toastr.success("Update Success")
      getreviewdata()

    }else{
      $('#updateReviewModal').modal('hide');
      toastr.error("Update failed")
    }


  }).catch(function(error){

    $('#updateReviewModal').modal('hide');
    toastr.error("Update failed")

  })

}
}