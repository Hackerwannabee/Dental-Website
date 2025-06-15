function showTab(id) {
  document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));

  document.getElementById(id).style.display = 'block';
  event.target.classList.add('active');
}

let promoIndex = 0;
let promoSlides = [];

function showPromoSlides() {
  promoSlides.forEach((s) => s.classList.remove('active'));
  promoIndex = (promoIndex + 1) % promoSlides.length;
  promoSlides[promoIndex].classList.add('active');
}

let hasilIndex = 0;
let hasilSlides = [];

function showHasilSlides() {
  hasilSlides.forEach((s) => s.classList.remove('active'));
  hasilIndex = (hasilIndex + 1) % hasilSlides.length;
  hasilSlides[hasilIndex].classList.add('active');
}

window.onload = () => {
  promoSlides = document.querySelectorAll('.promo-slide');
  hasilSlides = document.querySelectorAll('.hasil-slide');

  if (promoSlides.length > 0) promoSlides[0].classList.add('active');
  if (hasilSlides.length > 0) hasilSlides[0].classList.add('active');

  setInterval(showPromoSlides, 2000);
  setInterval(showHasilSlides, 2000);
}
