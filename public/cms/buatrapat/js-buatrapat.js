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
    resetAlert.style.display = 'block';
    
    setTimeout(function() {
        resetAlert.style.opacity = '0';
        setTimeout(function() {
            resetAlert.style.display = 'none';
            resetAlert.style.opacity = '1';
        }, 300);
    }, 3000);
}