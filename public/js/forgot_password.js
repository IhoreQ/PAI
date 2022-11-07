const turnOn = () => {
    document.querySelector(".app-cover").style.display = "flex";
    document.querySelector(".forgot-password-container").style.display = "flex";
}

const turnOff = () => {
    document.querySelector(".app-cover").style.display = "none";
    document.querySelector(".forgot-password-container").style.display = "none";
}