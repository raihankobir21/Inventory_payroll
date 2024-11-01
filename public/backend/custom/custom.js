	/// start get auto select data
		
    function getAutoDropdownData(targetShowClass, route, orderEmptyArr)
    {
        
        $.ajax({
            type: "GET",
            url: route,
            dataType: "JSON",


            beforeSend: function(){
                $(".ajax-loader-img").css("display", "block");
                    jQuery.each( orderEmptyArr, function( j, field ) {

                            $("."+field).empty();
                            $("."+field).append('<option value="">Select</option>');
                    });
               },
               complete: function(){
                 $(".ajax-loader-img").css("display", "none");
               },

            success: function(data) {
                
                if(data)
                {
                    
                    $.each(data,function(key,value){
                        $('.'+targetShowClass).append($("<option/>", {
                           value: key,
                           text: value
                        }));
                    });
                }

            },

            error: function() {
                jQuery.each( orderEmptyArr, function( j, field ) {

                        $("."+field).empty();
                        $("."+field).append('<option value="">Select</option>');
                });
            }

        });

        
    }

/// end get auto select data   


function getChatDataByIndivisual( url, token )
{
    
    //alert(token);
                            
    $.ajax({
        url: url,
        type: "GET",
        data: {
            "_token": token,
        },

      //   beforeSend: function(){
      //         $(".ajax-loader-img").css("display", "block");
      //     },
      //     complete: function(){
      //         $(".ajax-loader-img").css("display", "none");
      //     },
        cache: false,
        success: function(data) {

              if($.isEmptyObject(data.error)){

                $('.chat-head').html(data['to_user_id']);

                  if(data['conversation']) {
							
                            $.each( data['conversation'],function( key,value ) {
                               
                                if( value.message == null){
                                    value.message = '&nbsp;';
                                }

                               var appendLeft = '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">'+value.user.name+'</span><span class="direct-chat-timestamp float-right">'+moment(value.created_at).format("D MM Y h:s a")+'</span> </div><img class="direct-chat-img" src="storage/app/public/users/'+value.user.image+'" alt="img"><div class="direct-chat-text">'+value.message+'</div></div>';
              
                               var appndRight = '<div class="direct-chat-msg right"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-right">'+value.user.name+'</span><span class="direct-chat-timestamp float-left">'+moment(value.created_at).format("D M Y h:s a")+'</span></div><img class="direct-chat-img" src="storage/app/public/users/'+value.user.image+'" alt="img"><div class="direct-chat-text">'+value.message+'</div></div>';

                               if( value.from_user_id == data['current_user_id'] ){

                                    $('.direct-chat-messages').append(appndRight);
                               
                               }else{

                                    $('.direct-chat-messages').append(appendLeft);
                                }
                               

                               

                            });

                            var scrollHeight = 250;       
                            $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight); 
                        }

              }else{

                  toastr.options =
                  {
                  "closeButton" : true,
                  "progressBar" : true
                  }
                  toastr.error("Something went wrong, Please see the error bellow.");


              }

          }

    });

}



function sendMessage( url, token, senderId, urlGet ) {
    
    var message = $('.sender-msg').val();
    //var receiverId =$('.receiver-id').val();
    
          $.ajax({
              url: url,
              type: "POST",
              data: {
                  "_token": token,
                  message: message,
                  to_user_id: senderId,
              },

            //   beforeSend: function(){
            //         $(".ajax-loader-img").css("display", "block");
            //     },
            //     complete: function(){
            //         $(".ajax-loader-img").css("display", "none");
            //     },
              cache: false,
              success: function(data) {

                    if($.isEmptyObject(data.error)){

                        getChatDataByIndivisual( urlGet, token );

                        // $(".print-error-msg").css('display', 'none');
                        // $('.detect-common').css('border', 'none');
                        // $('.sender-msg').val(''); 
                        
                         $('#form').find("input[type=text], input[type=file]").val("");
                        // $(".subject").val(subject);
                        // $('.read_term').prop('checked', false); 
                        
                        //alert(data.success);

                        // toastr.options =
                        // {
                        // "closeButton" : true,
                        // "progressBar" : true
                        // }
                        // toastr.success(data.success);

                    }else{

                        toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                        toastr.error("Something went wrong, Please see the error bellow.");

                       // printErrorMsg(data.error);

                    }

                }

          });

        }
          

          function printErrorMsg (msg) {
                
                //$(".print-error-msg").html('');
                $(".print-error-msg").html('Something went wrong, Please see the error bellow.');
               
               
                $(".print-error-msg").css('display','block');

                $('.detect-common').css('border', 'none');
                $('.detect-common-alert').html('');
                    
                $.each( msg, function( key, value ) {

                    $('.'+key).css('border', '1px solid red');
                    
                    $( "<span class='invalid-feedback detect-common-alert' role='alert'><strong>"+value+"</strong></span>" ).insertAfter( $( '.'+key ) );
                    
                    //$(".print-error-msg").find("ul").append('<li>'+value+'</li>');

                });

            }


            /// start get data

        function getSingleProductDetails(route)
        {
            
            var returnVal = '';
            $.ajax({
                type: "GET",
                url: route,
                dataType: "JSON",
                async: false,

             
                success: function(data) {
                    
                    returnVal = ''; 
                    
                    if(data)
                    {
                        returnVal = data; 
                    }

                },

                error: function() {

                    returnVal = ''; 
                }

            });

             return returnVal;
        }
		
	function seeSessionPosItem( routeSeePos )
        {
			//alert('pp');
            var returnVal = '';
            $.ajax({
                type: "GET",
                url: routeSeePos,
                dataType: "JSON",
                async: false,

             
                success: function(data) {
                    
                    returnVal = ''; 
                    
                    if(data)
                    {
                        returnVal = data; 
                    }

                },

                error: function() {

                    returnVal = ''; 
                }

            });

             return returnVal;
        }

/// end get data



           

