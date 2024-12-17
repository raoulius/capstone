// For success message
const successAlert = document.querySelector('.alert-success');
if (successAlert) {
    setTimeout(function() {
        successAlert.style.opacity = '0';
        setTimeout(function() {
            successAlert.style.display = 'none';
        }, 300);
    }, 3000);
}

// For reset message
function showResetMessage() {
    const resetAlert = document.getElementById('resetAlert');
    if (resetAlert) {
        resetAlert.style.display = 'block';
        resetAlert.style.opacity = '1'; // Ensure it's visible
        
        setTimeout(function() {
            resetAlert.style.opacity = '0';
            setTimeout(function() {
                resetAlert.style.display = 'none';
                resetAlert.style.opacity = '1';
            }, 300);
        }, 3000);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Handle success message
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(function() {
            successAlert.style.opacity = '0';
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 300);
        }, 3000);
    }

   
});