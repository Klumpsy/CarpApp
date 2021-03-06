/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.css";
import "./styles/customStyles.css";
import "./script";

import $ from "jquery";
require("foundation-sites");
$(document).foundation();

// start the Stimulus application
import "./bootstrap";

function deleteFunction() {
  return confirm("Wil je deze vangst verwijderen?");
}

$(".sim-thumb").on("click", function () {
  $("#main-product-image").attr("src", $(this).data("image"));
});
