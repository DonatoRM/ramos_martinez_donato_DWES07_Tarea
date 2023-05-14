document.addEventListener(
  "DOMContentLoaded",
  () => {
    document.getElementById("table").addEventListener(
      "click",
      (evento) => {
        if (evento.target.tagName === "BUTTON") {
          const cod = evento.target.value;
          const valueSelect = document.getElementById("numVoto-" + cod).value;
          const responseVote = xajax.request(
            { xjxfun: "miVoto" },
            { mode: "synchronous", parameters: [cod, valueSelect] }
          );
          if (responseVote) {
            alert("Ya has votado ese producto !!!");
          }
          console.log(cod);
          xajax_pintarEstrellas(cod);
        }
      },
      false
    );
  },
  false
);
