// document.getElementById('submit').addEventListener('click', ajax);
// document.getElementById('submit').addEventListener('click', ajax);

function ajax(){
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function (e) {
        if(this.readyState === 4 && this.status === 200){
            // document.getElementById('login').innerHTML = this.responseText;
            // let txt = this;
            // console.log("test" + txt);
            // console.log(JSON.parse(this.responseText) + "yhyf");
            let test = JSON.parse(this.responseText);
            console.log(test);

            // document.getElementById('pseudo').innerHTML = comments.comment;
        }
    };
    document.getElementById('login').innerHTML = test;
    let pseudo = document.getElementById('pseudo').value;
    let password = document.getElementById('password').value;
    let checkPassword = document.getElementById('checkPassword').value;

    xhttp.open('POST', "models/backend.php", true);

    xhttp.send();
}