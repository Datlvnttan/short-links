


$('#form-login').on('submit',(ev)=>{
    ev.preventDefault();        
    let formData = $('#form-login').serialize();  
    $("#error-validate").text("");
    $("#btn-login").prop("disabled", true); 
    login(formData,(res)=>{
        //localStorage.setItem(TOKEN_AUTH,res.data.access_token)
        var d = new Date();
        d.setTime(d.getTime() + (res.data.expires_in*60*2000)); 
        var expires = "expires=" + d.toUTCString();
        document.cookie = `${"token"}=${res.data.access_token}; expires=${expires}; path=/; samesite=strict; secure`;   
        location.replace(res.data.url ?? "/");
    },(res)=>{
        $("#error-validate").text("Incorrect information");
    })                 
})

  

  
  
  
  
  
  