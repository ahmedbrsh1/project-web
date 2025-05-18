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

function addToCart() {
  const quantity = document.getElementById("quantity").value;
  const oldCart = localStorage.getItem("cart")
    ? JSON.parse(localStorage.getItem("cart"))
    : [];
  const existsIndex = oldCart.findIndex(
    (cartItem) => cartItem.id === productId
  );
  if (existsIndex !== -1) {
    oldCart[existsIndex].quantity = +oldCart[existsIndex].quantity + +quantity;
    localStorage.setItem("cart", JSON.stringify(oldCart));
  } else {
    localStorage.setItem(
      "cart",
      JSON.stringify([...oldCart, { id: productId, quantity: quantity }])
    );
  }
}
