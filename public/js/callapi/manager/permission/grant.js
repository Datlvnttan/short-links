var CallApiGetPermissionByRole = (roleId,func_success)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER+PREFIX_PERMISSION+PREFIX_GET_BY_ROLE,
        type: "GET",   
        data:{
            roleid:roleId
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
        }
    });
}

var CallApiGetPermissionUpdateStatus = (roleId,grouprouteid,status,func_success)=>{    
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER+PREFIX_PERMISSION+PREFIX_UPDATE_STATUS,
        type: "PUT",   
        data:{
            roleid:roleId,
            grouprouteid:grouprouteid,
            status:status,
        },    
        success: function (res) {                  
            if(typeof func_success === "function")
                    func_success(res);            
        },
        error: function (xhr, status, error) {
            handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors ?? xhr.responseJSON.message);
        }
    });
}