async function listar_calcados(){
    
    let main = document.getElementById("principal");
    let total = document.getElementById("total");

    console.log(main);

    let dados_php = await fetch('./select_calcados.php');

    let response = await dados_php.json();

    
    total.innerText = response.length;

    html = '';

    for(var i = 0; i< response.length; i++){

        html += `
        <div id="cards"> 
				<div id="produto">
					<img src=${response[i].foto}>
				</div>
				<div id="desc">
                    <h3>${response[i].nome} </h3>
					<a id="news" href="https://www.netshoes.com.br"> LANÇAMENTO </a>
					<h3>Tenis Nike Shox</h3>
					<p id="preco">R$ ${response[i].preco}</p>
					<p id="preco">ou 10x de 109,90</p>
					<p id="preco">Estoque: ${response[i].quantidade}</p>
				</div>
			</div>
        `;
    }

    main.innerHTML = html;

}