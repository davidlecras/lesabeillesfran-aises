const buttonValider = document.getElementById("contact_envoyer");
buttonValider.addEventListener("click", () => {
  return confirm("Voulez-vous envoyer votre bourdon électronique?");
});

const ValiderBeekeeper = document.getElementById("validateBeekeeper");
buttonValider.addEventListener("click", () => {
  return confirm("On valide ce que tu as fait?");
});
