$(document).ready(function() {    
    const make_an_appointments = $(".make-an-appointment");        
    if(make_an_appointments.length)
    {
        const box_effective_time_short_links = $(".box-effective-time-short-link")
        const box_expired_short_links = $(".box-expired-short-link")
        const error_validate_short_links = $(".error-validate-short-link")
        const input_effective_times = $(".effective-time-short-link")
        const input_expireds = $(`.expired-short-link`) 
        const limit_visitss = $(".limit-visits-short-link");
        for (const limit_visits of limit_visitss) {            
            createInputNumber($(limit_visits),0,9999999999,true)
        }
        for (let index = 0; index < make_an_appointments.length; index++) {                                        
            const box_expired_short_link = $(box_expired_short_links[index]);
            const box_effective_time_short_link = $(box_effective_time_short_links[index]);            
            $(make_an_appointments[index]).change(function(){
                if($(this).is(":checked"))
                {                    
                    box_expired_short_link.addClass("col-lg-6")
                    box_expired_short_link.removeClass("col-lg-12")                
                    setTimeout(()=>{
                        box_effective_time_short_link.fadeIn();
                    },300)              
                }    
                else
                {
                    box_effective_time_short_link.fadeOut();
                    setTimeout(()=>{
                        box_expired_short_link.removeClass("col-lg-6")
                        box_expired_short_link.addClass("col-lg-12")
                    },400)
                }  
            })  
        }                  
        $.get(BASE_URL_API+PREFIX_SETTING+PREFIX_MAXIMUN_TERM_EXPIRED,(res)=>{
            const expired = res.data;
            checkTimeValidate = (index = 0)=>{
                const error_validate_short_link = $(error_validate_short_links[index])
                const input_effective_time = $(input_effective_times[index])
                const input_expired = $(input_expireds[index])
                const startTime = new Date(input_effective_time.val())
                const endTime = new Date(input_expired.val()) 
                const make_an_appointment = $(make_an_appointments[index]);
                var today = new Date();                              
                if(today > endTime)
                {
                    errorShow(input_expired,error_validate_short_link,"Invalid end time")
                    return false;
                }            
                else
                    errorHide(input_expired,error_validate_short_link)         
                if(make_an_appointment.is(":checked"))
                {               
                    if(startTime > endTime)
                    {
                        errorShow(input_effective_time,error_validate_short_link,"Invalid start time")
                        return false;
                    }
                    else
                    {                    
                        errorHide(input_effective_time,error_validate_short_link)                
                    }
                }                                
                var expiredTime;
                if(make_an_appointment.is(":checked"))
                {
                    startTime.setDate(startTime.getDate()+expired)
                    expiredTime = startTime
                }
                else
                {                    
                    today.setDate(today.getDate()+expired)
                    expiredTime = today
                }             
                if(expiredTime <= endTime)
                {
                    errorShow(input_effective_time,error_validate_short_link,"Registration time exceeds regulations")
                    input_expired.addClass("border-error")   
                    return false;                  
                }
                else
                {
                    errorHide(input_effective_time,error_validate_short_link)
                    input_expired.removeClass("border-error")    
                }                

                return true;
            }    
            for (let index = 0; index < box_effective_time_short_links.length; index++) {
                const box_effective_time_short_link = $(box_effective_time_short_links[index]);
                const box_expired_short_link = $(box_expired_short_links[index]);
                box_effective_time_short_link.change(()=>{checkTimeValidate(index)})
                box_expired_short_link.change(()=>{checkTimeValidate(index)})
            }                                      
         })  
    }    
    
    const btn_QRCode = $("#btn-qrcode");
    const content_show_qrcode = $(".tab-panee.tab-qrcode");
    const input_short_link = $("#input-shorted-link")
    const count_custom_link_title = $("#count-custom-link-title");
    var clipboard = new ClipboardJS(input_short_link[0], {
        text: function() {                         
            return input_short_link.val();
        }
      });
    clipboard.on('success', function(e) {                       
        handleCreateToast("success","copied","shorl-link-"+e.text,true);
        e.clearSelection();                    
    });
    $("#form-short-link").on("submit",function(ev){
        ev.preventDefault();     
        if($("#input-link").val()!="")
        {
            var formData = $(this).serialize();
            $("#error-validate-short-link-insert").text("");
            ShortLink(formData,(res)=>{  
                console.log(res)              
                if(res.success)
                {
                    var shortened_link = res.data.shortened_link
                    input_short_link.val(URL_HOST+"/"+shortened_link) 
                    input_short_link.data("shortened_link",shortened_link)                   
                    if(res.data.vefify)       
                    {
                        if(btn_QRCode.data("vefify") == undefined)
                        {                            
                            btn_QRCode.data("vefify",true)
                            btn_QRCode.click(function(){                        
                                GetQRCode(input_short_link.data("shortened_link"),(res)=>{                                                                
                                    if(res.success)
                                    {
                                        content_show_qrcode.html(`<br>
                                                                <center>
                                                                    <h4>This is the QR Code for your <a href="${res.data}" id="href-short-link">${URL_HOST+"/"+shortened_link}</a> shortened link:</h4>
                                                                    <br>
                                                                    <div id="box-show-qrcode">
                                                                        <img src="${res.data.url}" alt="" sizes="100" class="w-100">
                                                                    </div>
                                                                </center>
                                                                <center><h4>You have ${res.data.create_remaining} remaining attempts to create QR Codes in this cycle</h4></center>`)
                                    }
                                },(res)=>{
                                    content_show_qrcode.html(`<center><h4>${res.error}</center>`)             
                                });                    
                            })
                        } 
                        if(res.data.count_custom_links_remaining_in_cycle < 1)
                            count_custom_link_title.text("You have no more link customizations in this cycle")   
                        else                    
                           count_custom_link_title.text(`Number of link customizations remaining in this cycle: `+res.data.count_custom_links_remaining_in_cycle)                                                                                                      
                        count_custom_link_title.attr("title",`You have ${res.data.count_custom_links_remaining_in_cycle} times left to customize link in this cycle`)                       
                    }     
                    else
                    {
                        
                    }  
                    
                }            
            },(res)=>{
                console.log(res) 
                $("#error-validate-short-link-insert").text(res.message);
                $("#error-validate-short-link-insert").slideDown();
            })
        }
        else
            handleCreateToast("error","You have not entered the original link","error",true);
    });  
    
    $(".lock-attribute").each(function(){
        $(this).find("i").on("mouseenter",function(){
            $(this).addClass("bx-tada");
        })
        $(this).find("i").on("mouseleave",function(){
            $(this).removeClass("bx-tada");
        })
    });

    //call function
    createEventSelect($("#input-shorted-link")) 
})
