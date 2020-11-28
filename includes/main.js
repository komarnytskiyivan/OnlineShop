// let deleteSolo = document.querySelector('.btn-delete-solo');
// let addSolo = document.querySelectorAll('.btn-add-item');
// let checkMain = document.querySelector('#scales');
// let ok = document.querySelectorAll('.btn-ok');
// let idItem = document.querySelector('.edit-item-id')
// let select = document.querySelectorAll('.select-action');
// let tableData = document.querySelector('.table-content');
// let title = document.querySelector('.modal-title');
// let arrChecked = [];
// let modalText = document.querySelector('.modal-text-confirm')
// let modalTitle = document.querySelector('.modal-title-confirm')
let cartPayButton = document.querySelector('.cart-pay');
let cartButton = document.querySelector('.cart-button');
let cartContent = document.querySelector('.modal-cart-content');
let products = document.querySelectorAll('.product-item');
console.log(products.length);
cartButton.textContent = `My cart(${products.length})`;
function submitProducts(){
    if(document.querySelector('.select-delivery').value == ""){
        cartPayButton.removeAttribute("data-dismiss");
    alert("Please select delivery!!!");
    }else{
        cartPayButton.setAttribute("data-dismiss", "modal");
    }
}
function changeCount(id_product){
    let bodyFormData = new FormData();
            let edit_count = document.querySelector('.edit-count').value;
            bodyFormData.append('id_product', id_product);
            bodyFormData.append('count', edit_count);
            axios({
                method: 'post',
                url: './includes/get_post.php',
                data: bodyFormData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                cartContent.innerHTML = response.data;
                let products = document.querySelectorAll('.product-item');
                console.log(products.length);
                cartButton.textContent = `My cart(${products.length})`
            })
}
function deleteProduct(id_product){
    console.log(id_product);
    let bodyFormData = new FormData();
            bodyFormData.append('id_product', id_product);
            bodyFormData.append('count', 0);
            axios({
                method: 'post',
                url: './includes/get_post.php',
                data: bodyFormData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                cartContent.innerHTML = response.data;
                let products = document.querySelectorAll('.product-item');
                console.log(products.length);
                cartButton.textContent = `My cart(${products.length})`
            })
}
function addProduct(id_product,name_product,description_product,price_product){
    console.log(id_product);
    let bodyFormData = new FormData();
            bodyFormData.append('id_product', id_product);
            bodyFormData.append('name', name_product);
            bodyFormData.append('description', description_product);
            bodyFormData.append('price', price_product);
            bodyFormData.append('count', 1);
            axios({
                method: 'post',
                url: './includes/get_post.php',
                data: bodyFormData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                cartContent.innerHTML = response.data;
                let products = document.querySelectorAll('.product-item');
                console.log(products.length);
                cartButton.textContent = `My cart(${products.length})`
            })
}
// document.body.addEventListener('click', function(event) {
//     console.log(event.target)
//     if (event.target.classList.contains('checkout')) {
//         let checkers = document.querySelectorAll('.checkout');
//         checkCheckers()
//         if(arrChecked != 0){
//         if (checkers.length == uniq_fast(arrChecked.split(",")).length - 1) {
//             checkMain.checked = true;
//         }
//     }
//     }
//     if (event.target.id == 'scales') {
//         let checkers = document.querySelectorAll('.checkout');
//         if (checkMain.checked == true) {
//             checkers.forEach(check => {
//                 check.checked = true;
//             })
//         } else {
//             checkers.forEach(check => {
//                 check.checked = false;
//             })
//         }
//     }
//     if (event.target.classList.contains('checkout')) {
//         if (event.target.checked == false) {
//             checkMain.checked = false;
//         }
//     }
//     if (event.target.classList.contains('btn-Delete-Submit')) {
//         deleteSolo.disabled = false;
//         modalTitle.textContent = "Delete row"
//         modalText.textContent = "Are you sure want to delete this row?"
//         deleteSolo.addEventListener('click', (e) => {
//             checkMain.checked = false;
//             e.preventDefault()
//             axios.get(`./includes/get_post.php?delete=${event.target.id}`).then(response => {
//                 tableData.innerHTML = response.data;
//             })
//         })
//     };
    // if (event.target.classList.contains('btn-add-submit')) {
    //         let default_count = 1;
    //         let id_product = event.target.dataset.id;
    //         let name_product = event.target.dataset.name;
    //         let price_product = event.target.dataset.price;
    //         let description_product = event.target.dataset.description;
//         let old_element = document.querySelector('.btn-modal-add-edit');
//         let type = old_element.cloneNode(true);
//         old_element.parentNode.replaceChild(type, old_element)
//         idItem.value = `${event.target.id}`;
//         name.value = event.target.parentElement.parentElement.parentElement.parentElement.children[1].children[0].textContent.trim()
//         lastname.value = event.target.parentElement.parentElement.parentElement.parentElement.children[1].children[1].textContent.trim()
//         status.checked = event.target.parentElement.parentElement.parentElement.parentElement.children[2].children[0].children[0].classList.contains('green')
//         role = event.target.parentElement.parentElement.parentElement.parentElement.children[3].children[0].textContent
//         title.textContent = 'Edit row'
//         type.textContent = `Save changes`;
//         type.addEventListener('click', (e) => {
//             e.preventDefault()
//             checkMain.checked = false;
            // buttonAddToCart.addEventListener('click', (e) => {
            // e.preventDefault()
            // let bodyFormData = new FormData();
            // bodyFormData.append('addid', id_product);
            // bodyFormData.append('name', name_product);
            // bodyFormData.append('description', description_product);
            // bodyFormData.append('price', price_product);
            // bodyFormData.append('count', default_count);
            // console.log(default_count);
            // axios({
            //     method: 'post',
            //     url: './includes/get_post.php',
            //     data: bodyFormData,
            //     headers: {
            //         'Content-Type': 'multipart/form-data'
            //     }
            // }).then(response => {
            //     cartContent.innerHTML = response.data;
            // })
            // }, {
            //     once: true
            // })
