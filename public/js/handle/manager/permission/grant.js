CallApiRole(function(roles){
    roles.forEach(role => {
        let row = $(`<option value="${role.id}" >${role.role_name}</option>`) 
        $("#slect-role").append(row);
    });
    loadDataTableWithRoleId(roles[0].id)
})


var loadDataTableWithRoleId = (roleId)=>{
    CallApiGetPermissionByRole(roleId,(data)=>{
        $("#table-permisson-by-role-body").html("")
        data.forEach(item=>{
            var row = $(`<tr>
                            <td>${item.id}</td>
                            <td>${item.group_route_name}</td>
                            <td>${item.group_route_title}</td>                                                        
                            <td>
                                <center class="form-check form-switch form-check-status">                                
                                    <input class="form-check-input" type="checkbox" role="switch" value="true" ${item.status ? "checked":""} ${item.lock ? "disabled":""}>                                                                                            
                                </center>                           
                            </td>                
                            <td class="created_at">${item.updated_at ? ConvertDateTimeToString(item.updated_at) : ""}</td>              
                        </tr>`)
            row.find(`input[type="checkbox"]`).change(function(){
                var input_status = $(this);
                input_status.prop("checked",!input_status.is(":checked"))
                showMessage("Thông báo","Xác nhận cập nhật quyền truy cập vào '"
                +item.group_route_name+"' cho nhóm quyền "+$("#slect-role option:selected").text() + "?",()=>{                            
                    CallApiGetPermissionUpdateStatus(roleId,item.id,!input_status.is(":checked"),function(res){                       
                        if(res.success)
                        {
                            handleCreateToast("success",res.message); 
                            input_status.prop("checked",!input_status.is(":checked"))
                            row.find(".created_at").text(ConvertDateTimeToString(res.data))                            
                        }
                    })
                })
            })
            $("#table-permisson-by-role-body").append(row);
        })
    })    
}
{/* <input type="checkbox" ${item.status ? "checked":""} ${item.lock ? "disabled":""}></input> */}

$("#slect-role").change(()=>{
    loadDataTableWithRoleId($("#slect-role").val());
})