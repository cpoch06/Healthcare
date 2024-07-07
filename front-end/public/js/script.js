function toggle_menu(){
    var menu = document.getElementById("menu");
    if (menu.style.display === "none") {
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
}


function toggle_schedule(scheduleId) {
    var schedule = document.getElementById(scheduleId);
    if (schedule.style.display === "none") {
        schedule.style.display = "block";
    } else {
        schedule.style.display = "none";
    }
}


function toggle_sideProfile() {
    var sideProfile = document.getElementById("side_profile");
    if (sideProfile.style.display === "none") {
        sideProfile.style.display = "block";
    } else {
        sideProfile.style.display = "none";
    }
}


function openModal() {
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}