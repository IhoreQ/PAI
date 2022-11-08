const buttons = document.querySelectorAll(".menu-bar-element");

buttons.forEach((button) => {
    button.addEventListener("click", () => {

        document.querySelector(".is-active").classList.remove("is-active");
        button.classList.add("is-active");

        const containerName = button.id + "-container";
        document.querySelector(".container-is-active").classList.remove("container-is-active");
        document.querySelector("." + containerName).classList.add("container-is-active");
    });
});