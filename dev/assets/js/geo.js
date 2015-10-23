function getBaseUrl() {
    var re = new RegExp(/^.*\//);
    return re.exec(window.location.href);
}
// this is called when the browser has shown support of navigator.geolocation
function GEOprocess(position) {
    $.session.set("geo", 1);
    // now we send this data to the php script behind the scenes with the GEOajax function
    GEOajax(getBaseUrl() + "controllers/geo.php?accuracy=" + position.coords.accuracy + "&lat=" + position.coords.latitude + "&lng=" + position.coords.longitude);
}

if (navigator.geolocation) {
   if($.session.get("geo") != 1) {
        navigator.geolocation.getCurrentPosition(GEOprocess);
   }
}

// this checks if the browser supports XML HTTP Requests and if so which method
if (window.XMLHttpRequest) {
    xmlHttp = new XMLHttpRequest();
}else if(window.ActiveXObject){
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
}

// this calls the php script with the data we have collected from the geolocation lookup
function GEOajax(url) {
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}