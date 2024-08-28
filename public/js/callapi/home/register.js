var register = (formData,func_success,func_fail)=>{
    console.log(formData)
    $.ajax({
        url: BASE_URL_API+PREFIX_AUTH+PREFIX_REGISTER,
        type: "POST",   
        data:formData,    
        success: function (res) {                           
            if(res.success)  
            {
                if(typeof func_success === "function")
                    func_success(res);
            }   
            else            
                handleCreateToast("error",res.message,'err');            
        },
        error: function (xhr, status, error) {     
            console.log(xhr)       
            if(typeof func_fail ==="function")
                func_fail(xhr.responseJSON);            
        }
    });
}