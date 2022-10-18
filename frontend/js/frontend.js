// frontend.js

// get cookie
const getCookie = (cname) => {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
// set cookie
const setCookie = (cname, cvalue, exdays) => {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// consts
const emailInput = document.getElementById("wpforms-10586-field_2")
const nameInput = document.getElementById("wpforms-10586-field_22")
const wpCalendly = document.getElementById("wp_calendly")
const nextBtn = document.querySelector(".wpforms-page-2 .wpforms-page-next")
const phoneInput = document.getElementById("wpforms-10586-field_24")
const phoneErr = document.getElementById("wpforms-10586-field_24-error")

// vars
var calendly_name = getCookie("calendly_name")
var calendly_email = getCookie("calendly_email")


// store email
emailInput.addEventListener("keyup",function(e){
    const userEmail = e.target.value
    calendly_email = userEmail.replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '')
    setCookie("calendly_email",userEmail)
})

// store name
nameInput.addEventListener("keyup",function(e){
    const userName = e.target.value
    calendly_name = userName
    setCookie("calendly_name",userName)
})

nextBtn.addEventListener("click",function(e){
    const next = e.target
    var calendly = `${wp_calendly_base}`;

    // add email
    if(calendly_email){
        calendly += `&email=${calendly_email}`;
    }
    // add name
    if(calendly_name){
        calendly += `&name=${calendly_name}`;
    }

    // set output
    const html = `<div class="calendly-inline-widget" data-url="${calendly}" style="min-width:100%; width:100%; height:100%;"><iframe src="${calendly}"" width="100%" height="100%" frameborder="0"></iframe></div>`;
    wpCalendly.innerHTML = html;

})

// fix phone number issue
setInterval(() => {
    const phoneFormat = jQuery("#wpforms-10586-field_24").attr("placeholder").split(/(?!$)/u);
    var formattedPhone = "";
    phoneFormat.map((pn,i)=>{
        if(Number.isInteger(parseInt(pn))){
            formattedPhone += 9
        }else{
            formattedPhone += pn
        }
    })
    jQuery(":input").inputmask();
    jQuery("#wpforms-10586-field_24").inputmask({"mask": formattedPhone});
}, 1500);
