$(document).ready(function(){

    const information_inputs = $(".information-input.readonly");
    const btn_update = $(".btn-update");
    const update_data_information = $("#update-data-information")    
    const error_informations = $(".error-information")



    
    const input_username = $("#input-username")
    const input_full_name = $("#input-full-name")
    const input_phone_number = $("#input-phone-number")
    const input_email = $("#input-email")
    const input_date_of_birth = $("#input-date-of-birth")


    const error_input_username = $("#error-input-username")
    const error_input_full_name = $("#error-input-full-name")
    const error_input_phone_number = $("#error-input-phone-number")
    const error_input_email = $("#error-input-email")
    const error_input_date_of_birth = $("#error-input-date-of-birth")


    const error_input_username_message = "Username cannot be blank";
    const error_input_full_name_message  = "Full name cannot be blank";
    const error_input_phone_number_message  = "Phone number cannot be blank";
    const error_input_email_message  = "Email cannot be blank";
    const error_input_email_message_format = "Email invalidate";
    const error_input_up_to_money_mesage  = "Cannot be blank"
    const error_input_up_to_money_mesage2  = "The minimum deposit is 10,000 VND"

    const input_amount_of_money = $("#input-amount-of-money")
    const input_up_to_money = $("#input-up-to-money")
    const form_top_up_money = $("#form-top-up-money")
    const error_input_up_to_money = $("#error-input-up-to-money")


    update_data_information.change(function(){
        console.log($(this).is(":checked"))
        if($(this).is(":checked"))
        {
            setInputReadonly(false)
            btn_update.text("Save")
            btn_update.removeClass("btn-outline-dark")
            btn_update.addClass("btn-warning")
        }
        else
        {
            update_data_information.prop("checked",true)
            for(var element of error_informations)
                if($(element).css("display")!=="none")
                {
                    handleCreateToast("error","Check information","check-information");
                    return; 
                }          
            showMessage("Notification","Confirm update of personal information?",function(){                            
                var data = {
                    "username":input_username.val(),
                    "full_name":input_full_name.val(),
                    "phone_number":input_phone_number.val(),
                    "email":input_email.val(),                    
                }                
                PutDataInfomation(data,function(res){
                    setInputReadonly(true)
                    btn_update.text("Change")
                    btn_update.addClass("btn-outline-dark")
                    btn_update.removeClass("btn-warning")
                    update_data_information.prop("checked",false)
                    handleCreateToast("success",res.message);                    
                },(res,status)=>{
                    handleCreateToast("error",res.message);                      
                    console.log(res) 
                    if(status == 422)
                    {                        
                        switch (res.status) {
                            case 0:
                                error_input_username.text(res.message);      
                                error_input_username.slideDown();                               
                                break;
                            case -1:
                                error_input_email.text(res.message);      
                                error_input_email.slideDown();  
                                break;
                            case -2:
                                error_input_phone_number.text(res.message);      
                                error_input_phone_number.slideDown();  
                                break;
                            case -3:
                                error_input_full_name.text(res.message)
                                error_input_full_name.slideDown();  
                                break;
                            default:
                                return;
                        }                                                                               
                    }
                })
            })
        }
    })
    var setInputReadonly = (boolValue)=>{
        information_inputs.each(function(){
            $(this).attr("readonly",boolValue);                    
            return boolValue ?  $(this).removeClass("information-input-hover"): $(this).addClass("information-input-hover");
            
        })
        $("input[type='radio']").each(function(){
            $(this).attr("disabled",boolValue)
        })
    }

    setInputReadonly(true);





    var GetInfoUser = ()=>{
        GetDataInfomation(function(data){   
            console.log(data)                                  
            input_username.val(data.username)
            input_full_name.val(data.full_name)
            input_phone_number.val(data.phone_number)
            input_email.val(data.email)      
            input_amount_of_money.html(data.amount_of_money.toLocaleString('de-DE') + "đ")         
            $("#input-joining-date").text(ConvertDateToString(data.created_at))
            $("#input-password").text('**********')
        });
    }

    GetInfoUser();

    createInputNumber(input_phone_number);
    createInputNumber(input_up_to_money,0,999999999);

    createEventInputNotImptyCustom(input_username,error_input_username,error_input_username_message)
    createEventInputNotSpecialCharacter(input_username)
    createEventInputNotImptyCustom(input_full_name,error_input_full_name,error_input_full_name_message)
    // createEventBlurCheckLength(input_phone_number,10,error_input_phone_number,error_input_phone_number_message)
    //createEventInputNotImptyCustom(input_phone_number,error_input_phone_number,error_input_phone_number_message)
    //createEventInputNotImptyCustom(input_email,error_input_email,error_input_email_message)
    input_email.blur(function(){
        if($(this).val()=="")    
            return errorShow($(this),error_input_email,error_input_email_message)            
        else if(!isEmail($(this).val()))            
            return errorShow($(this),error_input_email,error_input_email_message_format)    
        errorHide($(this),error_input_email)
    })
    input_up_to_money.blur(function(){
       return checkErrorTopUpMoney($(this))
    })
    var checkErrorTopUpMoney = (element)=>{
        if(element.val()=="")    
        {
            errorShow(element,error_input_up_to_money,error_input_up_to_money_mesage)  
            return -1;
        }
        else if(parseInt(element.val()) < 10000)
        {
            errorShow(element,error_input_up_to_money,error_input_up_to_money_mesage2);
            return -2;
        }
        errorHide(element,error_input_up_to_money)
        return 1;
    }
    // input_date_of_birth.change(function(){
    //     if(new Date($(this).val())>TODAY)
    //         messageSizeShow(error_input_date_of_birth,error_input_date_of_birth_message,$(this))
    //     else
    //         messageSizeHide(error_input_date_of_birth,$(this))
    // })


    const input_old_password = $("#input-old-password")
    const input_new_password = $("#input-new-password")
    const input_new_password_confirmation = $("#input-new-password-confirmation")

    const error_input_old_password = $("#error-input-old-password")
    const error_input_new_password = $("#error-input-new-password")
    const error_input_new_password_confirmation = $("#error-input-new-password-confirmation")


    const error_input_old_password_mess = "The old password cannot be blank"
    const error_input_new_password_mess = "The new password cannot be blank"
    const error_input_new_password_confirmation_mess = "Re-enter password cannot be blank"
    const error_input_new_password_confirmation_mess_not_match = "The re-entered password does not match";
    createEventInputNotImptyCustom(input_old_password,error_input_old_password,error_input_old_password_mess)
    createEventInputNotImptyCustom(input_new_password,error_input_new_password,error_input_new_password_mess)
    createEventInputNotImptyCustom(input_new_password_confirmation,error_input_new_password_confirmation,error_input_new_password_confirmation_mess)
    input_old_password.on("input",function(){
        $(this).val($(this).val().trim());
    })
    input_new_password.on("input",function(){
        $(this).val($(this).val().trim());
    })
    input_new_password_confirmation.on("input",function(){
        $(this).val($(this).val().trim());
    })
    form_top_up_money.on("submit",function(ev){
        ev.preventDefault();
        if ((error_code = checkErrorTopUpMoney(input_up_to_money)) < 0)
        {
            handleCreateToast("error",error_code == -1 ? error_input_up_to_money_mesage : error_input_up_to_money_mesage2,"error_up_to_money"+error_code.toString())
        }

    })
    $("#form-change-password").on("submit",function(ev){          
        ev.preventDefault();       
        let chkValidate = [            
            checkInputNotImptyCusTom(input_old_password,error_input_old_password,error_input_old_password_mess),
            checkInputNotImptyCusTom(input_new_password,error_input_new_password,error_input_new_password_mess),
            checkInputNotImptyCusTom(input_new_password_confirmation,error_input_new_password_confirmation,error_input_new_password_confirmation_mess)
        ]  
        if(chkValidate.indexOf(false)==-1)
        {
            if(input_new_password.val()!=input_new_password_confirmation.val())            
                return errorHide(input_new_password_confirmation,error_input_new_password_confirmation,error_input_new_password_confirmation_mess_not_match)                        
            var formData = $("#form-change-password").serialize();             
            ChangePassword(formData,(res)=>{
                input_old_password.val("")
                input_new_password.val("")
                input_new_password_confirmation.val("")
                handleCreateToast("success",res.message)   
                $("#btn-modal-change-password-close").trigger("click");         
            },(res)=>{                
                error_input_old_password.text(res.message)
                error_input_old_password.slideDown()
            })
        }                          
    })
    $("#show-password").click(function(){
        let type = $(this).is(":checked") ? "text":"password";
        $(".information-input.password").each(function(){
            $(this).attr("type",type);
        })
    })
})