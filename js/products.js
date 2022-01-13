$(buscar_datos());

function buscar_datos(consulta, campo) {
        $.ajax({
           url: '../search-engines/products-search.php',
           type: 'POST',
           dataType: 'html',
           data: {'consulta-producto': consulta, 'campo-producto': campo},
        })
        .done(function(respuesta) {
           $("#datos-productos").html(respuesta);
           
           document.getElementById("tabla-productos").childNodes[1].childNodes[1].childNodes.forEach(child => {
                   if (child.textContent !== "Imagen") {
                           child.addEventListener('click', function(){
                                if (this.textContent.includes(" ▼")) {
                                        this.textContent = this.textContent.replace(" ▼", " ▲");
                
                                        ordenar_datos(this.getAttribute("name"), "DESC")
                                } else {
                                        if (!this.textContent.includes(" ▲")) {
                                                this.parentNode.childNodes.forEach(childTr => {
                                                        if (child.textContent !== "Imagen" && (childTr.textContent.includes(" ▼") || childTr.textContent.includes(" ▲"))) {
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
                   }
           });
        })
        .fail(function() {
            console.log("Error");
        })
}

function ordenar_datos(consulta, campo) {
        $.ajax({
           url: '../ordenadores/order_products.php',
           type: 'GET',
           dataType: 'html',
           data: {'campo-orden': consulta, 'asc-desc': campo},
        })
        .done(function(respuesta) {
                document.getElementById('body-tabla-productos').innerHTML=respuesta;
        })
        .fail(function() {
            console.log("Error");
        })
}

$("#buscar-producto").keyup(function(){
        var valor = $(this).val();
        var campo = document.getElementById("campo-producto").options[document.getElementById("campo-producto").selectedIndex].value;

        if(valor != ""){
          buscar_datos(valor, campo);
        } else {
          buscar_datos();
        }
});

document.getElementById('campo-producto').addEventListener('click', function(){
        var valor = document.getElementById("buscar-producto").value;
        var campo = this.options[this.selectedIndex].value;

        if(valor != ""){
          buscar_datos(valor, campo);
        } else {
          buscar_datos();
        }
});