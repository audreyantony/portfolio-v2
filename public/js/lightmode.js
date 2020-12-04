var toggle = document.getElementById('container');
var toggleContainer = document.getElementById('toggle-container');
var toggleNumber;

toggle.addEventListener('click', function() {
    toggleNumber = !toggleNumber;
    if (toggleNumber) {
        toggleContainer.style.clipPath = 'inset(0 0 0 50%)';
        toggleContainer.style.backgroundColor = 'rgba(84, 84, 82,1)';
        document.cookie = 'style = darkmode ; path=/; SameSite=None ; Secure';
        setTimeout(() => {document.location.reload()},2000);
    } else {
        toggleContainer.style.clipPath = 'inset(0 50% 0 0)';
        toggleContainer.style.backgroundColor = 'rgba(84, 84, 82,0.4)';
        document.cookie = 'style = lightmode ; path=/; SameSite=None ; Secure';
        setTimeout(() => {document.location.reload()},2000);
    }
});

