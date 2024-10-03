// Check if the user is unauthenticated by calling the auth.php script
checUnauth();
function checUnauth(){
    fetch('/backend/inc/auth.php')
    .then(response => response.json())
    .then(data => {
        if (data.authenticated) {
            window.location.href = '/frontend/dashboard.html'; // Redirect to login
        }
    })
    .catch(error => console.error('Error:', error));
}

// Add an event listener to the login form for click
document.getElementById('register-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    // Collecting form data
    let username = document.getElementById('registerUsername').value;
    let email = document.getElementById('registerEmail').value;
    let password = document.getElementById('registerPassword').value;

    // Sending AJAX request to register.php
    fetch('/backend/Controller/register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ // Convert the data to JSON format
            username: username,
            email: email,
            password: password,
        }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Parse JSON response
    })
    .then(data => {
        console.log(data); // Log the data for debugging

        // Check if registration was successful
        if (data.status === 'ok') {
            alert("Registration successful! Redirecting to dashboard...");
            window.location.href = "dashboard.html"; // Adjust the path if necessary
        } else {
            document.getElementById('responseMessage').innerText = data.message; // Show error message
        }
    })
    .catch(error => console.error('Error:', error)); // Log any errors
});
 


 

