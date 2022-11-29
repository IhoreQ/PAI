const footer = document.querySelector(".places-footer-ideas");
const closeButton = document.querySelector(".app-cover-close");
const appCover = document.querySelector(".app-cover");


footer.addEventListener("click", () => {
    appCover.style.display = "flex";
});

function turnOff() {
    appCover.style.display = "none";
}

function turnOn() {
    appCover.style.display = "flex";
}

function showAddingPage() {
    document.querySelector(".new-dog-info").style.display = "none";
    document.querySelector(".new-dog-add-page").style.display = "flex";
}

const fileUpload = document.querySelector("#file-upload");

fileUpload.addEventListener("change", function() {
    document.querySelector("#file-chosen").textContent = this.files[0].name;
});