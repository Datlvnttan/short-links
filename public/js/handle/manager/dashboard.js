
$(document).ready(function() {
    const EXPIRED_SHORT_LINK_DEFAULT = $(`input[name="EXPIRED_SHORT_LINK_DEFAULT"]`)
    const EXPIRED_SHORT_LINK_AUTH = $(`input[name="EXPIRED_SHORT_LINK_AUTH"]`)
    createInputNumber(EXPIRED_SHORT_LINK_DEFAULT,1,999,true)
    createInputNumber(EXPIRED_SHORT_LINK_AUTH,1,999,true)    
    const table_premium = $("#body-show-premium");
    CallApiPremium((premiums)=>{
        premiums.forEach(premium => {
            let row = $(`<tr>
                            <td>
                                <img src="images/profile-1.jpg">
                                <p>${premium.premium_name}</p>
                            </td>
                            <td>${premium.premium_title}</td>
                            <td><span class="status pending">${premium.level}</span></td>
                        </tr>`) 
            table_premium.append(row);
        });        
    },(res)=>{

    })
})