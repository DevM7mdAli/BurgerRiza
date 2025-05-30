<h1 class="pb-24 font-bold"><?php echo htmlspecialchars($_SESSION["firstName"]) . "'s main menu" ?></h1>
<input type="search" class="border border-black rounded-lg px-4 py-2 text-center mb-28" id="search" placeholder="Search here..">
<div class="grid grid-cols-1 sm:grid-cols-2 gap-12" id="theBody">
  <?php if (!empty($output)) { ?>
    <?php foreach ($output as $product) : ?>
      <div class="flex flex-col justify-around gap-2 px-2 py-8 bg-white rounded-xl" id="<?php echo $product['id']  ?>">
        <img src="<?php echo htmlspecialchars($product['img'] ?? 'assets/burger.png') ?>"
          alt="product"
          class="w-24 h-24 block relative -top-10 -my-12 mx-auto bg-white shadow-md rounded-full object-contain">
        <h1 id="productName">Name: <?php echo htmlspecialchars($product['name']) ?></h1>
        <h1 id="productPrice">Price: <?php echo htmlspecialchars($product['price']) . "$" ?></h1>
        <h1 id="quantity">Quantity: <?php echo htmlspecialchars($product['quantity']) ?></h1>
        <a class="text-red-500 border-t-4" href="details.php?id=<?php echo $product['id'] ?>">more info</a>
      </div>
    <?php endforeach; ?>
  <?php } else { ?>
    <div class="col-span-2 text-center text-xl">
      <p>No products yet. <a href="add.php" class="text-red-500 hover:underline">Add your first product</a></p>
    </div>
  <?php } ?>
  <script>
    const search = document.getElementById('search');
    const productCards = document.querySelectorAll('#theBody > div');


    search.addEventListener('input', (e) => {
      const searchTerm = e.target.value.toLowerCase();

      productCards.forEach(card => {
        const productName = card.querySelector('#productName').textContent.toLowerCase();

        let isVisible = productName.includes(searchTerm)
        card.classList.toggle('hidden', !isVisible)
      });
    });
  </script>
</div>