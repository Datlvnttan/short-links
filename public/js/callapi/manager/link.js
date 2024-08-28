var GetDataShortlink = (page = 1,status=0,func_success)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER+PREFIX_LINK,
        type: "GET",   
        data:{
            status:status,
            page:page
        },
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
            if(xhr.status==404)
                $("body").html(error404());
        }
    });
}

const UpdateShortLink = (id,formData,func_success,func_fail)=>{
    // console.log(formData)
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER+PREFIX_LINK+id,
        type: "PUT",   
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


var DeleteShortlink = (id,func_success)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER+PREFIX_LINK+id,
        type: "DELETE",   
        // data:data,    
        //contentType: 'application/json', 
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
            handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors);                     
            if(xhr.status==404)
                $("body").html(error404());
        }
    });
}