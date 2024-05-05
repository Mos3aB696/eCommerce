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
});
