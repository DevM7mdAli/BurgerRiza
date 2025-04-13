<div class="text-3xl text-center p-12 min-h-screen">
  <h1 class="pb-24 font-bold"><?php echo htmlspecialchars($_SESSION["userName"]) . " main menu" ?></h1>
  <input type="search" class="border border-black rounded-lg px-4 py-2 text-center mb-28" placeholder="Search here..">
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-12" id="theBody">
    <?php foreach ($output as $burger) : ?>
      <div class="flex flex-col justify-around gap-2 px-2 py-8 bg-white rounded-xl">
        <img src="https://cdn.iconscout.com/icon/free/png-256/free-burger-2664522-2208951.png" alt="burger" class="w-24 h-24 block relative -top-10 -my-12 mx-auto bg-white shadow-md rounded-full">
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