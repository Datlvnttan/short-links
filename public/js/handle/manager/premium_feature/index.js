$(document).ready(function(){
    const select_premium = $("#slect-premium");
    CallApiPremium((premiums)=>{
        premiums.forEach(premium => {
            let row = $(`<option value="${premium.id}" >${premium.premium_name} - level ${premium.level}</option>`) 
            row.data("name",premium.premium_name)
            select_premium.append(row);
        });
        LoadDataTableWithPremiumId(premiums[0].id)
    },(res)=>{

    })

    const table_permisson_by_role_body = $("#table-permisson-by-role-body")
    var LoadDataTableWithPremiumId = (premiumId)=>{
        CallApiGetFeatureByFollowPremiumId(premiumId,(data)=>{            
            $("#table-permisson-by-role-body").html("")           
            data.forEach(item=>{
                var row = $(`<tr>
                                <td>${item.level ?? ""}</td>                                
                                <td>${item.premium_name ?? ""}</td>                                                                                                                                      
                                <td>${item.feature_name}</td>                                                        
                                <td>${item.feature_title}</td>                                                        
                                <td>${item.attribute}</td>                                                        
                                <td>
                                    <center class="form-check form-switch form-check-status">                                
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            ${(item.premium_id == null || item.premium_id == premiumId) ? `name="feature_add" value="${item.feature_id}"` : "disabled readonly"} ${item.level ? "checked" : ""}>
                                    </center> 
                                </td>                                                                                                      
                                <td class="created_at">${item.updated_at ? ConvertDateTimeToString(item.updated_at) : ""}</td>              
                            </tr>`)
                if((item.premium_id == null || item.premium_id == premiumId))
                {
                    row.find(`input[type="checkbox"]`).change(function(){
                        var input_update = $(this);
                        input_update.prop("checked",!input_update.is(":checked"))
                        if(input_update.is(":checked"))                            
                            return showMessageInput("Notification","Confirm feature update '"
                                        +item.feature_name+"' for premium package '"+$("#slect-premium option:selected").data("name") + "'?",
                                        "checkbox","Retain this feature in higher tier packages",(hold)=>{                                                                                
                                            HandleApiCreateOrDeletePremiumFeature(premiumId,item.feature_id,!input_update.is(":checked"),hold)
                                    })
                        return showMessage("Notification","Confirm feature update '"
                                +item.feature_name+"' for premium package '"+$("#slect-premium option:selected").data("name") + "'?",()=>{                                        
                                    HandleApiCreateOrDeletePremiumFeature(premiumId,item.feature_id,!input_update.is(":checked"))
                            })
                    })
                    table_permisson_by_role_body.prepend(row);
                }          
                else      
                    table_permisson_by_role_body.append(row);
            })
        })    
    }
    const HandleApiCreateOrDeletePremiumFeature = (premiumId,featureId,checkCreate,hold = false)=>{
        CallApiCreateOrDeletePremiumFeature(premiumId,featureId,checkCreate,hold,function(res){                       
            if(res.success)
            {
                handleCreateToast("success","Update successful",null,true); 
                LoadDataTableWithPremiumId(premiumId);                                                                
            }
        },(res)=>{
            handleCreateToast("error",res.message,'err');
        })
    }
    {/* <input type="checkbox" ${item.status ? "checked":""} ${item.lock ? "disabled":""}></input> */}
    
    select_premium.change(()=>{
        LoadDataTableWithPremiumId(select_premium.val());
    })

})