// script.js
function submitForm() {
    const formData = new FormData(document.getElementById("productForm"));
    fetch("add_product.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("response").innerHTML = data;
    })
    .catch(error => {
        console.error("Error:", error);
        document.getElementById("response").innerHTML = "An error occurred while adding the product.";
    });
}
