var ConvertDateToString = (date)=>{
    return new Date(date).toISOString().split('T')[0];
}
var ConvertDateTimeToString = (date)=>{
    let valueTime = new Date(date).toISOString();
    let vls = valueTime.split("T");
    valueTime = vls[0] +" "
    vls = vls[1].split(":");
    valueTime+=vls[0]+":"+vls[1];
    return valueTime;
}


var Subtring = (value, end = 41)=>{
    return value.length <= end-1 ? value : value.substring(0, end)+"...";
}

function containsSpecialCharacter(str) {
    const pattern = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?\s]+/;
    return pattern.test(str);
}
function checkForUnsignedString(str) {
    const pattern = /[^\x00-\x7F]+/;
    return pattern.test(str);
}

function isDigit(str) {    
    const pattern = /[0-9]+/;
    return pattern.test(str);
}
function isEmail(str) {    
    const pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    return pattern.test(str);
}

var createInputNumber = (element,min = null,max = null,numeric = true)=>{
    if(max==null)
        max = 9999999999;
    if(typeof element ==="string")
        element = $(element);
    element.on("keydown",function(ev){        
        if(!isDigit(ev.key) && ev.key!=="Backspace" && ev.key!=="Delete" && ev.key!=="ArrowLeft" && ev.key!=="ArrowRight" && ev.key!=="Shift" && ev.key!=="Home" && ev.key!=="End")    
            ev.preventDefault();
    });
    if(numeric == true)    
        element.on("input",function(ev){  
            if($(this).val()!="")      
            {            
                    var value = parseInt($(this).val());
                    $(this).val(value == (min-1) ? min : value > max ? max : value);                    
            }
        });
}

var createEventSelect = (dom)=>{
    if(typeof dom === "string")
        dom = $(dom);
    dom.click(function(){
        $(this).select();
    })
}



var createEventBlurCheckLength = (element,length,element_msg,msg)=>{
    element.blur(function(){
        checkLength($(this),length,element_msg,msg)
    })
}

var checkLength = (element,length,element_msg,msg)=>{
    if(element.val().length != length)
    {
        errorShow(element,element_msg,msg);
        return false;
    }
    else
    {
        errorHide(element_msg,element);
        return true;
    }            
}

var split = (str,separator)=>{
    ss = str.split(separator);
    let sss = ""
    for(s of ss)
        sss+=s;
    return s;
}

var createEventInputNotSpecialCharacter = (element)=>{
    element.on("keydown",function(ev){
        if(containsSpecialCharacter(ev.key) || checkForUnsignedString(ev.key))    
            ev.preventDefault();
    })
}

var createEventInputNotImptyCustom = (element,element_msg = null,msg = null)=>{
    element.blur(function(){
        checkInputNotImptyCusTom($(this),element_msg,msg);     
    })
}

var errorShow = (input_size,dom_mess = null,msg = null)=>{
    input_size.addClass("border-error") 
    if(dom_mess==null)
        return;
    dom_mess.text(msg);
    dom_mess.slideDown()           
}

var errorHide = (input_size,dom_mess = null)=>{    
    input_size.removeClass("border-error")    
    if(dom_mess==null)
        return;
    dom_mess.text("");
    dom_mess.slideUp();
}
checkInputNotImptyCusTom = (element,element_msg,msg)=>{    
    element.val(element.val().trim());
    if(element.val()=="")
    {
        errorShow(element,element_msg,msg);
        return false;
    }
    else
    {
        errorHide(element,element_msg);
        return true;

    }             
}

const createEventTada = (element)=>{
    element.on("mouseenter",function(){
        $(this).find("i").addClass("bx-tada");                        
     })
     element.on("mouseleave",function(){
        $(this).find("i").removeClass("bx-tada");
     })                        
}