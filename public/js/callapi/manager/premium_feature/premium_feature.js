// var CallApiGetPremiumFeatureByPremium = (premiumId,func_success)=>{
//     $.ajax({
//         url: BASE_URL_API+PREFIX_PREMIUM_FEATURE+PREFIX_GET_BY_PREMIUM,
//         type: "GET",   
//         data:{
//             premiumid:premiumId
//         },    
//         success: function (res) {                  
//             if(res.success)  
//             {
//                 if(typeof func_success === "function")
//                     func_success(res.data);
//             }   
//             else            
//                 handleCreateToast("error",res.message,'err');            
//         },
//         error: function (xhr, status, error) {
//             handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors);
//         }
//     });
// }



var CallApiUpdatePremiumFeature = (premiumId,featureId,key,value,prefix,func_success,func_fail)=>{    
        
    let data = {
        premiumid:premiumId,
        featureid:featureId,            
    }
    data[key]=value;
   $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER+PREFIX_PREMIUM_FEATURE+prefix,
        type: "PUT",   
        data:data,    
        success: function (res) { 
            console.log(res)   
            if(typeof func_success === "function")
                    func_success(res);            
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseJSON)
            if(typeof func_fail === "function")
                func_fail(xhr.responseJSON);
            // handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors ?? xhr.responseJSON.message);
        }
    });
}


var CallApiUpdateStatusPremiumFeature = (premiumId,featureId,status,func_success,func_fail)=>{ 
    CallApiUpdatePremiumFeature(premiumId,featureId,"status",status,PREFIX_UPDATE_STATUS,func_success,func_fail)
    // $.ajax({
    //     url: BASE_URL_API+PREFIX_MANAGER+PREFIX_PERMISSION+PREFIX_UPDATE_STATUS,
    //     type: "PUT",   
    //     data:{
    //         premiumid:premiumId,
    //         featureid:featureId,
    //         status:status,
    //     },    
    //     success: function (res) {                  
    //         if(typeof func_success === "function")
    //                 func_success(res);            
    //     },
    //     error: function (xhr, status, error) {
    //         if(typeof func_fail === "function")
    //             func_fail(xhr.responseJSON);
    //         // handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors ?? xhr.responseJSON.message);
    //     }
    // });
}

var CallApiCreateOrDeletePremiumFeature = (premiumId,featureId,create,hold = false,func_success,func_fail)=>{      
    //CallApiUpdatePremiumFeature(premiumId,featureId,"create",create,PREFIX_CREATE_OR_DELETE,func_success,func_fail)
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER+PREFIX_PREMIUM_FEATURE+PREFIX_CREATE_OR_DELETE,
        type: "PUT",   
        data:{
            premiumid:premiumId,
            featureid:featureId,
            create:create,
            hold:hold
        },    
        success: function (res) {
            if(typeof func_success === "function")
                    func_success(res);            
        },
        error: function (xhr, status, error) {
            if(typeof func_fail === "function")
                func_fail(xhr.responseJSON);
            // handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors ?? xhr.responseJSON.message);
        }
    });
}