document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault();
    registerUser();
});

function registerUser() {
    const first_name = document.getElementById('first_name').value;
    const last_name = document.getElementById('last_name').value;
    const email = document.getElementById('email').value;
    const pwd = document.getElementById('pwd').value;
    const messageElement = document.getElementById('message');

    // Validate required fields
    if (!first_name || !last_name || !email || !pwd) {
        messageElement.textContent = 'All fields are required!';
        return;
    }

    const data = {
        first_name,
        last_name,
        email,
        pwd,
    };

    console.log('Data being sent:', data);

    fetch('http://localhost/rent-a-car-app/backend/api/users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.json();
    })
    .then(data => {
        messageElement.textContent = 'Registration successful!';
        // Optionally, you can redirect the user or perform other actions upon successful registration
        window.location.href = '../login/index.html'; 
    })
    .catch(error => {
        messageElement.textContent = `Error: ${error.message}`;
    });
}
