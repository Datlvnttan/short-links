const CallApiGetFeatureByPremiumLevel = (level,func_success,func_fail)=>{
    CallApiGetFeatureByPremiumSetUp({
        level:level
    },PREFIX_GET_BY_PREMIUM_LEVEL,func_success,func_fail)    
}

const CallApiGetFeatureByFollowPremium = (level,func_success,func_fail)=>{      
    CallApiGetFeatureByPremiumSetUp({
        level:level
    },PREFIX_GET_BY_FOLLOW_PREMIUM,func_success,func_fail)    
}

const CallApiGetFeatureByFollowPremiumId = (Id,func_success,func_fail)=>{      
    CallApiGetFeatureByPremiumSetUp({
        id:Id
    },PREFIX_GET_BY_FOLLOW_PREMIUM_ID,func_success,func_fail)    
}


const CallApiGetFeatureByPremiumSetUp = (data,prefix,func_success,func_fail)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_FEATURE+prefix,
        type: "GET",   
        data:data,
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

