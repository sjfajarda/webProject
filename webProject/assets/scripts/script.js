"use strict";

/**
 * PRELOAD
 *
 * loading will be end after document is loaded
 */

const preloader = document.querySelector("[data-preaload]");

window.addEventListener("load", function () {
  setTimeout(function () {
    preloader.classList.add("loaded");
    document.body.classList.add("loaded");
    // Perform additional actions here after the delay
  }, 2500); // Delay of 2500 milliseconds (2.5 seconds)
});

/**
 * add event listener on multiple elements
 */

const addEventOnElements = function (elements, eventType, callback) {
  for (let i = 0, len = elements.length; i < len; i++) {
    elements[i].addEventListener(eventType, callback);
  }
};

/**
 * NAVBAR
 */

const navbar = document.querySelector("[data-navbar]");
const navTogglers = document.querySelectorAll("[data-nav-toggler]");
const overlay = document.querySelector("[data-overlay]");

const toggleNavbar = function () {
  navbar.classList.toggle("active");
  overlay.classList.toggle("active");
  document.body.classList.toggle("nav-active");
};

addEventOnElements(navTogglers, "click", toggleNavbar);

/**
 * HEADER & BACK TOP BTN
 */

const header = document.querySelector("[data-header]");
const backTopBtn = document.querySelector("[data-back-top-btn]");

let lastScrollPos = 0;

const hideHeader = function () {
  const isScrollBottom = lastScrollPos < window.scrollY;
  if (isScrollBottom) {
    header.classList.add("hide");
  } else {
    header.classList.remove("hide");
  }

  lastScrollPos = window.scrollY;
};

window.addEventListener("scroll", function () {
  if (window.scrollY >= 50) {
    header.classList.add("active");
    backTopBtn.classList.add("active");
    hideHeader();
  } else {
    header.classList.remove("active");
    backTopBtn.classList.remove("active");
  }
});

/**
 * HERO SLIDER
 */

const heroSlider = document.querySelector("[data-hero-slider]");
const heroSliderItems = document.querySelectorAll("[data-hero-slider-item]");
const heroSliderPrevBtn = document.querySelector("[data-prev-btn]");
const heroSliderNextBtn = document.querySelector("[data-next-btn]");

let currentSlidePos = 0;
let lastActiveSliderItem = heroSliderItems[0];

const updateSliderPos = function () {
  lastActiveSliderItem.classList.remove("active");
  heroSliderItems[currentSlidePos].classList.add("active");
  lastActiveSliderItem = heroSliderItems[currentSlidePos];
};

const slideNext = function () {
  if (currentSlidePos >= heroSliderItems.length - 1) {
    currentSlidePos = 0;
  } else {
    currentSlidePos++;
  }

  updateSliderPos();
};

heroSliderNextBtn.addEventListener("click", slideNext);

const slidePrev = function () {
  if (currentSlidePos <= 0) {
    currentSlidePos = heroSliderItems.length - 1;
  } else {
    currentSlidePos--;
  }

  updateSliderPos();
};

heroSliderPrevBtn.addEventListener("click", slidePrev);

/**
 * auto slide
 */

let autoSlideInterval;

const autoSlide = function () {
  autoSlideInterval = setInterval(function () {
    slideNext();
  }, 7000);
};

addEventOnElements(
  [heroSliderNextBtn, heroSliderPrevBtn],
  "mouseover",
  function () {
    clearInterval(autoSlideInterval);
  }
);

addEventOnElements(
  [heroSliderNextBtn, heroSliderPrevBtn],
  "mouseout",
  autoSlide
);

window.addEventListener("load", autoSlide);

/**
 * PARALLAX EFFECT
 */

const parallaxItems = document.querySelectorAll("[data-parallax-item]");

let x, y;

