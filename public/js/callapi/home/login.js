var login = (data,func_success,func_fail)=>{
    console.log(data)
    $.ajax({
        url: BASE_URL_API+PREFIX_AUTH+PREFIX_LOGIN,
        type: "POST",   
        data:data,    
        success: function (res) {  
            console.log(res)             
            if(res.success)  
            {
                if(typeof func_success === "function")
                    func_success(res);
            }   
            else            
                handleCreateToast("error",res.message,'err');            
        },
        error: function (xhr, status, error) {  
            if(typeof func_fail ==="function")
                func_fail(xhr.responseJSON)                      
        }
    });
}