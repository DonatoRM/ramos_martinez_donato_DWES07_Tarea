"use strict";
document.addEventListener(
  "DOMContentLoaded",
  () => {
    document.getElementById("formLogin").addEventListener(
      "submit",
      (evento) => {
        evento.preventDefault();
        const user = document.getElementById("user").value;
        const pass = document.getElementById("pass").value;
        const response = xajax.request(
          { xjxfun: "validateFormLogin" },
          { mode: "synchronous", parameters: [user, pass] }
        );
        if (response) {
          document.getElementById("formLogin").submit();
        }
        return response;
      },
      false
    );
  },
  false
);
