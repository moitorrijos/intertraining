; (function (document, new_details_obj, axios) {
  const form = document.getElementById('change-details')
  const errorMessage = document.querySelector('.error-message-details')
  const successMessage = document.querySelector('.success-message-details')
  form.addEventListener('submit', (event) => {
    event.preventDefault();
    errorMessage.style.display = 'none'
    const formData = new FormData(form)
    formData.append('security', new_details_obj.security)
    formData.append('action', 'change_details');
    axios.post(new_details_obj.ajax_url, formData)
      .then(response => {
        successMessage.style.display = 'block'
      }).catch(error => {
        errorMessage.textContent = 'There was an error changing your details, please try again later'
        errorMessage.style.display = 'block'
        console.error(error)
      })
    })
})(document, new_details_obj, axios)