document.getElementById("viewStudents").addEventListener("click", function() {
    loadData("viewStudents");
});

document.getElementById("viewCompanies").addEventListener("click", function() {
    loadData("viewCompanies");
});

document.getElementById("makeMatches").addEventListener("click", function() {
    loadData("makeMatches");
});

function loadData(action) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "server.php?action=" + action, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("mainContent").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// Fetch and display coordinator details
window.onload = function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "server.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var coordinatorInfo = JSON.parse(xhr.responseText);
            document.getElementById("userInfo").innerHTML = `
                <div>@${coordinatorInfo.username}</div>
                <div>Personal Information:</div>
                <div>Email Address: ${coordinatorInfo.email}</div>
                <div>Contact Number: ${coordinatorInfo.contact}</div>
            `;
        }
    };
    xhr.send();
};