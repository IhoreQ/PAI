let userHasDog;

function hasDog() {

    const myDoggyContent = document.querySelector(".my-doggy-content");
    const newDoggyContent = document.querySelector(".new-dog-content");

    fetch("/getIfUserHasDog", {
        method: "GET"
    }).then(res => res.json().then(data => {
        if (data === true) {
            userHasDog = true;
            myDoggyContent.style.display = "flex";
        }
        else {
            userHasDog = false;
            newDoggyContent.style.display = "flex";
        }
    }))
}

function getDogPhoto() {
    const dogPhoto = document.querySelector(".dog-photo");

    fetch("/getUserDogPhoto", {
        method: "GET"
    }).then(res => res.json().then(data => {
        dogPhoto.style.backgroundImage = `url('/public/uploads/${data}')`;
    }));
}



window.addEventListener("load", hasDog);
window.addEventListener("load", getDogPhoto);

