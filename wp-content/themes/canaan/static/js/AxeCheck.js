import axe from "axe-core";
class AxeCheck {
  constructor(el, options) {
      console.log(el);
    axe
      .run()
      .then((results) => {
        results.violations.forEach((violation) => {
          console.warn(`${violation.id} - ${violation.help}`);
          violation.nodes.forEach((node) => {
            console.log(document.querySelector(`${node.target}`));
          });
        });
      })
      .catch((err) => {
        console.log(err);
        console.error("Something bad happened:", err.message);
      });
  }
}

export default AxeCheck;
