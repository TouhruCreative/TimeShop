document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let login = this.querySelector('input[name="login"]').value;
    let password = this.querySelector('input[name="password"]').value;

    let formData = new FormData(this);
    fetch("./LogReg/login.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if(data == "0"){
            document.getElementById("response").textContent = "good"; 
            window.location.href = "profile.html";
        } else if(data=="1"){
            document.getElementById("response").textContent = "bad user";
        } else if(data=="2"){
            document.getElementById("response").textContent = "bad password";
        } else {
            document.getElementById("response").innerHTML = data;
        }
        
    });
});
