@extends('layout.app')
@section('title','Projects')
@section('content')

<div id="mainDivProject"  class="container  d-none">
    <div class="row">
    <div class="col-md-12 p-3">
    <button id="addNewProjectBtnId" class="btn my-3 btn-sm btn-danger">Add New Project </button>
    <table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
        <th class="th-sm">Name</th>
        <th class="th-sm">Description</th>
        <th class="th-sm">Edit</th>
        <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="projectTable">
    
      </tbody>
    </table>
    </div>
    </div>
    </div>
    
    
    <div id="loaderDivProject" class="container">
    <div class="row">
    <div class="col-md-12 text-center p-5">
        <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
    </div>
    </div>
    
    
    <div id="wrongDivProject" class="container d-none">
    <div class="row">
    <div class="col-md-12 text-center p-5">
        <h3>Something Went Wrong !</h3>
    </div>
    </div>
    </div>


{{-- Add New Project --}}

<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-header">
      <h5 class="modal-title">Add New Project</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body  text-center">
     <div class="container">
      <div class="row">
        <div class="col-md-12">
            <input id="projectNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
            <input id="projectDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
            <input id="projectLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
            <input id="projectImgId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
      </div>
     </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
      <button  id="projectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>
</div>

{{-- Update Project --}}



<div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
      
      <h5 id="projectEditId" class="mt-4 d-none">  </h5>

       <div id="projectEditForm" class="container d-none">

        <div class="row">
          <div class="col-md-12">
          <input id="projectNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
          <input id="projectDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Description">  
          <input id="projectLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
          <input id="projectImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
         </div>
       </div>

          <img id="projectEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          <h5 id="projectEditWrong" class="d-none">Something Went Wrong !</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="projectUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
</div>

{{-- Delete Project --}}
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 id="projectDeleteId" class="mt-4 d-none">   </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="projectDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



    
@endsection

@section('script')
<script type="text/javascript">
getProjectData()

//For Project Table 
function getProjectData() {
    axios.get('/getProjectData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivProject').removeClass('d-none');
                $('#loaderDivProject').addClass('d-none');

                $('#projectDataTable').DataTable().destroy();
                
                $('#projectTable').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>"+jsonData[i].projectName+"</td>" +
                        "<td>"+jsonData[i].projectDesc+"</td>" +  
                        "<td><a class='projectEditBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='projectDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#projectTable');
                });
                     $('.projectDeleteBtn').click(function(){
                       
                      var id= $(this).data('id');
                     $('#projectDeleteId').html(id);
                     $('#deleteProjectModal').modal('show');
                     })

                     $('.projectEditBtn').click(function(){
                        var id= $(this).data('id');
                        projectUpdateDetails(id);
                        $('#projectEditId').html(id);
                        $('#updateProjectModal').modal('show');
                     })
                    

                  

                  $('#projectDataTable').DataTable({"order":false});
                  $('.dataTables_length').addClass('bs-select');



            } else {

                $('#loaderDivProject').addClass('d-none');
                $('#wrongDivProject').removeClass('d-none');

            }

        })
        .catch(function(error) {
                $('#loaderDivProject').addClass('d-none');
                $('#wrongDivProject').removeClass('d-none');
        });

}

$('#addNewProjectBtnId').click(function(){
  $('#addProjectModal').modal('show');
});

$('#projectAddConfirmBtn').click(function(){
  var name=$('#projectNameId').val();
  var des=$('#projectDesId').val();
  var link=$('#projectLinkId').val();
  var img=$('#projectImgId').val();
  console.log("Faisal",name,des,link,img)
projectAdd(name,des,link,img)
});



