let cartButton = document.querySelector('.cart-button');
let products = document.querySelectorAll('.product-item');
cartButton.textContent = `My cart(${products.length})`;
function changeRate(id_product){
    let rate = document.querySelector(`.select-rate-${id_product}`).value;
    let selectRates = document.querySelectorAll('.select-rate');
    selectRates.forEach(rate => rate.setAttribute("disabled", "disabled"));
    let bodyFormData = new FormData();
    bodyFormData.append('id_product', id_product);
    bodyFormData.append('rate', rate);
    axios({
        method: 'post',
        url: './includes/rating.php',
        data: bodyFormData,
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then(response => {
        document.querySelector(`.current-rate-${id_product}`).innerHTML = `Current:${response.data}`;
    })
}
function submitProducts() {
    let cartPayButton = document.querySelector('.cart-pay');
    if (document.querySelector('.select-delivery').value == "") {
        cartPayButton.removeAttribute("data-dismiss");
        alert("Please select delivery!!!");
    } else {
        let cartPays = document.querySelector('.modal-cart-pays');
        cartPayButton.setAttribute("data-dismiss", "modal");
        let prev_balance = +document.querySelector('.balance').textContent;
        let counts = document.querySelectorAll('.edit-count');
        let prices = document.querySelectorAll('.price');
        let sum = +document.querySelector('.select-delivery').value;
        for (let i = 0; i < counts.length; i++) {
            sum += counts[i].value * prices[i].textContent;
        }
        let next_balance = prev_balance - sum;
        let bodyFormData = new FormData();
        bodyFormData.append('prev_balance', prev_balance);
        bodyFormData.append('sum', sum);
        bodyFormData.append('next_balance', next_balance);
        axios({
            method: 'post',
            url: './includes/buying.php',
            data: bodyFormData,
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(response => {
            cartPays.innerHTML = response.data;
            document.querySelector('.balance').textContent = next_balance;
        })
    }
}

function changeCount(id_product) {
    let bodyFormData = new FormData();
    let edit_count = document.querySelector(`.edit-count-${id_product}`).value;
    bodyFormData.append('id_product', id_product);
    bodyFormData.append('count', edit_count);
    changeCart(bodyFormData);
}

function deleteProduct(id_product) {
    let bodyFormData = new FormData();
    bodyFormData.append('id_product', id_product);
    bodyFormData.append('count', 0);
    changeCart(bodyFormData);
}

function addProduct(id_product, name_product, description_product, price_product) {
    let bodyFormData = new FormData();
    bodyFormData.append('id_product', id_product);
    bodyFormData.append('name', name_product);
    bodyFormData.append('description', description_product);
    bodyFormData.append('price', price_product);
    bodyFormData.append('count', 'increment');
    changeCart(bodyFormData);
}

function changeCart(bodyFormData) {
    let cartContent = document.querySelector('.modal-cart-products');
    axios({
        method: 'post',
        url: './includes/edit_products.php',
        data: bodyFormData,
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then(response => {
        cartContent.innerHTML = response.data;
        let products = document.querySelectorAll('.product-item');
        cartButton.textContent = `My cart(${products.length})`
    })
}