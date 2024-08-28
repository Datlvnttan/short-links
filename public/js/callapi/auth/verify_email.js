var callApiVerifyEmail = (id,token,func_success,func_fail)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_VERIFY+id+"/"+token,
        type: "POST",             
        success: function (res) {               
                if(typeof func_success === "function")
                    func_success(res);        
        },
        error: function (xhr, status, error) {
            if(typeof func_fail === "function")
            {
                func_fail(xhr.responseJSON);
            }
        }
    });
}

var callApiReSendVerifyEmail = (func_success,func_fail)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_PRESONAL+PREFIX_RESEND_VERIFY_EMAIL,
        type: "POST",             
        success: function (res) {               
            if(typeof func_success === "function")
                func_success(res);        
        },
        error: function (xhr, status, error) {
            if(typeof func_fail === "function")
            {
                func_fail(xhr.responseJSON);
            }
        }
    });
}