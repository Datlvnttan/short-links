const URL_HOST = window.location.origin;
const BASE_URL_API = URL_HOST+"/api/";
const TOKEN_AUTH = "token-auth";

//prefix auth
const PREFIX_AUTH = "auth/";
const PREFIX_LOGIN = "login";
const PREFIX_REGISTER = "register";
const PREFIX_VERIFY = "verify/";
const PREFIX_RESEND_VERIFY_EMAIL = "resend-verify-email"


const PREFIX_SETTING = "setting/"
const PREFIX_MAXIMUN_TERM_EXPIRED = "maximum-term-expired"

const PREFIX_MANAGER = "manager/"
const PREFIX_PERMISSION = "permission/";
const PREFIX_LINK = "links/";
const PREFIX_GRANT = "grant";
const PREFIX_ROLE = "role";
const PREFIX_GET_BY_ROLE = "get-by-role";
const PREFIX_UPDATE_STATUS = "update-status"

const PREFIX_USER = "users"
const PREFIX_PRESONAL = "personal/"
const PREFIX_INFOMATION = "infomation"
const PREFIX_CHANGE_PASSWORD = "change-password"

const PREFIX_PARSE = "parse"
const PREFIX_QRCODE = "qrcode"

const PREFIX_PREMIUM_FEATURE = "premium-feature/"
const PREFIX_GET_BY_PREMIUM = "get-by-premium"
const PREFIX_CREATE_OR_DELETE = "create-delete"
const PREFIX_PREMIUM = "premium/"
const PREFIX_FEATURE = "feature/"
const PREFIX_GET_BY_PREMIUM_LEVEL = "get-by-premium-level";
const PREFIX_GET_LEVEL = "get-level";
const PREFIX_GET_BY_FOLLOW_PREMIUM = "get-by-follow-premium";
const PREFIX_GET_BY_FOLLOW_PREMIUM_ID = "get-by-follow-premium-id";




const METHOD_GET = "GET";
const METHOD_POST = "POST";
const METHOD_PUT = "PUT";
const METHOD_PATCH = "PATCH";
const METHOD_DELETE = "DELETE";




function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
var Cookies = ()=> {
    var cookies = document.cookie;
    var cookieArray = cookies.split(';');
    var cookieList = {};
  
    for (var i = 0; i < cookieArray.length; i++) {
      var cookie = cookieArray[i].trim().split('=');
      var cookieName = cookie[0];
      var cookieValue = cookie[1];
      cookieList[cookieName] = cookieValue;
    }
  
    return cookieList;
  }
// $.ajaxSetup({
//     headers: {
//         'Authorization': `Bearer ${getCookie(TOKEN_AUTH)}`
//     }
// });