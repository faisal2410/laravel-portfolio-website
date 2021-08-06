@extends('layout.app')
@section('title','Services')

@section('content')
<div id="mainDiv" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">
      <button id="addNewBtnId" class="btn my-3 btn-sm btn-danger">Add New</button>
    <table id="serviceDataTable" class="table table-striped table-bordered display" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Image</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Description</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id=serviceTable>
        
      </tbody>
    </table>
    
    </div>
    </div>
    </div>

    <div id="loaderDiv"class="container">
      <div class="row">
      <div class="col-md-12 text-center p-5">
     <img class="loading-icon m-5" src="{{ asset('images/loader.svg') }}" alt="">
      
      </div>
      </div>
      </div>

      <div id="wrongDiv" class="container d-none">
        <div class="row">
        <div class="col-md-12 text-center p-5">
       <h1>Something Went Wrong!</h1>
        
        </div>
        </div>
        </div>


<div
  class="modal fade"
  id="deleteModal"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">     
      <div class="modal-body text-center p-3 mt-4"><h5>Do You Want to Delete?</h5></div>
      <h5 id="serviceDeleteId" class="mt-4 text-center d-none"></h5>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
          No
        </button>
        <button  id="serviceDeleteConfirmBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>
<div
  class="modal fade"
  id="editModal"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog ">
    <div class="modal-content">  
      <div class="modal-body p-5 text-center">
        <h5 id="serviceEditId" class="mt-4 text-center d-none"></h5>
        <div id="serviceEditForm" class="w-100 d-none">
          <input id="serviceNameId" type="email" id="" class="form-control mb-4 " placeholder="Service Name" />
          <input id="serviceDesId" type="email" id="" class="form-control mb-4" placeholder="Service Description" />
          <input id="serviceImgId" type="email" id="" class="form-control mb-4" placeholder="Service Image Link" />
        </div>
      
        <img id="serviceEditLoader" class="loading-icon m-5 text-center"  src="{{ asset('images/loader.svg') }}" alt="">
        <h5 id="serviceEditWrong" class="d-none">Something Went Wrong!</h5>     
      
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
          Cancel
        </button>
        <button  id="serviceEditConfirmBtn" type="button" class="btn btn-danger btn-sm">Save</button>
      </div>
    </div>
  </div>
</div>

<div
  class="modal fade"
  id="addModal"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog ">
    <div class="modal-content">  
      <div class="modal-body p-5 text-center">
      
        <div id="serviceAddForm" class="w-100 ">
          <h6 class="mb-4">Add New Service</h6>
          <input id="serviceNameAddId" type="email" id="" class="form-control mb-4 " placeholder="Service Name" />
          <input id="serviceDesAddId" type="email" id="" class="form-control mb-4" placeholder="Service Description" />
          <input id="serviceImgAddId" type="email" id="" class="form-control mb-4" placeholder="Service Image Link" />
        </div>     
         
      
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
          Cancel
        </button>
        <button  id="serviceAddConfirmBtn" type="button" class="btn btn-danger btn-sm">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
getServicesData();

