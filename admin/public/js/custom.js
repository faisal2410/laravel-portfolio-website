
        $('#imgInput').change(function () {
            var reader=new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload=function (event) {
               var imgSource= event.target.result;
                $('#imgPreview').attr('src',imgSource)
            }
        })


        $('#savePhoto').on('click',function () {
            $('#savePhoto').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
           var photoFile= $('#imgInput').prop('files')[0];
           var formData=new FormData();
           formData.append('photo',photoFile);
           axios.post("/photoUpload",formData).then(function (response) {
               if(response.status==200 && response.data==1){
                   $('#photoModal').modal('hide');
                   $('#savePhoto').html('Save');
                   alert('Photo Upload Success');
               }
               else{
                   $('#photoModal').modal('hide');
                   alert('Photo Upload Fail');
               }
           }).catch(function (error) {
               $('#photoModal').modal('hide');
               alert('Photo Upload Fail');
               $('#savePhoto').html('Save');
           })

        });


       



        function loadPhoto() {
            let URL="/photoJSON";
            axios.get(URL).then(function (response) {
                   $.each(response.data, function(i, item) {
                    $("<div class='col-md-4 p-1'>").html(
                        "<img data-id="+ item['id']+" class='imgOnRow' src=" + item['location'] + ">"+
                        "<button data-id="+ item['id']+" data-photo="+ item['location']+" class='btn deletePhoto btn-sm'> Delete</button>"
                    ).appendTo('.photoRow');
                })


                $('.deletePhoto').on('click',function (event) {
                    let id=$(this).data('id');
                    let photo=$(this).data('photo');

                    photoDelete(photo,id);

                    event.preventDefault();
                })

            }).catch(function (error) {

            })
        }


            var  imgId=0;
        function loadById(firstImgId,loadMoreBtn){
            imgId=imgId+3;
            let photoId=imgId+firstImgId;
            let URL="/photoJSONById/"+photoId

             loadMoreBtn.html("<div class='spinner-border spinner-border-sm' role='status'></div>")
             axios.get(URL).then(function (response) {
                 loadMoreBtn.html("Load More");
                $.each(response.data, function(i, item) {
                    $("<div class='col-md-4 p-1'>").html(
                        "<img data-id="+ item['id']+" class='imgOnRow' src=" + item['location'] + ">"+
                        "<button data-id="+ item['id']+" data-photo="+ item['location']+" class='btn deletePhoto btn-sm'> Delete</button>"
                    ).appendTo('.photoRow');
                })
                $('.deletePhoto').on('click',function (event) {
                    let id=$(this).data('id');
                    let photo=$(this).data('photo');

                    photoDelete(photo,id);

                    event.preventDefault();
                })

            }).catch(function (error) {

            })

        }

        $('#loadMoreBtn').on('click',function () {
           let loadMoreBtn=$(this);
           let firstImgId= $(this).closest('div').find('img').data('id');
           loadById(firstImgId,loadMoreBtn);
        })



        function photoDelete(oldPhotoURL,id) {
                let URL="/photoDelete";
                let myFormData=new FormData();
                myFormData.append('oldPhotoURL',oldPhotoURL);
                myFormData.append('id',id);
                axios.post(URL,myFormData).then(function (response) {
                    if(response.status==200 && response.data==1){
                        alert('Photo Delete Success');
                        window.location.href="/photo";

                    }
                    else{
                        alert('Delete Fail Try Again');
                    }
                }).catch(function () {
                    alert('Delete Fail Try Again');
                })

        }