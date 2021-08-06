@extends('layout.app')
@section('title','Review')
@section('content')


<div id="mainDivReview"  class="container  d-none">
    <div class="row">
    <div class="col-md-12 p-3">
    <button id="addNewReviewBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
    <table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
        <th class="th-sm">Name</th>
        <th class="th-sm">Description</th>
        <th class="th-sm">Edit</th>
        <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="reviewTable">
    
      </tbody>
    </table>
    </div>
    </div>
    </div>
    
    
    <div id="loaderDivReview" class="container">
    <div class="row">
    <div class="col-md-12 text-center p-5">
        <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
    </div>
    </div>
    
    
    <div id="wrongDivReview" class="container d-none">
    <div class="row">
    <div class="col-md-12 text-center p-5">
        <h3>Something Went Wrong !</h3>
    </div>
    </div>
    </div>




<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
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
        <div class="col-md-12">
            <input id="reviewNameId" type="text" id="" class="form-control mb-3" placeholder="Review Name">
            <input id="reviewDesId" type="text" id="" class="form-control mb-3" placeholder="Review Description">
            <input id="reviewImgId" type="text" id="" class="form-control mb-3" placeholder="Review Image">
      </div>
     </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
      <button  id="reviewAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>
</div>

<div class="modal fade" id="updateReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Update Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body  text-center">
        
        <h5 id="reviewEditId" class="mt-4 d-none">  </h5>
  
         <div id="reviewEditForm" class="container d-none">
  
          <div class="row">
            <div class="col-md-12">
            <input id="reviewNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Name">
            <input id="reviewDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Description">  
            <input id="reviewImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Image">
           </div>
         </div>
  
            <img id="reviewEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
            <h5 id="reviewEditWrong" class="d-none">Something Went Wrong !</h5>
  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button  id="reviewUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 id="reviewDeleteId" class="mt-4 d-none">   </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="reviewDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
  
  
    
    
@endsection
@section('script')
<script>
    getReviewData();
//For Review Table 
function getReviewData() {
    axios.get('/getReviewData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivReview').removeClass('d-none');
                $('#loaderDivReview').addClass('d-none');
                $('#reviewDataTable').DataTable().destroy();
               
                $('#reviewTable').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>"+jsonData[i].name+"</td>" +
                        "<td>"+jsonData[i].des+"</td>" +  
                        "<td><a class='reviewEditBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='reviewDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#reviewTable');
                });
                     $('.reviewDeleteBtn').click(function(){
                       
                      var id= $(this).data('id');
                     $('#reviewDeleteId').html(id);
                     $('#deleteReviewModal').modal('show');
                     })

                     $('.reviewEditBtn').click(function(){
                        var id= $(this).data('id');
                        reviewUpdateDetails(id);
                        $('#reviewEditId').html(id);
                        $('#updateReviewModal').modal('show');
                     })


                  $('#reviewDataTable').DataTable({"order":false});
                  $('.dataTables_length').addClass('bs-select');



            } else {

                $('#loaderDivReview').addClass('d-none');
                $('#wrongDivReview').removeClass('d-none');

            }

        })
        .catch(function(error) {
                $('#loaderDivReview').addClass('d-none');
                $('#wrongDivReview').removeClass('d-none');
        });

}

$('#addNewReviewBtnId').click(function(){
  $('#addReviewModal').modal('show');
});

$('#reviewAddConfirmBtn').click(function(){
  var reviewName=$('#reviewNameId').val();
  var reviewDes=$('#reviewDesId').val();
  var reviewImg=$('#reviewImgId').val();
    reviewAdd(reviewName,reviewDes,reviewImg);

})

