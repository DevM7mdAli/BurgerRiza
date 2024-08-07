<div id="bodyOfListRestaurant" class="flex flex-col items-center px-24 gap-y-14">
  <h1 class="text-center text-xl font-bold pt-3 pb-4">List of restaurant</h1>

  <?php foreach ($output as $rest) { ?>
    <div class="px-2 py-8 bg-white rounded-xl w-full h-36 flex flex-col justify-around ">
      <img src="https://cdn-icons-png.freepik.com/512/948/948149.png" alt="icon" class="mx-auto h-24 w-24 -my-12 -top-10 relative bg-white shadow-md rounded-full object-fit">
      <h1>Name of the Restaurant: <?php echo htmlspecialchars($rest['user_name']) ?></h1>
      <div class="text-red-500 border-t-4 text-center text-lg font-bold">
        <a href="restaurantMenu.php?restaurant_id=<?php echo htmlspecialchars($rest['user_id']) ?>">See the menu</a>
      </div>
    </div>
  <?php } ?>
</div>