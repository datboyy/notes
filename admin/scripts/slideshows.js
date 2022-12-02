document.addEventListener('DOMContentLoaded', (ev) =>
{
  //
  //
  //
  // Check slideshow metadatas form integrity
  let slideshowformSel = 'form[name="slideshow_form"]'
  let slideshowformEl = document.querySelector(slideshowformSel)                // Slideshow form
  let slideshowSubmitSel = 'input[name="slideshow_submit"]'                     // Slideshows submit button
  let slideshowSubmitEl = document.querySelector(slideshowSubmitSel)
  let slideshowTitleInputSel = 'input[name="title"]'                            // Slideshows title input
  let slideshowTitleInputEl = document.querySelector(slideshowTitleInputSel)
  let slideshowTagsInputSel = 'input[name="tags"]'                              // Slideshows tags input
  let slideshowTagsInputEl = document.querySelector(slideshowTagsInputSel)
  //
  // Submit the slideshow form
  slideshowformEl.addEventListener('submit', (ev) => {
    ev.preventDefault()
    let isCorrect = true
    if(!slideshowTitleInputEl.value)
    {
      // Slideshow title input is empty
      slideshowTitleInputEl.style.border = '4px solid #ff4902'
      isCorrect = false
    }
    else
    {
      // Remove border when field as been filled
      slideshowTitleInputEl.style = ''
    }
    if(!slideshowTagsInputEl.value)
    {
      // Slideshow tags input is empty
      slideshowTagsInputEl.style.border = '4px solid #ff4902'
      isCorrect = false
    }
    else
    {
      // Remove border when field as been filled
      slideshowTagsInputEl.style = ''
    }
    if(isCorrect)
    {
      ev.target.submit()
    }
  })
  //
  //
  //
  // Slideshows interactivity, add slides, etc...
  //
  // Slides containers
  let slidesContainerSel = '.sidebar__slides'
  let slidesContainerEl = document.querySelector(slidesContainerSel)
  //
  // Slides items
  let not = ':not(.sidebar__slides__slide--add)'        // add button is an item
  let smlrSlideItemsSel = '.sidebar__slides__slide'
  let slidesItemsSel = '.sidebar__slides__slide' + not  // add item is excluded
  let slidesItemsEls = document.querySelectorAll(slidesItemsSel)
  //
  // Slide add button
  let slideAddBtnSel = '.sidebar__slides__slide--add a'
  let slideAddBtnEl = document.querySelector(slideAddBtnSel)
  //
  // Modal window slide edition
  let slidesModalSel = '#modal_slide'
  let slidesModalTextareaSel = slidesModalSel + ' textarea'
  let slidesModalEl = document.querySelector(slidesModalSel)
  let slidesModalTextareaEl = document.querySelector(slidesModalTextareaSel)
  //
  //
  //
  // Event triggered when a slide is clicked
  slideClickedEvent(slidesItemsEls, slidesModalEl, slideshowformEl)
  //
  //
  //
  // Add a new slide
  slideAddBtnEl.addEventListener('click', (ev) => {
    let nbOfSlides = document.querySelectorAll(slidesItemsSel).length + 1
    let slideEl = document.createElement('div')
        slideEl.classList.add(smlrSlideItemsSel.substring(1))
        slideEl.innerText = nbOfSlides
        slideEl.setAttribute('data-slide-id', nbOfSlides)
    // Add new slid to the DOM
    slideAddBtnEl.parentNode.insertAdjacentElement('beforebegin', slideEl)
    // Set events to the newly created element
    slideClickedEvent(document.querySelectorAll(slidesItemsSel), slidesModalEl, slideshowformEl)
    return false;
  })
  //
  // Edit slides using the modal slides editor
  slidesModalEl.querySelector('form').addEventListener('submit', (ev) =>
  {
    ev.preventDefault()
  })

  slidesModalEl.querySelector('input[type="submit"]').addEventListener('click', (ev) => {
    // Slides datas have to be submitted using the slideshow form
    let modalTextarea = slidesModalEl.querySelector('textarea')
    let slideNb = modalTextarea.getAttribute('data-slide-id')
    if(!slideshowformEl.querySelectorAll('textarea[name="slide_' + slideNb + '"]').length)
    {
      //
      // Create an invisible textarea entry related to this slide in the general slideshow form
      let textareaEl = document.createElement('textarea')
          textareaEl.setAttribute('data-slide-id', slideNb)
          textareaEl.setAttribute('name', 'slide_' + slideNb)
          textareaEl.value = modalTextarea.value
          textareaEl.classList.add('d-none')
      slideshowformEl.insertAdjacentElement('beforeend', textareaEl)
    }
    else
    {
      //
      // Update the existing entry
      let currentSlideTextarea = slideshowformEl.querySelectorAll('textarea[name="slide_' + slideNb + '"]')
      currentSlideTextarea.value = modalTextarea.value
    }
    slidesModalEl.classList.add('d-none')
  })
})
//
//
//
// Open a slide to edit it in the slides editor content area
function slideClickedEvent(slidesItemsEls, slidesModalEl, slideshowformEl)
{
  //
  // Open window edition
  slidesItemsEls.forEach((item) => {
    if(!item.hasAttribute('listener'))
    {
      item.addEventListener('click', (ev) => {
        // Not to put events several times
        ev.target.setAttribute('listener', 1)
        let slidesEditorTextareaEl = slidesModalEl.querySelector('textarea')
        // Give to the slide editor textarea the data-slide-id of the clicked slide
        slidesEditorTextareaEl.setAttribute('data-slide-id', ev.target.getAttribute('data-slide-id'))
        //
        // If exsiting text for this slide, fill the modal window textarea
        let existingEntry = slideshowformEl.querySelectorAll('textarea[name="slide_' + slidesEditorTextareaEl.getAttribute('data-slide-id') + '"]')
        if(existingEntry.length)
        {
          slidesEditorTextareaEl.value = existingEntry[0].value
        }
        else
        {
          slidesEditorTextareaEl.value = ''
        }
        // Set the clicked slide as the active one
        slidesItemsEls.forEach((item) =>
        {
          item.classList.remove('active')
        })
        item.classList.add('active') // items become visually active
        // Open the slides content editor modal
        slidesModalEl.classList.remove('d-none')
      })
    }
  })
}
