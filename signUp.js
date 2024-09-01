function validateForm() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const acceptPolicies = document.getElementById('accept-policies').checked;

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    if (!acceptPolicies) {
        alert('You must accept the policies.');
        return false;
    }

    return true;
}
