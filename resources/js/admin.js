import { Tooltip } from 'bootstrap'

// Toggle the side navigation
$('#sidenavToggler').on('click', function (e) {
  e.preventDefault()
  $('body').toggleClass('sidenav-toggled')
})

// Configure tooltips for collapsed side navigation
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(tooltipTriggerEl => {
  new Tooltip(tooltipTriggerEl, {
    template: '<div class="tooltip navbar-sidenav-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
  })
})
