<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <h1 class="text-2xl font-bold mb-6">Create Your Restaurant</h1>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
    <div class="flex flex-col gap-2">
      <label for="name" class="text-sm font-medium text-gray-700">Restaurant Name</label>
      <input
        type="text"
        id="name"
        name="name"
        required
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
    </div>

    <div class="flex flex-col gap-2">
      <label for="address" class="text-sm font-medium text-gray-700">Address</label>
      <textarea
        id="address"
        name="address"
        required
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
    </div>

    <div class="flex flex-col gap-2">
      <label for="phone" class="text-sm font-medium text-gray-700">Phone Number</label>
      <input
        type="tel"
        id="phone"
        name="phone"
        pattern="^\+?[1-9]\d{1,14}$"
        maxlength="20"
        required
        placeholder="+1234567890"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
    </div>

    <div class="flex flex-col gap-2">
      <label for="file" class="text-sm font-medium text-gray-700">Restaurant Name</label>
      <input
        type="file"
        id="file"
        name="img"
        required
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
    </div>

    <button
      type="submit"
      name="create_restaurant"
      class="w-full bg-red-500 text-white py-2 rounded-lg font-bold hover:bg-orange-400 transition-transform transform hover:scale-105 mt-4">
      Create Restaurant
    </button>
  </form>
</div>