window.addEventListener("mousemove", function (event) {
  x = (event.clientX / window.innerWidth) * 10 - 5;
  y = (event.clientY / window.innerHeight) * 10 - 5;

  // reverse the number eg. 20 -> -20, -5 -> 5
  x = x - x * 2;
  y = y - y * 2;

  for (let i = 0, len = parallaxItems.length; i < len; i++) {
    x = x * Number(parallaxItems[i].dataset.parallaxSpeed);
    y = y * Number(parallaxItems[i].dataset.parallaxSpeed);
    parallaxItems[i].style.transform = `translate3d(${x}px, ${y}px, 0px)`;
  }
});

/*Hides logo upon hover*/

$(document).ready(function () {
  var detailsClicked = false;

  $(".service-card").hover(
    function () {
      if (!detailsClicked) {
        $(this).find(".overlay-image img").stop().fadeOut();
        $(this).find("#resto-pic").css("opacity", "1");
      }
    },
    function () {
      if (!detailsClicked) {
        $(this).find(".overlay-image img").stop().fadeIn();
        $(this).find("#resto-pic").css("opacity", "0.5");
      }
    }
  );

  $(".btn-text").click(function () {
    if (detailsClicked) {
      detailsClicked = false;
      $(this).closest(".service-card").find(".img-holder img").fadeIn();
      $(this).closest(".service-card").find(".details").toggle();
    } else {
      detailsClicked = true;
      $(this).closest(".service-card").find(".img-holder img").fadeOut();
      $(this).closest(".service-card").find(".overlay-image img").fadeOut();
      $(this).closest(".service-card").find(".details").fadeIn();
      $(this).closest(".service-card").find(".details").css("display", "flex");
    }
  });
});

// Check if the restaurant name is existing
function check() {
  var rName = document.getElementById("resto-name").value;
  if (rName.length == 0) {
    document.getElementById("prompt").innerHTML = "";
  } else {
    var http = new XMLHttpRequest();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (http.responseText == "Already Exist!") {
          document.getElementById("prompt").innerHTML = http.responseText;
          document.getElementById("prompt").style.display = "block";
          document.getElementById("prompt").style.color = "#FF0000";
          document.getElementById("btnUpdate").disabled = true;
        } else if (http.responseText == "Available!") {
          document.getElementById("prompt").innerHTML = http.responseText;
          document.getElementById("prompt").style.display = "block";
          document.getElementById("prompt").style.color = "#00FF00";
          document.getElementById("btnUpdate").disabled = false;
          document.getElementById("btnUpdate").style.cursor = "pointer";
        } else {
          document.getElementById("prompt").innerHTML = "";
          document.getElementById("add").disabled = true;
          document.getElementById("add").style.backgroundColor = "#808080";
          document.getElementById("add").style.cursor = "not-allowed";
        }
      }
    };
  }
  http.open("GET", "checkNames.php?rName=" + rName, true);
  http.send();
}
/* Hides other screens */

function hideScreens() {
  document.getElementById("view-screen").style.display = "none";
  document.getElementById("add-screen").style.display = "none";
}

/* Navbar Highlighter */

document.addEventListener("DOMContentLoaded", function () {
  var navbarLinks = document.querySelectorAll(".navbar-link");

  navbarLinks.forEach(function (link) {
    link.addEventListener("click", function (event) {
      event.preventDefault();

      // Remove "active" class from all links
      navbarLinks.forEach(function (link) {
        link.classList.remove("active");
      });

      // Add "active" class to the clicked link
      link.classList.add("active");
    });
  });
});

/* Navigation Script */

