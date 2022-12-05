const form = document.getElementById('change-password');
const errorMessage = document.querySelector('.error-message');
const successMessage = document.querySelector('.success-message');
const { ajax_url, security } = new_pass_obj;

form.addEventListener('submit', event => {
  event.preventDefault();
  errorMessage.style.display = 'none';
  if (!form['new-password'].value || !form['confirm-password'].value) {
    errorMessage.textContent = 'Please enter a new password';
    errorMessage.style.display = 'block';
    return;
  }
  if (form['new-password'].value !== form['confirm-password'].value) {
    errorMessage.textContent = 'Passwords do not match';
    errorMessage.style.display = 'block';
    return;
  }
  const formData = new FormData(form);
  formData.append('action', 'new_password');
  formData.append('security', security);
  axios.post(ajax_url, formData)
    .then(response => {
      successMessage.style.display = 'block';
      form.reset();
    }).catch(error => {
      errorMessage.textContent = 'There was an error changing your password, please try again later';
      errorMessage.style.display = 'block';
      console.error(error);
    });
});
