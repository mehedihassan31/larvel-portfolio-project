@extends('layout.app')
@section('title','Gallery')
@section('content')


<div id="mainDivReview" class="container ">
    <div class="row">
        <div class="col-md-12 p-5">
             <button id="addReviewbtn" data-toggle="modal" data-target="#PhotoModal" class="btn btn-sm mr-3 btn-danger">Add New</button>
        </div>
    </div>
</div>
<div  class="container ">
    <div class="row photorow">

      </div>

    </div>
    <button id="loadmore"  class="btn btn-sm mr-3 btn-danger">Load More</button>

</div>






{{-- modal --}}
<div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title">Add Photo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body  text-center">
                        <input id="imgInput" type="file" >
                        <img class=" imgpreview " src="{{asset('images/default-image.jpg')}}" alt="" id="imgpreview">
                        
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
            <button  id="PhotoConfirm" type="button" class="btn  btn-sm  btn-danger">Save</button>
          </div>
  </div>
</div>
</div>
@endsection

@section('script')
<script>

    $('#imgInput').change(function(){

        var reader=new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload=function(event){
            var ImgSource=event.target.result;
            $('#imgpreview').attr('src',ImgSource)
        }
    })

    $('#PhotoConfirm').on('click',function(){

      $('#PhotoConfirm').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

      var PhotoFile= $('#imgInput').prop('files')[0];

           var formData=new FormData();
           formData.append('photo',PhotoFile);

           axios.post("/photoupload",formData).then(function (response) {
             if(response.status==200 && response.data==1){

            $('#PhotoModal').modal("hide");
            $('#PhotoConfirm').html("Save");
            toastr.success('Photo upload succes');

             }else{
              toastr.error('Photo upload Fail');
              $('#PhotoModal').modal("hide");
             }


      }).catch(function(error){
        toastr.error('Photo upload Fail');
        $('#PhotoModal').modal("hide");
      })

    })



    loadphoto();
    function loadphoto(){

      axios.get('/photoall').then(function(response){

        var jsonPhoto=response.data;

        $.each(jsonPhoto,function(i){

        $("<div class='col-md-3'>").html(
         "<div class='card'>"+
         "<img data-id="+jsonPhoto[i].id+" class='imagerow' src="+jsonPhoto[i].location+" alt='Card image cap'>"+  
         "<button data-photo='"+jsonPhoto[i].location+"' data-id='"+jsonPhoto[i].id+"' class='deletebtn btn btn-sm mr-3 btn-primary'>Delete</button>"+ 
        "</div>"
          ).appendTo('.photorow');
        })

        $('.deletebtn').on('click',function(event){

          let id =$(this).data('id');
          let photo =$(this).data('photo');
          photodelete(photo,id)
          event.preventDefault();


    })


      }).catch(function(error){
      })
    }





  $('#loadmore').on('click',function(){

let loadmorebtn=$(this);
var first= $(this).closest('div').find('img').data('id');
loadbyid(first,loadmorebtn)
})


    let  imgid=0;
    function loadbyid(first,loadmorebtn){
    imgid=imgid+4;
    let photoid=imgid+first;

      let url="/photojsonbyid/"+photoid;
      

      loadmorebtn.html("<div class='spinner-border spinner-border-sm' role='status'></div>");

      axios.get(url).then(function(response){
        loadmorebtn.html("load more");

            var jsonPhoto=response.data;

            $.each(jsonPhoto,function(i){

            $("<div class='col-md-3'>").html(
            "<div class='card'>"+
            "<img data-id="+jsonPhoto[i].id+" class='imagerow' src="+jsonPhoto[i].location+" alt='Card image cap'>"+ 
            "<button  data-photo='"+jsonPhoto[i].location+"' data-id='"+jsonPhoto[i].id+"' class='deletebtn btn btn-sm mr-3 btn-primary'>Delete</button>"+ 
            "</div>"
              ).appendTo('.photorow');
            })
            }).catch(function(error){
            })

    }


function photodelete(oldphotourl,id){

  let url='/photodelete';
  let myFormdata=new FormData();
  myFormdata.append('oldphotourl',oldphotourl);
  myFormdata.append('id',id);

  axios.post(url,myFormdata).then(function(response){

    if(response.status==200 && response.data==1){

      toastr.success("photo delete success");
      $('.photorow').empty();
      loadphoto();

    }else{

      toastr.error("delete fail");
    }
  }).catch(function(error){
    toastr.error("delete fail");
    
  })




}



</script>
    
@endsection