// For Services Table
function getServicesData() {
  axios.get('/getServicesData')
      .then(function(response) {
          if (response.status == 200) {
              $('#mainDiv').removeClass('d-none');
              $('#loaderDiv').addClass('d-none');             
              $('#serviceDataTable').DataTable().destroy();
              $('#serviceTable').empty();
              var jsonData = response.data
              $.each(jsonData, function(i, item) {
                  $('<tr>').html(
                      "<td><img class='table-img'src=" + jsonData[i].serviceImg + ">  + </td>" +
                      "<td>" + jsonData[i].serviceName + "</td>" +
                      "<td>" + jsonData[i].serviceDes + "</td>" +
                      "<td><a class='serviceEditBtn'  data-id=" + jsonData[i].id +"><i class='fas fa-edit'></i></a></td>" +
                      "<td><a class='serviceDeleteBtn'data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                  ).appendTo('#serviceTable');

              })

              // Services Table Delete Icon Click
              $('.serviceDeleteBtn').click(function() {
                  var id = $(this).data('id');
                  $('#serviceDeleteId').html(id)
                  $('#deleteModal').modal('show');
              })
              

              // Services Table Edit Icon Click 
              $('.serviceEditBtn').click(function() {
                var id = $(this).data('id');
                $('#serviceEditId').html(id)
                serviceUpdateDetails(id)
                $('#editModal').modal('show');
              
              })
               // Service Edit Modal Yes Button
               $('#serviceEditConfirmBtn').click(function() {
                })

                $('#serviceDataTable').DataTable({"order":false});
               $('.dataTables_length').addClass('bs-select');

                  
             


          } else {
              $('#loaderDiv').addClass('d-none');
              $('#wrongDiv').removeClass('d-none');

          }



      }).catch(function(error) {
          $('#loaderDiv').addClass('d-none');
          $('#wrongDiv').removeClass('d-none');

      });
}
// Service Delete Modal Yes Button
$('#serviceDeleteConfirmBtn').click(function() {
    var id = $('#serviceDeleteId').html();
    serviceDelete(id);
})
    

// Service Delete
function serviceDelete(deleteId) {
    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border' role='status'></div>")   //Animation .....

  axios.post('/serviceDelete', {
          id: deleteId
      })
      .then(function(response) {
        $('#serviceDeleteConfirmBtn').html("Yes");
          if (response.data == 1) {
              $('#deleteModal').modal('hide');
              getServicesData();
              alert("Delete Success");

          } else {
              $('#deleteModal').modal('hide');
              alert("Delete Fail");
              getServicesData()

          }
      }).catch(function(error) {
        $('#deleteModal').modal('hide');
              alert("Something Went Wrong");
      })

}


//  Each Service Update Details
function serviceUpdateDetails(detailsId) {
    axios.post('/serviceDetails', {
            id: detailsId
        })
        .then(function(response) {
            if(response.status==200){
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditForm').removeClass('d-none');
               
                var jsonData = response.data;
                $('#serviceNameId').val(jsonData[0].serviceName);
                $('#serviceDesId').val(jsonData[0].serviceDes);
                $('#serviceImgId').val(jsonData[0].serviceImg);
            } else{
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditWrong').removeClass('d-none');
                

            }
        
        }).catch(function(error) {
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').removeClass('d-none');
        })
  
  }
  // Service Edit Modal Save Button
  $('#serviceEditConfirmBtn').click(function() {
    var id = $('#serviceEditId').html();
    var name = $('#serviceNameId').val();
    var des = $('#serviceDesId').val();
    var img = $('#serviceImgId').val();

    serviceUpdate(id,name,des,img)   
})

// Service Update
  function serviceUpdate(serviceId,serviceName,serviceDes,serviceImg) {
      if (serviceName.length==0){
          alert('Service Name Required');

      }else if(serviceDes.length==0){
        alert('Service Description Required');
      }else if(serviceImg.length==0){
        alert('Service Image Required');
      }else{
        $('#serviceEditConfirmBtn').html("<div class='spinner-border' role='status'></div>")   //Animation .....
        axios.post('/serviceUpdate', {
            id: serviceId,
            name:serviceName,
            des:serviceDes,
            img:serviceImg
        })
        .then(function(response) {
            $('#serviceEditConfirmBtn').html("Save");
            if(response.status == 200){
                if (response.data == 1) {
                    $('#editModal').modal('hide');
                    getServicesData();
                    alert("Update Success");
      
                } else {
                    $('#editModal').modal('hide');
                    alert("Update Fail");
                    getServicesData()
      
                }
            }else{
                $('#editModal').modal('hide');
                alert("Something Went Wrong");
            }
          
         
        }).catch(function(error) {
            $('#editModal').modal('hide');
            alert("Something Went Wrong");
        })
  

      }
  
  }

//   Service Add New Btn Click 

$('#addNewBtnId').click(function(){

    $('#addModal').modal('show');
})

  // Service Add Modal Save Button
  $('#serviceAddConfirmBtn').click(function() {
    var name = $('#serviceNameAddId').val();
    var des = $('#serviceDesAddId').val();
    var img = $('#serviceImgAddId').val();

    serviceAdd(name,des,img)   
})

// Service Add Method

function serviceAdd(serviceName,serviceDes,serviceImg) {
    if (serviceName.length==0){
        alert('Service Name Required');

    }else if(serviceDes.length==0){
      alert('Service Description Required');
    }else if(serviceImg.length==0){
      alert('Service Image Required');
    }else{
      $('#serviceAddConfirmBtn').html("<div class='spinner-border' role='status'></div>")   //Animation .....
      axios.post('/serviceAdd', {
          name:serviceName,
          des:serviceDes,
          img:serviceImg
      })
      .then(function(response) {
          $('#serviceAddConfirmBtn').html("Save");
          if(response.status == 200){
              if (response.data == 1) {
                  $('#addModal').modal('hide');
                  getServicesData();
                  alert("Add Success");
    
              } else {
                  $('#addModal').modal('hide');
                  alert("Add Fail");
                  getServicesData()
    
              }
          }else{
              $('#addModal').modal('hide');
              alert("Something Went Wrong");
          }
        
       
      }).catch(function(error) {
          $('#addModal').modal('hide');
          alert("Something Went Wrong");
      })


    }

}



</script>    
@endsection