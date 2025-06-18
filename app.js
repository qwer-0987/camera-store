const wrapper = document.querySelector(".sliderWrapper");
const menuItems = document.querySelectorAll(".menuItem");

const products = [
  {
    id: 1,
    title: "Canon EOS R6",
    price: 8999,
    colors: [
      {
        code: "black",
        img: "./img/canon1.png",
      },
      {
        code: "darkgray",
        img: "./img/canon2.png",
      },
    ],
  },
  {
    id: 2,
    title: "Nikon Z6 II",
    price: 7999,
    colors: [
      {
        code: "black",
        img: "./img/nikon1.png",
      },
      {
        code: "silver",
        img: "./img/nikon2.png",
      },
    ],
  },
  {
    id: 3,
    title: "Sony A7 III",
    price: 8499,
    colors: [
      {
        code: "black",
        img: "./img/sony1.png",
      },
      {
        code: "gray",
        img: "./img/sony2.png",
      },
    ],
  },
  {
    id: 4,
    title: "Fujifilm X-T4",
    price: 6799,
    colors: [
      {
        code: "silver",
        img: "./img/fuji1.png",
      },
      {
        code: "black",
        img: "./img/fuji2.png",
      },
    ],
  },
  {
    id: 5,
    title: "Panasonic Lumix S5",
    price: 7499,
    colors: [
      {
        code: "black",
        img: "./img/lumix1.png",
      },
      {
        code: "charcoal",
        img: "./img/lumix2.png",
      },
    ],
  },
];

let choosenProduct = products[0];

const currentProductImg = document.querySelector(".productImg");
const currentProductTitle = document.querySelector(".productTitle");
const currentProductPrice = document.querySelector(".productPrice");
const currentProductColors = document.querySelectorAll(".color");
const currentProductSizes = document.querySelectorAll(".size");

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    // Change the current slide
    wrapper.style.transform = `translateX(${-100 * index}vw)`;

    // Change the choosen product
    choosenProduct = products[index];

    // Change texts of currentProduct
    currentProductTitle.textContent = choosenProduct.title;
    currentProductPrice.textContent = "RM" + choosenProduct.price;
    currentProductImg.src = choosenProduct.colors[0].img;

    // Assign new colors
    currentProductColors.forEach((color, index) => {
      if(choosenProduct.colors[index]) {
        color.style.backgroundColor = choosenProduct.colors[index].code;
        color.style.display = "inline-block";
      } else {
        color.style.display = "none"; // hide unused color elements
      }
    });
  });
});

currentProductColors.forEach((color, index) => {
  color.addEventListener("click", () => {
    if(choosenProduct.colors[index]) {
      currentProductImg.src = choosenProduct.colors[index].img;
    }
  });
});

currentProductSizes.forEach((size, index) => {
  size.addEventListener("click", () => {
    currentProductSizes.forEach((size) => {
      size.style.backgroundColor = "white";
      size.style.color = "black";
    });
    size.style.backgroundColor = "black";
    size.style.color = "white";
  });
});

const productButton = document.querySelector(".productButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");

productButton.addEventListener("click", () => {
  payment.style.display = "flex";
});

close.addEventListener("click", () => {
  payment.style.display = "none";
});
