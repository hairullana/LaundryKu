//menangkap id
var keyword = document.getElementById('keyword');
var cariData = document.getElementById('cariData');
var container = document.getElementById('container');

//trigger ketika cariData di klik
// cariData.addEventListener('mouseover', function () {
//     alert('Tombol Ditekan !');
// });

//trigger ketika 
keyword.addEventListener('keyup', function () {
    //alert('Tombol Ditekan !');

    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //menampilkan di console
            // console.log(xhr.responseText);

            // manipulasi dokumen html id='container'
            container.innerHTML = xhr.responseText;
        }
    }

    // eksekusi ajax
    // metode = GET, sumber = ajax/coba.txt, true = ashyncronous
    xhr.open('GET', 'ajax/agen.php?keyword=' + keyword.value, true);
    xhr.send();

});