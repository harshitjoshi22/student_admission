document.getElementById('admissionForm').addEventListener('submit', function(event) {
    // Get form elements
    const firstName = document.getElementById('first_name').value;
    const lastName = document.getElementById('last_name').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const photograph = document.getElementById('photograph').files[0];
    
    // Basic validation
    if (!firstName || !lastName || !phone || !email || !photograph) {
        alert('Please fill out all required fields and upload a photograph.');
        event.preventDefault();
    }

    // Validate phone number
    const phonePattern = /^[0-9]{10}$/;
    if (!phonePattern.test(phone)) {
        alert('Please enter a valid 10-digit phone number.');
        event.preventDefault();
    }

    // Validate email address
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        event.preventDefault();
    }
});
