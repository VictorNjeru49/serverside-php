document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("appointment-form").addEventListener("submit", function (event) {
      event.preventDefault(); // Prevents form from reloading page

      // Get form data
      let formData = new FormData(this);

      // Disable submit button to prevent multiple submissions
      let submitButton = document.querySelector(".btn");
      submitButton.disabled = true;
      submitButton.textContent = "Booking...";

      // Send form data using Fetch API
      fetch("appointment.php", {
          method: "POST",
          body: formData,
      })
      .then(response => response.text()) // Convert response to text
      .then(data => {
          console.log("Server Response:", data); // Debugging

          if (data.includes("✅")) { // If PHP response contains success message
              document.getElementById("confirmation-message").innerHTML = `
                  <h3>✅ Appointment Confirmed!</h3>
                  <p>${data}</p>
              `;
              document.getElementById("confirmation-message").style.display = "block";
              document.getElementById("appointment-form").style.display = "none";
          } else {
              // Show error message
              document.getElementById("confirmation-message").innerHTML = `
                  <h3>❌ Error Booking Appointment</h3>
                  <p>${data}</p>
              `;
              document.getElementById("confirmation-message").style.display = "block";
          }
      })
      .catch(error => {
          console.error("Error:", error);
          document.getElementById("confirmation-message").innerHTML = `
              <h3>❌ Server Error</h3>
              <p>There was an issue booking your appointment. Please try again.</p>
          `;
          document.getElementById("confirmation-message").style.display = "block";
      })
      .finally(() => {
          // Re-enable submit button
          submitButton.disabled = false;
          submitButton.textContent = "Book Appointment";
      });
  });
});
