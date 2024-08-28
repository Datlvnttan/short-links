
var CallApiPre = (prefix,func_success,func_fail)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_PREMIUM+prefix,
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
            if(typeof func_fail === "function")
                func_fail(xhr.responseJSON);
            // handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors);
        }
    });
}

var CallApiPremium = (func_success,func_fail)=>{  
    return CallApiPre("",func_success,func_fail)
}

var CallApiPremiumGetLevel = (func_success,func_fail)=>{  
    return CallApiPre(PREFIX_GET_LEVEL,func_success,func_fail)  
}


var CallApiShowPremium = (id,func_success,func_fail)=>{
    return CallApiPre(id,func_success,func_fail)
}

var CallApiCreatePremium = (formData,func_success,func_fail)=>{    
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER + PREFIX_PREMIUM,
        type: "POST",
        data:formData,   
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
            if(typeof func_fail === "function")
                func_fail(xhr.responseJSON);
            // handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors);
        }
    });
}


const CallApiPutDeletePremium = (id,formData,func_success,func_fail,method = null)=>{    
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER + PREFIX_PREMIUM+id,
        type: method ?? "PUT",
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
            if(typeof func_fail === "function")
                func_fail(xhr.responseJSON);
            // handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors);
        }
    });
}
const CallApiUpdatePremium = (id,formData,func_success,func_fail)=>{    
    CallApiPutDeletePremium = (id,formData,func_success,func_fail)
}

const CallApiDeletePremium = (id,password,func_success,func_fail)=>{    
    CallApiPutDeletePremium(id,{password:password},func_success,func_fail,"DELETE")
}