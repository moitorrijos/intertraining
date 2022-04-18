;(function(){
  const csLoginForm = document.getElementById('cs-login-form');
  const usernameInput = document.getElementById('pmtsc_user_login');
  const passwordInput = document.getElementById('pmtsc_user_pass');
  const loginSubmit = document.getElementById('login-submit');
  function addShakeAnimation() {
    csLoginForm.classList.add('animated');
    csLoginForm.classList.add('shake');
  }
  function addLoadingAnimation() {
    loginSubmit.classList.add('loading-animation');
    loginSubmit.disabled = true;
  }
  function removeLoadingAnimation() {
    loginSubmit.classList.remove('loading-animation');
    loginSubmit.disabled = false;
  }
  function isUsernameEmpty() {
    return (usernameInput.value === '')
  }
  function isPasswordEmpty() {
    return (passwordInput.value === '');
  }
  function addRedBorders() {
    usernameInput.classList.add('red-border');
    passwordInput.classList.add('red-border');
  }
  function redirectPage() {
    document.location.href = ajax_obj.redirect_url;
  }
  csLoginForm.addEventListener('submit', function(event){
    event.preventDefault();
    addLoadingAnimation();
    const formData = new FormData(this);
    formData.append('security', ajax_obj.security);
    formData.append('action', 'ajax_login');
    if (isUsernameEmpty() || isPasswordEmpty() ) {
      addShakeAnimation();
      removeLoadingAnimation();
      addRedBorders();
    } else {
      axios.post(ajax_obj.ajax_url, formData)
        .then( response => {
          if ( response.data.logged_in ) {
            redirectPage();
          } else {
            console.error(response.data.error_message);
            addShakeAnimation();
            addRedBorders();
            removeLoadingAnimation();
          }
        })
        .catch( error => { 
          console.error(error) 
          addShakeAnimation();
          removeLoadingAnimation();     
        });
    }
  });
})()