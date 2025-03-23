document.getElementById("regForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let login = this.querySelector('input[name="login"]').value;
    let password = this.querySelector('input[name="password"]').value;
    let password_ver = this.querySelector('input[name="password_ver"]').value;
    if(password_ver!=password){
        document.getElementById("response").textContent = "Пароли не совпадают";
        return;
    }
    let formData = new FormData(this);
    fetch("./LogReg/reg.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if(data == "0"){
            document.getElementById("response").textContent = "Вы зарегестрировались"; 
            window.location.href = "profile.html";
        } else if(data=="1"){
            document.getElementById("response").textContent = "Так пользователь уже существует";
        } else {
            document.getElementById("response").innerHTML = data;
        }
        
    });
});
