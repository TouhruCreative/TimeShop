function getCookie(name) {
    let cookies = document.cookie.split("; ");
    for (let cookie of cookies) {
        let [key, value] = cookie.split("=");
        if (key === name) return decodeURIComponent(value);
    }
    return null;
}
if(getCookie("userID") !=null ){
fetch("./Cookie/Cookie.php")
.then(respone => respone.json())
.then(data => {
    let profInfo = document.getElementById("profileInfo");
    profInfo.textContent=data+"₸";
})
.catch(error => console.error("ошибка, ", error));
} else {
    let content = document.getElementById("content");
    let loginOrReg = document.createElement("div");
    let log = document.createElement("a");
    log.textContent="У меня есть аккаунт!";
    log.setAttribute("href","login.html");
    let reg = document.createElement("a");
    reg.textContent="У меня нет аккаунт!";
    reg.setAttribute("href","reg.html");
    loginOrReg.appendChild(log);
    loginOrReg.appendChild(reg);
    content.appendChild(loginOrReg);
}