// For Adding New Project

  
  function projectAdd(projectName,projectDesc,projectLink,projectImg){
    
      if(projectName.length==0){
      alert("Project Name Required");
      }
      else if(projectDesc.length==0){
        alert("Project Description Required");
      }
      else if(projectLink.length==0){
        alert("Project Description Required");
      }
      else if(projectImg.length==0){
        alert("Project Image Required");
      }
  
      else{
      $('#projectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
      axios.post('/projectAdd',{
        name:projectName,
        des:projectDesc,
        link:projectLink,
        img:projectImg
        
      }).then(function(response){
              $('#projectAddConfirmBtn').html("Save");
            
              if(response.status==200){
  
                if (response.data == 1) {
                  $('#addProjectModal').modal('hide');
                  alert("Project Add Successful");
                  getProjectData();
              } else {
                  $('#addProjectModal').modal('hide');
                  alert("Project Add Fail");
                  getProjectData();
              }  
           } 
           else{
               $('#addProjectModal').modal('hide');
               alert("Something Went Wrong");
           }   
  
      })
      .catch(function(error) {
     
               $('#addProjectModal').modal('hide');
               alert("Something Went Wrong");
     });
  
  }
  
  }

          // Project Update

          function projectUpdateDetails(detailsID){
            axios.post('/projectDetails', {
              id: detailsID
            })
           .then(function(response) {

             if(response.status==200){
                  $('#projectEditForm').removeClass('d-none');
                  $('#projectEditLoader').addClass('d-none');    
                  var jsonData = response.data;
                  $('#projectNameUpdateId').val(jsonData[0].projectName);
                  $('#projectDesUpdateId').val(jsonData[0].projectDesc);
                  $('#projectLinkUpdateId').val(jsonData[0].projectLink);
                  $('#projectImgUpdateId').val(jsonData[0].projectImg);
              }
            
            else{
                $('#projectEditLoader').addClass('d-none');
                $('#projectEditWrong').removeClass('d-none');
              }
            })
            .catch(function(error) {
                $('#projectEditLoader').addClass('d-none');
                $('#projectEditWrong').removeClass('d-none');
          });

  }

$('#projectUpdateConfirmBtn').click(function(){
var projectID=$('#projectEditId').html();
var  projectName=$('#projectNameUpdateId').val();
var  projectDes=$('#projectDesUpdateId').val();
var projectLink=$('#projectLinkUpdateId').val();
var  projectImg=$('#projectImgUpdateId').val();
projectUpdate(projectID,projectName,projectDes,projectLink,projectImg);
})

function projectUpdate(projectID,projectName,projectDes,projectLink,projectImg) {

if(projectName.length==0){
alert('Project Name Required');
}
else if(projectDes.length==0){
  alert('Project Description Required');
}
else if(projectLink.length==0){
  alert('Project Link Required');
}
else if(projectImg.length==0){
  alert('Project Image Required');
}
else{
$('#projectUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
axios.post('/projectUpdate', {
      id: projectID,
      projectName:projectName,
      projectDesc:projectDes,
      projectLink:projectLink,             
      projectImg:projectImg   
  })
  .then(function(response) {
      $('#projectUpdateConfirmBtn').html("Save");
      if(response.status==200){
        if (response.data == 1) {
          $('#updateProjectModal').modal('hide');
          alert('Update Successful');
          getProjectData();
      } else {
          $('#updateProjectModal').modal('hide');
          alert('Update Fail');
          getProjectData();
      }  
   } 
   else{
      $('#updateProjectModal').modal('hide');
      alert('Something Went Wrong !');
   }   
})
.catch(function(error) {
  $('#updateProjectModal').modal('hide');
  alert('Something Went Wrong !');
});

}
}

// Project Delete 


 // Project Delete Confirm 
 $('#projectDeleteConfirmBtn').click(function(){
  var id= $('#projectDeleteId').html();
  projectDelete(id);
})


// Project Delete Method
function projectDelete(deleteID) {
 $('#projectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
   axios.post('/projectDelete', {
           id: deleteID
       })
       .then(function(response) {
           $('#projectDeleteConfirmBtn').html("Yes");
           if(response.status==200){
           if (response.data == 1) {
               $('#deleteProjectModal').modal('hide');
               alert('Delete Success');
       getProjectData();
           } else {
               $('#deleteProjectModal').modal('hide');
               alert('Delete Fail');
       getProjectData();
           }

           }
           else{
             $('#projectDeleteConfirmBtn').html("Yes");
            $('#deleteProjectModal').modal('hide');
            alert('Something Went Wrong !');
           }

       })
       .catch(function(error) {
            $('#projectDeleteConfirmBtn').html("Yes");
            $('#deleteProjectModal').modal('hide');
            alert('Something Went Wrong !');
       });

}


</script>
    
@endsection