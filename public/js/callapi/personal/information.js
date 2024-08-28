var GetDataInfomation = (func_success)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_PRESONAL+PREFIX_INFOMATION,
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
            
        }
    });
}

var PutDataInfomation = (data,func_success,func_fail)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_PRESONAL+PREFIX_INFOMATION,
        type: "PUT",
        data:data,   
        success: function (res) {  
            if(typeof func_success === "function")
                func_success(res);           
        },
        error: function (xhr, status, error) {                        
            if(typeof func_fail === "function")
                func_fail(xhr.responseJSON,xhr.status);     
        }
    });
}
var ChangePassword = (data,func_success,func_fail)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_PRESONAL+PREFIX_CHANGE_PASSWORD,
        type: "PUT",
        data:data,
        success: function (res) {  
            if(typeof func_success === "function")
                func_success(res);           
        },
        error: function (xhr, status, error) {
            if(typeof func_fail === "function")
                func_fail(xhr.responseJSON);     
        }
    });
}