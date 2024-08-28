var verifyEmail = (id,token)=>{    
    const box_show_result_verify_email = $("#box-show-result-verify-email");
    callApiVerifyEmail(id,token,
        function(res){
            if(res.success)
            {
                box_show_result_verify_email.html(`<center><h3>${res.message}</h3></center>
                                                    <center><a href="/">Click here to visit our website</a></center>`)
            }
        },
        function(res){
            box_show_result_verify_email.html(`<center><h3>${res.message}</h3></center>`)
        })
}

var buildMessageVerifyEmail = ()=>{
    const element = $(`<div class="box-message-confim-email row">
                            <div class="col-11 box-message-confim-email-title">
                                <center><span class="title-message-confim-email" >Please access your email and click on the verification email to complete the registration process!</span></center>
                                <center>If you have verified your email, <a href="${window.location}">click here</a></center>
                                <center id="box-re-send-verify-email"><button class="btn-re-send-verify-email btn btn-outline-secondary">Click here if you have not received our confirmation email</button></center>
                                <div id="box-show-countdown-timer"></div>                            
                            </div>
                            <div class="col-1 box-close-mes">
                                <button class="icon-close btn-close" title="close">
                                    <i class='bx bx-x'></i>
                                </button>
                            </div>                    
                        </div>  `);
    element.find(".btn-close").click(()=>{
        element.slideUp();
        setTimeout(()=>{
            element.remove()
        },1000)        
    })
    const btnReSend = $(`<button class="btn-re-send-verify-email btn btn-btn-outline-dark">Click here if you have not received our confirmation email</button>`);
    const reSendVerifyEmail = ()=>{        
        callApiReSendVerifyEmail((res)=>{
            handleCreateToast("success","Successful, please check your email","success-resend-verify-email");  
            element.find("#box-re-send-verify-email").html("");    
            btnReSend.attr("disabled",true);    
            const countDownTimer = $(`<center id="title-countdown-timer">Resend after <span id="countdown-timer">60</span>s</center>`);
            const countDown = countDownTimer.find("#countdown-timer")            
            const countdownInterval = setInterval(()=>{
                countDown.text(parseInt(countDown.text())-1);
            }, 1000);            
            element.find("#box-show-countdown-timer").html(countDownTimer)          
            setTimeout(()=>{
                btnReSend.attr("disabled",false)
                element.find("#box-show-countdown-timer").html("") 
                clearInterval(countdownInterval);
                btnReSend.click(function(){        
                    reSendVerifyEmail();
                })
                element.find("#box-re-send-verify-email").html(btnReSend);
            },60000)              
        },(res)=>{
            console.log(res)
            btnReSend.attr("disabled",false)
        })       
    }
    btnReSend.click(function(){        
        reSendVerifyEmail();
    })
    element.find("#box-re-send-verify-email").html(btnReSend);
    $("#box-show-message-verify-email").html(element);
}