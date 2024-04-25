// Get LogIn Inputs
let username = document.getElementById("username");
let password = document.getElementById("password");
let email = document.getElementById("email");
let fullName = document.getElementById("fullname");

// Make Document Load Before Run JS Code
document.addEventListener("DOMContentLoaded", function () {
  // Mange Placeholder Function [Hide Placeholder When Focus & Show When Blur]
  function mangePlaceholder(input) {
    let originalPlaceholder = input.placeholder;
    input.addEventListener("focus", () => {
      input.placeholder = "";
    });

    input.addEventListener("blur", () => {
      if (input.value === "") {
        input.placeholder = originalPlaceholder;
      }
    });
  }
  mangePlaceholder(username);
  mangePlaceholder(password);
  mangePlaceholder(email);
  mangePlaceholder(fullName);

  // Add Asterisk To Required Fields
  function addAsterisk() {
    let requiredFields = document.querySelectorAll("input[required]");
    requiredFields.forEach((field) => {
      let span = document.createElement("span");
      let asterisk = document.createTextNode("*");
      span.appendChild(asterisk);
      span.classList.add("asterisk");
      field.parentElement.appendChild(span);
    });
  }
  addAsterisk();
});
