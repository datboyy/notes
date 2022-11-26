document.addEventListener('DOMContentLoaded', (ev) => {

  // Toggle menu selectors
  let toggleMenuSel = 'admin-toggle-menu'                                       // menu itself
  let toggleMenuIconSel = 'fa-ellipsis'                                         // menu trigger
  let toggleMenuIconEl = document.querySelector('.' + toggleMenuIconSel)        // menu icon element
  let toggleMenuEl = document.querySelector('.' + toggleMenuSel)                // contex menu element
  // Reach all possible triggers
  let toggleMenuItemEls = toggleMenuEl.querySelectorAll('li')
  // Modal selector
  let modalSel = 'modal'
  // Attribute given to the element that displays modal on-click
  let modalAttr = 'data-modal'
  // Modal close button
  let modalCloseSel = 'modal-title i.fa-xmark'
  // Reach modal close buttons elements
  let modalCloseEls = document.querySelectorAll('.' + modalCloseSel)

  // Compute the three dots menu icons position to align the context menu with
  let iconPosition = toggleMenuIconEl.getBoundingClientRect()
  toggleMenuEl.style.top = iconPosition.y + 10 + 'px'
  toggleMenuEl.style.left = iconPosition.x - 10 + 'px'
  //
  // Toggle the context menu display
  toggleMenuIconEl.parentNode.addEventListener('click', (ev) =>
  {
    toggleMenuEl.classList.toggle('d-none')
  })
  //
  // Toggle modal windows display
  toggleMenuItemEls.forEach((item) =>
  {
      item.addEventListener('click', (ev) => {
        if(ev.target.hasAttribute(modalAttr))
        {
           let modal = document.querySelector('#' + ev.target.getAttribute(modalAttr))
           modal.classList.remove('d-none')
        }
      })
  })
  //
  // Hide context menu on document click
  document.addEventListener('click', (ev) => {
    if(!ev.target.classList.contains('fa-ellipsis'))
    {
      toggleMenuEl.classList.add('d-none')
    }
  })
  //
  // Modals closes buttons events
  modalCloseEls.forEach((item) => {
   item.addEventListener('click', (ev) => {
    item.closest('.' + modalSel).classList.add('d-none')
  });
 })

})
