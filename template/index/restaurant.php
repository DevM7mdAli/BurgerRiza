<div class="text-3xl text-center p-12">
  <h1 class="pb-8 font-bold"><?php echo htmlspecialchars($_SESSION["userName"]) . " main menu" ?></h1>

  <div class="grid grid-cols-3 gap-4" id="theBody">
    <?php foreach ($output as $burger) : ?>

      <div class="flex flex-col justify-around gap-2  px-2 py-8 bg-white rounded-xl">
        <h1 id="burgerName"> Burger Name: <?php echo htmlspecialchars($burger['burgerName']) ?> </h1>
        <div id="Extras" class="flex justify-center flex-wrap"> Extras: <?php foreach (explode(',', $burger['Extras']) as $Extra) { ?>
            <div class="px-2"> <?php echo htmlspecialchars($Extra) . " , " ?> </div>
          <?php  } ?>
        </div>
        <h1 id="burgerPrice"> Burger price: <?php echo htmlspecialchars($burger['burger_price']) . "$" ?> </h1>
        <h1 id="quantity"> quantity: <?php echo htmlspecialchars($burger['quantity']) ?> </h1>

        <div class="text-red-500 border-t-4">
          <a href="details.php?id=<?php echo $burger['id'] ?>">more info</a>
        </div>
      </div>

    <?php endforeach; ?>
  </div>

</div>