const ShortLink = (formData,func_success,func_fail)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_PARSE,
        type: "POST",   
        data:formData,          
        success: function (res) {                     
            if(typeof func_success === "function")
                func_success(res);        
        },
        error: function (xhr, status, error) {
            if(typeof func_fail === "function")
            func_fail(xhr.responseJSON);
            // handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors);
        }
    });
}
const GetQRCode = (shortened_link,func_success,func_fail)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_PRESONAL+PREFIX_QRCODE + "/"+shortened_link,
        type: "GET",                  
        success: function (res) {                     
            if(typeof func_success === "function")
                func_success(res);        
        },
        error: function (xhr, status, error) {
            if(typeof func_fail === "function")
            func_fail(xhr.responseJSON);
            // handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors);
        }
    });
}