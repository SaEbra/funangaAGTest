// Check if the user is authenticated by calling the auth.php script
checkAuth();
function checkAuth(){
    fetch('/backend/inc/auth.php')
    .then(response => response.json())
    .then(data => {
        if (!data.authenticated) {
            window.location.href = '/frontend/login.html'; // Redirect to login
        }
    })
    .catch(error => console.error('Error:', error));
}
// Add an event listener to the login form for click
document.getElementById('logout').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent default form submission
    fetch('/backend/Controller/logout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.success) {
            alert("Logout successful! Redirecting to login page...");
            window.location.href = "/frontend/login.html"; // Redirect to the login page
        } else {
            alert("Logout failed: " + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});