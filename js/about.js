document.addEventListener("DOMContentLoaded", function() {
    // FAQ toggle functionality
    const faqHeaders = document.querySelectorAll('.faq-item h3');
    faqHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const answer = header.nextElementSibling;
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        });
    });

    // Add click event listeners to each name cell
    document.querySelectorAll('.name').forEach(item => {
        item.addEventListener('click', () => showPopup(item));
    });
});

// Function to show the popup
function showPopup(nameElement) {
    // Get data attributes
    const name = nameElement.getAttribute('data-name');
    const specialization = nameElement.getAttribute('data-specialization');
    const experience = nameElement.getAttribute('data-experience');
    const education = nameElement.getAttribute('data-education');
    const certifications = nameElement.getAttribute('data-certifications');
    const languages = nameElement.getAttribute('data-languages');
    const contact = nameElement.getAttribute('data-contact');

    // Set values in the popup
    document.getElementById('popup-name').innerText = name;
    document.getElementById('popup-specialization').innerText = specialization;
    document.getElementById('popup-experience').innerText = experience;
    document.getElementById('popup-education').innerText = education;
    document.getElementById('popup-certifications').innerText = certifications;
    document.getElementById('popup-languages').innerText = languages;
    document.getElementById('popup-contact').innerText = contact;

    // Display the popup
    document.getElementById('popup').style.display = 'block';
}

// Function to close the popup
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}
