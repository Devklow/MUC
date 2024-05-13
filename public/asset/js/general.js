/** @var $ = jQuery */


//@TODO Langue française JSON
// $('.dataTable').DataTable();

$('#DarkModeSwitchLabel').on('click',(e)=>{
    e.preventDefault();
    document.querySelector("#DarkModeSwitch").click();
})

function enableDarkMode() {
    document.querySelector('body').classList.add('dark-mode')
    document.querySelector('nav').classList.remove('navbar-white')
    document.querySelector('nav').classList.remove('navbar-light')
    document.querySelector('.btn-navbar').classList.add('btn-dark')
    document.querySelector('.form-control-navbar').classList.add('navbar-dark')
    setCookie("darkmode", "true", 365)
}

$('#DarkModeSwitch').on('change', ()=>{
    if($('#DarkModeSwitch').is(':checked')){
        enableDarkMode();
    } else {
        document.querySelector('body').classList.remove('dark-mode')
        document.querySelector('nav').classList.add('navbar-white')
        document.querySelector('nav').classList.add('navbar-light')
        document.querySelector('.btn-navbar').classList.remove('btn-dark')
        document.querySelector('.form-control-navbar').classList.remove('navbar-dark')
        setCookie("darkmode","false",365)
        // sessionStorage.setItem("darkmode",false);
    }
})

window. addEventListener('load',() =>{
    // console.log(sessionStorage.getItem("darkmode"))
    // console.log(document.cookie)

    if(getCookie("darkmode") === "true" && document.querySelector("#DarkModeSwitch")){
        enableDarkMode();
        document.querySelector("#DarkModeSwitch").checked = true;
    }
});

$(document).on('click', '#helpDropdown .dropdown-menu', function (e) {
    e.stopPropagation();
});

function setCookie(name, value, day) {
    const d = new Date();
    d.setTime(d.getTime() + (day*24*60*60));
    let expires = "expires="+ d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}