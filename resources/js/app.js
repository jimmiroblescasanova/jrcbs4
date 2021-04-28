require("./bootstrap");

window.moment = require("moment");

window.livewire.on("LiveAlert", (event) => {
    swal({
        icon: event.icon,
        title: event.title,
        text: event.message,
    });
});
