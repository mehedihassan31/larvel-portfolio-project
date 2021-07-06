@extends('layout.app')

@section('content')


<div id="mainDivReview" class="container d-non">
    <div class="row">
        <div class="col-md-12 p-5">
             <button id="addReviewbtn" class="btn btn-sm mr-3 btn-danger">Add New</button>
                <table id="Reviewdatatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Description</th>

                    <th class="th-sm">Edit</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="review_table">
                
                </tbody>
                </table>
        </div>
    </div>
</div>


    <div id="loaderDivReview" class="container">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
          
          </div>
        </div>
  </div>

  <div id="wrongDivReview" class="container d-none">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <h3>Something went worng</h3>
          </div>
        </div>
  </div>






{{-- 
add Review modal --}}



<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  <div class="modal-header">
      <h5 class="modal-title">Add New Review</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body  text-center">
     <div class="container">
         <div class="row">
             <div class="col-md">
               <input id="ReviewNameId" type="text" id="" class="form-control mb-3" placeholder=" Name">
                 <input id="ReviewDesId" type="text" id="" class="form-control mb-3" placeholder=" Description">
                 <input id="ReviewImgId" type="text" id="" class="form-control mb-3" placeholder=" Image">
             </div>
         </div>
     </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
      <button  id="ReviewAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>







{{-- delete modal --}}

<div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Review</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
            <h6>Do you want to delete?</h6>
            <h2 id="reviewDeletebtnid"> </h2>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
              <button data-id='' id='reviewConfrmDeletebtn' type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
          </div>
        </div>
</div>



{{-- 
update Review modal --}}



<div class="modal fade" id="updateReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <div class="modal-body  text-center">
      <h5 id="reviewReviewid"></h5>
      <div id="reviewEditFrom"  class="container d-none">
         <div class="row">
             <div class="col-md">
               <input id="ReviewNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Name">
                 <input id="ReviewDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Description">
                 <input id="ReviewImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Image">
             </div>
         </div>
      </div>
    </div>


    <div id="loaderDivReviewUpdate" class="container">
        <div class="row">
          <div class="col-md-12 p-5 text-center">
              <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
          </div>
        </div>
    </div>

    <div id="wrongDivReviewUpdate" class="container d-none">
          <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something went worng</h3>
            </div>
          </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
      <button  id="ReviewUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>






@endsection

@section('script')
<script type="text/javascript" >
getreviewdata()
</script >
@endsection