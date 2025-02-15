document.addEventListener("contextmenu", event => event.preventDefault());
document.addEventListener("keydown", event => {
    if (event.ctrlKey && ["u", "s", "i", "j"].includes(event.key.toLowerCase())) {
        event.preventDefault();
    }
    if (event.keyCode === 123) {
        event.preventDefault();
    }
});
setInterval(() => {
    if (window.outerHeight - window.innerHeight > 100) {
        document.body.innerHTML = "";
    }
}, 500);