

var CallApiUsers = (method,data = null,func)=>{
    $.ajax({
        url: BASE_URL_API+PREFIX_MANAGER+PREFIX_USER,
        type: method,   
        data:data,     
        //contentType: 'application/json',       
        success: function (res) {    
            if(typeof func === "function")
            func(res);          
        },
        error: function (xhr, status, error) {
            console.log(xhr)
            //handleCreateToast("error",xhr.responseJSON.error ?? xhr.responseJSON.errors ?? xhr.responseJSON.message);                             
        }
    });
}


var CallApiGetUser = (page = 1)=>{    
    data = {
        per_page:$(`input[name="per_page"]`).val() ?? 10,
        page:parseInt(page)
    }
    let uname = $("input[name='sort_username']:checked")
    let bday = $("input[name='sort_birthday']:checked")
    let created = $("input[name='sort_created_at']:checked")
    if(uname.length)
        data["uname"] = parseInt(uname.val());
    if(bday.length)
        data["bday"] = parseInt(bday.val());
    if(created.length)
        data["created"] = parseInt(created.val());           
    CallApiUsers(METHOD_GET,data,function(res){ 
        loadDataUsers(res);
    })
}

var CallApiDeleteUsers = (listId)=>{
    CallApiUsers(METHOD_DELETE,{
        list_id:listId
    },function(res){ 
        if(res.success)
        {
            handleCreateToast("success","delete users successfully!");
            listId.forEach(id=>{
                $(`#user-id-${id}`).remove()
            })
        }   
    })    
}

var loadDataUsers = (res)=>{     
    if(res.success)
    {
        let s = ""
        res.data.data.forEach(item => {
            s+=`<tr id="user-id-${item.id}">
                    <td><input type="checkbox" value="${item.id}" class="user-ids"></td>
                    <td>${item.id}</td>
                    <td>${item.username}</td>
                    <td>${item.full_name}</td>
                    <td>${item.email}</td>
                    <td>${item.phone_number ?? "-"}</td>                    
                    <td>${item.status ? "verified" : "Not verified"}</td>
                    <td>${item.role_name}</td>
                    <td>${item.premium_name}</td>
                    <td>${item.premium_register_date}</td>
                    <td>${item.paymented ? "Yes":"No"}</td>
                    <td>${item.amount_of_money.toLocaleString('de-DE')}đ</td>                    
                    <td>${ConvertDateTimeToString(item.created_at)}</td>                                     
                </tr>`
        });
        $("#table-users-body").html(s);
        loadPaginationButtons(res.data.current_page,res.data.last_page,function(page,numpages){
            CallApiGetUser(page)
        })
    }    
}

$("#btn-sort").click(function(){
    var currentURL = window.location.href;
    var url = new URL(currentURL);
	page = url.searchParams.get("page")
    CallApiGetUser(page)
})

$("#delete").click(function(){

    var listId = $(`input[class="user-ids"]:checked`).map(function() {
        return $(this).val();
    }).get();
    if(listId.length)
    {
        CallApiDeleteUsers(listId);
    }  
    else
    {
        handleCreateToast("warning","You have not selected any object yet!!!","warning-delete");
    }  
})


CallApiGetUser()