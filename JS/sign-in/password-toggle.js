function togglePassword() {
  const password = document.getElementById('password');
  const toggle = document.querySelector('.toggle-password');

  if (password.type === "password") {
    password.type = "text";
    toggle.value = "🙈";
  } else {
    password.type = "password";
    toggle.value = "👁️";
  }
}