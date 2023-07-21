document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("signup").addEventListener("submit", function(e) {
      e.preventDefault();
  
      fetch("http://127.0.0.1/Mini-FullStack/signup.php", {
        method: "POST",
        body: new FormData(e.target)
      }) .then((response) => response.json())
         .then((data) => {
        alert(data.message); 
      }) .catch((error) => console.log(error));
    });


document.getElementById("signin").addEventListener("submit", function(e) {
    e.preventDefault();
  
    const formData = new FormData(e.target);
    fetch("http://127.0.0.1/Mini-FullStack/signin.php", {
      method: "POST",
      body: formData
    }).then((response) => response.json())
      .then((data) => {
      if (data.status == "success!") {
        window.location.href = `welcome.html?username=${encodeURIComponent(data.username)}`;
    } else {
        alert(data.status);
      }
    }).catch((error) => console.log(error));
  });

  })