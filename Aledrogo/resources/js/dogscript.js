document.addEventListener('DOMContentLoaded', function() {
    try {
        document.querySelector("#strony > nav > div > div > p").style.paddingRight = "20px";
        document.querySelector("#strony > nav > div > div > p").classList.add("text-white");
    } catch (e) {
        console.log("unlucky");
    }
});
