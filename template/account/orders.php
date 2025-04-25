<div class="container mx-auto min-h-screen">
    <div class="bg-white p-4 rounded-2xl shadow-lg">
        <div class="bg-white p-8 rounded-2xl">
            <div class="flex justify-between items-center bg-gray-400 px-4 py-2 font-semibold text-gray-700 border-b rounded-t-2xl">
                <div class="w-1/4 text-center">Order ID</div>
                <div class="w-1/4 text-center">Number of Items</div>
                <div class="w-1/4 text-center">Total Price</div>
                <div class="w-1/4 text-center">Date</div>
            </div>

            <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : ?>
                    <div class="flex justify-between items-center px-4 py-4 border-b transition-transform duration-200 ease-in-out transform hover:scale-105 hover:shadow-xl cursor-pointer hover:border-0 hover:bg-gray-200 hover:rounded-2xl">
                        <div class="w-1/4 text-center">#<?php echo htmlspecialchars($order['order_id']); ?></div>
                        <div class="w-1/4 text-center"><?php echo htmlspecialchars($order['item_count']); ?></div>
                        <div class="w-1/4 text-center"><?php echo htmlspecialchars($order['order_total']); ?> SAR</div>
                        <div class="w-1/4 text-center"><?php echo date('Y/m/d', strtotime($order['created_at'])); ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="text-center py-4 text-gray-500">
                    No orders found
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>