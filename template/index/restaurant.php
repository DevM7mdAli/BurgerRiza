<div class="text-3xl text-center p-12 min-h-screen">
  <h1 class="pb-24 font-bold tracking-wider"><?php echo "Owner \"" . htmlspecialchars(strtoupper($_SESSION["userName"])) . "\" " . "<br>" . " Main Menu" ?></h1>

  <div class="grid grid-cols-3 gap-12" id="theBody">
    <?php foreach ($output as $burger) : ?>

      <div class="flex flex-col justify-around gap-2 px-2 py-8 mt-4 bg-white rounded-xl">
        <img src="https://cdn.iconscout.com/icon/free/png-256/free-burger-2664522-2208951.png" alt="burger" class="w-24 h-24 block relative -top-10 -my-12 mx-auto bg-white shadow-md rounded-full">
        <h1 id="burgerName" class="text-left font-semibold"> Burger Name: <?php echo htmlspecialchars($burger['burgerName']) ?> </h1>
        <div id="Extras" class="flex flex-wrap font-semibold"> Extras: <?php foreach (explode(',', $burger['Extras']) as $Extra) { ?>
            <div class="px-2"> <?php echo htmlspecialchars($Extra) . " , " ?> </div>
          <?php  } ?>
        </div>
        <h1 id="burgerPrice" class="text-left font-semibold"> Burger price: <?php echo htmlspecialchars($burger['burger_price']) . "$" ?> </h1>
        <h1 id="quantity" class="text-left font-semibold"> Quantity: <?php echo htmlspecialchars($burger['quantity']) ?> </h1>
        <hr>
        <div class="text-white font-semibold">
          <!-- How to access edit details page dircet once clicking a button or input? -->
          <form action="details.php?id=<?php echo $burger['id'] ?>" method="post">
            <input type="hidden" name="burgerName" value="<?php echo $burger['burgerName'] ?>">
            <input type="hidden" name="burgerPrice" value="<?php echo $burger['burger_price'] ?>">
            <input type="hidden" name="extras" value="<?php echo $burger['Extras'] ?>">
            <input type="hidden" name="burgerQuantity" value="<?php echo $burger['quantity'] ?>">
            <input type="submit" name="edit" value="Edit" class="block bg-yellow-400 p-1 mb-2 w-full rounded">
          </form>
          <form action="details.php?id=<?php echo $burger['id'] ?>" method="post">
            <input type="hidden" name="id_to_delete" value="<?php echo $burger['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="block bg-red-500 p-1 w-full rounded">
          </form>
        </div>
      </div>
      
    <?php endforeach; ?>
  </div>
  <div class="flex justify-center items-center mt-32">
    <a href="add.php" class="block text-center text-white w-xl text-3xl font-semibold bg-orange-400 p-2 rounded-lg">Add Burger</a>
  </div>
</div>