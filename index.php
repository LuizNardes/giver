<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row bg-dark">
            <div class="col-lg-12">
                <p class="text-center text-light fs-1 mt-1">
                    Upload
                </p>
            </div>
        </div>

        <div class="row mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nova lista Customers</h5>
                    <form id="formulario" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input class="form-control" type="file" id="formFile" name="file">
                        </div>
                        <button class="btn btn-danger float-end">Enviar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gênero</th>
                            <th scope="col">IP Address</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Título</th>
                            <th scope="col">Site</th>
                        </tr>
                    </thead>
                    <tbody id="tabela"></tbody>
                </table>
            </div>
        </div>

        <div id="teste">

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script>

    $('#formulario').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "importar.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                alert(data);
                if(data == 'Sucesso'){
                    consulta();
                }

            }
        })
    });


    function consulta() {
        $.ajax({         
			url: 'consulta.php',
			type: 'post',
			datatype:"json",
			success: function(data){
                /* $('#teste').html(data); */
			    var resposta = JSON.parse(data);
				var qtd_resposta = Object.keys(resposta).length;
				var cols = "";

                for (var i = 0; i < qtd_resposta; i++) {

                    cols = '<tr>';
                        cols += `<th scope='row'>${resposta[i].id}`;
                        cols += `<td>${resposta[i].first_name} ${resposta[i].last_name}</td>`;      
                        cols += `<td>${resposta[i].email}</td>`;    
                        cols += `<td>${resposta[i].gender}</td>`;    
                        cols += `<td>${resposta[i].ip_address}</td>`;    
                        cols += `<td>${resposta[i].company}</td>`;    
                        cols += `<td>${resposta[i].city}</td>`;    
                        cols += `<td>${resposta[i].title}</td>`;    
                        cols += `<td>${resposta[i].website}</td>`;    
                    cols += '</tr>';                    
                    $("#tabela").append(cols);
                }
         	}
        });
    }
     


  /*       
 */

    </script>
</body>

</html>