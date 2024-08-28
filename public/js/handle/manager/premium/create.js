$(document).ready(function(){
    const input_premium_name = $(`input[name="premium_name"]`)
    const input_premium_title = $(`input[name="premium_title"]`)
    const input_billing_cycle = $(`input[name="billing_cycle"]`)
    const input_upgrade_costs = $(`input[name="upgrade_costs"]`)
    const input_level = $(`select[name="level"]`)
    const input_link_lifespan = $(`input[name="link_lifespan"]`)
    const input_limit_create_custom_link = $(`input[name="limit_create_custom_link"]`)
    const input_limit_create_qrcode = $(`input[name="limit_create_qrcode"]`)

    const error_premium_name = $(`span[class="premium_name"]`)
    const error_premium_title = $(`span[class="premium_title"]`)
    const error_billing_cycle = $(`span[class="billing_cycle"]`)
    const error_upgrade_costs = $(`span[class="upgrade_costs"]`)
    const error_level = $(`span[class="level"]`)
    const error_link_lifespan = $(`span[class="link_ifespan"]`)
    const error_limit_create_custom_link = $(`span[class="limit_create_custom_link"]`)
    const error_limit_create_qrcode = $(`span[class="limit_create_qrcode"]`)


    const table_feature = $("#body-data-feature");
    const box_show_feature =$(".box-show-feature");
    const form_create_permium = $("#form-create-permium")
    const btn_save =$("#btn-save")
    // const error_premium_name_mess ="Name cannot be left blank"
    // const error_premium_title_mess ="Title cannot be left blank"
    // const error_billing_cycle_mess = "Billing Cycle cannot be left blank"
    // const error_upgrade_costs_mess = "Upgrade Costs cannot be left blank"
    // const error_level_mess ="Level cannot be left blank"
    // const error_link_lifespan_mess ="Link Lifespan cannot be left blank"
    // const error_limit_create_custom_link_mess ="Limit Custom Link cannot be left blank"
    // const error_limit_create_qrcode_mess ="Limit QR Code cannot be left blank"

    createEventInputNotImptyCustom(input_premium_name)
    createEventInputNotImptyCustom(input_premium_title)
    createEventInputNotImptyCustom(input_billing_cycle)
    createEventInputNotImptyCustom(input_upgrade_costs)
    createEventInputNotImptyCustom(input_link_lifespan)
    createEventInputNotImptyCustom(input_limit_create_custom_link)
    createEventInputNotImptyCustom(input_limit_create_qrcode)    


    $(".numeric").each(function(){
        createInputNumber($(this),0,9999999999,true);
    })

    CallApiPremiumGetLevel((levels)=>{    
        let newLevel = levels[0].level+1;              
        input_level.append($(`<option value="${newLevel}">${newLevel}</option>`));
        levels.forEach(level => {
            var option = $(`<option value="${level.level}">${level.level}</option>`);
            input_level.append(option);
        });  
        let prefixs = window.location.toString().split("/")
        const id = prefixs[prefixs.length-1]               
        if(parseInt(id))
        {                    
            CallApiShowPremium(id,(data)=>{
                $("#title").text("Edit Premium "+data.premium_name)
                form_create_permium.data("edit-id",data.id);
                input_premium_name.val(data.premium_name);
                input_premium_title.val(data.premium_title);
                input_billing_cycle.val(data.billing_cycle);
                input_upgrade_costs.val(data.upgrade_costs);
                input_level.val(data.level);
                input_link_lifespan.val(data.link_lifespan);
                input_limit_create_custom_link.val(data.limit_create_custom_link);
                input_limit_create_qrcode.val(data.limit_create_qrcode);
                input_level.find(`option[value="${data.level}"]`).attr("selected",true);
                loadDataFeatureByFollowPremium(data.level,id)  
            },(res)=>{            
                form_create_permium.html(`<center><h4>${res.message}</h4></center>`)
            })            
        }  
        else
            loadDataFeatureByFollowPremium(newLevel)                         
    },(res)=>{
        
    })
    const buildDataFeature = (data,id =null)=>
    {
        console.log(data)
        table_feature.html("")            
        if(data.length == 0)
        {
            box_show_feature.slideUp();
            return;
        }
        box_show_feature.slideDown();
        data.forEach(item=>{
            table_feature.append(`<tr>
                                    <td>${item.level ?? "NO"}</td>
                                    <td>${item.feature_name}</td>
                                    <td>${item.feature_title}</td>
                                    <td>${item.attribute}</td>
                                    <td><center class="form-check form-switch form-check-status">                                
                                            <input class="form-check-input" type="checkbox" role="switch" 
                                            ${ id ?  `${(item.premium_id == null || item.premium_id == id) ? `name="feature_add" value="${item.feature_id}"` : "disabled readonly"} ${item.level ? "checked" : ""}`
                                                : `${item.level ? `checked disabled readonly`:`name='feature_add' value="${item.id}"`} `}>                                                                                            
                                        </center>
                                    </td>                                        
                                </tr>`)
        })
    }

    const loadDataFeatureByFollowPremium = (level,id=null)=>{ 
        if(id!=null)
            return CallApiGetFeatureByFollowPremiumId(id,(data)=>{
                buildDataFeature(data,id)
            })       
        CallApiGetFeatureByFollowPremium(level,(data)=>{        
            buildDataFeature(data)
        },(res)=>{

        })
    }
    input_level.change(function () {
        loadDataFeatureByFollowPremium(input_level.val())
    })    

    const showError = (res)=>{
        for (const key in res.errors) {
            if (Object.hasOwnProperty.call(res.errors, key)) {
                const error = res.errors[key][0];
                $(`.error-validate-update.${key}`).text(error);
                errorShow( $(`input[name="${key}"]`))
            }
        }  
    }
    form_create_permium.on("submit",function(ev){
        ev.preventDefault();     
        const chk_validate = [
            checkInputNotImptyCusTom(input_premium_name),
            checkInputNotImptyCusTom(input_premium_title),
            checkInputNotImptyCusTom(input_billing_cycle),
            checkInputNotImptyCusTom(input_upgrade_costs),
            checkInputNotImptyCusTom(input_link_lifespan),
            checkInputNotImptyCusTom(input_limit_create_custom_link),
            checkInputNotImptyCusTom(input_limit_create_qrcode),
        ]
        if(chk_validate.indexOf(false)==-1)
        {
            showMessage("Notification","Confirm execution of this action",()=>{
                $(".input-update").each(function(){
                    errorHide($(this))
                    $(`.error-validate-update.${$(this).attr("name")}`).text("");
                })   
                var data={
                    premium_name:input_premium_name.val(),
                    premium_title:input_premium_title.val(),
                    billing_cycle:input_billing_cycle.val(),
                    upgrade_costs:input_upgrade_costs.val(),
                    level:input_level.val(),
                    link_lifespan:input_link_lifespan.val(),
                    limit_create_custom_link:input_limit_create_custom_link.val(),
                    limit_create_qrcode:input_limit_create_qrcode.val(),
                    feature_add:$(`input[name="feature_add"]:checked`).map(function() {
                        return parseInt(this.value);
                    }).get()
                }
                // var formData = $(this).serialize();   
                // console.log(data) 
                var id;
                if((id = form_create_permium.data("edit-id"))!=undefined)
                    return CallApiUpdatePremium(id,data,(res)=>{
                        handleCreateToast("success","Update successfully!!!",null,true);   
                        $("#title").text("Edit Premium "+input_premium_name.val())                      
                    },(res)=>{ 
                        console.log(res)                                  
                        showError(res);          
                    })
                CallApiCreatePremium(data,(res)=>{
                    showMessage("Successfully","Create successfully!!!",()=>{
                        location.reload();
                    },false)   
                },(res)=>{                                     
                    showError(res);          
                })
            })            
            
        }
    });
});