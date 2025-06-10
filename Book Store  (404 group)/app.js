const wrapper = document.querySelector(".sliderWrapper");
const menuItems = document.querySelectorAll(".menuItem");

const products = [
  {
    id: 1,
    title: "Hero",
    price: 35,
    colors: [
      {img: "./img/hero.png" },
    ],
  },
  {
    id: 2,
    title: "Pemburu",
    price: 149,
    colors: [
      {img: "./img/pemburu.png" }
    ],
  },
  {
    id: 3,
    title: "Surihati Encik Pembunuh",
    price: 35,
    colors: [
      {img: "./img/surihatiencikpembunuh.png" },
    ],
  },
  {
    id: 4,
    title: "Samurai Melayu",
    price: 35,
    colors: [
      {img: "./img/samuraimelayu.png" }
    ],
  },
  {
    id: 5,
    title: "Membunuh Muhammad",
    price: 35,
    colors: [
      {img: "./img/membunuhmuhammad.png" }
    ],
  },
];

let choosenProduct = products[0];

const currentProductImg = document.querySelector(".productImg");
const currentProductTitle = document.querySelector(".productTitle");
const currentProductPrice = document.querySelector(".productPrice");

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    // Change the current slide
    wrapper.style.transform = `translateX(${-100 * index}vw)`;

    // Change the chosen product
    choosenProduct = products[index];

    // Update content
    currentProductTitle.textContent = choosenProduct.title;
    currentProductPrice.textContent = "RM" + choosenProduct.price;
    currentProductImg.src = choosenProduct.colors[0].img;

    });
  });

// Payment logic
const productButton = document.querySelector(".productButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");

productButton.addEventListener("click", () => {
  payment.style.display = "flex";
});

close.addEventListener("click", () => {
  payment.style.display = "none";
});