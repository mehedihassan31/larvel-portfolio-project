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

$('#contactconfirmbtn').click(function(){
    var contactName=$('#contactNameId').val();
    var contactMob=$('#contactMobId').val();
    var contactEmail=$('#contactEmailId').val();
    var contactMessage=$('#contactMessageId').val();

    sendContact(contactName,contactMob,contactEmail,contactMessage);


})

function sendContact(contact_name,contact_mobile,contact_email,contact_msg){

    if(contact_name.length==0){
        
        $('#contactconfirmbtn').html('please input name')
        setTimeout(function(){
            $('#contactconfirmbtn').html('পাঠিয়ে দিন ')
        },1000)

    }else if(contact_mobile.length==0){
        $('#contactconfirmbtn').html('please input mobile')
        setTimeout(function(){
            $('#contactconfirmbtn').html('পাঠিয়ে দিন ')
        },1000)

    }else if(contact_email.length==0){
        $('#contactconfirmbtn').html('please input email')
        setTimeout(function(){
            $('#contactconfirmbtn').html('পাঠিয়ে দিন ')
        },1000)
        
    }else if(contact_msg.length==0){
        $('#contactconfirmbtn').html('please input msg')
        setTimeout(function(){
            $('#contactconfirmbtn').html('পাঠিয়ে দিন ')
        },1000)
        
    }else{
        $('#contactconfirmbtn').html('Sending')
        axios.post('/Contactsend',{
            contact_name:contact_name,
            contact_mobile:contact_mobile,
            contact_email:contact_email,
            contact_msg: contact_msg
    
        })
        .then(function(response){
            if(response.status==200){

                if(response.data==1){
                    $('#contactconfirmbtn').html('Sucess!')
                    setTimeout(function(){
                        $('#contactconfirmbtn').html('পাঠিয়ে দিন ')
                    },2000)

                }else{
                    $('#contactconfirmbtn').html('try again')
                    setTimeout(function(){
                        $('#contactconfirmbtn').html('পাঠিয়ে দিন ')
                    },2000)


                }

            }else{
                $('#contactconfirmbtn').html('try again')
                setTimeout(function(){
                    $('#contactconfirmbtn').html('পাঠিয়ে দিন ')
                },2000)

            }
    
    
        }).catch(function(error){
            $('#contactconfirmbtn').html('try again')
            setTimeout(function(){
                $('#contactconfirmbtn').html('পাঠিয়ে দিন ')
            },2000)
    
    
        })
    }





}