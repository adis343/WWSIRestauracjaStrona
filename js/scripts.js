function ajax(url, cFunction) {
    var xhttp;
    xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cFunction(this);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
function find(xhttp) {
    document.getElementById('lista').innerHTML='';
    document.getElementById('lista').innerHTML=xhttp.responseText;
}

document.addEventListener("DOMContentLoaded", function(event) {

    const input = document.getElementById('searchProduct');
    const url = new URL(document.URL);
    const kategory = url.searchParams.get("kat");


    input.addEventListener('keyup',function(){
        let link = 'szukaj.php?kategory='+kategory+'&text='+input.value;

        ajax(link, find);
    });

});