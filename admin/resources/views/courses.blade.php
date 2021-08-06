@extends('layout.app')
@section('title','Courses')

@section('content')
<div id="mainDivCourse" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">
        <button id="addNewCourseBtnId" class="btn my-3 btn-sm btn-danger">Add New</button>
    <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Name</th>
          <th class="th-sm">Fee</th>
          <th class="th-sm">Class</th>
          <th class="th-sm">Enroll</th>         
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id=courseTable>     
      </tbody>
    </table>
    
    </div>
    </div>
    </div>

    <div id="loaderDivCourse"class="container">
        <div class="row">
        <div class="col-md-12 text-center p-5">
       <img class="loading-icon m-5" src="{{ asset('images/loader.svg') }}" alt="">        
        </div>
        </div>
    </div>
  
        <div id="wrongDivCourse" class="container d-none">
          <div class="row">
          <div class="col-md-12 text-center p-5">
         <h1>Something Went Wrong!</h1>          
          </div>
          </div>
     </div>

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
        <button  id="courseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div
  class="modal fade"
  id="deleteCourseModal"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">     
      <div class="modal-body text-center p-3 mt-4"><h5>Do You Want to Delete?</h5></div>
      <h5 id="courseDeleteId" class="mt-4 text-center d-none"></h5>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
          No
        </button>
        <button  id="courseDeleteConfirmBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>

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
        <h5 id="courseEditId" class="mt-4 text-center d-none"></h5>
       <div id="courseEditForm" class="container d-none">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="courseNameEditId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="courseDesEditId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="courseFeeEditId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="courseEnrollEditId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="courseClassEditId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="courseLinkEditId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="courseImgEditId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
       <img id="courseEditLoader" class="loading-icon m-5 text-center"  src="{{ asset('images/loader.svg') }}" alt="">
        <h5 id="courseEditWrong" class="d-none">Something Went Wrong!</h5>   

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="courseEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

    
@endsection
@section('script')
<script type="text/javascript">
getCoursesData()
// For Courses Table
function getCoursesData() {
  axios.get('/getCoursesData')
      .then(function(response) {
          if (response.status == 200) {
              $('#mainDivCourse').removeClass('d-none');
              $('#loaderDivCourse').addClass('d-none');
              $('#courseDataTable').DataTable().destroy();
              $('#courseTable').empty();
              var jsonData = response.data
              $.each(jsonData, function(i, item) {
                  $('<tr>').html(
                      "<td>"+jsonData[i].courseName+"</td>" +
                      "<td>"+jsonData[i].courseFee+"</td>" +
                      "<td>"+jsonData[i].courseTotalClass+"</td>" +
                      "<td>"+jsonData[i].courseTotalEnroll+"</td>" +
                      "<td><a class='courseEditBtn'  data-id=" + jsonData[i].id +"><i class='fas fa-edit'></i></a></td>" +
                      "<td><a class='courseDeleteBtn'data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                  ).appendTo('#courseTable');
              })

              $('.courseDeleteBtn').click(function(){
                 var id= $(this).data('id');
                 $('#courseDeleteId').html(id);
                $('#deleteCourseModal').modal('show');
              })

              $('.courseEditBtn').click(function(){
                var id= $(this).data('id');   
                courseUpdateDetails(id)   
              $('#courseEditId').html(id);    
              $('#updateCourseModal').modal('show');
             })
             $('#courseDataTable').DataTable({"order":false});
             $('.dataTables_length').addClass('bs-select');

          } else {
              $('#loaderDivCourse').addClass('d-none');
              $('#wrongDivCourse').removeClass('d-none');
          }

      }).catch(function(error) {
          $('#loaderDivCouse').addClass('d-none');
          $('#wrongDivCourse').removeClass('d-none');
      });
}

$('#addNewCourseBtnId').click(function(){
    $('#addCourseModal').modal('show');

});

$('#courseAddConfirmBtn').click(function(){
 var courseName=   $('#CourseNameId').val();
 var courseDes=   $('#CourseDesId').val();
 var courseFee=   $('#CourseFeeId').val();
 var courseEnroll=$('#CourseEnrollId').val();
 var courseClass=  $('#CourseClassId').val();
 var courseLink = $('#CourseLinkId').val();
 var courseImg=  $('#CourseImgId').val();
courseAdd(courseName,courseDes,courseFee,courseEnroll,courseClass,courseLink,courseImg);
});

// Course Add Method

function courseAdd(courseName,courseDes,courseFee,courseTotalEnroll,courseTotalClass,courseLink,courseImg) {
    if (courseName.length==0){
        alert('Course Name Required');

    }else if(courseDes.length==0){
      alert('Course Description Required');
    }else if(courseTotalEnroll.length==0){
        alert('Course Total Enroll Required');
      }
      else if(courseTotalClass.length==0){
        alert('Course Total Class Required');
      }
      else if(courseLink.length==0){
        alert('Course Link Required');
      }
      else if(courseImg.length==0){
        alert('Course Image Required');
      }
    else{
      $('#courseAddConfirmBtn').html("<div class='spinner-border' role='status'></div>")   //Animation .....
      axios.post('/courseAdd', {
          courseName:courseName,
          courseDes:courseDes,
          courseFee:courseFee,
          courseTotalEnroll:courseTotalEnroll,
          courseTotalClass:courseTotalClass,
          courseLink:courseLink,
          courseImg:courseImg
      })
      .then(function(response) {
          $('#courseAddConfirmBtn').html("Save");
          if(response.status == 200){
              if (response.data == 1) {
                  $('#addCourseModal').modal('hide');
                  getCoursesData();
                  alert("Add Success");
    
              } else {
                  $('#addCourseModal').modal('hide');
                  alert("Add Fail");
                  getCoursesData()
    
              }
          }else{
              $('#addCourseModal').modal('hide');
              alert("Something Went Wrong");
          }
        
       
      }).catch(function(error) {
          $('#addCourseModal').modal('hide');
          alert("Something Went Wrong");
      })


    }

}
// Course Delete Confirm

$('#courseDeleteConfirmBtn').click(function() {
  var id= $('#courseDeleteId').html();
  courseDelete(id)
})

// Course Delete
function courseDelete(deleteId) {
    $('#courseDeleteConfirmBtn').html("<div class='spinner-border' role='status'></div>")   //Animation .....

  axios.post('/courseDelete', {
          id: deleteId
      })
      .then(function(response) {
        $('#courseDeleteConfirmBtn').html("Yes");
          if (response.data == 1) {
              $('#deleteCourseModal').modal('hide');
              getCoursesData();
              alert("Delete Success");

          } else {
              $('#deleteCourseModal').modal('hide');
              alert("Delete Fail");
              getCoursesData()

          }
      }).catch(function(error) {
        $('#deleteCourseModal').modal('hide');
        alert("Something Went Wrong");
      })

}

// Course Update Details

function courseUpdateDetails(detailsId){

    axios.post('/courseDetails', {
        id: detailsId
    })
    .then(function(response) {
        if(response.status==200){
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditForm').removeClass('d-none');
           
            var jsonData = response.data;
            $('#courseNameEditId').val(jsonData[0].courseName);
            $('#courseDesEditId').val(jsonData[0].courseDes);
            $('#courseFeeEditId').val(jsonData[0].courseFee);
            $('#courseEnrollEditId').val(jsonData[0].courseTotalEnroll);
            $('#courseClassEditId').val(jsonData[0].courseTotalClass);
            $('#courseLinkEditId').val(jsonData[0].courseLink);
            $('#courseImgEditId').val(jsonData[0].courseImg);

        } else{
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');
            

        }
    
    }).catch(function(error) {
        $('#courseEditLoader').addClass('d-none');
        $('#courseEditWrong').removeClass('d-none');
    })

}

$('#courseEditConfirmBtn').click(function(){
 var courseId=$('#courseEditId').html();
var  courseName=$('#courseNameEditId').val();
 var courseDes=$('#courseDesEditId').val();
 var courseFee=$('#courseFeeEditId').val();
 var courseTotalEnroll=$('#courseEnrollEditId').val();
 var courseTotalClass=$('#courseClassEditId').val();
 var courseLink =$('#courseLinkEditId').val();
 var courseImg=$('#courseImgEditId').val();

  courseUpdate(courseId,courseName,courseDes,courseFee,courseTotalEnroll,courseTotalClass,courseLink,courseImg)
})

// Course Update
function courseUpdate(courseId,courseName,courseDes,courseFee,courseTotalEnroll,courseTotalClass,courseLink,courseImg) {
    if (courseName.length==0){
        alert('Course Name Required');

    }else if(courseDes.length==0){
      alert('Course Description Required');
    }else if(courseFee.length==0){
      alert('Course Fee Required');
    }else if(courseTotalEnroll.length==0){
        alert('Course Total Enroll Required');
      }
      else if(courseTotalClass.length==0){
        alert('Course Total Class Required');
      }
      else if(courseLink.length==0){
        alert('Course Link Required');
      }
      else if(courseImg.length==0){
        alert('Course Image Required');
      }
    else{
      $('#courseEditConfirmBtn').html("<div class='spinner-border' role='status'></div>")   //Animation .....
      axios.post('/courseUpdate', {
          id: courseId,
          courseName:courseName,
          courseDes:courseDes,
          courseFee:courseFee,
          courseTotalEnroll:courseTotalEnroll,
          courseTotalClass:courseTotalClass,
          courseLink:courseLink,
          courseImg:courseImg
      })
      .then(function(response) {
          $('#courseEditConfirmBtn').html("Save");
          if(response.status == 200){
              if (response.data == 1) {
                  $('#updateCourseModal').modal('hide');
                  getCoursesData()
                  alert("Update Success");
    
              } else {
                  $('#updateCourseModal').modal('hide');
                  alert("Update Fail");
                  getCoursesData()
    
              }
          }else{
              $('#updateCourseModal').modal('hide');
              alert("Something Went Wrong");
          }
        
       
      }).catch(function(error) {
          $('#updateCourseModal').modal('hide');
          alert("Something Went Wrong");
      })


    }

}

</script>    
@endsection