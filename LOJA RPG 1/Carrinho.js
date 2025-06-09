
function updateCart() {
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    var cartDiv = document.getElementById('cart');
    var total = 0;
    cartDiv.innerHTML = '';
    cart.forEach(function(item, index) { /* Aqui ele pega todos os dados armazenados no carrinho (nome , preço e quantidade ) e calcula o preço total do produto , multiplicando o preço e a quantidade*/
        var itemDiv = document.createElement('div');
        itemDiv.textContent = item.name + ' - R$' + item.price + ' x ' + item.quantity;

        var removeButton = document.createElement('button');/* Aqui ele adiciona um botão chamado Remover para cada item, que rewmove o item que estiver no carrinho*/
        removeButton.textContent = 'Remover';
        removeButton.onclick = function() {
            removeFromCart(index);
        };
        itemDiv.appendChild(removeButton);

        var increaseButton = document.createElement('button');/* Aqui ele adiciona um botão que aumenta a quantidade do produto dentro do carrinho */
        increaseButton.textContent = '+';
        increaseButton.onclick = function() {
            increaseQuantity(index);
        };
        itemDiv.appendChild(increaseButton);

        var decreaseButton = document.createElement('button');/* Aqui ele adiciona um botão que diminui a quantidade do produto dentro do carrinho */
        decreaseButton.textContent = '-';
        decreaseButton.onclick = function() {
            decreaseQuantity(index);
        };
        itemDiv.appendChild(decreaseButton);

        cartDiv.appendChild(itemDiv);/* Aqui ele Calcula o total de todos os produtos no carrinho*/
        total += item.price * item.quantity;
    });
    document.getElementById('total').textContent = 'Total: R$ ' + total.toFixed(2);
}

updateCart();

function removeFromCart(index) {/*Aqui ele Atualiza os produtos que ficaram no carrinho , após de remover algum produto*/
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
}

function increaseQuantity(index) {/*Aqui ele Atualiza os produtos, após diminuir a quantidade de algum produto*/
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart[index].quantity++;
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
}

function decreaseQuantity(index) {/*Aqui ele Atualiza os produtos que ficaram no carrinho , após aumentar a quantidade de algum produto*/
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart[index].quantity > 1) {
        cart[index].quantity--;
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCart();
    }
}