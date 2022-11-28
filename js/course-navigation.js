;(function () {
  // Get location hash
  const { hash } = window.location;

  // Get post id
  const header = document.querySelector('header.course-header')
  const post_id = header.dataset.postId

  function showSelectedSection( hash ) {
    //1. set all sections to display none
    Array.from(document.querySelectorAll('section')).forEach( section => {
      section.style.display = 'none';
    })
    //2 Remove class current-section from internal nav links.
    Array.from(document.querySelectorAll('nav.course-navigation > a')).forEach( nav => {
      nav.classList.remove('current-section')
    });
    //3. Show section selected
    document.querySelector(hash).style.display = 'block';
    //4 Add current-section class to navigation link
    document
      .querySelector(`a[href="${hash}"]`)
      .classList.add('current-section');
  }

  function updateLastesPosition( hash ) {
    // 1. Create FormData to send via axios
    const formData = new FormData();
    formData.append('action', 'update_latest_position')
    formData.append('security', course_obj.security)
    formData.append('post_id', post_id)
    formData.append('hash', hash)
    // 2. Send the hash to server
    axios.post( course_obj.ajax_url, formData )
    .then(response => {
      console.log(response)
    }).catch(error => {
      console.error(error)
    })
  }

  window.addEventListener('DOMContentLoaded', function() {
    if (hash) showSelectedSection(hash)
  });

  // Listen to changes in location hash
  window.addEventListener('hashchange', function(event) {
    event.stopPropagation();
    const { hash } = window.location
    showSelectedSection(hash);
    updateLastesPosition(hash);
  }) //Hashchange listener

  //Add next button functionality for all next section buttons
  Array.from(document.querySelectorAll('button.next-section')).forEach( button => {
    button.addEventListener('click', event => {
      const { nextElementSibling } = event.target.parentNode.parentNode
      const nextElementId = nextElementSibling.id
      const hash = `#${nextElementId}`
      if ( nextElementSibling ) {
        showSelectedSection(hash)
        updateLastesPosition(hash)
      }
    })
  })

  Array.from(document.querySelectorAll('button.prev-section')).forEach( button => {
    button.addEventListener('click', event => {
      const { previousElementSibling } = event.target.parentNode.parentNode
      const prevElementId = previousElementSibling.id
      const hash = `#${prevElementId}`
      if ( previousElementSibling ) {
        showSelectedSection(hash)
        updateLastesPosition(hash)
      }
    }) 
  })

  
})()