console.log(window.Vue);

window.test = "test";
window.Vue.component("testing-this", () => import("./components/TestingThis"));
