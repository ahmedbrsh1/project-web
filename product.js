const urlParams = new URLSearchParams(window.location.search);
const productId = parseInt(urlParams.get("id"));

const product = products.find((p) => p.id === productId);
console.log(product);
console.log(products);

if (product) {
  document.getElementById("name").textContent = product.name;
  document.getElementById("desc").textContent = product.description;
  document.getElementById("price").textContent = `$${product.price}`;
  document.getElementById("image").src = product.image;
}