//         }, {
//             once: true
//         })
    // }
    // });
// addSolo.forEach(element => {
//     element.addEventListener('click', () => {
//         let old_element = document.querySelector('.btn-modal-add-edit');
//         let type = old_element.cloneNode(true);
//         old_element.parentNode.replaceChild(type, old_element)
//         name.value = ''
//         lastname.value = ''
//         status.checked = false
//         role = ''
//         title.textContent = 'Add row'
//         type.textContent = `Add row`;
//         checkMain.checked = false;
//         idItem.value = '';
//         type.addEventListener('click', (e) => {
//             console.log(1)
//             e.preventDefault()
//             let bodyFormData = new FormData();
//             bodyFormData.append('id', '')
//             bodyFormData.append('name', document.querySelector('.form-control[name="name"]').value);
//             bodyFormData.append('lastname', document.querySelector('.form-control[name="lastname"]').value);
//             bodyFormData.append('status', document.querySelector('.form-control[name="status"]').checked ? 'on' : '');
//             bodyFormData.append('role', document.querySelector('.form-control[name="role"]').value);
//             bodyFormData.append('addsolo', 1);
//             axios({
//                 method: 'post',
//                 url: './includes/get_post.php',
//                 data: bodyFormData,
//                 headers: {
//                     'Content-Type': 'multipart/form-data'
//                 }
//             }).then(response => {
//                 tableData.innerHTML = response.data;
//             })
//         }, {
//             once: true
//         })
//     })
// })

// for (let i = 0; i < ok.length; i++) {
//     ok[i].addEventListener('click', (ev) => {
//         checkCheckers();
//         console.log(arrChecked.length)
//         if (select[i].value == "Please select") {
//             modalTitle.textContent = "Oh no, something go wrong!!!"
//             modalText.textContent = "Please select action"
//             deleteSolo.disabled = true;
//         }else if(arrChecked.length == 0){
//             modalTitle.textContent = "Oh no, something go wrong!!!"
//             modalText.textContent = "Please select items"
//             deleteSolo.disabled = true
//         }else if (select[i].value == "Delete") {
//             deleteSolo.disabled = false;
//             modalTitle.textContent = "Delete rows"
//             modalText.textContent = "Are you sure want to delete rows?"
//             ev.target.setAttribute('data-toggle', 'modal')
//             deleteSolo.addEventListener('click', (e) => {
//                 e.preventDefault()
//                 checkMain.checked = false;
//                 console.log(arrChecked)
//                 axios.get(`./includes/get_post.php?deleteMany=${arrChecked}`).then(response => tableData.innerHTML = response.data)
//                 arrChecked = [];
//             }, {
//                 once: true
//             })
//         } else if (select[i].value == "Set active") {
//             deleteSolo.disabled = false;
//             modalTitle.textContent = "Set active"
//             modalText.textContent = "Are you sure want to set this rows active?"
//             ev.target.setAttribute('data-toggle', 'modal')
//             deleteSolo.addEventListener('click', (e) => {
//                 e.preventDefault();
//                 console.log(arrChecked)
//                 checkMain.checked = false;
//                 axios.get(`./includes/get_post.php?setActive=${arrChecked}`).then(response => tableData.innerHTML = response.data)
//                 arrChecked = [];
//             }, {
//                 once: true
//             })
//         } else if (select[i].value == "Set not active") {
//             deleteSolo.disabled = false;
//             modalTitle.textContent = "Set not active"
//             modalText.textContent = "Are you sure want to set this rows not active?"
//             ev.target.setAttribute('data-toggle', 'modal')
//             deleteSolo.addEventListener('click', (e) => {
//                 e.preventDefault();
//                 console.log(arrChecked)
//                 checkMain.checked = false;
//                 axios.get(`./includes/get_post.php?setNotActive=${arrChecked}`).then(response => tableData.innerHTML = response.data)
//                 arrChecked = [];
//             }, {
//                 once: true
//             })
//         }
//     })
// }

// function checkCheckers() {
//     let checkers = document.querySelectorAll('.checkout');
//     arrChecked = []
//     checkers.forEach(check => {
//         if (check.checked == true) {
//             arrChecked += `${check.id},`;
//         }
//     })
// }

// function uniq_fast(a) {
//     var seen = {};
//     var out = [];
//     var len = a.length;
//     var j = 0;
//     for (var i = 0; i < len; i++) {
//         var item = a[i];
//         if (seen[item] !== 1) {
//             seen[item] = 1;
//             out[j++] = item;
//         }
//     }
//     return out;
// }