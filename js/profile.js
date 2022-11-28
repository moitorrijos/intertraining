;(function () {
  const profileSectionButton = document.querySelector('button.profile-section-button');
  const passwordSectionButton = document.querySelector('button.password-section-button');
  const coursesSectionButton = document.querySelector('button.courses-section-button');
  const profileSection = document.querySelector('.profile-details-section');
  const passwordSection = document.querySelector('.change-password-section');
  const coursesSection = document.querySelector('.courses-section');

  function showSection(button, section) {
    button.addEventListener('click', (event) => {
      
      Array.from(document.querySelectorAll('.profile-tabs button'))
        .forEach(button => button.classList.remove('current-tab'));

      event.target.classList.add('current-tab');

      Array.from(document.querySelectorAll('.profile-tabs-body > div'))
        .forEach(section => section.style.display = 'none');
      section.style.display = 'block';

    })
  }

  showSection(coursesSectionButton, coursesSection)
  showSection(profileSectionButton, profileSection)
  showSection(passwordSectionButton, passwordSection)
})()