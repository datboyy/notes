document.addEventListener('DOMContentLoaded', (ev) =>
{

  //
  //
  // Check slideshow metadatas form integrity

  // Slideshow form
  let slideshowformSel = 'form[name="slideshow_form"]'
  let slideshowformEl = document.querySelector(slideshowformSel)
  // Slideshows submit button
  let slideshowSubmitSel = 'input[name="slideshow_submit"]'
  let slideshowSubmitEl = document.querySelector(slideshowSubmitSel)
  // Slideshows title input
  let slideshowTitleInputSel = 'input[name="title"]'
  let slideshowTitleInputEl = document.querySelector(slideshowTitleInputSel)
  // Slideshows tags input
  let slideshowTagsInputSel = 'input[name="tags"]'
  let slideshowTagsInputEl = document.querySelector(slideshowTagsInputSel)

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
  // Slideshows interactivity, add slides, etc...


})
