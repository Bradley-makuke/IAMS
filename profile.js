function viewStudents() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'view_students.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('content').innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function viewCompanies() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'view_companies.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('content').innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function makeMatches() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'make_matches.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('content').innerHTML = this.responseText;
        }
    }
    xhr.send();
}