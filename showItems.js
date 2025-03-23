fetch("products.php")
    .then(response => {
        if (!response.ok) {
            throw new Error(`Ошибка сервера: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log("Товары:", data);
        let container = document.getElementById("Products");

        if (!container) {
            console.error("Ошибка: Элемент #container не найден!");
            return;
        }

        data.forEach(product => {
            let newElement = document.createElement("div");
            newElement.textContent = product.name ?`${product.name} - ${product.price}₸` : "Нет данных";
            newElement.classList.add("Product");

            let desc = document.createElement("p");
            desc.textContent = product.description ?? "(У товара отсутсвует описание)";
            newElement.appendChild(desc);
            
            container.appendChild(newElement);
        });
    })
    .catch(error => console.error("Ошибка загрузки данных:", error));
