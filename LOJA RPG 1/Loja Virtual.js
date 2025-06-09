function addToCart(button) {/* Aqui ele determina a função do botão */
    var product = button.parentElement;/* Aqui é o lugar onde o botão irá pegar os dados do produto*/
    var productName = product.getAttribute('data-name');/*Aqui ele pega o nome do produto */
    var productPrice = parseFloat(product.getAttribute('data-price'));/* Aqui ele pega o preço do produto */
    var quantity = parseInt(product.querySelector('.quantity').textContent);/* Aqui ele pega a quantidade escolhida do produto*/

    var cartItem = {/*Aqui ele armazena os dados colhidos (Nome , Preço e Quantidade no carrinho) */
        name: productName,
        price: productPrice,
        quantity: quantity
    };
    
    var cart = JSON.parse(localStorage.getItem('cart')) || [];/*Aqui ele obtém o carrinho atual do localStorage*/
    cart.push(cartItem);/*Adiciona o item novo ao carrinho*/
    localStorage.setItem('cart', JSON.stringify(cart));/*Atualiza o carrinho no localStorage com o novo item*/
    
}


function increaseQuantity(button) {/*Esse botão faz você aumentar a quantidade dos itens */
    var quantityElement = button.parentElement.querySelector('.quantity');
    var quantity = parseInt(quantityElement.textContent);
    quantityElement.textContent = quantity + 1;
}

function decreaseQuantity(button) {/*Esse botão faz você diminuir a quantidade  */
    var quantityElement = button.parentElement.querySelector('.quantity');
    var quantity = parseInt(quantityElement.textContent);
    if (quantity > 0) {
        quantityElement.textContent = quantity - 1;
    }
}


  function toggleDescription() {
    var description = document.getElementById("description");
    if (description.style.display === "none") {
      description.style.display = "block";
    } else {
      description.style.display = "none";
    }
  }