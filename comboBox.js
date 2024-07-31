var xmlhttp = createRequestObject();
function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
}

function DinamisDaerah(combobox)
{
    var kode = combobox.value;
    if (!kode) return;
    xmlhttp.open('get', 'combo/get_hotel-opr.php?kode='+kode, true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
        {
             document.getElementById("hotel").innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}

function DinamisKategori(combobox)
{
    var kode = combobox.value;
    if (!kode) return;
    xmlhttp.open('get', 'combo/get_paket-opr.php?kode='+kode, true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
        {
             document.getElementById("paket").innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}