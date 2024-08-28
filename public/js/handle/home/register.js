$("#form-register").on("submit",function(ev){
    ev.preventDefault();
    let formData = $('#form-register').serialize(); 
    $("button[type='submit']").attr("disabled",true)
    $('[id^="error_"]').text("");   
    register(formData,function (res) {
        if(res.success)
        {
            // handleCreateToast("success",res.message);
            alert(res.message)
            location.replace("/auth/login")
        }        
    }, function(res){
        handleCreateToast("error",res.message)
        for (const key in res.errors) {
            if (Object.hasOwnProperty.call(res.errors, key)) {
                const error = res.errors[key];
                $(`#error_${key}`).text(error[0]);
                $("button[type='submit']").attr("disabled",false)
            }
        }
    })
})