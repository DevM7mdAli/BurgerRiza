<div class="container mx-auto min-h-screen">


    <?php if (!empty($orders)) : ?>
        <div class="bg-white rounded-3xl p-6">
            <h2 class="text-2xl font-bold mb-4"><?php echo $info['account_role'] === 'owner' ? 'Restaurant Orders' : 'My Orders' ?></h2>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <?php if ($info['account_role'] === 'owner') : ?>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <?php else : ?>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Restaurant</th>
                            <?php endif; ?>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    #<?php echo htmlspecialchars($order['order_id']); ?>
                                </td>
                                <?php if ($info['account_role'] === 'owner') : ?>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    <?php echo htmlspecialchars($order['email']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                <?php else : ?>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo htmlspecialchars($order['restaurant_name']); ?>
                                    </td>
                                <?php endif; ?>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    $<?php echo number_format($order['order_total'], 2); ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?php echo htmlspecialchars($order['notes']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else : ?>
        <div class="bg-white rounded-3xl p-6 text-center">
            <h2 class="text-xl text-gray-600">
                <?php echo $info['account_role'] === 'owner' ? 'No orders for your restaurant yet' : 'You haven\'t placed any orders yet'; ?>
            </h2>
            <?php if ($info['account_role'] !== 'owner') : ?>
                <a href="index.php" class="mt-4 inline-block px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent-dark transition duration-200">
                    Browse Restaurants
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>