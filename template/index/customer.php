<h1 class="text-center text-xl font-bold pt-3 pb-4 mb-12">List of restaurant</h1>
<div id="bodyOfListRestaurant" class="grid grid-cols-1 sm:grid-cols-2 items-center px-12 gap-x-5 gap-y-14">

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