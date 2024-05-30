$(document).ready(function(){
    // Submit event handler for the contact form
    $("#contactForm").submit(function(event){
      // Prevent default form submission
      event.preventDefault();
      
      // AJAX request to submit the form data
      $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: $(this).serialize(),
        success: function(response) {
          // Show success message
          $(".alert").text("Message reçu").addClass("alert-success").show();
          // Hide the message after 3 seconds
          setTimeout(function(){
            $(".alert").fadeOut();
          }, 3000);
          // Reload the page after 3 seconds
          setTimeout(function(){
            window.location.reload();
          }, 3000);
        },
        error: function(xhr, status, error) {
          // Show error message if any
          $(".alert").text("Error: " + error).addClass("alert-danger").show();
        }
      });
    });
  });
  