function reviewAdd(reviewName,reviewDes,reviewImg) {
  
    if(reviewName.length==0){
     alert('Review Name is Required !');
    }
    else if(reviewDes.length==0){
     alert('Review Description is Required !');
    }
    else if(reviewImg.length==0){
      alert('Review Image is Required !');
    }

    else{
    $('#reviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
    axios.post('/reviewAdd', {
            reviewName: reviewName,
            reviewDesc: reviewDes,
            reviewImg: reviewImg                                    
        })
        .then(function(response) {
            $('#reviewAddConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#addReviewModal').modal('hide');
                alert('Add Success');
                getReviewData();
            } else {
                $('#addReviewModal').modal('hide');
                alert('Add Fail');
                getReviewData();
            }  
         } 
         else{
             $('#addReviewModal').modal('hide');
             alert('Something Went Wrong !');
         }   

    })
    .catch(function(error) {
             $('#addReviewModal').modal('hide');
             alert('Something Went Wrong !');
   });

}
}

  // Review Update

  function reviewUpdateDetails(detailsID){
    axios.post('/reviewDetails', {
      id: detailsID
    })
   .then(function(response) {

     if(response.status==200){
          $('#reviewEditForm').removeClass('d-none');
          $('#reviewEditLoader').addClass('d-none');    
          var jsonData = response.data;
          $('#reviewNameUpdateId').val(jsonData[0].name);
          $('#reviewDesUpdateId').val(jsonData[0].des);
          $('#reviewImgUpdateId').val(jsonData[0].img);
      }
    
    else{
        $('#reviewEditLoader').addClass('d-none');
        $('#reviewEditWrong').removeClass('d-none');
      }
    })
    .catch(function(error) {
        $('#reviewEditLoader').addClass('d-none');
        $('#reviewEditWrong').removeClass('d-none');
  });

}

$('#reviewUpdateConfirmBtn').click(function(){
var reviewID=$('#reviewEditId').html();
var  reviewName=$('#reviewNameUpdateId').val();
var  reviewDes=$('#reviewDesUpdateId').val();
var  reviewImg=$('#reviewImgUpdateId').val();
reviewUpdate(reviewID,reviewName,reviewDes,reviewImg);
})

function reviewUpdate(reviewID,reviewName,reviewDes,reviewImg) {

if(reviewName.length==0){
alert('Review Name is Required!');
}
else if(reviewDes.length==0){
alert('Review Description is Required !');
}
else if(reviewImg.length==0){
alert('Review Image is Required !');
}
else{
$('#reviewUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
axios.post('/reviewUpdate', {
id: reviewID,
reviewName:reviewName,
reviewDesc:reviewDes,           
reviewImg:reviewImg   
})
.then(function(response) {
$('#reviewUpdateConfirmBtn').html("Save");
if(response.status==200){
if (response.data == 1) {
  $('#updateReviewModal').modal('hide');
  alert('Update Success');
  getReviewData();
} else {
  $('#updateReviewModal').modal('hide');
  alert('Update Fail');
  getReviewData();
}  
} 
else{
$('#updateReviewModal').modal('hide');
alert('Something Went Wrong !');
}   
})
.catch(function(error) {
$('#updateReviewModal').modal('hide');
alert('Something Went Wrong !');
});

}
}

 // Review Delete Confirm 
 $('#reviewDeleteConfirmBtn').click(function(){
  var id= $('#reviewDeleteId').html();
  reviewDelete(id);
})


// Review Delete
function reviewDelete(deleteID) {
 $('#reviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
   axios.post('/reviewDelete', {
           id: deleteID
       })
       .then(function(response) {
           $('#reviewDeleteConfirmBtn').html("Yes");
           if(response.status==200){
           if (response.data == 1) {
               $('#deleteReviewModal').modal('hide');
               alert('Delete Success');
       getReviewData();
           } else {
               $('#deleteReviewModal').modal('hide');
               alert('Delete Fail');
       getReviewData();
           }

           }
           else{
             $('#reviewDeleteConfirmBtn').html("Yes");
            $('#deleteReviewModal').modal('hide');
            alert('Something Went Wrong !');
           }

       })
       .catch(function(error) {
            $('#reviewDeleteConfirmBtn').html("Yes");
            $('#deleteReviewModal').modal('hide');
            alert('Something Went Wrong !');
       });

}






     

</script>
    
@endsection