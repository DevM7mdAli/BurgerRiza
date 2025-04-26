<h1 class="text-center text-xl font-bold pt-3 pb-4 mb-12">List of restaurant</h1>
<div id="bodyOfListRestaurant" class="grid grid-cols-1 sm:grid-cols-2 items-center px-12 py-4 gap-x-5 gap-y-16">

  <?php foreach ($output as $rest) { ?>
    <div class="px-2 pt-8 pb-4 bg-white rounded-xl w-full h-48 flex flex-col gap-2 justify-around">
      <img src="<?php echo $rest['img'] ?? 'assets/rest.png' ?>" alt="icon" class="mx-auto h-24 w-24 object-contain -my-12 -top-10 relative bg-white shadow-md rounded-full object-fit">
      <h1>Name of the Restaurant: <?php echo htmlspecialchars($rest['name']) ?></h1>
      <a href="tel:<?php echo htmlspecialchars($rest['phone']) ?>">Phone: <?php echo htmlspecialchars($rest['phone']) ?></a>
      <h2>Address: <?php echo htmlspecialchars($rest['address']) ?></h2>
      <div class="text-red-500 border-t-4 text-center text-lg font-bold">
        <a href="restaurantMenu.php?restaurant_id=<?php echo htmlspecialchars($rest['id']) ?>">See the menu</a>
      </div>
    </div>
  <?php } ?>
</div>