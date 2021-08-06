@extends('layout.app')
@section('title','Contact')
@section('content')

<div id="mainDivContact"  class="container  d-none">
    <div class="row">
        <div class="col-md-12 p-3">
            <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Mobile</th>
                    <th class="th-sm">Email</th>
                    <th class="th-sm">Message</th>
                    <th class="th-sm">Delete</th>
                </tr>
                </thead>
                <tbody id="contactTable">

                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="loaderDivContact" class="container">
    <div class="row">
        <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
        </div>
    </div>
</div>


<div id="wrongDivContact" class="container d-none">
    <div class="row">
        <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-body p-3 text-center">
           <h5 class="mt-4">Do You Want To Delete?</h5>
           <h5 id="contactDeleteId" class="mt-4 d-none">   </h5>
       </div>
       <div class="modal-footer">
           <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
           <button  id="contactDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
       </div>
   </div>
</div>
</div>



    
@endsection

@section('script')
<script type="text/javascript">
 getContactData();
    
        //For Contact Table
        function getContactData() {
            axios.get('/getcontactData')
                .then(function(response) {
                    if (response.status == 200) {
                        $('#mainDivContact').removeClass('d-none');
                        $('#loaderDivContact').addClass('d-none');
                        $('#contactDataTable').DataTable().destroy();

                        $('#contactTable').empty();
                        var jsonData = response.data;
                        $.each(jsonData, function(i, item) {
                            $('<tr>').html(
                                "<td>"+jsonData[i].contactName+"</td>" +
                                "<td>"+jsonData[i].contactMobile+"</td>" +
                                "<td>"+jsonData[i].contactEmail+"</td>" +
                                "<td>"+jsonData[i].contactMsg+"</td>" +
                                "<td><a class='contactDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#contactTable');
                        });
                        $('.contactDeleteBtn').click(function(){

                            var id= $(this).data('id');
                            $('#contactDeleteId').html(id);
                            $('#deleteContactModal').modal('show');
                        })
                        $('#contactDataTable').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');
                    } else {
                        $('#loaderDivContact').addClass('d-none');
                        $('#wrongDivContact').removeClass('d-none');
                    }
                })
                .catch(function(error) {
                    $('#loaderDivContact').addClass('d-none');
                    $('#wrongDivContact').removeClass('d-none');
                });
        }

         // Contact Delete Confirm
         $('#contactDeleteConfirmBtn').click(function(){
          var id= $('#contactDeleteId').html();
          contactDelete(id);
      })
      // Contact Delete
      function contactDelete(deleteID) {
          $('#contactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
          axios.post('/contactDelete', {
              id: deleteID
          })
              .then(function(response) {
                  $('#contactDeleteConfirmBtn').html("Yes");
                  if(response.status==200){
                      if (response.data == 1) {
                          $('#deleteContactModal').modal('hide');
                          alert('Delete Success');
                          getContactData();
                      } else {
                          $('#deleteContactModal').modal('hide');
                          alert('Delete Fail');
                          getContactData();
                      }
                  }
                  else{
                      $('#contactDeleteConfirmBtn').html("Yes");
                      $('#deleteContactModal').modal('hide');
                      alert('Something Went Wrong !');
                  }
              })
              .catch(function(error) {
                  $('#contactDeleteConfirmBtn').html("Yes");
                  $('#deleteContactModal').modal('hide');
                  alert('Something Went Wrong !');
              });
      }



</script>
    
@endsection