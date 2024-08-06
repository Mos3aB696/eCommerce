// Make Document Load Before Run JS Code
document.addEventListener("DOMContentLoaded", function () {
  /**
   * Mange Placeholder [Hide Placeholder When Focus & Show When Blur]
   * Get All Inputs In Page And Store Them In inputs Array
   * Loop Over Inputs And Add Event Listener For Focus And Blur For Each Input
   * When Input Is Focused, Remove Placeholder
   * When Input Is Blurred, Add Placeholder
   */
  let inputs = document.querySelectorAll("input");
  inputs.forEach((input) => {
    let originalPlaceholder = input.placeholder;
    input.addEventListener("focus", () => {
      input.placeholder = "";
    });
    input.addEventListener("blur", () => {
      input.placeholder = originalPlaceholder;
    });
  });
  /**
   * Add Asterisk To Required Fields
   * Get All Inputs With Required Attribute And Store Them In requiredFields Variable
   * Loop Over requiredFields And Add Asterisk Span Element After Each Required Field
   * Create Span Element And Text Node With Asterisk And Append Text Node To Span Element
   * Add Class Asterisk To Span Element
   * Append Span Element To Required Field Parent Element
   * Required Field Parent Element Is The Div That Contains The Input Field
   * So The Asterisk Will Be Added After The Input Field
   * Asterisk Will Be Added After The Input Field
   */
  let requiredFields = document.querySelectorAll("input[required]");
  requiredFields.forEach((field) => {
    let span = document.createElement("span");
    let asterisk = document.createTextNode("*");
    span.appendChild(asterisk);
    span.classList.add("asterisk");
    field.parentElement.appendChild(span);
  });
  /**
   * updateTime Function To Update Time Every Second
   */
  function updateTime() {
    let now = new Date();
    let hours = now.getHours();
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    let Am_Pm = hours <= 12 ? "PM" : "AM";
    let minutes =
      now.getMinutes() < 10 ? "0" + now.getMinutes() : now.getMinutes();
    let seconds =
      now.getSeconds() > 9 ? now.getSeconds() : "0" + now.getSeconds();
    const months = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ];
    document.getElementById("time").innerHTML =
      months[now.getMonth()] +
      " " +
      now.getDate() +
      " - " +
      hours +
      ":" +
      minutes +
      ":" +
      seconds +
      " " +
      Am_Pm;
  }

  setInterval(updateTime, 1000); // Update every second
});