document.addEventListener("DOMContentLoaded", function () {
  const homeButton = document.getElementById("home-button");
  const viewButton = document.getElementById("view-button");
  const addButton = document.getElementById("add-button");
  const editButton = document.getElementById("edit-button");
  const deleteButton = document.getElementById("delete-button");

  homeButton.addEventListener("click", function () {
    $("#view-screen").fadeOut(1000, function () {
      $("#home-screen").fadeIn(1000);
    });
    $("#add-screen").fadeOut(1000);
    $("#edit-screen").fadeOut(1000);
    $("#delete-screen").fadeOut(1000);
  });

  viewButton.addEventListener("click", function () {
    $("#home-screen").fadeOut(1000, function () {
      $("#view-screen").fadeIn(1000);
    });
    $("#add-screen").fadeOut(1000);
    $("#edit-screen").fadeOut(1000);
    $("#delete-screen").fadeOut(1000);
  });

  addButton.addEventListener("click", function () {
    $("#home-screen").fadeOut(1000, function () {
      $("#add-screen").fadeIn(1000);
    });
    $("#view-screen").fadeOut(1000);
    $("#edit-screen").fadeOut(1000);
    $("#delete-screen").fadeOut(1000);
  });

  editButton.addEventListener("click", function () {
    $("#home-screen").fadeOut(1000, function () {
      $("#edit-screen").fadeIn(1000);
    });
    $("#view-screen").fadeOut(1000);
    $("#add-screen").fadeOut(1000);
    $("#delete-screen").fadeOut(1000);
  });

  deleteButton.addEventListener("click", function () {
    $("#home-screen").fadeOut(1000, function () {
      $("#delete-screen").fadeIn(1000);
    });
    $("#view-screen").fadeOut(1000);
    $("#add-screen").fadeOut(1000);
    $("#edit-screen").fadeOut(1000);
  });
});

function navigateToSection(sectionId) {
  const currentSection = document.querySelector("section.active");
  const selectedSection = document.getElementById(sectionId);

  if (currentSection === selectedSection) {
    return; // Don't navigate if already on the selected section
  }

  currentSection.classList.remove("active");
  selectedSection.classList.add("active");

  currentSection.style.opacity = 0; // Fade out the current section
  selectedSection.style.opacity = 1; // Fade in the selected section

  // Scroll to the selected section
  selectedSection.scrollIntoView({ behavior: "smooth" });
}

/* FORM VALIDATOR */

function validateForm() {
  // Get form fields
  var restoName = document.getElementById("resto-name").value;
  var location = document.getElementById("location").value;
  var price = document.getElementById("price").value;
  var services = document.querySelectorAll('input[name="service[]"]:checked');
  var oHours = document.getElementById("oHours").value;
  var cHours = document.getElementById("cHours").value;
  var rating = document.getElementById("rating").value;
  var restoPic = document.getElementById("restoPic").value;
  var logo = document.getElementById("logo").value;

  // Reset error messages
  var errorMessages = document.getElementsByClassName("error-message");
  for (var i = 0; i < errorMessages.length; i++) {
    errorMessages[i].textContent = "";
  }

  // Validate each field
  var isValid = true;
  if (restoName.trim() === "") {
    document.getElementById("resto-name-error").textContent =
      "Please enter a restaurant name.";
    isValid = false;
  }
  if (location.trim() === "") {
    document.getElementById("location-error").textContent =
      "Please enter a location.";
    isValid = false;
  }
  if (price.trim() === "" || isNaN(price)) {
    document.getElementById("price-error").textContent =
      "Please enter a valid price.";
    isValid = false;
  }
  if (services.length === 0) {
    document.getElementById("service-error").textContent =
      "Please select at least one service option.";
    isValid = false;
  }
  if (oHours.trim() === "") {
    document.getElementById("oHours-error").textContent =
      "Please enter the opening hours.";
    isValid = false;
  }
  if (cHours.trim() === "") {
    document.getElementById("cHours-error").textContent =
      "Please enter the closing hours.";
    isValid = false;
  }
  if (rating.trim() === "" || isNaN(rating)) {
    document.getElementById("rating-error").textContent =
      "Please enter a valid rating.";
    isValid = false;
  }
  if (restoPic.trim() === "") {
    document.getElementById("restoPic-error").textContent =
      "Please select a restaurant image.";
    isValid = false;
  }
  if (logo.trim() === "") {
    document.getElementById("logo-error").textContent =
      "Please select a restaurant logo.";
    isValid = false;
  }

  if (isValid) {
    // If all fields pass validation, submit the form
    document.getElementById("resto-name").disabled = false;
    document.getElementById("myForm").submit();
  }

  return isValid;
}

