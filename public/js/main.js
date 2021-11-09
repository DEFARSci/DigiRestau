var state = false;
var state1 = false;
function toggle(){
    if(state){
        document.getElementById('password').setAttribute("type", "password");
        document.getElementById("eye").style.color='#7a797e'
        state = false;
    }else{
     document.getElementById('password').setAttribute("type", "text");
     document.getElementById("eye").style.color='#5887ef'
        state = true;
    }
}

function toggleR(){
    if(state1){
        document.getElementById('password1').setAttribute("type", "password");
        document.getElementById("eye1").style.color='#7a797e'
        state1 = false;
    }else{
     document.getElementById('password').setAttribute("type", "text");
     document.getElementById("eye1").style.color='#5887ef'
     state1 = true;
    }
}


function showPrevent(event){
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById('file-ip-1-preview');
        preview.src = src;
        preview.style.display = "block";
    }
}


$(document).ready(function(){
    var button = document.getElementById('btnLocalisation');
    var latitude = document.getElementById('latitude');
    var longitude = document.getElementById('longitude');

    button.addEventListener('click', function(){
        navigator.geolocation.getCurrentPosition(function(pos){
            let lat = pos.coords.latitude;
            let long = pos.coords.longitude;

            latitude.value = lat;
            longitude.value = long
        });
    });
    });

