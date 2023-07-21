const urlParams = new URLSearchParams(window.location.search);
const welcome_username = urlParams.get("username");

document.getElementById("welcome_name").innerText = welcome_username;