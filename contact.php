<!DOCTYPE html>
<html lang="en">
<?php require('./template/header.php') ?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300 gap-4 px-3">
  <div class="bg-white bg-opacity-95 backdrop-blur-md p-8 rounded-lg shadow-lg w-300 h-150">
    <h1 class="text-2xl border-b-2 border-black mb-4">Contact Us</h1>
    <p><strong>Address: </strong>32633 Ruzain Bin Anas Al-Salmi Street, Qatif Province</p>
    <p><strong>Email: </strong>contact@burgerriza.com</p>
    <p><strong>Phone: </strong>+966-57-0550-1998</p>
    <iframe 
    class="mt-4"
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6114.887953190543!2d50.0172908584579!3d26.566180276951968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e35ff7eed2d02bb%3A0x645d5dd3d46214b8!2z2LTYp9ix2Lkg2LHYstmK2YYg2KjZhiDYo9mG2LMg2KfZhNiz2YTZhdmK2Iwg2KfZhNiu2LLYp9mF2YnYjCDYp9mE2YLYt9mK2YHigI4gMzI2MzM!5e1!3m2!1sar!2ssa!4v1746363515135!5m2!1sar!2ssa" 
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
