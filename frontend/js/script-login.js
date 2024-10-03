// Check if the user is authenticated by calling the auth.php script
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

// Add an event listener to the login form for submission
document.getElementById('login-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    // Collecting form data
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    const rememberMe = document.getElementById('rememberMe').checked;

    // Sending AJAX request to login.php
    fetch('/backend/Controller/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', // Indicate JSON content
        },
        body: JSON.stringify({ // Convert the data to JSON format
            email: email,
            password: password,
            rememberMe: rememberMe,
        }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Parse JSON response
    })
    .then(data => {
        if (data.status === 'ok') {
            alert("Login successful! Redirecting to dashboard...");
            window.location.href = "/frontend/dashboard.html"; // Redirect to dashboard
        } else {
            document.getElementById('responseMessage').innerText = data.message; // Show error message
        }
    })
    .catch(error => console.error('Error:', error)); // Log any errors
});



 

