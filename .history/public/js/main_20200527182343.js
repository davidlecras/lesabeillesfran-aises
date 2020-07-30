const barre = document.querySelector(".bar");
addEventListener("scroll", function () {
  const max = this.document.body.scrollHeight - this.innerHeight;
  const pourcentage = (this.pageYOffset / max) * 100;
  barre.style.width = pourcentage + "%";
});
