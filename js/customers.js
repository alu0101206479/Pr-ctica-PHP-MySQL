$(buscar_datos());

function buscar_datos(consulta, campo) {
        $.ajax({
           url: '../search-engines/customers-search.php',
           type: 'POST',
           dataType: 'html',
           data: {'consulta-cliente': consulta, 'campo-cliente': campo},
        })
        .done(function(respuesta) {
           $("#datos-clientes").html(respuesta);
           
           document.getElementById("tabla-clientes").childNodes[1].childNodes[1].childNodes.forEach(child => {
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
           url: '../ordenadores/order_clients.php',
           type: 'GET',
           dataType: 'html',
           data: {'campo-orden': consulta, 'asc-desc': campo},
        })
        .done(function(respuesta) {
                document.getElementById('body-tabla-cliente').innerHTML=respuesta;
        })
        .fail(function() {
            console.log("Error");
        })
}


$("#buscar-cliente").keyup(function(){
        var valor = $(this).val();
        var campo = document.getElementById("campo-cliente").options[document.getElementById("campo-cliente").selectedIndex].value;

        if(valor != ""){
          buscar_datos(valor, campo);
        } else {
          buscar_datos();
        }
});