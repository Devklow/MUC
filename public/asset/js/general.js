/** @var $ = jQuery */


//@TODO Langue française JSON
// $('.dataTable').DataTable();

$('#DarkModeSwitchLabel').on('click',(e)=>{
    e.preventDefault();
    document.querySelector("#DarkModeSwitch").click();
})

$('#DarkModeSwitch').on('change', ()=>{
    if($('#DarkModeSwitch').is(':checked')){
        document.querySelector('body').classList.add('dark-mode')
        document.querySelector('nav').classList.remove('navbar-white')
        document.querySelector('nav').classList.remove('navbar-light')
        setCookie("darkmode","true",365)
    } else {
        document.querySelector('body').classList.remove('dark-mode')
        document.querySelector('nav').classList.add('navbar-white')
        document.querySelector('nav').classList.add('navbar-light')
        setCookie("darkmode","false",365)
        // sessionStorage.setItem("darkmode",false);
    }
})

window. addEventListener('load',() =>{
    // console.log(sessionStorage.getItem("darkmode"))
    // console.log(document.cookie)

    if(getCookie("darkmode") === "true" && document.querySelector("#DarkModeSwitch")){
        document.querySelector("#DarkModeSwitch").click();
    }
});

$(document).on('click', '#helpDropdown .dropdown-menu', function (e) {
    e.stopPropagation();
});

function setCookie(name, value, exp) {
    const d = new Date();
    d.setTime(d.getTime() + (exp*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = name + "=" + value + ";" + exp + ";path=/";
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