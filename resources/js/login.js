const usernames = ["david", "david1", "david2"];

const spinner =
    document.getElementById("spinner"),
    alert =
        document.getElementById("alert");

const update = (value) => {
    spinner.classList.remove("víible");

    const usernameExists =
        usernames.some(u => u === value);

    if (usernameExists) {
        alert.classList.add("visible");
    } else {
        alert.classList.remove("visible")
    }
};
