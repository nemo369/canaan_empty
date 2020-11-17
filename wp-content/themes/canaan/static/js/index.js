import './cross-site/images'

const components = [
    {
      Class: ScrollNav,
      selector: 'html',
      options: {},
    },
  ];
  
  components.forEach(component => {
    if (document.querySelector(component.selector) !== null) {
      document
        .querySelectorAll(component.selector)
        .forEach(element => new component.Class(element, component.options));
    }
  });


  
window.addEventListener('load', function () {
    console.log('nemo');
    
});