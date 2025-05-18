<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web Project</title>
    <link rel="stylesheet" href="home.css" />
  </head>
  <body>
    <div id="navbar"></div>
    <header>
      <div class="container">
        <h1>
          Sale 20% Off <br />
          On Everything
        </h1>
        <p>
          Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam
          fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat
          molestias, veniam, vel architecto veritatis delectus repellat modi
          impedit sequi.
        </p>
        <a class="red-button" href="products.html">Shop Now</a>
      </div>
    </header>

    <section>
      <div class="container">
        <h2>Why Shop With Us</h2>
        <div class="grid-container">
          <div>
            <h3>Fast Delivery</h3>
            <p>variations of passages of Lorem Ipsum available</p>
          </div>
          <div>
            <h3>Quality Assurance</h3>
            <p>variations of passages of Lorem Ipsum available</p>
          </div>
          <div>
            <h3>Easy returns</h3>
            <p>variations of passages of Lorem Ipsum available</p>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <h2>Explore Our Products</h2>
        <div class="products">
          <div class="product">
            <a href="product-details.html?id=1">
              <img src="images/p1.png" alt="shirt 1" />
              <h3>Men's Shirt</h3>
              <p class="price">$75</p>
            </a>
          </div>
          <div class="product">
            <a href="product-details.html?id=2">
              <img src="images/p2.png" alt="shirt 2" />
              <h3>Men's Shirt</h3>
              <p class="price">$80</p>
            </a>
          </div>
          <div class="product">
            <a href="product-details.html?id=3">
              <img src="images/p3.png" alt="dress 1" />
              <h3>Women's Dress</h3>
              <p class="price">$68</p>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section id="subscribe">
      <div class="container">
        <div>
          <h2>Subscribe To Get Discount Offers</h2>

          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor
          </p>
          <div class="button-container">
            <input type="email" placeholder="Enter your email" />
            <button class="red-button">Subscribe</button>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <div class="grid">
          <div>
            <div>
              <a href="#"><img width="210" src="images/logo.png" alt="#" /></a>
            </div>

            <p>
              <strong>ADDRESS:</strong> 28 White tower, Street Name New York
              City, USA
            </p>
            <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
            <p><strong>EMAIL:</strong> yourmain@gmail.com</p>
          </div>
          <div>
            <h3>Menu</h3>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Testimonial</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
          <div>
            <h3>Account</h3>
            <ul>
              <li><a href="#">Account</a></li>
              <li><a href="#">Checkout</a></li>
              <li><a href="#">Login</a></li>
              <li><a href="#">Register</a></li>
              <li><a href="#">Shopping</a></li>
              <li><a href="#">Widget</a></li>
            </ul>
          </div>
          <div>
            <h3>Newsletter</h3>
            <p>Subscribe by our newsletter and get update protidin.</p>

            <div class="flex">
              <input type="email" placeholder="Enter Your Mail" name="email" />
              <button class="red-button">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script>
      fetch("/navbar.php")
        .then((res) => res.text())
        .then((data) => {
          document.getElementById("navbar").innerHTML = data;
        });
    </script>
  </body>
</html>
