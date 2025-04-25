<div class="text-3xl text-center p-12 min-h-screen">
  <?php if (!$hasRestaurant) {
    require 'template/index/restaurant-UI/making-res.php';
  } else {
    require 'template/index/restaurant-UI/all-products.php';
  } ?>
</div>