; (function (document, support_obj, axios) {
  const form = document.getElementById('support-form');
  const errorMessage = document.querySelector('.error-message');
  const successMessage = document.querySelector('.success-message');
  form.addEventListener('submit', (event) => {
    event.preventDefault();
    errorMessage.style.display = 'none';
    const formData = new FormData(form);
    formData.append('security', support_obj.security);
    formData.append('action', 'support');
    axios.post(support_obj.ajax_url, formData)
      .then(response => {
        successMessage.style.display = 'block';
      }).catch(error => {
        errorMessage.textContent = 'There was an error sending your message, please try again later';
        errorMessage.style.display = 'block';
        console.error(error);
      });
  })
})(document, support_obj, axios);