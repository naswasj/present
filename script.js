$(document).ready(function () {
  const wrapper = $(".wrapper");
  const loginLink = $(".login-link");
  const registerLink = $(".register-link");
  const btnPopup = $(".popup-login");
  const iconClose = $(".close");

  // Event listener untuk membuka form register
  registerLink.on("click", function () {
    wrapper.addClass("active");
  });

  // Event listener untuk membuka form login
  loginLink.on("click", function () {
    wrapper.removeClass("active");
  });

  // Event listener untuk membuka popup login
  btnPopup.on("click", function () {
    wrapper.addClass("active-popup");
  });

  // Event listener untuk menutup popup login/register
  iconClose.on("click", function () {
    wrapper.removeClass("active-popup");
  });

  // Validasi form
  $("form").on("submit", function (event) {
    let email = $('input[name="email"]').val();
    let password = $('input[name="password"]').val();

    if (!email || !password) {
      event.preventDefault();
      alert("Email dan password harus diisi!");
    }
  });
});
