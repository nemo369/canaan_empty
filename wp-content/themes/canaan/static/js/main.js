import '../css/tailwind.css';
import '../css/style.scss';
import AxeCheck from './AxeCheck';


const components = [
  // {
  //   Class: ScrollNav,
  //   selector: 'html',
  //   options: {},
  // },
  {
    Class: AxeCheck,
    selector: ".axe-is-dev",
    options: {},
  },
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