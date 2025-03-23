
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this); // Get form data

        fetch('contact.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error('Network response was not ok.');
        })
        .then(data => {
            alert('Message sent successfully!');
            // Optionally, reset the form
            this.reset();
        })
        .catch(error => {
            alert('There was a problem with your submission: ' + error.message);
        });
    });

