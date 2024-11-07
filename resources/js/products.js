let listProductHTML = document.querySelector('.listProduct');
let listCartHTML = document.querySelector('.listCart');
let iconCart = document.querySelector('.icon-cart');
let iconCartSpan = document.querySelector('.icon-cart span');
let body = document.querySelector('body');
let closeCart = document.querySelector('.close');
let products = [];
let cart = [];

document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('menuBtn');
    const menu = document.getElementById('side-nav');
    const closeBtn = document.querySelector('.closenav');

    menuBtn.addEventListener('click', function() {
        menu.classList.add('show');
    });

    closeBtn.addEventListener('click', function() {
        menu.classList.remove('show');
    });
});


iconCart.addEventListener('click', () => {

    body.classList.toggle('showCart');
})


closeCart.addEventListener('click', () => {
    body.classList.toggle('showCart');
})

const addDataToHTML = () => {
    if (products.length > 0) {
        products.forEach(product => {
            let newProduct = document.createElement('div');
            newProduct.classList.add('mycard');
            newProduct.innerHTML =
                `<div class="heart"><img src="heart.png" alt=""></div>
                <div class="mycardinfo">
                    <h2>${product.name}</h2>
                    <div class="cardprice">
                        <div>
                            <p><span>$${product.price.toFixed(2)} </span>USD</p>
                        </div>
                    </div>
                    <button class="addCart">Add To Cart</button>
                    <span class="hidden-id" style="display:none;">${product.id}</span> <!-- Hidden span for product ID -->
                </div>`;
            newProduct.style.backgroundImage = product.image
            listProductHTML.appendChild(newProduct);
        });
    }
}

listProductHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if (positionClick.classList.contains('addCart')) {
        let parentDiv = positionClick.closest('.mycard');
        let hiddenIdSpan = parentDiv.querySelector('.hidden-id');
        let id_product = hiddenIdSpan.textContent;
        addToCart(id_product);
    }
})


const addToCart = (product_id) => {

    if (product_id !== undefined && !isNaN(product_id)) {
        product_id = parseInt(product_id);


        let productIndex = products.findIndex(product => product.id === product_id);
        if (productIndex !== -1) {

            let cartItemIndex = cart.findIndex(item => item.product_id === product_id);
            if (cartItemIndex === -1) {

                cart.push({ product_id: product_id, quantity: 1 });
            } else {

                cart[cartItemIndex].quantity++;
            }

            addCartToHTML();

            addCartToMemory();
        } else {
            console.error(`Product with ID ${product_id} not found.`);
        }
    } else {
        console.error("Invalid product ID:", product_id);
    }
}




const addCartToMemory = () => {
    localStorage.setItem('cart', JSON.stringify(cart));
}


const addCartToHTML = () => {
    listCartHTML.innerHTML = '';
    let totalQuantity = 0;
    if (cart.length > 0) {
        cart.forEach(item => {
            totalQuantity += item.quantity;
            let newItem = document.createElement('div');
            newItem.classList.add('item');
            newItem.dataset.id = item.product_id;

            let positionProduct = products.findIndex((value) => value.id == item.product_id);
            if (positionProduct !== -1) {
                let info = products[positionProduct];
                listCartHTML.appendChild(newItem);

                newItem.innerHTML = `
                    <div class="imagecart" style="background-image: ${info.image.slice(5, -2)}"></div>
                    <div class="info">
                        <div class="name">${info.name}</div>
                        <div class="totalPrice">$${(info.price * item.quantity).toFixed(2)}</div>
                        <div class="quantity">
                            <span class="minus"><p><</p></span>
                            <span><p>${item.quantity}</p></span>
                            <span class="plus"><p>></p></span>
                        </div>
                    </div>
                `;

                // Add event listeners for plus and minus buttons
                newItem.querySelector('.minus').addEventListener('click', () => {
                    changeQuantityCart(item.product_id, 'minus');
                });

                newItem.querySelector('.plus').addEventListener('click', () => {
                    changeQuantityCart(item.product_id, 'plus');
                });
            } else {
                console.error(`Product with ID ${item.product_id} not found.`);
            }
        })
    }
    iconCartSpan.innerText = totalQuantity;
}



listCartHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if (positionClick.classList.contains('minus') || positionClick.classList.contains('plus')) {
        let product_id = positionClick.parentElement.parentElement.dataset.id;
        let type = 'minus';
        if (positionClick.classList.contains('plus')) {
            type = 'plus';
        }
        changeQuantityCart(product_id, type);
    }
})
const changeQuantityCart = (product_id, type) => {
    let positionItemInCart = cart.findIndex((value) => value.product_id == product_id);
    if (positionItemInCart >= 0) {
        let info = cart[positionItemInCart];
        switch (type) {
            case 'plus':
                cart[positionItemInCart].quantity = cart[positionItemInCart].quantity + 1;
                break;

            default:
                let changeQuantity = cart[positionItemInCart].quantity - 1;
                if (changeQuantity > 0) {
                    cart[positionItemInCart].quantity = changeQuantity;
                } else {
                    cart.splice(positionItemInCart, 1);
                }
                break;
        }
    }
    addCartToHTML();
    addCartToMemory();
}



const initApp = () => {

    fetch('products.json')
        .then(response => response.json())
        .then(data => {
            products = data;
            addDataToHTML();


            if (localStorage.getItem('cart')) {
                cart = JSON.parse(localStorage.getItem('cart'));
                addCartToHTML();
            }
        })
}


initApp();