document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("signup").addEventListener("submit", function(event) {
      event.preventDefault();
  
      fetch("http://127.0.0.1/Register-Login-system-back-and-front-end/apis/signup.php", {
        method: "POST",
        body: new FormData(event.target)
      })
      .then((response) => response.json())
      .then((data) => {
        alert(data.message); 
      })
      .catch((error) => console.log(error));
    });
}