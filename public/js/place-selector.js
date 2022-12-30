const places = document.querySelectorAll(".place-text-box");

function setPlaceCookie() {

    const placeName = this.parentElement.getAttribute('id');

    fetch(`/getPlaceID/${placeName}`, {
        method: "GET"
    }).then(res => res.json()
        .then(data => {
            document.cookie = `chosen_place=${data};path=/`;
            window.location.replace("place");
        }));
}

places.forEach(place => {
    place.addEventListener("click", setPlaceCookie)
})