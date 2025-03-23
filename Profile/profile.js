function getCookie(name) {
    let cookies = document.cookie.split("; ");
    for (let cookie of cookies) {
        let [key, value] = cookie.split("=");
        if (key === name) return decodeURIComponent(value);
    }
    return null;
}
if(getCookie("userID") !=null ){
    let button = document.createElement("button"); // Создаём кнопку
button.textContent = "Выйти"; // Устанавливаем текст кнопки
button.classList.add("quitBTN"); // Добавляем CSS-класс (если нужно)
button.addEventListener("click", function() {
    fetch("./Profile/Quit.php")
    .then(()=>{
    location.reload();
    console.log("exit");
    })
    .catch(error => console.error("Ошибка при выходе:", error));
});

// Добавляем кнопку в существующий контейнер
document.getElementById("content").appendChild(button); // Добавляем кнопку в конец <body>

}