; (function (document, course_obj, axios) {
  const { ajax_url, security, course_id } = course_obj;
  const form = document.forms[0]
  form.addEventListener('submit', event => {
    event.preventDefault()
    const submitButton = form.querySelector('button.submit-answers')
    const formData = new FormData(form)
    submitButton.classList.add('loading-animation')
    submitButton.textContent = "Sending answers..."
    formData.append("action", "theoretical_exam")
    formData.append("security", security)
    formData.append("course_id", course_id)
    axios.post(ajax_url, formData)
      .then(response => {
        console.log(response)
        submitButton.classList.remove('loading-animation')
        submitButton.classList.add('disabled-button')
        submitButton.textContent = "Your answers have been submitted successfully"
      }).catch(error => {
        console.error(error)
        submitButton.classList.remove('loading-animation')
        submitButton.classList.add('disabled-button')
        submitButton.textContent = "There was an error submitting your answers, please try again later"
      })
  })
})(document, course_obj, axios);
