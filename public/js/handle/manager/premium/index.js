
$(document).ready(function() {
    const table_premium = $("#body-show-premiums");
    CallApiPremium((premiums)=>{
        premiums.forEach(premium => {
            const row = $(`<tr>
                            <td>${premium.id}</td>       
                            <td>
                                <img src="images/profile-1.jpg">
                                <p>${premium.premium_name}</p>
                            </td>
                            <td>${premium.premium_title}</td>
                            <td>${premium.level}</td>
                            <td>${premium.billing_cycle}</td>
                            <td>${premium.upgrade_costs}</td>
                            <td>${premium.limit_create_custom_link}</td>
                            <td>${premium.limit_create_qrcode}</td>
                            <td>${premium.link_lifespan}</td>
                            <td>
                                <div class="box-show-btn-update" style="display:none">
                                    <a href="/manager/premium/${premium.id}" title="edit" class="btn btn-outline-secondary"><i class='bx bx-edit'></i></a>
                                    <button title="delete" class="btn-delete btn btn-outline-danger"><i class='bx bx-trash-alt' ></i></button>
                                </div>
                                <label title="Select update" class="label-show-update" for="checkbox-update-premium-${premium.id}">...</label>
                                <input class="btn-show-update" type="checkbox" id="checkbox-update-premium-${premium.id}" hidden>
                            </td>
                        </tr>`) 
            var box_show = row.find(".box-show-btn-update");            
            row.find(`.btn-show-update`).click(function(){                             
                if($(this).is(":checked"))                
                    box_show.slideDown()  
                else
                    box_show.slideUp()  
            })
            row.find(".btn-delete").click(function(){
                showMessageInput("Confirm deletion of this premium package ?",
                "For safety reasons, please enter your password to perform this operation!!!","password",null,
                (password)=>{
                    CallApiDeletePremium(premium.id,password,(res)=>{
                        handleCreateToast("success",res.message,null,true);
                    },(res)=>{
                        console.log(res)
                        handleCreateToast("error",res.message ?? res.error,null,true);
                    })
                })
            });
            table_premium.append(row);
        });        
    },(res)=>{

    })
})