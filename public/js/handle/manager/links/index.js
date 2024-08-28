
$(document).ready(function() {


    const form_update_short_link = $("#form-update-short-link");
    const input_update_title = $(`input[name="update_title"]`)
    const input_update_back_half = $(`input[name="update_back_half"]`)
    const input_update_limit_visits = $("#limit-visits-short-link-update");
    const box_update_effective_time_short_link = $("#box-update-effective-time-short-link");
    const box_update_expired_short_link = $("#box-update-expired-short-link");

    const input_update_make_an_appointment = $(`#update-make-an-appointment`)
    const input_update_effective_time = $(`input[name="update_effective_time"]`)
    const input_update_expired = $(`input[name="update_expired"]`)
    const input_check_box_set_password = $("input[name='check_box_set_password']");
    const input_box_update_short_link_set_password = $(".box-update-short-link-set-password"); 
    const input_show_password_short_link = $("input[name='show_password_short_link']") 
    const input_update_password_confirmation = $("input[name='update_password_confirmation']") 
    const input_update_password = $("input[name='update_password']");
    const error_validate_short_link_update =  $("#error-validate-short-link-update");

    const label_show_password_short_link_update = $("#label-show-password-short-link-update")

    input_check_box_set_password.change(function(){
        if($(this).is(":checked"))
            input_box_update_short_link_set_password.slideDown()
        else
            input_box_update_short_link_set_password.slideUp()
    })    
    input_show_password_short_link.change(function(){
        if($(this).is(":checked"))
        {
            input_update_password.attr("type","text")
            input_update_password_confirmation.attr("type","text")
            label_show_password_short_link_update.html(`<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(151, 151, 151);transform: ;msFilter:;">
                                                            <path d="M14 12c-1.095 0-2-.905-2-2 0-.354.103-.683.268-.973C12.178 9.02 12.092 9 12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-.092-.02-.178-.027-.268-.29.165-.619.268-.973.268z"></path><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z"></path>
                                                        </svg>`)           
            
        }
        else
        {
            input_update_password.attr("type","password")
            input_update_password_confirmation.attr("type","password")
            label_show_password_short_link_update.html(`<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(151, 151, 151);transform: ;msFilter:;">
                                                            <path d="M12 4.998c-1.836 0-3.356.389-4.617.971L3.707 2.293 2.293 3.707l3.315 3.316c-2.613 1.952-3.543 4.618-3.557 4.66l-.105.316.105.316C2.073 12.382 4.367 19 12 19c1.835 0 3.354-.389 4.615-.971l3.678 3.678 1.414-1.414-3.317-3.317c2.614-1.952 3.545-4.618 3.559-4.66l.105-.316-.105-.316c-.022-.068-2.316-6.686-9.949-6.686zM4.074 12c.103-.236.274-.586.521-.989l5.867 5.867C6.249 16.23 4.523 13.035 4.074 12zm9.247 4.907-7.48-7.481a8.138 8.138 0 0 1 1.188-.982l8.055 8.054a8.835 8.835 0 0 1-1.763.409zm3.648-1.352-1.541-1.541c.354-.596.572-1.28.572-2.015 0-.474-.099-.924-.255-1.349A.983.983 0 0 1 15 11a1 1 0 0 1-1-1c0-.439.288-.802.682-.936A3.97 3.97 0 0 0 12 7.999c-.735 0-1.419.218-2.015.572l-1.07-1.07A9.292 9.292 0 0 1 12 6.998c5.351 0 7.425 3.847 7.926 5a8.573 8.573 0 0 1-2.957 3.557z"></path>
                                                        </svg>`)            
        }
    })     

    const LoadDataShortLink = (page = 1,status=0 ,box_show)=>{
        $('#pagination').html("");
        GetDataShortlink(page,status,(data)=>{            
            if(data.data.length==0)
            {
                box_show.html("<center><h4>No data found</h4></center>");                
                return;
            }
            box_show.html("")            
            data.data.forEach(item => {
                let s = `<div class="item-my-short-link row">
                            <div class="item-my-short-link-left col-xl-9 col-lg-8 col-12 row">
                                <div class="check-box-select-short-link col-1 p-0">
                                    <input type="checkbox" name="" id="my-short-link-id-${item.id}" hidden>
                                </div>
                                <div class="box-my-short-link-infomation col-11 p-0">
                                    <h4 class="link-title">${item.title ?? "No title yet"} ${item.password ? "<i class='bx bxs-lock-alt' title='Password has been set'></i>" : ""}</h4>
                                    <a href="${URL_HOST + "/" +item.shortened_link}" class="my-shorted-link-title">${URL_HOST + "/" +item.shortened_link}</a><br>
                                    <a href="${item.original_link}" class="original-link-title">${item.original_link.length > 30 ? item.original_link.substring(0,50)+"...":item.original_link}</a><br>
                                    <span class="my-short-link-start-day">${ConvertDateTimeToString(item.created_at)}</span>|
                                    <i class='bx bx-calendar-alt'></i>`
                                    if(item.effective_time)
                                        s+=`<span class="my-short-link-start-day" title="effective time">${ConvertDateTimeToString(item.effective_time)}</span><i class='bx bx-time-five' ></i>`
                                    s+=`</i><span class="my-short-link-end-day" title="expired"> ${ConvertDateTimeToString(item.expired)}</span><br>
                                    <span title="total visits">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59"></path>
                                        </svg>
                                        ${item.total_visits}
                                    </span>  ${item.limit_visits !=null ? `|| <span title="limit visits"><i class='bx bxs-hourglass-top' ></i> ${item.limit_visits}</span>`:""}                             
                                </div>
                            </div>
                            <div class="item-my-short-link-right col-xl-3 col-lg-4 col-12">                                
                                <button title="copy" class="btn-my-short-link-copy btn"><i class='bx bx-copy'></i></button>
                                <button title="edit" class="btn-my-short-link-edit btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal-edit-short-link"><i class='bx bx-edit'></i></button>
                                <button title="delete" class="btn-my-short-link-delete btn btn-outline-danger"><i class='bx bx-trash-alt' ></i></button>
                            </div>
                        </div>`
                var element = $(s)
                element.find(".btn-my-short-link-delete").click(()=>{
                    showMessage("Thông báo","Xác nhận xóa link này?",function(){
                        DeleteShortlink(item.id,(res)=>{
                            handleCreateToast("success","Link removed successfully","mes-id-"+item.id,true);
                            element.remove()
                        })
                    })
                })
                element.find(".btn-my-short-link-edit").click(()=>{
                    form_update_short_link.attr("id-short-url-change",item.id);
                    input_update_password.attr("type","password")                    
                    label_show_password_short_link_update.html(`<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(151, 151, 151);transform: ;msFilter:;">
                                                                    <path d="M12 4.998c-1.836 0-3.356.389-4.617.971L3.707 2.293 2.293 3.707l3.315 3.316c-2.613 1.952-3.543 4.618-3.557 4.66l-.105.316.105.316C2.073 12.382 4.367 19 12 19c1.835 0 3.354-.389 4.615-.971l3.678 3.678 1.414-1.414-3.317-3.317c2.614-1.952 3.545-4.618 3.559-4.66l.105-.316-.105-.316c-.022-.068-2.316-6.686-9.949-6.686zM4.074 12c.103-.236.274-.586.521-.989l5.867 5.867C6.249 16.23 4.523 13.035 4.074 12zm9.247 4.907-7.48-7.481a8.138 8.138 0 0 1 1.188-.982l8.055 8.054a8.835 8.835 0 0 1-1.763.409zm3.648-1.352-1.541-1.541c.354-.596.572-1.28.572-2.015 0-.474-.099-.924-.255-1.349A.983.983 0 0 1 15 11a1 1 0 0 1-1-1c0-.439.288-.802.682-.936A3.97 3.97 0 0 0 12 7.999c-.735 0-1.419.218-2.015.572l-1.07-1.07A9.292 9.292 0 0 1 12 6.998c5.351 0 7.425 3.847 7.926 5a8.573 8.573 0 0 1-2.957 3.557z"></path>
                                                                </svg>`)                                                             
                    input_update_title.val(item.title);
                    input_update_back_half.val(item.shortened_link);
    
                    if(item.limit_visits)
                        input_update_limit_visits.val(item.limit_visits)
                    else
                        input_update_limit_visits.val("")
                    if(item.effective_time)
                    {
                        console.log(input_update_effective_time)
                        input_update_effective_time.val(ConvertDateTimeToString(item.effective_time));
                        input_update_make_an_appointment.prop("checked",true)
                        box_update_expired_short_link.addClass("col-lg-6")
                        box_update_expired_short_link.removeClass("col-lg-12")                                    
                        box_update_effective_time_short_link.fadeIn();                                 
                    }
                    else
                    {
                        input_update_make_an_appointment.prop("checked",false)
                        box_update_expired_short_link.removeClass("col-lg-6")
                        box_update_expired_short_link.addClass("col-lg-12")                                    
                        box_update_effective_time_short_link.fadeOut(); 
                    }                
                    input_update_expired.val(ConvertDateTimeToString(item.expired));
                    if(item.password)
                    {
                        input_check_box_set_password.prop("checked",true)
                        input_update_password.val(item.password);                   
                    } 
                    else
                    {
                        input_check_box_set_password.prop("checked",false)
                        input_box_update_short_link_set_password.hide();
                        input_update_password.val("");
                    }                               
                })
                
                const btnCopy = element.find(".btn-my-short-link-copy")
                var clipboard = new ClipboardJS(btnCopy[0], {
                    text: function() {                      
                      return URL_HOST+"/"+item.shortened_link;
                    }
                  });
                  clipboard.on('success', function(e) {                            
                    e.clearSelection();
                    btnCopy.html("copied")
                    setTimeout(()=>{
                        btnCopy.html(`<i class='bx bx-copy'></i>`)
                    },1000)
                  });           
                box_show.append(element)
            });
            loadPaginationButtons(data.current_page,data.last_page,function(page,numpages){
                LoadDataShortLink(page,status,box_show)
            })            
        })            
    }
  

    form_update_short_link.on("submit",function(ev){
        ev.preventDefault();             
        var formData = $(this).serialize();       
        error_validate_short_link_update.text("")
        const id = form_update_short_link.attr("id-short-url-change");                   
        if(parseInt(id) == NaN)   
            return;        
        UpdateShortLink(id,formData,(res)=>{  
            //console.log(res)              
            if(res.success)
            {
                showMessage("Success","Update short link successful",()=>{
                    location.reload();
                },false)
            }            
        },(res)=>{            
            error_validate_short_link_update.text(res.message);
            error_validate_short_link_update.slideDown();
        })       
    });

    const tabs = $(".tab");
    const tab_panes = $(".tab-pane")
    for (let index = 0; index < tabs.length; index++) {
        const tab = $(tabs[index]);
        const tab_pane = $(tab_panes[index])
        tab.click(function(){
            LoadDataShortLink(1,index,tab_pane)
        })        
    }
    LoadDataShortLink(1,0,$(tab_panes[0]))
})
