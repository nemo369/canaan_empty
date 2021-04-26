import 'vite/dynamic-import-polyfill'
import '../css/tailwind.css';


const components = [
  // {
  //   Class: ScrollNav,
  //   selector: 'html',
  //   options: {},
  // },
];


window.addEventListener('load', function () {
  document.documentElement.style.setProperty('--full-height', `${window.innerHeight}px`);
  // create an Observer instance
  const resizeObserver = new ResizeObserver(entries =>
    document.documentElement.style.setProperty('--full-height', `${window.innerHeight}px`)
  );
  // start observing a DOM node
  resizeObserver.observe(document.body);
  console.log('nemo ,load');

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