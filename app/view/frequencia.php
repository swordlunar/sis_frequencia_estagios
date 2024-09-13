<?php
?>

<?php if($_SESSION['TIPO_USUARIO'] == 1){?>
    <div class="row mt-5">
        
        <div class="col-12 mt-5">
            <p class='h1'>Frequência</p>
            <div class="mt-5">
                <div class='row'>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <button class='col-12 btn btn-primary btn-block fa-lg gradient-custom-2'>Registrar horário</button>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <button class='col-12 btn btn-primary btn-block fa-lg gradient-custom-2'>Histórico de horários</button>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                    <!-- <label for="disabledTextInput" class="form-label">Setor:</label><div id='disabledTextInput' class="border border-success p-2">Clínica Cirúrgica</div> -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="Clínica Cirúrgica" disabled>
                            <label for="floatingInput">Setor:</label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="13/09/2024" disabled>
                            <label for="floatingInput">Dia:</label>
                        </div>
                    </div>
                </div>        
            </div>
            <div class="mt-5">
                <div class='row'>
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center bg-primary text-white">
                            <div class="card-header">Entrada</div>
                            <div class="card-body">
                                <p>16:15</p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">Intervalo</div>
                            <div class="card-body">
                                <p>Não registrado</p>
                            </div>
                        </div>
                    </div>          
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">Volta do Intervalo</div>
                            <div class="card-body">
                                <p>Não registrado</p>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">Saída</div>
                            <div class="card-body">
                               <p>Não registrado</p>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">2° Entrada</div>
                            <div class="card-body">
                                <p>Não registrado</p>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">2° Saída</div>
                            <div class="card-body">
                                <p>Não registrado</p>
                            </div>
                        </div>
                    </div>   
                </div>
                  
            </div>
        </div>

    </div>
<?php } 





?>