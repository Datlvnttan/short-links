var CallApiRole = (func_success)=>{    
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER+PREFIX_ROLE,
        type: "GET",   
        success: function (res) {                   
            if(res.success)  
            {
                if(typeof func_success === "function")
                    func_success(res.data);
            }   
            else            
                handleCreateToast("error",res.message,'err');            
        },
        error: function (xhr, status, error) {
            handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors);
        }
    });
}