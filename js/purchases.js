$(buscar_datos());

function buscar_datos(consulta, campo) {
        $.ajax({
           url: '../search-engines/purchases-search.php',
           type: 'POST',
           dataType: 'html',
           data: {'consulta-compra': consulta, 'campo-compra': campo},
        })
        .done(function(respuesta) {
           $("#datos-compras").html(respuesta);
           
           document.getElementById("tabla-compras").childNodes[1].childNodes[1].childNodes.forEach(child => {
                   child.addEventListener('click', function(){
                        if (this.textContent.includes(" ▼")) {
                                this.textContent = this.textContent.replace(" ▼", " ▲");
        
                                ordenar_datos(this.getAttribute("name"), "DESC")
                        } else {
                                if (!this.textContent.includes(" ▲")) {
                                        this.parentNode.childNodes.forEach(childTr => {
                                                if (childTr.textContent.includes(" ▼") || childTr.textContent.includes(" ▲")) {
                                                        childTr.textContent = childTr.textContent.substring(0, childTr.textContent.length - 1);
                                                }
                                        });
                                        
                                        this.textContent = this.textContent + " ▼";
                                } else {
                                        this.textContent = this.textContent.replace(" ▲", " ▼");
                                }
                                
                                ordenar_datos(this.getAttribute("name"), "ASC")
                        }
                   });
           });
        })
        .fail(function() {
            console.log("Error");
        })
}

function ordenar_datos(consulta, campo) {
        $.ajax({
           url: '../ordenadores/order_purchases.php',
           type: 'GET',
           dataType: 'html',
           data: {'campo-orden': consulta, 'asc-desc': campo},
        })
        .done(function(respuesta) {
                document.getElementById('body-tabla-compras').innerHTML=respuesta;
        })
        .fail(function() {
            console.log("Error");
        })
}

$("#buscar-compra").keyup(function(){
        var valor = $(this).val();
        var campo = document.getElementById("campo-compra").options[document.getElementById("campo-compra").selectedIndex].value;

        if(valor != ""){
          buscar_datos(valor, campo);
        } else {
          buscar_datos();
        }
});

document.getElementById('campo-compra').addEventListener('click', function(){
        var valor = document.getElementById("buscar-compra").value;
        var campo = this.options[this.selectedIndex].value;

        if(valor !== ""){
          buscar_datos(valor, campo);
        } else {
          buscar_datos();
        }
});

let checks = document.querySelectorAll('[id^=check]');

for(let i = 0; i < checks.length; i++) {
                checks[i].addEventListener('change', function(){
                        if (checks[i].checked) {
                                let input = document.createElement("input");
                                input.setAttribute("class", "quantity-input")
                                input.setAttribute("type", "number")
                                input.setAttribute("id", "quantity-"+i);
                                input.setAttribute("name", "quantities[]")
                                input.setAttribute("placeholder", "Cantidad")
                                checks[i].parentNode.parentNode.appendChild(input);
                        } else {
                                checks[i].parentNode.parentNode.removeChild(document.getElementById("quantity-"+i));
                        }
        });
};