/* Update Function */

function update(button) {
  // Get the container elements
  const formContainer = document.getElementById("univ-form");
  const editScreen = document.getElementById("edit-screen");

  // Clone the form element
  const form = formContainer.cloneNode(true);

  // Get the current details from the clicked card
  const card = button.closest(".service-card");
  const restaurantName = card.querySelector(
    ".card-title#resto-name"
  ).textContent;
  const location = card.querySelector(".card-title#location").textContent;
  const basePrice = card.querySelector("#price").textContent;
  const serviceOptions = card.querySelector(".details #sOptions").textContent;
  const openingHours = card.querySelector(
    ".oHours span:first-child"
  ).textContent;
  const closingHours = card.querySelector(
    ".oHours span:last-child"
  ).textContent;
  const googleReviewRatings = card.querySelector(
    ".details div:last-child span"
  ).textContent;

  // Set the current details in the form fields
  form.querySelector("#resto-name").value = restaurantName;
  form.querySelector("#location").value = location;
  form.querySelector("#price").value = basePrice;
  form.querySelector(".prompt #prompt").textContent = "Currently Selected: ";
  form.querySelector("#selected").textContent = serviceOptions;
  form.querySelector("#oHours").value = openingHours;
  form.querySelector("#cHours").value = closingHours;
  form.querySelector("#rating").value = googleReviewRatings;

  // Update the form title
  form.querySelector("h1.title-5").textContent = "Update Restaurant";
  form.querySelector("form").action = "updateProcess.php";
  form.querySelector("form").method = "POST";

  // Replace the form in the edit screen container
  editScreen.querySelector(".update-form").innerHTML = "";
  editScreen.querySelector(".update-form").appendChild(form);
  editScreen.style.display = "block";
  editScreen.querySelector(".container").style.display = "none";
}

/* Delete Function */
function deleteEntry(button) {
  // Get the container elements
  const card = button.closest(".service-card");
  const restaurantName = card.querySelector(
    ".card-title#resto-name"
  ).textContent;
  const location = card.querySelector(".card-title#location").textContent;

  // Use the details to confirm deletion
  const confirmDeletion = confirm(
    `Are you sure you want to delete ${restaurantName} at ${location}?`
  );

  if (confirmDeletion) {
    card.remove();
    var restaurantNames = button.dataset.value;
    document.getElementById("tbSearch").value = restaurantNames;
    document.getElementById("delete-form").submit();
  }
}

/*Search Function*/
$(function() {
  $("#iSearch").autocomplete({
    source: function(request, response) {
      $.ajax({
        url: "getNames.php", 
        method: "GET",
        dataType: "json",
        data: { q: request.term },
        success: function(data) {
          response(data);
        }
      });
    },
    minLength: 1,
    select: function(event, ui) {
      $("#iSearch").val(ui.item.value); // Set selected value in the textbox
      $("#search-form").submit(); // Trigger form submission
    }
  });
});

/*Open View For searchProcess.php*/

function openView(){
  document.getElementById("home-screen").style.display = "none";
  document.getElementById("view-screen").style.display = "block";
  document.getElementById("home-button").classList.remove("active");
  document.getElementById("view-button").classList.add("active");
}

/*Get Selected CB*/

$(document).ready(function() {
  // Listen for changes in the checkboxes
  $('input[name="service[]"]').on('change', function() {
    var selectedServices = [];

    // Iterate over all checked checkboxes and add their values to the array
    $('input[name="service[]"]:checked').each(function() {
      selectedServices.push($(this).val());
    });

    // Display the selected services in the span element
    $('#selected').text(selectedServices.join(', '));
  });
});

