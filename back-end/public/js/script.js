document.getElementById('show-password').addEventListener('change', function() {
    var passwordInput = document.getElementById('password');
    if (this.checked) {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});

// function toggle_notis(){
//     document.getElementById('notis').classList.toggle('active');
    
//     var notis = document.getElementById('notis');

//     if(notis.classList.contains('active')){
//         notis.style.display = 'block';
//     }
//     else{
//         notis.style.display = 'none';
//     }
// }

function toggle_schedule(scheduleId) {
    var schedule = document.getElementById(scheduleId);
    if (schedule.style.display === "none") {
        schedule.style.display = "block";
    } else {
        schedule.style.display = "none";
    }
}

function openModal(doctorId) {
    document.getElementById('deleteModal' + doctorId).classList.remove('hidden');
}

function closeModal(doctorId) {
    document.getElementById('deleteModal' + doctorId).classList.add('hidden');
}

