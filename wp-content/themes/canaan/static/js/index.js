import '../css/style.scss';
import './cross-site/images'

const components = [
    // {
    //   Class: ScrollNav,
    //   selector: 'html',
    //   options: {},
    // },
  ];
  
 
window.addEventListener('load', function () {
    console.log('nemo ,load');
    
});

window.addEventListener('DOMContentLoaded', function () {
  console.log('nemo2 ,DOMContentLoaded');
  components.forEach(component => {
    if (document.querySelector(component.selector) !== null) {
      document
        .querySelectorAll(component.selector)
        .forEach(element => new component.Class(element, component.options));
    }
  });
});