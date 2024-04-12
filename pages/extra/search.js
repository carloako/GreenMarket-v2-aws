let searchBar = document.getElementById('search-bar');

let search = () => {
  if (searchBar.value in products) {
    window.location.href = `${products[`${searchBar.value}`]}`;
    return false;
  }
  return false;
}

let products = {
  "fruit platter": "/P2-P3/eve/meals/fruit-platter.html",
  "pasta": "/P2-P3/eve/meals/pasta.html",
  "tuna salad": "/P2-P3/eve/meals/tuna-salad.html",
  "soup": "/P2-P3/eve/meals/soup.html",
  "tomato salad": "/P2-P3/eve/meals/tomato-salad.html",
  "salmon": "/P2-P3/eve/meals/salmon.html",
  "milk": "/P2-P3/francis/beverages/milk.html",
  "orange": "/P2-P3/francis/beverages/orange.html",
  "smoothie": "/P2-P3/francis/beverages/smoothie.html",
  "tea": "/P2-P3/francis/beverages/tea.html",
  "water": "/P2-P3/francis/beverages/water.html",
  "wine": "/P2-P3/francis/beverages/wine.html",
  "avocado": "/P2-P3/john/fruits/avocado.html",
  "banana": "/P2-P3/john/fruits/banana.html",
  "grapes": "/P2-P3/john/fruits/grapes.html",
  "lime": "/P2-P3/john/fruits/lime.html",
  "mango": "/P2-P3/john/fruits/mango.html",
  "melon": "/P2-P3/john/fruits/melon.html",
  "raspberries": "/P2-P3/john/fruits/raspberries.html",
  "strawberries": "/P2-P3/john/fruits/strawberries.html",
  "watermelon": "/P2-P3/john/fruits/watermelon.html",
  "chickpeas": "/P2-P3/ulas/snacks/chickpeas.html",
  "crackers": "/P2-P3/ulas/snacks/crackers.html",
  "nutmix": "/P2-P3/ulas/snacks/nutmix.html",
  "go! nuts": "/P2-P3/ulas/snacks/nutmix2.html",
  "go nuts": "/P2-P3/ulas/snacks/nutmix2.html",
  "nutmix2": "/P2-P3/ulas/snacks/nutmix2.html",
  "pistachios": "/P2-P3/ulas/snacks/pistachios.html",
  "sunflower seeds": "/P2-P3/ulas/snacks/sunflowerseeds.html",
}