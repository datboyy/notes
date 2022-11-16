document.addEventListener('DOMContentLoaded', (ev) => {
  let toggleMenuSel = 'admin-toggle-menu'
  let toggleMenuIconSel = 'fa-ellipsis'

  let toggleMenuIconEl = document.querySelector('.' + toggleMenuIconSel)
  let toggleMenuEl = document.querySelector('.' + toggleMenuSel)
  let toggleMenuItemEls = toggleMenuEl.querySelectorAll('li')

  let modalSel = 'modal'
  let modalAttr = 'data-modal'
  let modalCloseSel = 'modal-title i.fa-xmark'

  let modalCloseEls = document.querySelectorAll('.' + modalCloseSel)

  let iconPosition = toggleMenuIconEl.getBoundingClientRect()
  toggleMenuEl.style.top = iconPosition.y + 10 + 'px'
  toggleMenuEl.style.left = iconPosition.x - 10 + 'px'

  toggleMenuIconEl.parentNode.addEventListener('click', (ev) =>
  {
    toggleMenuEl.classList.toggle('d-none')
  })

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

  document.addEventListener('click', (ev) => {
    if(!ev.target.classList.contains('fa-ellipsis'))
    {
      toggleMenuEl.classList.add('d-none')
    }
  })

  modalCloseEls.forEach((item) => {
   item.addEventListener('click', (ev) => {
    item.closest('.' + modalSel).classList.add('d-none')
  });
 })

})
