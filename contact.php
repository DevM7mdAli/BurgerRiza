<!DOCTYPE html>
<html lang="en">
<?php require('./template/header.php') ?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300 gap-4 px-3">
  <div class="bg-white bg-opacity-95 backdrop-blur-md p-8 rounded-lg shadow-lg w-300 h-150">
    <h1 class="text-2xl border-b-2 border-black mb-4">Contact Us</h1>
    <p><strong>Address: </strong>A11, College of Computer Science and Information Technology, Imam Abdulrahman bin Faisal University, Al Khobar </p>
    <p><strong>Email: </strong>contact@burgerriza.com</p>
    <p><strong>Phone: </strong>+966-57-0550-1998</p>
    <iframe 
    class="mt-4"
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d195822.67331511455!2d50.18791981093751!3d26.480404317840897!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49ef811304efab%3A0xe664343a49ebbf2b!2z2YPZhNmK2Kkg2LnZhNmI2YUg2KfZhNit2KfYs9ioINmI2KrZgtmG2YrYqSDYp9mE2YXYudmE2YjZhdin2Ko!5e1!3m2!1sar!2ssa!4v1746382032312!5m2!1sar!2ssa" 
    width="100%" 
    height="70%" 
    style="border:0;" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
  <div class="bg-white bg-opacity-95 backdrop-blur-md p-8 rounded-lg shadow-lg w-300 h-150">
    <h1 class="text-2xl border-b-2 border-black">Send Your Problem</h1>
    <form action="save_problem.php" method="post">
        <div class="flex flex-col mt-4">
            <label class="font-semibold">Name: </label>
            <input type="text" name="name" class="border border-solid border-black rounded h-10">
            <label class="font-semibold">Email: </label>
            <input type="email" name="email" class="border border-solid border-black rounded h-10">
            <label class="font-semibold">Problem: </label>
            <textarea name="problem" rows="10" cols="5" placeholder="Write you problem here.." class="border border-solid border-black rounded"></textarea>
        </div>
        <div class="flex justify-center items-center mt-4">
            <button
            type="submit"  
            class="border border-solid border-black bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300 text-white px-4 py-2 rounded font-semibold">
            Send Problem
            </button>
        </div>
    </form>
  </div>
</div>










<?php require('./template/footer.php') ?>
</html>
