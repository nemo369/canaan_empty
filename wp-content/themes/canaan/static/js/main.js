import '../css/tailwind.css';
import '../css/style.scss';


const components = [
  // {
  //   Class: ScrollNav,
  //   selector: 'html',
  //   options: {},
  // },
];


window.addEventListener('load', function () {
  console.log("Built By naaman, https://naamanfrenkel.dev/");
});

window.addEventListener('DOMContentLoaded', function () {
  components.forEach(component => {
    if (document.querySelector(component.selector) !== null) {
      document
        .querySelectorAll(component.selector)
        .forEach(element => new component.Class(element, component.options));
    }
  });
});