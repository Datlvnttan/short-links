const notifications = document.querySelector(".notifications");

const removeToast = (toast) => {
    toast.classList.add("remove");
    setTimeout(() => toast.remove(), 500);
};
// fa-check-circle
// fa-times-circle
// fa-exclamation-circle
// fa-info-circle
const toastDetails = {
    success: {
        icon: "bxs-check-circle",
        title: "Thành công: ",
    },
    error: {
        icon: "bxs-error-circle",
        title: "Lỗi: ",
    },
    warning: {
        icon: "bxs-error",
        title: "Chú ý: ",
    },
    info: {
        icon: "bxs-message-rounded-error",
        title: "Thông báo:",
    },
};
const handleCreateToast = (id, message, typeid = null, autodelete = false) => {
    if ( typeid != null && document.getElementById(typeid))
        return;
    $(".auto-delete-toast").each(function(){
        $(this).remove();
    })    
    const { icon, title } = toastDetails[id];
    const toast = document.createElement("li");
    toast.id = typeid
    toast.className = `toast-design ${id} ${autodelete ? "auto-delete-toast" : ""}`;
    toast.innerHTML = `<div class="column">
                          <i class="bx ${icon}"></i>
                          <span>${message}</span>
                        </div>
                        <a class="message-close" onclick="removeToast(this.parentElement)"><i class='bx bx-x'></i></a>`
    notifications.appendChild(toast);
    setTimeout(() => removeToast(toast), 5000);
};
//buttons.forEach((button) => {
//    button.addEventListener("click", () => {
//        handleCreateToast(button.id);
//    });
//});

//handleCreateToast("success","Cập thật thông tin thành công");

//handleCreateToast("error");
