// Owl Carousel Start..................
$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});

// Owl Carousel End..................

// Contact Send
$('#contactSendBtnId').click(function(){
   var name= $('#contactNameId').val();
   var mobile= $('#contactMobileId').val();
   var email= $('#contactEmailId').val();
   var msg= $('#contactMsgId').val();
   sendContact(name,mobile,email,msg)
})

function sendContact(contactName,contactMobile,contactEmail,contactMsg) {
    if(contactName.length==0){
      $('#contactSendBtnId').html('আপনার নাম লিখুন');
      setTimeout(function(){
        $('#contactSendBtnId').html('পাঠিয়ে দিন');
      },2000);
    }else if(contactMobile.length==0){
        $('#contactSendBtnId').html('আপনার মোবাইল নাম্বার লিখুন');
        setTimeout(function(){
            $('#contactSendBtnId').html('পাঠিয়ে দিন');
          },2000);
    } else if(contactEmail.length==0){
        $('#contactSendBtnId').html('আপনার ইমেইল লিখুন');
        setTimeout(function(){
            $('#contactSendBtnId').html('পাঠিয়ে দিন');
          },2000);

    }else if(contactMsg.length==0){
        $('#contactSendBtnId').html('আপনার মেসেজ লিখুন');
        setTimeout(function(){
            $('#contactSendBtnId').html('পাঠিয়ে দিন');
          },2000);
    }else{
        $('#contactSendBtnId').html('পাঠানো হচ্ছে...');
        axios.post('/contactSend',{
            contactName:contactName,
            contactMobile:contactMobile,
            contactEmail:contactEmail,
            contactMsg:contactMsg
        }).then(function(response) {
           if(response.status==200){
                if(response.data==1){
                    $('#contactSendBtnId').html('আপনার মেসেজের জন্য ধন্যবাদ');
                    setTimeout(function(){
                        $('#contactSendBtnId').html('পাঠিয়ে দিন');
                      },3000);
                }else{

                }
           }else{
            $('#contactSendBtnId').html('মেসেজ যায় নাই। আবার চেষ্ঠা করুন');
            setTimeout(function(){
                $('#contactSendBtnId').html('পাঠিয়ে দিন');
              },3000);

           }
            
        
        }).catch(function(error){
            $('#contactSendBtnId').html('আবার চেষ্ঠা করুন');
            setTimeout(function(){
                $('#contactSendBtnId').html('পাঠিয়ে দিন');
              },3000);
        });

    }


}
